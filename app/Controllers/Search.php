<?php

namespace App\Controllers;

class Search extends BaseController
{
    public function probis()
    {
        # Com a cadeia de referencia marcada o campo de residuos vem vazio: o
        # sitio e montado aqui, a partir da estrutura.
        $usa_referencia = (bool) $this->request->getPost("use_reference");
        $cadeia_ref = $this->nome_seguro((string) $this->request->getPost("ref_chain"), 1);

        # O usuario pode enviar a propria estrutura em vez de informar um codigo
        $enviado = $this->request->getFile("pdb_file");
        $tem_upload = ($enviado !== null and $enviado->isValid() and !$enviado->hasMoved() and $enviado->getSize() > 0);

        if (!isset($_POST["search_binding_sites"]) || !isset($_POST["chain"])
            || (!isset($_POST["pdb"]) && !$tem_upload)
            || (!isset($_POST["residues"]) && !$usa_referencia)) {
            redirect("/explore");
        }

        # Escolheu um arquivo mas ele nao chegou inteiro (tamanho acima do limite
        # do PHP, envio interrompido): explica em vez de cair no download.
        if ($enviado !== null and $enviado->getError() !== UPLOAD_ERR_NO_FILE and !$tem_upload) {
            return redirect()->back()->with(
                'error',
                '<strong>Upload failed.</strong> ' . esc($enviado->getErrorString())
            );
        }

        $data = array();

        # ********************* Receiving post data *********************
        # Nomes vao para dentro de um comando de shell: so letras e numeros.
        if ($tem_upload) {
            $data['pdb'] = $this->nome_seguro(pathinfo($enviado->getClientName(), PATHINFO_FILENAME), 32, 'query');
        } else {
            $data['pdb'] = $this->nome_seguro((string) $this->request->getPost("pdb"), 4);
        }
        $data['chain'] = $this->nome_seguro((string) $this->request->getPost("chain"), 1);
        $data['residues'] = $this->processa_residuos((string) $this->request->getPost("residues"));

        if ($data['pdb'] === '' or $data['chain'] === '') {
            return redirect()->back()->with(
                'error',
                '<strong>Missing data.</strong> Inform a PDB code (or upload a structure) and the target chain.'
            );
        }

        # Confere o arquivo enviado antes de criar a pasta do projeto
        if ($tem_upload) {
            if (!in_array(strtolower($enviado->getClientExtension()), ['pdb', 'ent'])) {
                return redirect()->back()->with(
                    'error',
                    '<strong>Unsupported file.</strong> Send the structure in PDB format (.pdb or .ent).'
                );
            }
            if ($enviado->getSize() > 20 * 1024 * 1024) {
                return redirect()->back()->with(
                    'error',
                    '<strong>File too large.</strong> The structure must be at most 20 MB.'
                );
            }
        }

        # ********************* Create new ID *********************
		$id = $this->generateRandomString(6);
        $data['id'] = $id;
		
		# Read directory
		if (file_exists('../public/data/projects')) { chdir('../public/data/projects'); }
		else{ chdir('../data/projects'); }
		
		$arquivos = glob("{*}", GLOB_BRACE);

		# Is the id unique? If not, create a new!
		for($i = 0; $i < (count($arquivos)); $i++){
			if($arquivos[$i] == $id){
				$id = $this->generateRandomString(6);
				$i = 0;
			}
		}

		# Create project folder 
		mkdir("../../../public/data/projects/$id");
		chmod("../../../public/data/projects/$id", 0777);        

        $save_dir = FCPATH . "data/projects/{$id}/";
        $save_path = $save_dir . "{$data['pdb']}.pdb";

        if ($tem_upload) {
            // estrutura enviada pelo usuário
            // o nome do arquivo gravado vem de nome_seguro(), nunca do usuário
            $enviado->move($save_dir, "{$data['pdb']}.pdb", true);

            if (!$this->tem_coordenadas($save_path)) {
                return $this->cancela(
                    $save_dir,
                    '<strong>No coordinates found.</strong> The file does not contain ATOM records in PDB format.'
                );
            }
        } else {
            // download pdb
            // URL da API REST do RCSB PDB
            $url = "https://files.rcsb.org/download/{$data['pdb']}.pdb";

            // Faz a requisição
            $response = @file_get_contents($url);
            if ($response === FALSE) {
                return $this->cancela(
                    $save_dir,
                    '<strong>Structure not found.</strong> ' . esc($data['pdb']) . ' could not be downloaded from the RCSB PDB. Check the code or upload the structure yourself.'
                );
            }

            // grava no diretório
            file_put_contents($save_path, $response);
        }

        // Cadeia de referência: o sítio de ligação é formado pelos resíduos da
        // cadeia alvo que estão a 6 Å ou menos da cadeia de referência — o mesmo
        // critério dos resíduos de interface listados em cada entrada.
        if ($usa_referencia and $cadeia_ref !== '') {
            $data['residues'] = $this->residuos_na_interface($save_path, $data['chain'], $cadeia_ref);

            if ($data['residues'] === '') {
                return $this->cancela(
                    $save_dir,
                    '<strong>No binding site found.</strong> No residue of chain ' . esc($data['chain'])
                    . ' lies within 6 Å of chain ' . esc($cadeia_ref) . ' in ' . esc($data['pdb'])
                    . '. Check the chain identifiers.'
                );
            }
        }

        if ($data['residues'] === '') {
            return $this->cancela(
                $save_dir,
                '<strong>No residues informed.</strong> Type the binding site residues or indicate a reference chain.'
            );
        }

        // grava info no diretório
        // Caminho do arquivo CSV
        $info = $save_dir . "info.csv";

        // Abre o arquivo para escrita (sobrescreve se já existir)
        $fp = fopen($info, 'w');
        if ($fp === false) {
            throw new \RuntimeException("Não foi possível criar o arquivo: {$info}");
        }

        fputcsv($fp, [
            $data['pdb'],
            $data['chain'],
            $data['residues']
        ], ';');
        fclose($fp);

        // PROBIS
        // passo 1 - converte entrada num arquivo 'probis'
        $comando = "probis -extract -f1 {$save_dir}{$data['pdb']}.pdb -c1 {$data['chain']} -motif \[:{$data['chain']} and {$data['residues']}]\ -srffile {$save_dir}query.srf > {$save_dir}conversao.log";

        system($comando);

        // passo 2 - roda o probis para buscar proteínas com sítio de ligação similar
        $probis_db = "/home/liase/www/propedia26/public/data/db/probis/propedia26_srf.csv";
        $comando2 = "nohup probis -ncpu 5 -longnames -surfdb -local -sfile {$probis_db} -f1 {$save_dir}query.srf -c1 A -nosql {$save_dir}result.nosql > {$save_dir}busca.log &";

        system($comando2);

        // muda as permissões de segurança
        chmod("../../../public/data/projects/$id", 0755);

        // carrega view - aguardando processamento
        return view("running", $data);
    }

    public function project($id): string{
        $data = [];

        $save_dir = FCPATH . "data/projects/{$id}/";
        $fileinfo = $save_dir . "info.csv";

        if (!file_exists($fileinfo)) {
            throw new \RuntimeException("Arquivo não encontrado: {$fileinfo}");
        }

        # o probis so grava o nosql ao final da busca - pode nao existir ainda
        $nosql = $save_dir . "result.nosql";
        if (file_exists($nosql)) { chmod($nosql, 0755); }

        $dados = [];
        if (($fp = fopen($fileinfo, 'r')) !== false) {
            $dados = fgetcsv($fp, 0, ';');
            fclose($fp);
        }

        $logfile = $save_dir . 'busca.log';
        $ini_time = file_exists($logfile) ? filemtime($logfile) : filemtime($fileinfo);
        $data['created'] = date('Y-m-d H:i', $ini_time);
        if ((time() - $ini_time) > 1000) {
            $data['is_running'] = 'ready';
        }
        else{
            $data['is_running'] = '<i class="bi bi-gear-fill spin text-primary"></i><span class="ms-1 text-primary">running</span>';
        }

        $resultcsv = $save_dir . "result.csv";

        if($data['is_running'] != 'ready'){
            system("python ../app/ThirdParty/nosql_to_csv.py {$save_dir}result.nosql {$save_dir}"); # recria o arquivo a cada refresh
        }

        $result = [];
        if (file_exists($resultcsv) && ($fp = fopen($resultcsv, 'r')) !== false) {
            // Lê o cabeçalho (primeira linha)
            $cabecalho = fgetcsv($fp, 0, ';');
            // Lê cada linha e monta array associativo
            while (($linha = fgetcsv($fp, 0, ';')) !== false) {
                if ($cabecalho !== false && count($cabecalho) === count($linha)) {
                    $result[] = array_combine($cabecalho, $linha);
                }
            }
            fclose($fp);
        }

        $data['id'] = $id;
        $data['pdb'] = $dados[0] ?? '';
        $data['chain'] = $dados[1] ?? '';
        $data['residues'] = $dados[2] ?? '';
        $data['status'] = 1;
        $data['log'] = 'ok';
        $data['results'] = $result;

        # conta os complexos encontrados (antes contava as linhas do arquivo, incluindo o cabeçalho)
        $data['cont_results'] = count($result);

        # sem nenhum complexo: a busca terminou sem resultados ou ainda esta rodando.
        # a view probis espera ao menos um resultado ($results[0]) para montar os visualizadores.
        if ($data['cont_results'] === 0) {
            return view("probis_empty", $data);
        }

        return view("probis",$data);
    }

    private function generateRandomString($size): string {
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$randomString = '';
		for($i = 0; $i < $size; $i = $i+1){
			$randomString .= $chars[mt_rand(0,35)];
		}
		return $randomString;
	}

    private function cancela(string $save_dir, string $mensagem) {
        # Busca interrompida: apaga a pasta recem-criada para nao acumular
        # projetos vazios e volta com a mensagem de erro.
        if (is_dir($save_dir)) {
            foreach (glob($save_dir . '*') as $arquivo) {
                if (is_file($arquivo)) {
                    @unlink($arquivo);
                }
            }
            @rmdir($save_dir);
        }

        return redirect()->back()->with('error', $mensagem);
    }

    private function nome_seguro(string $valor, int $tamanho, string $padrao = ''): string {
        # Mantem apenas letras e numeros: esses valores entram em um comando de
        # shell e no nome de um arquivo.
        $limpo = preg_replace('/[^A-Za-z0-9]/', '', $valor);
        $limpo = substr($limpo, 0, $tamanho);

        return ($limpo === '') ? $padrao : $limpo;
    }

    private function tem_coordenadas(string $arquivo): bool {
        # O arquivo enviado precisa ter registros ATOM no formato PDB
        if (!file_exists($arquivo)) {
            return false;
        }

        $handle = fopen($arquivo, 'r');
        if ($handle === false) {
            return false;
        }

        $tem = false;
        while (($linha = fgets($handle)) !== false) {
            if (strncmp($linha, 'ATOM  ', 6) === 0) {
                $tem = true;
                break;
            }
        }
        fclose($handle);

        return $tem;
    }

    private function residuos_na_interface(string $arquivo, string $chain, string $chain_ref, float $corte = 6.0): string {
        # Residuos de $chain com pelo menos um atomo a $corte angstroms ou menos
        # de $chain_ref. Le as colunas fixas do formato PDB: 22 = cadeia,
        # 23-26 = numero do residuo, 31-54 = coordenadas x, y e z.
        if (!file_exists($arquivo)) {
            return '';
        }

        $handle = fopen($arquivo, 'r');
        if ($handle === false) {
            return '';
        }

        $alvo = [];      # [numero do residuo, x, y, z]
        $referencia = [];

        while (($linha = fgets($handle)) !== false) {
            if (strncmp($linha, 'ATOM  ', 6) !== 0) {
                continue;
            }

            $cadeia = substr($linha, 21, 1);
            if ($cadeia !== $chain and $cadeia !== $chain_ref) {
                continue;
            }

            $atomo = [
                (int) trim(substr($linha, 22, 4)),
                (float) substr($linha, 30, 8),
                (float) substr($linha, 38, 8),
                (float) substr($linha, 46, 8),
            ];

            if ($cadeia === $chain) {
                $alvo[] = $atomo;
            } else {
                $referencia[] = $atomo;
            }
        }
        fclose($handle);

        if (empty($alvo) or empty($referencia)) {
            return '';
        }

        $corte2 = $corte * $corte;
        $residuos = [];
        foreach ($alvo as $a) {
            if (isset($residuos[$a[0]])) {
                continue; # residuo ja incluido
            }
            foreach ($referencia as $b) {
                $dx = $a[1] - $b[1];
                $dy = $a[2] - $b[2];
                $dz = $a[3] - $b[3];
                if (($dx * $dx + $dy * $dy + $dz * $dz) <= $corte2) {
                    $residuos[$a[0]] = true;
                    break;
                }
            }
        }

        $numeros = array_keys($residuos);
        sort($numeros, SORT_NUMERIC);

        return implode(',', $numeros);
    }

    private function processa_residuos(string $input): string {
        $nums = [];
        foreach (preg_split('/\s*,\s*/', trim($input)) as $part) {
            if (strpos($part, '-') !== false) {
                [$a, $b] = array_map('intval', explode('-', $part, 2));
                $nums = array_merge($nums, range($a, $b));
            } elseif (is_numeric($part)) {
                $nums[] = (int)$part;
            }
        }
        return implode(',', $nums);
    }

}
