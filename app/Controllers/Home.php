<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        # BUSCAR DADOS ESTATÍSTICOS
		$data = array();

        $url = "./data/pdb/total_contacts2.txt";

        $data['h1'] = "93,151";
        $data['h2'] = "73,392";
        $data['h3'] = "38,218";
        $data['h4'] = "19,759";

        $data['update'] = 'Apr 6, 2026';

        if (file_exists($url)) {
            # se houver um arquivo de configuração, atualize os valores
            $file_handle = fopen($url, 'r');
            if($file_handle) {
                $current_line = 1;
                while (($line = fgets($file_handle)) !== false) {
                    switch($current_line){
                        case 1: $data['h2'] = number_format((int)$line, 0, '', ','); $current_line++; break;
                        case 2: $data['h3'] = number_format($line, 0, '', ','); $current_line++; break;
                        case 3: $data['h1'] = number_format($line, 0, '', ','); $current_line++; break;
                        case 4: $data['h4'] = number_format($line, 0, '', ','); $current_line++; break;
                        case 5: $data['update'] = $line; $current_line++; break;
                    }
                }
                fclose($file_handle);
            } else {
                echo "Error.";
            }
        }

        return view('home', $data);
    }

    public function documentation(): string
    {
        return view('documentation');
    }

    public function download(): string
    {
        return view('download');
    }

    public function blast(): string
    {
        return view('blast');
    }

    public function explore(): string
    {
        return view('explore');
    }

    # Arquivo resumido da base, lido pela pagina Explore.
    # 25 colunas separadas por TAB, sem cabecalho, ordenado por id:
    #   0 id  1 PROTEIN_SIZE  2 PEPTIDE_SIZE  3 PEPTIDE_SEQ  4 TITLE
    #   5 CLASSIFICATION  6 is_leader  7 leader_id
    #   8 PISA_n_hbonds  9 PISA_n_saltbridges  10 BSA  11 BPP%
    #  12 RESOLUTION  13 STRUCTURE_METHOD  14 peptide_HydrophobicPercent
    #  15 peptide_PositiveResidues  16-21 AAP ABP ACP AIP QSP SBP
    #  22 PISA_CSS  23 binding affinity  24 PISA_diss_energy
    private const EXPLORE_ARQUIVO = 'data/propedia26_v17.tsv';
    private const EXPLORE_COLUNAS_EXIBIDAS = 8;
    private const EXPLORE_CLASSES = ['AAP' => 16, 'ABP' => 17, 'ACP' => 18, 'AIP' => 19, 'QSP' => 20, 'SBP' => 21];

    # Endpoint de dados do Explore (DataTables server-side): le o TSV, aplica
    # busca/filtros/ordenacao/paginacao e devolve apenas a pagina pedida. Evita
    # carregar os 16 MB do arquivo no navegador.
    public function exploreData()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(60);

        $req    = $this->request;
        $draw   = (int) $req->getGet('draw');
        $start  = max(0, (int) $req->getGet('start'));
        $length = (int) $req->getGet('length');
        if ($length <= 0) {
            $length = 10;
        }

        $busca = strtolower(trim(($req->getGet('search')['value'] ?? '')));

        $ordem    = $req->getGet('order');
        $coluna   = (int) ($ordem[0]['column'] ?? 0);
        $direcao  = (($ordem[0]['dir'] ?? 'asc') === 'desc') ? 'desc' : 'asc';

        $filtros   = $this->exploreFiltros($req);
        $temFiltro = !empty($filtros) || $busca !== '';

        $arquivo  = FCPATH . self::EXPLORE_ARQUIVO;
        $resposta = ['draw' => $draw, 'recordsTotal' => 0, 'recordsFiltered' => 0, 'data' => []];

        if (!file_exists($arquivo) || ($handle = fopen($arquivo, 'r')) === false) {
            return $this->response->setJSON($resposta);
        }

        # Caminho rapido: sem filtros e na ordenacao padrao (id crescente, que e
        # a ordem do arquivo), le so a janela pedida.
        if (!$temFiltro && $coluna === 0 && $direcao === 'asc') {
            $total = 0;
            $fim   = $start + $length;
            $dados = [];
            while (($linha = fgets($handle)) !== false) {
                $linha = rtrim($linha, "\r\n");
                if ($linha === '') {
                    continue;
                }
                if ($total >= $start && $total < $fim) {
                    $dados[] = array_slice(explode("\t", $linha), 0, self::EXPLORE_COLUNAS_EXIBIDAS);
                }
                $total++;
            }
            fclose($handle);

            $resposta['recordsTotal']    = $total;
            $resposta['recordsFiltered'] = $total;
            $resposta['data']            = $dados;
            return $this->response->setJSON($resposta);
        }

        # Caminho geral: filtra em streaming, guardando [chave de ordenacao, linha]
        $numerica     = in_array($coluna, [1, 2], true); # PROTEIN_SIZE e PEPTIDE_SIZE
        $total        = 0;
        $selecionadas = [];

        while (($linha = fgets($handle)) !== false) {
            $linha = rtrim($linha, "\r\n");
            if ($linha === '') {
                continue;
            }
            $total++;

            if ($busca !== '' && strpos(strtolower($linha), $busca) === false) {
                continue;
            }

            $colunas = explode("\t", $linha);
            if (count($colunas) < 25) {
                continue;
            }
            if (!$this->exploreAceita($colunas, $filtros)) {
                continue;
            }

            $chave          = $numerica ? (float) $colunas[$coluna] : strtolower($colunas[$coluna]);
            $selecionadas[] = [$chave, $colunas];
        }
        fclose($handle);

        $filtradas = count($selecionadas);

        if (!($coluna === 0 && $direcao === 'asc')) {
            usort($selecionadas, function ($a, $b) use ($numerica, $direcao) {
                $cmp = $numerica ? ($a[0] <=> $b[0]) : strcmp($a[0], $b[0]);
                return $direcao === 'asc' ? $cmp : -$cmp;
            });
        }

        $dados = [];
        foreach (array_slice($selecionadas, $start, $length) as $item) {
            $dados[] = array_slice($item[1], 0, self::EXPLORE_COLUNAS_EXIBIDAS);
        }

        $resposta['recordsTotal']    = $total;
        $resposta['recordsFiltered'] = $filtradas;
        $resposta['data']            = $dados;
        return $this->response->setJSON($resposta);
    }

    # Exporta em CSV todas as linhas que passam pelos filtros correntes (e nao
    # apenas a pagina exibida), com as 25 colunas do arquivo.
    public function exploreExport()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(120);

        $req     = $this->request;
        $busca   = strtolower(trim((string) $req->getGet('search')));
        $filtros = $this->exploreFiltros($req);

        $cabecalho = [
            'id', 'PROTEIN_SIZE', 'PEPTIDE_SIZE', 'PEPTIDE_SEQ', 'TITLE', 'CLASSIFICATION',
            'is_leader', 'leader_id', 'PISA_n_hbonds', 'PISA_n_saltbridges', 'BSA', 'BPP%',
            'RESOLUTION', 'STRUCTURE_METHOD', 'peptide_HydrophobicPercent', 'peptide_PositiveResidues',
            'AAP', 'ABP', 'ACP', 'AIP', 'QSP', 'SBP', 'PISA_CSS',
            'predicted_binding_affinity', 'PISA_diss_energy',
        ];

        $arquivo = FCPATH . self::EXPLORE_ARQUIVO;

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="propedia26_explore.csv"');
        $saida = fopen('php://output', 'w');
        fputcsv($saida, $cabecalho, ',', '"', "\\");

        if (file_exists($arquivo) && ($handle = fopen($arquivo, 'r')) !== false) {
            while (($linha = fgets($handle)) !== false) {
                $linha = rtrim($linha, "\r\n");
                if ($linha === '') {
                    continue;
                }
                if ($busca !== '' && strpos(strtolower($linha), $busca) === false) {
                    continue;
                }
                $colunas = explode("\t", $linha);
                if (count($colunas) < 25 || !$this->exploreAceita($colunas, $filtros)) {
                    continue;
                }
                fputcsv($saida, $colunas, ',', '"', "\\");
            }
            fclose($handle);
        }

        fclose($saida);
        exit;
    }

    # Le os filtros da requisicao, guardando apenas os que foram preenchidos
    private function exploreFiltros($req): Array
    {
        $numero = function ($nome) use ($req) {
            $valor = $req->getGet($nome);
            return ($valor === null || trim((string) $valor) === '') ? null : (float) $valor;
        };
        $texto = function ($nome) use ($req) {
            return trim((string) ($req->getGet($nome) ?? ''));
        };
        $marcado = function ($nome) use ($req) {
            $valor = (string) ($req->getGet($nome) ?? '');
            return ($valor === '1' || $valor === 'true');
        };

        $filtros = [
            'minSize'        => $numero('minSize'),
            'maxSize'        => $numero('maxSize'),
            'classificacao'  => $texto('classification'),
            'aminoacidos'    => $texto('aminoAcids'),
            'semRedundancia' => $marcado('onlyUnique'),
            'minHbonds'      => $numero('minHbonds'),
            'pontes'         => $texto('saltBridges'),
            'minBsa'         => $numero('minBsa'),
            'minBpp'         => $numero('minBpp'),
            'maxResolucao'   => $numero('maxResolution'),
            'metodo'         => $texto('method'),
            'evidencia'      => $texto('interfaceEvidence'),
            'minHidrofobico' => $numero('minHydrophobic'),
            'minPositivos'   => $numero('minPositive'),
            'classe'         => $texto('therapeutic'),
            'minClasse'      => $numero('minTherapeutic'),
            'maxAfinidade'   => $numero('maxAffinity'),
            'minDiss'        => $numero('minDiss'),
        ];

        # descarta o que nao foi preenchido, para saber se ha filtro ativo
        return array_filter($filtros, function ($valor) {
            return $valor !== null && $valor !== '' && $valor !== false;
        });
    }

    # Um valor vazio no arquivo nunca satisfaz um filtro numerico
    private function exploreForaDoMinimo($valor, $limite): bool
    {
        if ($limite === null) {
            return false;
        }
        return ($valor === '' || $valor === null) ? true : ((float) $valor < $limite);
    }

    private function exploreForaDoMaximo($valor, $limite): bool
    {
        if ($limite === null) {
            return false;
        }
        return ($valor === '' || $valor === null) ? true : ((float) $valor > $limite);
    }

    private function exploreAceita(Array $c, Array $f): bool
    {
        # tamanho do peptideo, classificacao e caixas de selecao
        if ($this->exploreForaDoMinimo($c[2], $f['minSize'] ?? null)) { return false; }
        if ($this->exploreForaDoMaximo($c[2], $f['maxSize'] ?? null)) { return false; }
        if (!empty($f['classificacao']) && trim($c[5]) !== $f['classificacao']) { return false; }
        if (!empty($f['aminoacidos'])) {
            $temX = (strpos(strtolower($c[3]), 'x') !== false);
            if ($f['aminoacidos'] === 'canonical' && $temX) { return false; }
            if ($f['aminoacidos'] === 'noncanonical' && !$temX) { return false; }
        }
        if (!empty($f['semRedundancia']) && strtolower(trim($c[6])) !== 'yes') { return false; }

        # interface
        if ($this->exploreForaDoMinimo($c[8], $f['minHbonds'] ?? null)) { return false; }
        if (!empty($f['pontes'])) {
            # sem valor do PISA nao da para afirmar nem uma coisa nem outra
            $temValor = (trim($c[9]) !== '');
            if ($f['pontes'] === 'with' && !($temValor && (float) $c[9] > 0)) { return false; }
            if ($f['pontes'] === 'without' && !($temValor && (float) $c[9] == 0)) { return false; }
        }
        if ($this->exploreForaDoMinimo($c[10], $f['minBsa'] ?? null)) { return false; }
        if ($this->exploreForaDoMinimo($c[11], $f['minBpp'] ?? null)) { return false; }

        # estrutura
        if ($this->exploreForaDoMaximo($c[12], $f['maxResolucao'] ?? null)) { return false; }
        if (!empty($f['metodo']) && trim($c[13]) !== $f['metodo']) { return false; }
        if (!empty($f['evidencia'])) {
            # CSS do PISA: a partir de 0.5 a interface sustenta a montagem,
            # 0 = nenhum papel. Vazio = o PISA nao avaliou (so ha valor para difracao).
            $css = trim($c[22]);
            $temCss = ($css !== '');
            if ($f['evidencia'] === 'not_assessed' && $temCss) { return false; }
            if ($f['evidencia'] === 'strong' && !($temCss && (float) $css >= 0.5)) { return false; }
            if ($f['evidencia'] === 'moderate' && !($temCss && (float) $css > 0 && (float) $css < 0.5)) { return false; }
            if ($f['evidencia'] === 'weak' && !($temCss && (float) $css == 0)) { return false; }
        }

        # peptideo
        if ($this->exploreForaDoMinimo($c[14], $f['minHidrofobico'] ?? null)) { return false; }
        if ($this->exploreForaDoMinimo($c[15], $f['minPositivos'] ?? null)) { return false; }
        if (!empty($f['classe']) && isset(self::EXPLORE_CLASSES[$f['classe']])) {
            $corte = $f['minClasse'] ?? 0.9; # padrao adotado no site
            if ($this->exploreForaDoMinimo($c[self::EXPLORE_CLASSES[$f['classe']]], $corte)) { return false; }
        }

        # energias (preditas)
        if ($this->exploreForaDoMaximo($c[23], $f['maxAfinidade'] ?? null)) { return false; }
        if ($this->exploreForaDoMinimo($c[24], $f['minDiss'] ?? null)) { return false; }

        return true;
    }

    private function getInfo($id): Array 
    {
        $first_letter = substr($id, 0, 1);
        $url = "./data/pdb/$first_letter/$id/$id"."_info.csv";

        if (!file_exists($url)) {
            return ["File not exist."];
        }

        $file_handle = fopen($url, 'r');
        $lines = "";
        if($file_handle) {
            while (($line = fgets($file_handle)) !== false) {
                $lines = $lines.$line;
            }
            fclose($file_handle);
        } else {
            echo "Error.";
        }
        
        $info = explode(",", $lines);
        return $info;
    }


    private function getContacts($id): Array 
    {
        $contacts = [];
        $first_letter = substr($id, 0, 1);

        # contacts
        $url = "./data/pdb/$first_letter/$id/$id"."_contacts.csv";
        if (!file_exists($url)) {
            return ["File not exist."];
        }
        $file_handle = fopen($url, 'r');
        if ($file_handle) {
            while (($line = fgets($file_handle)) !== false) {
                array_push($contacts,$line);
            }
            fclose($file_handle);
        } else {
            echo "Error.";
        }
        
        return $contacts;
    }

    public function entry($id): string
    {
        $data = [];
        $data['id'] = $id;

        // código inexistente
        if(strlen($id) != 4){
            return view('404', $data);
        }

        // pega informações básicas
        $data['info'] = $this->getInfo($id);
        if($data['info'][0] == "File not exist."){
            return view('404', $data);
        }
        $data['total_results'] = $data['info'][3];
        // pega informações de contatos
        $data['contacts'] = $this->getContacts($id);

        return view('entry', $data);
    }

}
