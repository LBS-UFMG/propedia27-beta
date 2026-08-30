<?php

namespace App\Controllers;

class Entry extends BaseController
{
    public function id(){
        return view('explore');
	}

    // ********************************************* PEP-PRO *********************************************
    public function entry($id = null){

        $data = [];

        $modo = 'db'; // db
        $arquivo = "data/$modo/csv/".$id[0].'/'.$id.".csv";

        // Verifique se o arquivo existe
        if (!file_exists($arquivo)) {
            $modo = 'examples'; // se o arquivo nao existir, carrega a base de exemplo
            $arquivo = "data/$modo/csv/".$id[0].'/'.$id.".csv";
        }
        if (!file_exists($arquivo)) {
            return view('404');
        }

        $data['db'] = "$modo";
        $data['id'] = $id;

        $data['pdb_id'] = explode("-",$id)[0];
        $data['peptide_chain'] = explode("-",$id)[1];
        $data['protein_chain'] = explode("-",$id)[2];
        
        // Abra o arquivo para leitura
        if (($handle = fopen($arquivo, "r")) !== false) {
            while (($linha = fgetcsv($handle, 0, ";")) !== false) {
                // Verifica se a primeira coluna é igual ao ID
                if ($linha[0] === $id) {
                    // Exibe a linha encontrada
                    $data['info'] = $linha;
                    break; // Sai do loop após encontrar
                }
            }
            fclose($handle);
        } 
        $data['info'][13] = $this->br($data['info'][13]); # PROTEIN_SEQ
        $data['info'][14] = $this->br($data['info'][14]); # PEPTIDE_SEQ
        # [0] id;PDB_ID;TITLE;RESOLUTION;CLASSIFICATION;
        # [5] DEPOSITION_DATE;STRUCTURE_METHOD;PROTEIN_CHAIN;PEPTIDE_CHAIN;PROTEIN_SIZE;
        # [10] PEPTIDE_SIZE;PROTEIN_DESC;PEPTIDE_DESC;PROTEIN_SEQ;PEPTIDE_SEQ;
        # [15] leader_id;is_leader;peptide_Length;peptide_MW;peptide_pI;
        # [20] peptide_InstabilityIndex;peptide_AliphaticIndex;peptide_GRAVY;peptide_HydrophobicPercent;peptide_PositiveResidues;peptide_NegativeResidues;peptide_C;peptide_H;peptide_N;peptide_O;peptide_S;peptide_Formula;peptide_TotalAtoms;peptide_ExtCoeff_Disulfide;peptide_ExtCoeff_NoDisulfide;protein_Length;protein_MW;protein_pI;protein_InstabilityIndex;protein_AliphaticIndex;protein_GRAVY;protein_HydrophobicPercent;protein_PositiveResidues;protein_NegativeResidues;protein_C;protein_H;protein_N;protein_O;protein_S;protein_Formula;protein_TotalAtoms;protein_ExtCoeff_Disulfide;protein_ExtCoeff_NoDisulfide

        $data['contacts'] = $this->getContacts($id,$modo);
        $data['pisa_css'] = $this->getPisaCss($id);

        return view('entry', $data);
    }

    private function getPisaCss($id): string
    {
        # O CSS do PISA nao esta entre as 93 colunas do CSV da entrada: ele vem
        # do arquivo resumido usado pela pagina Explore (coluna 22, separado por
        # TAB). O arquivo tem dezenas de milhares de linhas, entao compara o
        # inicio de cada uma e so parseia a linha certa.
        $arquivo = FCPATH . 'data/propedia26_v17.tsv';
        if (!file_exists($arquivo)) {
            return '';
        }

        $handle = fopen($arquivo, 'r');
        if ($handle === false) {
            return '';
        }

        $prefixo = $id . "\t";
        $tamanho = strlen($prefixo);
        $css = '';

        while (($linha = fgets($handle)) !== false) {
            if (strncmp($linha, $prefixo, $tamanho) !== 0) {
                continue;
            }
            $colunas = explode("\t", rtrim($linha, "\r\n"));
            $css = isset($colunas[22]) ? trim($colunas[22]) : '';
            break;
        }
        fclose($handle);

        return $css;
    }

    private function getContacts($id, $modo, $tipo = null): Array 
    {
        $contacts = [];

        # contacts
        $url = "./data/$modo/contacts/$id/".substr($id,0,4)."_contacts.csv";
        if($tipo == 'multipro'){
            $url = "./data/$modo/multipro/contacts/$id/".substr($id,0,4)."_contacts.csv";
        }
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

    // ********************************************* PEP-MULTIPRO *********************************************
    public function multipro($id = null){
        // exibe cadeias de peptídeos interagindo com multiplas proteínas

        $data = [];

        $modo = 'db'; // db
        $arquivo = "data/$modo/multipro/csv/".$id[0].'/'.$id.".csv";

        // Verifique se o arquivo existe
        if (!file_exists($arquivo)) {
            $modo = 'examples'; // se o arquivo nao existir, carrega a base de exemplo
            $arquivo = "data/$modo/multipro/csv/".$id[0].'/'.$id.".csv";
        }
        if (!file_exists($arquivo)) {
            if(strlen($id) == 6){
                return redirect()->back()->with('success', '<strong>No multi-protein complex available</strong>. Structure composed of only a single protein-peptide pair.');
            }
            else{ return view('404'); }
        }

        $data['db'] = "$modo";
        $data['id'] = $id;

        $data['pdb_id'] = explode("-",$id)[0];
        $data['peptide_chain'] = explode("-",$id)[1];
        
        // Abra o arquivo para leitura
        if (($handle = fopen($arquivo, "r")) !== false) {
            while (($linha = fgetcsv($handle, 0, ";")) !== false) {
                // Verifica se a primeira coluna é igual ao ID
                if ($linha[0] === $id) {
                    // Exibe a linha encontrada
                    $data['info'] = $linha;
                    break; // Sai do loop após encontrar
                }
            }
            fclose($handle);
        } 
        $data['info'][13] = $this->br($data['info'][13]); # PROTEIN_SEQ
        $data['info'][14] = $this->br($data['info'][14]); # PEPTIDE_SEQ
        #0 id;PDB_ID;TITLE;RESOLUTION;CLASSIFICATION;
        #5 DEPOSITION_DATE;STRUCTURE_METHOD;PROTEIN_CHAIN;PEPTIDE_CHAIN;PROTEIN_SIZE;
        #10 PEPTIDE_SIZE;PROTEIN_DESC;PEPTIDE_DESC;PROTEIN_SEQ;PEPTIDE_SEQ;
        #15 leader_id;is_leader;peptide_Length;peptide_MW;peptide_pI;
        #20 peptide_InstabilityIndex;peptide_AliphaticIndex;peptide_GRAVY;peptide_HydrophobicPercent;peptide_PositiveResidues;
        #25 peptide_NegativeResidues;peptide_C;peptide_H;peptide_N;peptide_O;
        #30 peptide_S;peptide_Formula;peptide_TotalAtoms;peptide_ExtCoeff_Disulfide;peptide_ExtCoeff_NoDisulfide;
        #35 protein_Length;protein_MW;protein_pI;protein_InstabilityIndex;protein_AliphaticIndex;
        #40 protein_GRAVY;protein_HydrophobicPercent;protein_PositiveResidues;protein_NegativeResidues;protein_C;
        #45 protein_H;protein_N;protein_O;protein_S;protein_Formula;
        #50 protein_TotalAtoms;protein_ExtCoeff_Disulfide;protein_ExtCoeff_NoDisulfide;protein_chains

        $data['protein_chain'] = $data['info'][53];

        $data['contacts'] = $this->getContacts($id,$modo,'multipro');

        return view('multipro', $data);
    }
    
    private function br($texto, $tamanho = 40) {
        # adiciona uma quebra de linha a cada 40 caracteres
        return wordwrap($texto, $tamanho, "<br>", true);
    }

}
