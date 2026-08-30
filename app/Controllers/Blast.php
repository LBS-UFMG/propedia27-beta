<?php

namespace App\Controllers;

class Blast extends BaseController
{
    public function index()
    {
        if (!isset($_POST["sequence"]) || !isset($_POST["search"])) {
            redirect("/explore");
        }

        $data = array();

        $data['sequence'] = addslashes($_POST["sequence"]);

        $where = addslashes($_POST["search"]);

        if($where == 'peptides'){ $tamanho = " -word_size 2 -task blastp-short -seg no  -evalue 100000"; } 
        else{ $tamanho = " -word_size 3"; }

        if (($where != 'peptides') and ($where != 'receptors')) {
            $where = 'peptides';
        }

        $fp = fopen('../writable/blast/tmp.fasta', 'w');
        fwrite($fp, $data['sequence']);
        fclose($fp);


        $output = shell_exec('blastp -query ../writable/blast/tmp.fasta -subject data/' . $where . '.fasta -outfmt="6 qseqid sseqid pident score slen sstart send qlen qstart qend qframe positive sseq" -max_target_seqs 50' . $tamanho);

        // dd('blastp -query ../writable/blast/tmp.fasta -subject data/' . $where . '.fasta -outfmt="6 qseqid sseqid pident score slen sstart send qlen qstart qend qframe positive" -max_target_seqs 50' . $tamanho);

        $out = explode("\n", $output);
        $i = 0;
        $data['result'] = array();


        foreach ($out as $o) {
            $c = explode("\t", $o);

            if (isset($c[6]) and isset($c[5]) and isset($c[4]) and isset($c[2])) {
                if ((($c[6] - $c[5]) / $c[4] > 0.5) and ($c[2] > 25)) {
                    $complex_name = str_replace("-", "_", explode("|", $c[1])[0]);
                    array_push($data['result'], $c);
                }
            }
        }

        return view("blast", $data);
    }
}
