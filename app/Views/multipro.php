<?= $this->extend('template') ?>
<?= $this->section('conteudo') ?>
<!-- Conteúdo personalizado -->

<?php function quebra($x){ return str_replace(":","<br>",$x); }?>
<?php function quebra2($x){ return str_replace(":","<br><br>",$x); }?>
<?php function soma($x){ return str_replace(":","+",$x); }?>
<?php
// Cores das cadeias: o peptideo fica com o laranja de destaque e as proteinas
// recebem as demais cores, na ordem do campo PROTEIN_CHAIN. O mesmo mapa
// alimenta os badges da tabela de propriedades, as legendas e o viewer 3D.
$mp_pep = trim($info[9]);
$mp_prots = array_values(array_filter(array_map('trim', explode(':', $info[8]))));
$mp_paleta = ['grey', 'deepskyblue', 'green', 'purple', 'cyan'];
$mp_hex = [
    'orangered' => '#e8500e', 'grey' => '#6c757d', 'deepskyblue' => '#0d8fc4',
    'green' => '#198754', 'purple' => '#6f42c1', 'cyan' => '#0aa2c0',
];
$mp_cores = [$mp_pep => 'orangered'];
foreach ($mp_prots as $i => $ch) {
    $mp_cores[$ch] = $mp_paleta[$i % count($mp_paleta)];
}

// Badge com a letra da cadeia, na cor dela
function mp_badge($ch, $cores, $hex) {
    $ch = trim($ch);
    $cor = $hex[$cores[$ch] ?? 'grey'] ?? '#6c757d';
    return "<b class=\"ct\" style=\"background:$cor\">$ch</b>";
}

// Um badge por elemento do campo (cadeias, tamanhos, ...), com o texto inteiro
// dentro do badge e na cor da cadeia correspondente.
function mp_badges($valor, $cadeias, $cores, $hex) {
    $saida = [];
    foreach (explode(':', (string) $valor) as $i => $v) {
        $v = trim($v);
        if ($v === '') {
            continue;
        }
        $ch = $cadeias[$i] ?? '';
        $cor = $hex[$cores[$ch] ?? 'grey'] ?? '#6c757d';
        $saida[] = "<span class=\"ct-full\" style=\"background: $cor\">$v</span>";
    }
    return implode('', $saida);
}

// Valor de uma propriedade por cadeia. O CSV guarda os valores das varias
// cadeias de proteina em um unico campo, separados por ":", na mesma ordem de
// PROTEIN_CHAIN; aqui cada valor sai com o badge da cadeia a que pertence.
// Posicoes vazias sao puladas sem perder o alinhamento com a lista de cadeias.
function mp_por_cadeia($valor, $cadeias, $cores, $hex, $fmt = null, $sep = '<br>') {
    $saida = [];
    foreach (explode(':', (string) $valor) as $i => $v) {
        $v = trim($v);
        if ($v === '') {
            continue;
        }
        $ch = $cadeias[$i] ?? '';
        // sem escapar: os campos ja vem do CSV com as quebras de linha que o
        // controller inseriu (<br>), como no comportamento anterior de quebra()
        $texto = $fmt ? $fmt($v) : $v;
        $saida[] = ($ch !== '' ? mp_badge($ch, $cores, $hex) : '') . $texto;
    }
    return implode($sep, $saida);
}
?>

<style>
    /* Badge com o texto inteiro do item, na cor da cadeia */
    .ct-full {
        display: inline-block; margin: 0 4px 4px 0; padding: 2px 8px;
        border-radius: 4px; font-size: 0.8rem; font-weight: 600; color: #fff;
    }

    /* Quando o badge e um link: sem sublinhado e laranja no hover. O
       !important vence a cor da cadeia, que vem no style da propria tag. */
    a.ct-full {
        text-decoration: none;
        transition: background-color .15s;
    }
    a.ct-full:hover,
    a.ct-full:focus {
        background-color: orangered !important;
        color: #fff;
    }

    /* Badge da cadeia: identifica a que cadeia cada valor pertence */
    .ct {
        display: inline-block; min-width: 1.1rem; margin-right: 4px;
        padding: 0 4px; border-radius: 3px; text-align: center;
        font-size: 0.65rem; font-weight: 700; line-height: 1.35; color: #fff;
    }
</style>

<?php function formata_formula($f){
    preg_match('/([0-9]*[+-]+)$/', $f, $m); $c = $m[1] ?? ''; if($c) $f = substr($f, 0, -strlen($c));
    return preg_replace('/(\d+)/','<sub>$1</sub>',htmlspecialchars($f)).($c?'<sup>'.$c.'</sup>':'');
}?>
<link rel="stylesheet" href="<?php echo base_url('/css/dt.css'); ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div id="loading">
    <div class="text-center">
        <img src="<?= base_url('/img/cocadito-loading.png') ?>" width="200px"><br>
        <div class="spinner-border spinner-border-sm" role="status"></div>
        <strong class="ms-2">Loading...</strong>
    </div>
</div>
<div style="background-color:#e4e4e4; min-height:180px; margin: -25px -10px 20px -10px;">
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-12 pt-2">
                <h1 class="title_h2 pt-4">
                    <strong><?php echo $id; ?></strong>
                    <div class="dropdown d-inline ms-2" title="Export files">
                        <div class="dropdown d-inline">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Download
                            </button>
                            <ul class="dropdown-menu">
                                <li><b class="ms-3">Download</b></li>
                                <hr>
                                <li><a class="dropdown-item mt-2" href="<?php echo base_url(); ?>data/db/multipro/contacts/<?= $id ?>/<?= substr($id,0,-2) ?>_contacts.csv">Contacts</a></li>
                                <li><a class="dropdown-item" href="https://files.rcsb.org/download/<?= substr($id,0,-2) ?>.cif">PDB file</a></li>
                                <hr>
                                <!-- <li><a class="dropdown-item" href="<?= base_url("/export/pdb-to-pymol/$id") ?>">Export to PyMOL</a></li> -->
                            </ul>
                        </div>
                    </div>

                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#contactMap">
                        Contact map <i class="bi bi-image"></i>
                    </button>
                </h1>

                <div class="mb-3">
                    <a target="_blank" style="text-decoration:none" title="Search in PDB" href="https://www.rcsb.org/structure/<?= $pdb_id ?>">
                        <span class="badge bg-dark text-light">PDB</span>
                    </a>

                    <a target="_blank" style="text-decoration:none" title="Search in UniProt" href="https://www.uniprot.org/uniprot/?query=<?= $pdb_id ?>+database:pdb">
                        <span class="badge bg-dark">UniProt</span>
                    </a>

                    <a target="_blank" style="text-decoration:none" title="Search in PubMed" href="https://www.ncbi.nlm.nih.gov/pubmed/?term=<?= $pdb_id ?>">
                        <span class="badge bg-dark">PubMed</span>
                    </a>

                    <!-- <a title="Classified in the sequence cluster number 967" style="text-decoration:none" href="http://bioinfo.dcc.ufmg.br/propedia2/cluster/sequence/967"><span class="badge bg-dark">Cluster S967</span></a>
                    <a title="Classified in the binding cluster number 35" style="text-decoration:none" href="http://bioinfo.dcc.ufmg.br/propedia2/cluster/binding/35"><span class="badge bg-dark">Cluster C35</span></a>
                    <a title="Classified in the interface cluster number 243" style="text-decoration:none" href="http://bioinfo.dcc.ufmg.br/propedia2/cluster/interface/243"><span class="badge bg-dark">Cluster I243</span></a> -->
                </div>

                <div class="row mb-1">
                    <div class="col">
                        <strong>PDB ID: </strong><span><?= $info[2] ?></span>
                    </div>
                    <div class="col">
                        <strong>Classification: </strong><span><?= $info[5] ?></span>
                    </div>
                    <div class="col">
                        <strong>Resolution: </strong><span><?= $info[4] ?></span>
                    </div>
                    
                    <div class="col">
                        <strong>Structure method: </strong><span><?= $info[7] ?></span>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <strong>Peptide chain: </strong><span><?= $info[9] ?></span>
                    </div>
                    <div class="col">
                        <strong>Peptide length: </strong><span><?= $info[11] ?></span>
                    </div>
                    <div class="col">
                        <strong>Protein chain: </strong><span><?= mp_badges($info[8], $mp_prots, $mp_cores, $mp_hex) ?></span>
                    </div>
                    <div class="col">
                        <strong>Protein length: </strong><span><?= mp_badges($info[10], $mp_prots, $mp_cores, $mp_hex) ?></span>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <p><strong>Description: </strong>  <?= $info[3] ?></p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-8 col-12" ng-if="cttlok" id="col1">

            <div class="row">
                <!-- [0] id;PDB_ID;TITLE;RESOLUTION;CLASSIFICATION;
        # [5] DEPOSITION_DATE;STRUCTURE_METHOD;PROTEIN_CHAIN;PEPTIDE_CHAIN;PROTEIN_SIZE;
        # [10] PEPTIDE_SIZE;PROTEIN_DESC;PEPTIDE_DESC;PROTEIN_SEQ;PEPTIDE_SEQ;
        # [15] leader_id;is_leader;peptide_Length;peptide_MW;peptide_pI;
        # [20] peptide_InstabilityIndex;peptide_AliphaticIndex;peptide_GRAVY;peptide_HydrophobicPercent;peptide_PositiveResidues;
        # [25] peptide_NegativeResidues;peptide_C;peptide_H;peptide_N;peptide_O;
        # [30] peptide_S;peptide_Formula;peptide_TotalAtoms;peptide_ExtCoeff_Disulfide;peptide_ExtCoeff_NoDisulfide;
        # [35] protein_Length;protein_MW;protein_pI;protein_InstabilityIndex;protein_AliphaticIndex;
        # [40] protein_GRAVY;protein_HydrophobicPercent;protein_PositiveResidues;protein_NegativeResidues;protein_C;
        # [45] protein_H;protein_N;protein_O;protein_S;protein_Formula;
        # [50] protein_TotalAtoms;protein_ExtCoeff_Disulfide;protein_ExtCoeff_NoDisulfide -->
                <div class="table-responsive">

                    <table class="table table-striped small">
                        <thead>
                            <tr>
                                <th style="width: 20%;"></th>
                                <th style="width: 40%;">
                                    <h2>Protein</h2>
                                </th>
                                <th style="width: 40%;">
                                    <h2>Peptide</h2>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Chain</th>
                                <td><?php foreach ($mp_prots as $ch): ?><?= mp_badge($ch, $mp_cores, $mp_hex) ?><?php endforeach; ?></td>
                                <td><?= mp_badge($mp_pep, $mp_cores, $mp_hex) ?></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td><?= mp_por_cadeia($info[12], $mp_prots, $mp_cores, $mp_hex) ?></td>
                                <td><?= $info[13] ?></td>
                            </tr>
                            <tr>
                                <th>Length (residues)</th>
                                <td><?= mp_por_cadeia($info[30], $mp_prots, $mp_cores, $mp_hex) ?></td>
                                <td><?= $info[17] ?></td>
                            </tr>
                            <tr>
                                <th>Hydrophobic (%)</th>
                                <td><?= mp_por_cadeia($info[36], $mp_prots, $mp_cores, $mp_hex) ?></td>
                                <td><?= $info[23] ?></td>
                            </tr>
                            <tr>
                                <th>Positive Residues</th>
                                <td><?= mp_por_cadeia($info[37], $mp_prots, $mp_cores, $mp_hex) ?></td>
                                <td><?= $info[24] ?></td>
                            </tr>
                            <tr>
                                <th>Negative Residues</th>
                                <td><?= mp_por_cadeia($info[38], $mp_prots, $mp_cores, $mp_hex) ?></td>
                                <td><?= $info[25] ?></td>
                            </tr>
                            <tr>
                                <th>Atomic Formula</th>
                                <td><?= mp_por_cadeia($info[39], $mp_prots, $mp_cores, $mp_hex, 'formata_formula') ?></td>
                                <td><?= formata_formula($info[26]) ?></td>
                            </tr>
                            <tr>
                                <th>Total Atoms</th>
                                <td><?= mp_por_cadeia($info[40], $mp_prots, $mp_cores, $mp_hex) ?></td>
                                <td><?= $info[27] ?></td>
                            </tr>                           
                            <tr>
                                <th>Sequence</th>
                                <td>
                                    <pre><?= mp_por_cadeia($info[14], $mp_prots, $mp_cores, $mp_hex, null, '<br><br>') ?></pre>
                                </td>
                                <td>
                                    <pre><?= $info[15] ?></pre>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h2>Clustering classification</h2>
                </div>
                <hr>
                <div class="col-12">
                  
                    <p>
 <strong>Cluster entries: </strong><br>
                        <?php foreach (explode(':', $info[1]) as $i => $ent):
                            $ent = trim($ent);
                            if ($ent === '') {
                                continue;
                            }
                            $ch = $mp_prots[$i] ?? '';
                            $cor = $mp_hex[$mp_cores[$ch] ?? 'grey'] ?? '#6c757d';
                        ?>
                            <a class="ct-full" style="background: <?= $cor ?>" href="<?= base_url('/entry/' . $ent) ?>"><?= $ent ?></a>
                        <?php endforeach; ?>
                    </p>
                    <p>
 <strong>PDB classification: </strong><span><?= $info[5] ?></span>
                    </p>
                </div>
            </div>
            <h4 class="mt-4">Contacts (calculated using COCaDA)  <sup><a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Contacts (calculated using COCaDA): Number and type of interatomic contacts calculated by the COCaDA tool (https://bioinfo.dcc.ufmg.br/cocada-web), used to characterize specific atom-atom interactions across the interfaces of this multi-protein complex."><i class="bi bi-question-circle-fill opacity-25"></i></a></sup></h4>
            <?php
            // Contagem de contatos por tipo, exibida nos botoes de filtro.
            // Os padroes sao os mesmos das buscas aplicadas a tabela (DataTables),
            // para que o numero do botao corresponda ao total de linhas filtradas.
            $padroes_filtro = [
                'hb' => '/HB/i',
                'at' => '/AT/i',
                're' => '/RE/i',
                'hy' => '/HY/i',
                'ar' => '/AS|SPA|SPE|SOT/i',
                'sb' => '/SB/i',
                'ds' => '/DS/i',
                'un' => '/u/i',
            ];
            $n = array_fill_keys(array_keys($padroes_filtro), 0);
            $n['all'] = $n['intra'] = $n['inter'] = 0;
            foreach ($contacts as $contact) {
                $c = explode(',', $contact);
                if ((count($c) < 5) or ($c[0] == 'Chain1')) {
                    continue;
                }
                $n['all']++;
                if ($c[0] == $c[4]) {
                    $n['intra']++;
                } else {
                    $n['inter']++;
                }
                $tipo = isset($c[9]) ? trim($c[9]) : '';
                foreach ($padroes_filtro as $k => $regex) {
                    if (preg_match($regex, $tipo)) {
                        $n[$k]++;
                    }
                }
            }
            ?>

            <style>
                /* Botoes de filtro de contatos (estilo limpo com contagem) */
                .contact-filters { display: flex; flex-wrap: wrap; gap: 6px; align-items: center; }
                .btn-filter {
                    border: 1px solid #adb5bd; background: #fff; color: #212529;
                    font-size: 0.75rem; padding: 4px 10px; border-radius: 4px;
                    font-weight: 600; line-height: 1.2; cursor: pointer; transition: background-color .15s;
                }
                .btn-filter:hover { background: #f1f3f5; }
                .btn-filter.active { background: #212529; color: #fff; border-color: #212529; }
                .badge-cnt {
                    background: rgba(0,0,0,.12); padding: 0 5px; border-radius: 3px;
                    margin-left: 5px; font-size: 0.7rem; color: inherit;
                }
                .btn-filter.active .badge-cnt { background: rgba(255,255,255,.25); color: #fff; }
            </style>

            <!-- Filtros de contato -->
            <div class="contact-filters mb-2">
                <span class="me-1 small text-muted"><b><i class="bi bi-funnel-fill"></i> Filter:</b></span>
                <button type="button" id="show_all" class="btn-filter btn-all active" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="All contacts">All <span class="badge-cnt"><?= number_format($n['all']) ?></span></button>
                <button type="button" id="hb" class="btn-filter" style="border-bottom: 3px solid #198754" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hydrogen Bonds">HB <span class="badge-cnt"><?= number_format($n['hb']) ?></span></button>
                <button type="button" id="at" class="btn-filter" style="border-bottom: 3px solid #0dcaf0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Attractive">AT <span class="badge-cnt"><?= number_format($n['at']) ?></span></button>
                <button type="button" id="re" class="btn-filter" style="border-bottom: 3px solid #dc3545" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Repulsive">RE <span class="badge-cnt"><?= number_format($n['re']) ?></span></button>
                <button type="button" id="hy" class="btn-filter" style="border-bottom: 3px solid #ffc107" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hydrophobic">HY <span class="badge-cnt"><?= number_format($n['hy']) ?></span></button>
                <button type="button" id="ar" class="btn-filter" style="border-bottom: 3px solid #6c757d" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Aromatic">AR <span class="badge-cnt"><?= number_format($n['ar']) ?></span></button>
                <button type="button" id="sb" class="btn-filter" style="border-bottom: 3px solid #0d6efd" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Salt Bridge">SB <span class="badge-cnt"><?= number_format($n['sb']) ?></span></button>
                <button type="button" id="ds" class="btn-filter" style="border-bottom: 3px solid #212529" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Disulfide Bond">DS <span class="badge-cnt"><?= number_format($n['ds']) ?></span></button>
                <button type="button" id="un" class="btn-filter" style="border-bottom: 3px solid #ced4da" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Uncertain contact (depends on pH; can be attractive, repulsive, or salt bridge)">UN <span class="badge-cnt"><?= number_format($n['un']) ?></span></button>
                <?php // INTRA/INTER so aparecem quando ha os dois tipos
                if ($n['intra'] > 0 and $n['inter'] > 0): ?>
                    <span class="vr mx-1"></span>
                    <button type="button" id="intra" class="btn-filter" style="border-bottom: 3px solid #495057" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Intrachain contacts (same chain)">INTRA <span class="badge-cnt"><?= number_format($n['intra']) ?></span></button>
                    <button type="button" id="inter" class="btn-filter" style="border-bottom: 3px solid #adb5bd" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Interchain contacts (different chains)">INTER <span class="badge-cnt"><?= number_format($n['inter']) ?></span></button>
                <?php endif; ?>
            </div>

            <!-- Somente contatos de cadeia lateral -->
            <div class="form-check form-switch pb-2">
                <input class="form-check-input" type="checkbox" id="side_chain">
                <label class="form-check-label small text-muted" for="side_chain">Only side chain contacts</label>
            </div>

            <div class="table-responsive small">
                <table class="display" id="mut">
                    <thead>
                        <tr>
                            <th>Contact</th>
                            <th>Chain1</th>
                            <th>R1</th>
                            <th>Atom1</th>
                            <th>Chain2</th>
                            <th>R2</th>
                            <th>Atom2</th>
                            <th>Distance</th>
                            <th>Local</th>
                            <th>Type</th>
                            <th>Show</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $contact) {  ?>
                            <?php
                            $m = explode(',', $contact);
                            $len_mut = count($m);
                            if (($len_mut < 5) or ($m[0] == 'Chain1')) {
                                continue;
                            }
                            ?>
                            <tr onclick="selectID(
                            glviewer,
                            this.children[0].innerHTML, // residues, 
                            this.children[8].innerHTML, // type, => inter ou intra
                            this.children[1].innerHTML,  // chain 1, 
                            this.children[4].innerHTML,  // chain 2, 
                            this.children[3].innerHTML,  // a1, 
                            this.children[6].innerHTML  // a2
                            )" id="<?php echo $m[2] . $m[1] . '/' . $m[6] . $m[5]; ?>">
                                <td><?php echo $m[2] . $m[1] . '/' . $m[6] . $m[5]; ?></td>
                                <td><?php echo $m[0]; // chain 1 
                                    ?></td>
                                <td><?php echo $m[2];
                                    echo $m[1]; // res 1 
                                    ?></td>
                                <td><?php echo $m[3]; // atom 1 
                                    ?></td>
                                <td><?php echo $m[4]; // chain 2 
                                    ?></td>
                                <td><?php echo $m[6];
                                    echo $m[5]; // res2 
                                    ?></td>
                                <td><?php echo $m[7]; // atom2 
                                    ?></td>
                                <td><?php echo $m[8]; // dist 
                                    ?></td>
                                <td>
                                    <?php // local = INTRA ou PPI
                                    if ($m[0] == $m[4]) {
                                        echo "<span class='badge text-bg-dark'>INTRA</hb>";
                                    } else {
                                        echo "<span class='badge text-bg-secondary'>INTER</hb>";
                                    }
                                    ?>
                                </td>
                                <td><?php
                                    //echo $m[9];  // type
                                    switch (trim($m[9])) {
                                        case "HB":
                                            echo "<span class='badge text-bg-success'>HB</hb>";
                                            break;
                                        case "HY":
                                            echo "<span class='badge text-bg-warning'>HY</hb>";
                                            break;
                                        case "AT":
                                            echo "<span class='badge text-bg-info'>AT</hb>";
                                            break;
                                        case "RE":
                                            echo "<span class='badge text-bg-danger'>RE</hb>";
                                            break;
                                        case "SB":
                                            echo "<span class='badge text-bg-primary'>SB</hb>";
                                            break;
                                        case "DS":
                                            echo "<span class='badge text-bg-dark text-white'>DS</hb>";
                                            break;
                                        default:
                                            echo "<span class='badge text-bg-light'>$m[9]</hb>";
                                            break;
                                    }

                                    ?>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0);"><i class="bi bi-eye-fill"></i></a>
                                </td>


                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="col-md-4 col-12" id="col2">
            <div class="bd-toc" data-spy="affix" id="affix" data-offset-top="240" data-offset-bottom="250">
                <style>
                    /* Chaves do viewer: azul-escuro da Propedia quando ligadas */
                    .viewer-controls .form-check-input:checked {
                        background-color: #031430;
                        border-color: #031430;
                    }

                    /* "Surface:", barra e valor formam um bloco so, com o
                       espacamento interno menor que o da linha de controles. */
                    .viewer-controls .surface-group {
                        margin-bottom: 3px;
                    }

                    /* O trilho padrao do Bootstrap e quase branco (#f8f9fa) */
                    .viewer-controls .form-range {
                        height: 1.3125rem;
                    }
                    .viewer-controls .form-range::-webkit-slider-runnable-track {
                        background-color: #ced4da;
                    }
                    .viewer-controls .form-range::-moz-range-track {
                        background-color: #ced4da;
                    }
                </style>

                <!-- Controles do viewer, acima da estrutura: tres grupos (chaves,
                     superficie e botoes) com o espaco sobrando dividido por igual.
                     Abaixo de 1400px de janela nao cabe o texto das chaves, e ai
                     entram os icones; o tooltip explica os dois casos. -->
                <div class="d-flex align-items-center flex-wrap justify-content-between gap-2 mb-2 small viewer-controls">
                    <div class="d-flex align-items-center gap-3">
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" role="switch" id="show_lines" checked>
                            <label class="form-check-label" for="show_lines" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Lines: bonds of the whole structure drawn as thin lines">
                                <i class="bi bi-slash-lg d-xxl-none"></i><span class="d-none d-xxl-inline">Lines</span>
                            </label>
                        </div>

                        <!-- Destaca as interfaces: residuos em sticks, superficie por
                             cima e os contatos atomo-atomo da tabela como linhas -->
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" role="switch" id="show_interface">
                            <label class="form-check-label" for="show_interface" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Interface residues as sticks, covered by a surface, with the atom contacts drawn as lines">
                                <i class="bi bi-intersect d-xxl-none"></i><span class="d-none d-xxl-inline">Interface</span>
                            </label>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-1 surface-group">
                        <label class="mb-0" for="opacityRange">Surface:</label>
                        <input class="form-range" style="max-width: 3.5rem" type="range" id="opacityRange" min="0" max="1" step="0.1" value="1">
                        <span class="badge bg-secondary px-1" id="opacityValue">100%</span>
                    </div>

                    <div class="d-flex align-items-center gap-1">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="reset()" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Clear: back to the initial 3D viewer settings">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </button>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#zoom" class="btn btn-sm btn-outline-secondary" id="click_zoom" data-bs-placement="top" data-bs-title="See the 3D structure in full screen">
                            <i class="bi bi-arrows-fullscreen"></i>
                        </a>
                    </div>
                </div>

                <div id="pdb" style="min-height: 400px; height: 80vh; min-width:280px; width: 100%">

                </div>

                <!-- Legenda das cadeias: as cores sao as mesmas dos badges da
                     tabela de contatos e do cartoon do 3Dmol -->
                <div class="small text-muted mt-1">
                    <?= mp_badge($mp_pep, $mp_cores, $mp_hex) ?> peptide
                    <?php foreach ($mp_prots as $ch): ?>
                        <span class="ms-2"><?= mp_badge($ch, $mp_cores, $mp_hex) ?> protein</span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="contactMap" tabindex="-1" aria-labelledby="contactMap" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3 text-center w-100" id="contactMapTitle"><strong>Contacts map for <?= $id ?></strong></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div id="controls">
                    <div class="row px-4">
                        <div class="col">
                            <label for="chainX">X-axis Chain:</label>
                            <select id="chainX" class="form-select" onchange="updateChart()"></select>
                        </div>
                        <div class="col">
                            <label for="chainY">Y-axis Chain:</label>
                            <select id="chainY" class="form-select" onchange="updateChart()"></select>
                        </div>
                        <!-- <div class="col">
                                <button class="btn btn-primary w-100 mt-4" onclick="updateChart()">Update chart</button>
                            </div> -->
                        <div class="col">
                            <button id="saveButton" class="btn btn-success w-100 mt-4" onclick="saveChart()">Save figure</button>
                        </div>
                    </div>
                </div>

                <style>
                    #pdb_modal canvas {
                        position: relative !important;
                    }
                </style>
                <div class="row mt-3">

                    <!-- Mapa de contatos (Chart.js) -->
                    <div class="col-lg-6 col-12" id="scatter">
                        <div style="position: relative; height: calc(100vh - 220px);">
                            <!-- Botao sobreposto, ao lado da legenda (topo do grafico) -->
                            <button id="backButton" class="btn btn-sm btn-outline-secondary"
                                onclick="resetChartZoom()"
                                style="position: absolute; top: 0; right: 0; z-index: 5;">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset Zoom
                            </button>
                            <canvas id="scatterChart"></canvas>
                        </div>
                    </div>

                    <!-- Visualizacao 3D do par selecionado -->
                    <div class="col-lg-6 col-12">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <p class="text-muted small mb-0">Click a point on the map to display the contact pair here.</p>
                            <button class="btn btn-sm btn-outline-secondary" onclick="resetViewer(modalViewer)">
                                <i class="bi bi-arrow-counterclockwise"></i> Clear
                            </button>
                        </div>
                        <div id="pdb_modal" style="height: calc(100vh - 260px); min-height: 400px; width: 100%; position: relative;"></div>
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="zoom" tabindex="-1" aria-labelledby="title3d" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="title3d">3D structure</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Contêiner do 3Dmol -->
                <div id="pdbModalViewer" style="width: 1100px; height: 650px;" class=""></div>
            </div>

        </div>
    </div>
</div>
<script>
    let glviewerModal; // variável global para o viewer do modal

    $('#click_zoom').on('click', function() {
        // Inicializa viewer só na primeira vez
        if (!glviewerModal) {
            glviewerModal = $3Dmol.createViewer("pdbModalViewer", {
                defaultcolors: $3Dmol.rasmolElementColors
            });

            // Adiciona modelo
            $.get('<?php echo base_url('/data/' . $db . '/multipro/pdb/' . $id[0] . '/' . $id . '.pdb'); ?>', function(data) {
                const m2 = glviewerModal.addModel(data, "pdb");
                glviewerModal.setBackgroundColor(0xffffff);

                glviewerModal.setStyle({}, {
                    line: {
                        colorscheme: 'greyCarbon'
                    },
                    cartoon: {
                        color: 'grey'
                    }
                });

                glviewerModal.setStyle({
                    chain: '<?= substr($id, 5, 1) ?>'
                }, {
                    stick: {
                        colorscheme: 'orangeredCarbon'
                    },
                    cartoon: {
                        color: 'orangered'
                    }
                });

                function three_to_one(a) {
                    const code = a.toUpperCase();

                    // Dicionário de conversão 3 letras -> 1 letra
                    const map = {
                        ALA: "A",
                        ARG: "R",
                        ASN: "N",
                        ASP: "D",
                        CYS: "C",
                        GLN: "Q",
                        GLU: "E",
                        GLY: "G",
                        HIS: "H",
                        ILE: "I",
                        LEU: "L",
                        LYS: "K",
                        MET: "M",
                        PHE: "F",
                        PRO: "P",
                        SER: "S",
                        THR: "T",
                        TRP: "W",
                        TYR: "Y",
                        VAL: "V",
                        SEC: "U",
                        PYL: "O" // aminoácidos especiais
                    };

                    // Retorna o código de 1 letra ou "X" para desconhecido
                    return map[code] || "X";
                }
                const atoms21 = m2.selectedAtoms({});
                for (let i in atoms21) {
                    let atom = atoms21[i];
                    if (atom.elem == 'N') {
                        glviewerModal.addLabel(three_to_one(atom.resn) + atom.resi, {
                            fontSize: 9,
                            position: {
                                x: atom.x,
                                y: atom.y,
                                z: atom.z
                            },
                            backgroundColor: "grey",
                            fontColor: 'black',
                            backgroundOpacity: 0,

                        });

                    }
                }

                glviewerModal.zoomTo();
                glviewerModal.render();
            });
        } else {
            glviewerModal.render(); // re-render se modal for aberto novamente
        }
    });
    let lastZoomValue = 100; // valor inicial do slider
</script>

<!-- Return to Top -->
<a href="#" title="Return to top" style="position:fixed; right:10px; bottom:10px; color:#cccccc77"><span class="glyphicon glyphicon-chevron-up small" aria-hidden="true">Top</span></a>

<script>
    // loading
    $(() => setTimeout(() => $('#loading').fadeOut(), 1000));

    $(() => {
        let table = $('#mut').DataTable({
            "paging": true
        });

        // Destaca (estado ativo) o botao de filtro clicado
        $('.btn-filter').on('click', function() {
            $('.btn-filter').removeClass('active');
            $(this).addClass('active');
        });

        $('#side_chain').click(function() {
            if ($("#side_chain").prop("checked")) {
                table
                    .columns(3).search("CB|CG|CG1|CG2|CD|CD1|CD2|CE|CE1|CE2|CE3|CZ|CZ2|CZ3|CH2|ND1|ND2|NE|NE1|NE2|NZ|OD1|OD2|OE1|OE2|OG|OG1|OH|SD|SG", true, false)
                    .columns(6).search("CB|CG|CG1|CG2|CD|CD1|CD2|CE|CE1|CE2|CE3|CZ|CZ2|CZ3|CH2|ND1|ND2|NE|NE1|NE2|NZ|OD1|OD2|OE1|OE2|OG|OG1|OH|SD|SG", true, false)
                    .draw();
            } else {
                table.columns(3).search(".*", true, false)
                    .columns(6).search(".*", true, false).draw();
            }
        });

        $('#at').click(function() {
            table.columns(9).search("AT", true, false).draw();
        });
        $('#hb').click(function() {
            table.columns(9).search("HB", true, false).draw();
        });
        $('#re').click(function() {
            table.columns(9).search("RE", true, false).draw();
        });
        $('#ar').click(function() {
            table.columns(9).search("AS|SPA|SPE|SOT", true, false).draw();
        });
        $('#hy').click(function() {
            table.columns(9).search("HY", true, false).draw();
        });
        $('#sb').click(function() {
            table.columns(9).search("SB", true, false).draw();
        });
        $('#ds').click(function() {
            table.columns(9).search("DS", true, false).draw();
        });
        $('#un').click(function() {
            table.columns(9).search("u", true, false).draw();
        });
        // INTRA/INTER filtram a coluna "Local" (indice 8)
        $('#intra').click(function() {
            table.columns(8).search("INTRA", true, false).draw();
        });
        $('#inter').click(function() {
            table.columns(8).search("INTER", true, false).draw();
        });
        $('#show_all').click(function() {
            // Limpa tanto o filtro de tipo (col. 9) quanto o de Local (col. 8)
            table.columns(9).search(".*", true, false)
                .columns(8).search(".*", true, false).draw();
        });
    });


    $('nav').css('position', 'relative');

    function highlight(pos) {
        $(pos).css("background-color", "#f2dede");
    }

    // 3DMOL **********************************************************************
    /* Converte o nome do residuo de 3 letras (ALA) para 1 letra (A) */
    function three2one(resn) {
        var map = {
            ALA: 'A', ARG: 'R', ASN: 'N', ASP: 'D', CYS: 'C',
            GLN: 'Q', GLU: 'E', GLY: 'G', HIS: 'H', ILE: 'I',
            LEU: 'L', LYS: 'K', MET: 'M', PHE: 'F', PRO: 'P',
            SER: 'S', THR: 'T', TRP: 'W', TYR: 'Y', VAL: 'V',
            SEC: 'U', PYL: 'O'
        };
        var code = map[String(resn).toUpperCase().trim()];
        return code ? code : resn; // desconhecido: mantem o nome original
    }

    /* Cor do atomo conforme o elemento (esquema rasmol usado nos viewers) */
    function atomColor(atom) {
        var colors = ($3Dmol.elementColors && $3Dmol.elementColors.rasmol) ||
            $3Dmol.rasmolElementColors || {};
        var c = colors[atom.elem];
        return (c === undefined) ? 0xcccccc : c; // desconhecido: cinza claro
    }

    // Cor de cartoon de cada cadeia; preenchida ao carregar o modelo principal e
    // reutilizada pelo viewer do mapa de contatos, para que os dois tenham o
    // mesmo padrao de cores.
    var chainColorMap = {};

    // Estado da chave "Lines": as linhas somem quando ela e desligada
    var mostrarLinhas = true;

    // Parte `line` do estilo, conforme a chave. Oculta com hidden:true, em vez
    // de remover a chave, para o 3Dmol nao herdar o estilo anterior.
    function estiloDeLinha() {
        return mostrarLinhas ? { colorscheme: 'greyCarbon' } : { hidden: true };
    }

    // Estilo da estrutura inteira (estado inicial / apos Clear): cartoon colorido
    // por cadeia mais as linhas. Nao mexe nas superficies do viewer principal.
    // Guarda como reaplicar o estilo, para a chave de linhas nao perder a selecao.
    function styleWhole(viewer) {
        var chains = Object.keys(chainColorMap);
        if (chains.length) {
            chains.forEach(function(chain) {
                viewer.setStyle({
                    chain: chain
                }, {
                    line: estiloDeLinha(),
                    cartoon: {
                        color: chainColorMap[chain]
                    }
                });
            });
        } else {
            viewer.setStyle({}, {
                line: estiloDeLinha(),
                cartoon: {
                    color: 'grey'
                }
            });
        }
        viewer._reapplyStyle = function() {
            styleWhole(viewer);
        };

        // Sticks da interface, quando a chave "Interface" estiver ligada
        ifaceEstiloSticks(viewer);
    }

    // Estilo de destaque de um par: volta o resto da estrutura ao estilo padrao
    // (removendo o destaque anterior) e poe sticks nos dois residuos.
    function styleHighlight(viewer, res1, chain1, res2, chain2) {
        styleWhole(viewer);
        viewer._reapplyStyle = function() {
            styleHighlight(viewer, res1, chain1, res2, chain2);
        };

        // ATENCAO: os sticks entram com addStyle, e nao com setStyle. O 3Dmol
        // desenha o cartoon em trechos continuos de residuos que compartilham o
        // MESMO estilo; trocar o estilo de um residuo no meio da cadeia parte a
        // fita em duas (o cartoon do peptideo "quebra"). Com addStyle o estilo
        // de cartoon da cadeia continua identico e os sticks so se somam a ele.
        viewer.addStyle({
            resi: res1,
            chain: chain1
        }, {
            stick: {
                colorscheme: 'whiteCarbon'
            }
        });
        viewer.addStyle({
            resi: res2,
            chain: chain2
        }, {
            stick: {
                colorscheme: 'whiteCarbon'
            }
        });
    }

    // Destaca um par de residuos e da zoom. Limpa labels/shapes do contato
    // anterior; cada viewer guarda os seus, de forma independente.
    function highlightPair(viewer, res1, chain1, res2, chain2, type) {

        (viewer._contactLabels || []).forEach(function(l) {
            viewer.removeLabel(l);
        });
        (viewer._contactShapes || []).forEach(function(sh) {
            viewer.removeShape(sh);
        });
        viewer._contactLabels = [];
        viewer._contactShapes = [];

        styleHighlight(viewer, res1, chain1, res2, chain2);

        if (type.includes('INTRA')) {
            viewer.zoomTo({
                resi: [res1, res2],
                chain: chain1
            });
        } else if (type.includes('INTER')) {
            viewer.zoomTo({
                resi: res1,
                chain: chain1
            });
        }
    }

    // Desenha UM contato (atomo a1 -> atomo a2): cilindro pontilhado, esferas nos
    // atomos, labels dos residuos e a distancia no centro. `color` define a cor do
    // cilindro e do label de distancia (padrao laranja).
    function drawContact(viewer, res1, chain1, a1, res2, chain2, a2, color) {

        color = color || "orange";
        var contactLabels = viewer._contactLabels || (viewer._contactLabels = []);
        var contactShapes = viewer._contactShapes || (viewer._contactShapes = []);

        let atm1 = viewer.selectedAtoms({
            resi: res1,
            atom: a1,
            chain: chain1
        });
        let atm2 = viewer.selectedAtoms({
            resi: res2,
            atom: a2,
            chain: chain2
        });

        // Garantir que os atomos foram encontrados antes de desenhar a linha
        if (atm1.length > 0 && atm2.length > 0) {
            var atom1 = atm1[0]; // Primeiro atomo correspondente
            var atom2 = atm2[0]; // Primeiro atomo correspondente

            // Linha tracejada (grossa) entre os atomos em contato
            contactShapes.push(viewer.addCylinder({
                dashed: true,
                start: {
                    x: atom1.x,
                    y: atom1.y,
                    z: atom1.z
                },
                end: {
                    x: atom2.x,
                    y: atom2.y,
                    z: atom2.z
                },
                radius: 0.12, // grossura da linha tracejada
                fromCap: 1,
                toCap: 1,
                color: color
            }));

            // Esferas sobre os atomos em contato, na cor do atomo
            contactShapes.push(viewer.addSphere({
                center: {
                    x: atom1.x,
                    y: atom1.y,
                    z: atom1.z
                },
                radius: 0.4,
                color: atomColor(atom1)
            }));
            contactShapes.push(viewer.addSphere({
                center: {
                    x: atom2.x,
                    y: atom2.y,
                    z: atom2.z
                },
                radius: 0.4,
                color: atomColor(atom2)
            }));

            // Labels dos residuos em contato (ex.: E7 (OE1) = glutamato 7, atomo OE1)
            var labelStyle = {
                fontSize: 12,
                fontColor: "white",
                backgroundColor: "black",
                backgroundOpacity: 0.8,
                inFront: true,
                borderThickness: 0.5,
                borderColor: "white"
            };

            contactLabels.push(viewer.addLabel(
                three2one(atom1.resn) + atom1.resi + " (" + atom1.atom + ")",
                Object.assign({
                    position: {
                        x: atom1.x,
                        y: atom1.y,
                        z: atom1.z
                    }
                }, labelStyle)
            ));

            contactLabels.push(viewer.addLabel(
                three2one(atom2.resn) + atom2.resi + " (" + atom2.atom + ")",
                Object.assign({
                    position: {
                        x: atom2.x,
                        y: atom2.y,
                        z: atom2.z
                    }
                }, labelStyle)
            ));

            // Label da distancia de contato, no centro da linha
            var dx = atom1.x - atom2.x;
            var dy = atom1.y - atom2.y;
            var dz = atom1.z - atom2.z;
            var dist = Math.sqrt(dx * dx + dy * dy + dz * dz);

            contactLabels.push(viewer.addLabel(
                dist.toFixed(2) + " Å", {
                    position: {
                        x: (atom1.x + atom2.x) / 2,
                        y: (atom1.y + atom2.y) / 2,
                        z: (atom1.z + atom2.z) / 2
                    },
                    fontSize: 11,
                    fontColor: "white",
                    backgroundColor: color,
                    backgroundOpacity: 0.85,
                    inFront: true
                }
            ));
        }
    }

    /* Select ID: destaca o par e desenha um unico contato */
    function selectID(glviewer, residues, type, chain1, chain2, a1, a2) {

        residues = residues.split("/");

        var res1 = residues[0].substr(1);
        var res2 = residues[1].substr(1);

        highlightPair(glviewer, res1, chain1, res2, chain2, type);
        drawContact(glviewer, res1, chain1, a1, res2, chain2, a2);

        glviewer.render();
    }

    // Clique em uma linha da tabela de contatos. Os valores vem dos data-* da
    // linha, e nao do texto das celulas, porque cada celula tambem exibe o
    // badge da cadeia.
    function selectIDdaLinha(tr) {
        var d = tr.dataset;

        highlightPair(glviewer, d.res1, d.c1, d.res2, d.c2, d.local);
        drawContact(glviewer, d.res1, d.c1, d.a1, d.res2, d.c2, d.a2);
        glviewer.render();

        // Com a superficie cheia o par destacado fica escondido por baixo dela:
        // baixa para 30% (o handler do slider refaz as superficies e reaplica o
        // destaque). O trigger e do jQuery porque o handler tambem e.
        var barra = document.getElementById('opacityRange');
        if (barra && parseFloat(barra.value) > 0.3) {
            $(barra).val(0.3).trigger('input');
        }
    }

    // Chave "Lines": redesenha mantendo a selecao corrente. Antes da primeira
    // selecao o viewer ainda nao tem _reapplyStyle (o estilo inicial vem de
    // createSurfacesWithOpacity), entao cai no estilo padrao.
    $(document).on('change', '#show_lines', function() {
        mostrarLinhas = this.checked;
        [typeof glviewer !== 'undefined' ? glviewer : null, modalViewer].forEach(function(v) {
            if (!v) {
                return;
            }
            if (v._reapplyStyle) {
                v._reapplyStyle();
            } else {
                styleWhole(v);
            }
            v.render();
        });
    });

    function selectPDB(id) {

        var ids = id.split("_");
        var mut = ids[1].replace("/", "_");

        try {
            var pos = mut.split("_");
            var pos1 = pos[0].substr(1, pos[0].length - 2);
            var pos2 = pos[1].substr(1, pos[1].length - 2);
            var pos1a = Number(pos1) - 1;
            var pos1d = Number(pos1) + 1;
            var pos2a = Number(pos2) - 1;
            var pos2d = Number(pos2) + 1;
            pos1a = pos1a.toString();
            pos1d = pos1d.toString();
            pos2a = pos2a.toString();
            pos2d = pos2d.toString();
        } catch (err) {
            var erro = 1;
        }


        var atomcallback = function(atom, viewer) {
            if (atom.clickLabel === undefined ||
                !atom.clickLabel instanceof $3Dmol.Label) {
                atom.clickLabel = viewer.addLabel(atom.resn + " " + atom.resi + " (" + atom.elem + ")", {
                    fontSize: 10,
                    position: {
                        x: atom.x,
                        y: atom.y,
                        z: atom.z
                    },
                    backgroundColor: "black"
                });
                atom.clicked = true;
            }

            //toggle label style
            else {

                if (atom.clicked) {
                    var newstyle = atom.clickLabel.getStyle();
                    newstyle.backgroundColor = 0x66ccff;

                    viewer.setLabelStyle(atom.clickLabel, newstyle);
                    atom.clicked = !atom.clicked;
                } else {
                    viewer.removeLabel(atom.clickLabel);
                    delete atom.clickLabel;
                    atom.clicked = false;
                }
            }
        };
    }

    // Reseta um viewer especifico ao estado inicial (estrutura inteira, sem selecao)
    function resetViewer(viewer) {
        if (!viewer) {
            return;
        }

        // Remove shapes do contato selecionado nesse viewer
        (viewer._contactShapes || []).forEach(function(sh) {
            viewer.removeShape(sh);
        });
        viewer._contactLabels = [];
        viewer._contactShapes = [];

        // Remove TODOS os labels: tanto os do contato quanto os rotulos criados
        // ao clicar em atomos (atomcallback guarda em atom.clickLabel)
        viewer.removeAllLabels();

        // Zera o estado de clique dos atomos, para que um novo clique volte a
        // criar o rotulo corretamente (senao o atomo continuaria "clicado")
        viewer.selectedAtoms({}).forEach(function(atom) {
            delete atom.clickLabel;
            atom.clicked = false;
        });

        // Volta ao estilo inicial (as superficies do viewer principal sao mantidas)
        styleWhole(viewer);

        viewer.zoomTo();
        viewer.render();
    }

    // Botao Clear do viewer principal
    function reset() {
        if (typeof glviewer !== 'undefined' && glviewer) {
            resetViewer(glviewer);
            // resetViewer removeu todos os labels do viewer, inclusive os da
            // interface: refaz o destaque para ele nao ficar pela metade
            ifaceRotulos = [];
            ifaceAplica();
        }
    }

    // ============ Destaque da interface no viewer principal (#pdb) ============
    // A chave "Interface", acima da estrutura, poe os residuos das interfaces em
    // sticks e esferas, cobre os das proteinas com uma superficie densa (os do
    // peptideo ficam com a superficie do slider) e desenha os contatos
    // atomo-atomo da tabela de contatos (pares de
    // cadeias diferentes) como linhas pontilhadas coloridas pelo tipo de
    // contato. A distancia de cada contato fica na tabela de contatos.

    var mostrarInterface = false;
    // Opacidade da superficie sobre os residuos da interface da proteina
    const IFACE_OPACIDADE_PROT = 0.9;

    var ifaceSuperficies = []; // ids das superficies criadas por este recurso
    var ifaceLinhas = [];      // shapes das linhas de contato
    var ifaceRotulos = [];     // labels dos residuos que interagem
    var ifaceIndice = null;    // cadeia:residuo:atomo -> atomo do modelo

    // No multipro o peptideo interage com varias cadeias de proteina; a
    // superficie densa da interface e aplicada a todas elas.
    const ifaceCadeiasProt = <?= json_encode(array_values(array_filter(array_map('trim', explode(':', $info[8]))))) ?>;

    <?php
    // Contatos de cada cadeia de proteina com o peptideo, no formato do CSV da
    // tabela de contatos: 0 cadeia1, 1 numero1, 2 nome1, 3 atomo1, 4 cadeia2,
    // 5 numero2, 6 nome2, 7 atomo2, 8 distancia, 9 tipo. Contatos entre duas
    // cadeias de proteina ficam de fora: a interface aqui e sempre com o peptideo.
    $contatos_interface = [];
    foreach ($contacts as $contact) {
        $c = explode(',', $contact);
        if ((count($c) < 9) or ($c[0] == 'Chain1') or (trim($c[0]) === trim($c[4]))) {
            continue;
        }
        if ((trim($c[0]) !== $mp_pep) and (trim($c[4]) !== $mp_pep)) {
            continue;
        }
        $contatos_interface[] = [
            'c1' => trim($c[0]), 'r1' => (int) $c[1], 'a1' => trim($c[3]),
            'c2' => trim($c[4]), 'r2' => (int) $c[5], 'a2' => trim($c[7]),
            'd'  => (float) $c[8],
            't'  => isset($c[9]) ? trim($c[9]) : '',
        ];
    }
    ?>
    const ifaceContatos = <?= json_encode($contatos_interface) ?>;

    // Residuos da interface por cadeia: os que aparecem nos contatos de cada
    // cadeia de proteina com o peptideo.
    const ifaceResiduos = (function() {
        var porCadeia = {};

        function guarda(chain, resi) {
            if (!chain) {
                return;
            }
            if (!porCadeia[chain]) {
                porCadeia[chain] = {};
            }
            porCadeia[chain][resi] = true;
        }
        ifaceContatos.forEach(function(ct) {
            guarda(ct.c1, ct.r1);
            guarda(ct.c2, ct.r2);
        });
        var saida = {};
        Object.keys(porCadeia).forEach(function(chain) {
            saida[chain] = Object.keys(porCadeia[chain]).map(Number);
        });
        return saida;
    })();

    // Contatos hidrofobicos ficam de fora do desenho: sao muitos e poluem a
    // visualizacao. Eles seguem na tabela de contatos e no mapa de contatos, e os
    // residuos que fazem esses contatos continuam destacados como interface.
    function ifaceContatoOculto(tipo) {
        return /HY/i.test(String(tipo));
    }

    // Cor da linha conforme o tipo de contato: as mesmas cores dos botoes de
    // filtro e dos badges da coluna Type da tabela.
    function ifaceCorContato(tipo) {
        var t = String(tipo).toUpperCase();
        if (t.indexOf('HB') >= 0) return '#198754';  // ligacao de hidrogenio
        if (t.indexOf('SB') >= 0) return '#0d6efd';  // ponte salina
        if (t.indexOf('DS') >= 0) return '#212529';  // ponte dissulfeto
        if (t.indexOf('AT') >= 0) return '#0dcaf0';  // atrativo
        if (t.indexOf('RE') >= 0) return '#dc3545';  // repulsivo
        if (t.indexOf('HY') >= 0) return '#ffc107';  // hidrofobico
        if (/AS|SPA|SPE|SOT/.test(t)) return '#6c757d'; // aromaticos
        return '#adb5bd';                            // indefinido
    }

    // Sticks nos residuos da interface, chamado no fim de styleWhole(). Entra com
    // addStyle, e nao setStyle, para nao partir o cartoon (ver styleHighlight).
    function ifaceEstiloSticks(viewer) {
        if (!mostrarInterface || typeof glviewer === 'undefined' || viewer !== glviewer) {
            return;
        }
        Object.keys(ifaceResiduos).forEach(function(chain) {
            var esquema = (chainColorMap[chain] || 'grey') + 'Carbon';
            viewer.addStyle({
                chain: chain,
                resi: ifaceResiduos[chain]
            }, {
                stick: {
                    radius: 0.2,
                    colorscheme: esquema
                },
                sphere: {
                    scale: 0.25,
                    colorscheme: esquema
                }
            });
        });
    }

    function ifaceRemoveSuperficies() {
        ifaceSuperficies.forEach(function(sup) {
            try {
                glviewer.removeSurface(sup);
            } catch (err) {
                // a superficie ja pode ter sido removida pelo slider de opacidade
            }
        });
        ifaceSuperficies = [];
    }

    // Superficie so sobre os residuos da interface da proteina, bem mais densa
    // que a do slider. Os residuos do peptideo ficam com a superficie padrao da
    // cadeia, que o slider controla.
    function ifaceCriaSuperficies() {
        ifaceCadeiasProt.forEach(function(chain) {
            var resis = ifaceResiduos[chain];
            if (!resis || !resis.length) {
                return;
            }
            // addSurface devolve uma promise com o id da superficie em .surfid,
            // que e o que removeSurface espera
            var sup = glviewer.addSurface($3Dmol.SurfaceType.VDW, {
                opacity: IFACE_OPACIDADE_PROT,
                color: chainColorMap[chain] || 'grey'
            }, {
                chain: chain,
                resi: resis
            });
            ifaceSuperficies.push((sup && sup.surfid !== undefined) ? sup.surfid : sup);
        });
    }

    function ifaceRemoveLinhas() {
        ifaceLinhas.forEach(function(sh) {
            try {
                glviewer.removeShape(sh);
            } catch (err) {
                // ignora shapes que ja nao existem
            }
        });
        ifaceLinhas = [];
    }

    // Indice cadeia:residuo:atomo montado uma unica vez, para achar os atomos de
    // cada contato sem varrer o modelo inteiro linha a linha
    function ifaceMontaIndice() {
        ifaceIndice = {};
        glviewer.selectedAtoms({}).forEach(function(a) {
            ifaceIndice[a.chain + ':' + a.resi + ':' + a.atom] = a;
        });
    }

    // Linhas dos contatos: cilindros pontilhados, e nao addLine, porque a
    // espessura de linha do WebGL fica presa em 1 px na maioria dos navegadores.
    function ifaceCriaLinhas() {
        ifaceContatos.forEach(function(ct) {
            if (ifaceContatoOculto(ct.t)) {
                return;
            }
            var a = ifaceIndice[ct.c1 + ':' + ct.r1 + ':' + ct.a1];
            var b = ifaceIndice[ct.c2 + ':' + ct.r2 + ':' + ct.a2];
            if (!a || !b) {
                return; // atomo ausente na estrutura (ex.: hidrogenio)
            }
            var cor = ifaceCorContato(ct.t);

            ifaceLinhas.push(glviewer.addCylinder({
                dashed: true,
                start: { x: a.x, y: a.y, z: a.z },
                end: { x: b.x, y: b.y, z: b.z },
                radius: 0.1,
                fromCap: 1,
                toCap: 1,
                color: cor
            }));
        });
    }

    function ifaceRemoveRotulos() {
        ifaceRotulos.forEach(function(l) {
            glviewer.removeLabel(l);
        });
        ifaceRotulos = [];
    }

    // Um rotulo por residuo da interface, no CA, no mesmo formato dos rotulos do
    // viewer em tela cheia (codigo de uma letra + numero).
    function ifaceCriaRotulos() {
        Object.keys(ifaceResiduos).forEach(function(chain) {
            ifaceResiduos[chain].forEach(function(resi) {
                var ca = ifaceIndice[chain + ':' + resi + ':CA'];
                if (!ca) {
                    return;
                }
                ifaceRotulos.push(glviewer.addLabel(three2one(ca.resn) + resi, {
                    position: { x: ca.x, y: ca.y, z: ca.z },
                    fontSize: 8,
                    fontColor: 'black',
                    backgroundOpacity: 0,
                    inFront: true
                }));
            });
        });
    }

    // (Re)aplica o destaque conforme o estado da chave. Reaproveitado pelo slider
    // de opacidade, que refaz as superficies e o estilo das cadeias.
    function ifaceAplica() {
        if (typeof glviewer === 'undefined' || !glviewer) {
            return;
        }
        ifaceRemoveSuperficies();
        ifaceRemoveLinhas();
        ifaceRemoveRotulos();

        // Reaplica o estilo atual; styleWhole()/styleHighlight() ja somam os
        // sticks da interface quando a chave esta ligada
        if (glviewer._reapplyStyle) {
            glviewer._reapplyStyle();
        } else {
            styleWhole(glviewer);
        }

        if (mostrarInterface) {
            if (!ifaceIndice) {
                ifaceMontaIndice();
            }
            ifaceCriaSuperficies();
            ifaceCriaLinhas();
            ifaceCriaRotulos();
        }
        glviewer.render();
    }

    $('#show_interface').on('change', function() {
        mostrarInterface = this.checked;
        ifaceAplica();
    });

    // PDB carregado no viewer principal, reaproveitado pelo viewer do mapa de contatos
    let moldata = null;

    $(() => {
        const pdb_data = "<?php echo base_url('/data/' . $db . '/multipro/pdb/' . $id[0] . '/' . $id . '.pdb'); ?>";

        $.get(pdb_data, function(d) {
            const data = d;
            moldata = d; // guarda o PDB para o viewer do mapa de contatos
            // Cria viewer
            glviewer = $3Dmol.createViewer("pdb", {
                defaultcolors: $3Dmol.rasmolElementColors
            });
            glviewer.setBackgroundColor(0xffffff);

            // Adiciona modelo
            const m = glviewer.addModel(data, "pdb");

            // Cores e cadeias
            const colors = ["grey", "orangered", "deepskyblue", "green", "purple", "cyan"];
            const atomsx = m.selectedAtoms({});
            const chains = [...new Set(atomsx.map(atom => atom.chain))];

            // Guarda a cor de cada cadeia, reutilizada por styleWhole() e pelo
            // viewer 3D do mapa de contatos. O peptideo fica com o mesmo laranja
            // da pagina de uma entrada, e as cadeias de proteina recebem as
            // demais cores na ordem em que aparecem no arquivo.
            const coresDasCadeias = <?= json_encode($mp_cores) ?>;
            chains.forEach(chain => {
                chainColorMap[chain] = coresDasCadeias[chain] || 'grey';
            });

            // Função utilitária debounce
            const debounce = (fn, wait = 80) => {
                let t;
                return function(...args) {
                    clearTimeout(t);
                    t = setTimeout(() => fn.apply(this, args), wait);
                };
            };

            // Função segura para remover todas as superfícies
            function removeAllSurfacesSafe(viewer) {
                // Preferir método pronto, se existir
                if (typeof viewer.removeAllSurfaces === 'function') {
                    viewer.removeAllSurfaces();
                    return;
                }
                // Fallback: iterar sobre viewer.surfaces (se existir) e tentar remover
                if (Array.isArray(viewer.surfaces) && viewer.surfaces.length) {
                    // copie a lista porque removeSurface pode mutar viewer.surfaces
                    const existing = viewer.surfaces.slice();
                    for (const s of existing) {
                        try {
                            // tentamos remover pelo objeto/handle — envolver em try para não quebrar
                            viewer.removeSurface(s);
                        } catch (err) {
                            // Algumas versões esperam um índice ou outro formato; ignorar se falhar
                            console.warn('removeSurface failed for', s, err);
                        }
                    }
                }
            }

            // Função que (re)cria todas as superfícies com a opacidade passada
            function createSurfacesWithOpacity(opacity) {
                chains.forEach((chain) => {
                    const color = chainColorMap[chain] || 'grey';
                    glviewer.setStyle({
                        chain: chain
                    }, {
                        line: estiloDeLinha(),
                        cartoon: {
                            color: color
                        }
                    });
                    glviewer.addSurface($3Dmol.SurfaceType.VDW, {
                        opacity: opacity,
                        color: color
                    }, {
                        chain: chain
                    });
                });
            }

            // Cria superfícies iniciais usando o valor atual do slider (fallback 0.3)
            const initialOpacity = parseFloat($('#opacityRange').val()) || 0.3;
            createSurfacesWithOpacity(initialOpacity);

            // Handler único, debounced, que remove e recria superfícies
            $('#opacityRange').on('input', debounce(function() {
                const newOpacity = parseFloat($(this).val());
                $('#opacityValue').text((newOpacity * 100).toFixed(0) + "%");

                // remove todas as superfícies de forma segura
                removeAllSurfacesSafe(glviewer);

                // (re)cria todas as superfícies com a nova opacidade
                createSurfacesWithOpacity(newOpacity);

                // o setStyle acima apaga os sticks da interface: refaz o
                // destaque (linhas e rótulos inclusive) se ele estiver ligado
                ifaceAplica();
            }, 60));

            // restante: marca átomos como clicáveis etc.
            const atoms = m.selectedAtoms({});
            for (let i in atoms) {
                let atom = atoms[i];
                atom.clickable = true;
                atom.callback = atomcallback;
            }

            glviewer.mapAtomProperties($3Dmol.applyPartialCharges);
            glviewer.zoomTo();
            glviewer.render();

            // Se a chave "Interface" foi ligada antes de a estrutura carregar
            if (mostrarInterface) {
                ifaceAplica();
            }
        });

        const atomcallback = function(atom, viewer) {
            if (atom.clickLabel === undefined || !(atom.clickLabel instanceof $3Dmol.Label)) {
                atom.clickLabel = viewer.addLabel(atom.resn + " " + atom.resi + " (" + atom.elem + ")", {
                    fontSize: 10,
                    position: {
                        x: atom.x,
                        y: atom.y,
                        z: atom.z
                    },
                    backgroundColor: "black"
                });
                atom.clicked = true;
            } else {
                if (atom.clicked) {
                    let newstyle = atom.clickLabel.getStyle();
                    newstyle.backgroundColor = 0x66ccff;
                    viewer.setLabelStyle(atom.clickLabel, newstyle);
                    atom.clicked = !atom.clicked;
                } else {
                    viewer.removeLabel(atom.clickLabel);
                    delete atom.clickLabel;
                    atom.clicked = false;
                }
            }
        };
    });

    // $(() => {

    //     const pdb_data = "<?php echo base_url('/data/' . $db . '/multipro/pdb/' . $id[0] . '/' . $id . '.pdb'); ?>";

    //     $.get(pdb_data, function(d) {

    //         moldata = data = d;

    //         /* Creating visualization */
    //         glviewer = $3Dmol.createViewer("pdb", {
    //             defaultcolors: $3Dmol.rasmolElementColors
    //         });

    //         /* Color background */
    //         glviewer.setBackgroundColor(0xffffff);

    //         receptorModel = m = glviewer.addModel(data, "pqr");

    //         // Defina um array de cores
    //         const colors = ["grey", "orangered", "deepskyblue", "green", "purple", "cyan"];

    //         const atomsx = m.selectedAtoms({});
    //         const chains = [...new Set(atomsx.map(atom => atom.chain))]; // lista única de cadeias

    //         // Define cartoon e superfície para cada cadeia
    //         chains.forEach((chain, i) => {
    //             const color = colors[i % colors.length];

    //             // Estilo cartoon com cor
    //             glviewer.setStyle({
    //                 chain: chain
    //             }, {
    //                 line: {
    //                     colorscheme: 'greyCarbon'
    //                 },
    //                 cartoon: {
    //                     color: color
    //                 }
    //             });

    //             // Adiciona superfície com a mesma cor do cartoon
    //             glviewer.addSurface($3Dmol.SurfaceType.VDW, {
    //                 opacity: 0.3,
    //                 color: color
    //             }, {
    //                 chain: chain
    //             });
    //         });

    //         /* Name of the atoms */
    //         atoms = m.selectedAtoms({});
    //         for (let i in atoms) {
    //             let atom = atoms[i];
    //             atom.clickable = true;
    //             atom.callback = atomcallback;
    //         }

    //         glviewer.mapAtomProperties($3Dmol.applyPartialCharges);
    //         glviewer.zoomTo();
    //         glviewer.render();

    //     });


    //     const atomcallback = function(atom, viewer) {
    //         if (atom.clickLabel === undefined ||
    //             !atom.clickLabel instanceof $3Dmol.Label) {
    //             atom.clickLabel = viewer.addLabel(atom.resn + " " + atom.resi + " (" + atom.elem + ")", {
    //                 fontSize: 10,
    //                 position: {
    //                     x: atom.x,
    //                     y: atom.y,
    //                     z: atom.z
    //                 },
    //                 backgroundColor: "black"
    //             });
    //             atom.clicked = true;
    //         }

    //         //toggle label style
    //         else {

    //             if (atom.clicked) {
    //                 let newstyle = atom.clickLabel.getStyle();
    //                 newstyle.backgroundColor = 0x66ccff;

    //                 viewer.setLabelStyle(atom.clickLabel, newstyle);
    //                 atom.clicked = !atom.clicked;
    //             } else {
    //                 viewer.removeLabel(atom.clickLabel);
    //                 delete atom.clickLabel;
    //                 atom.clicked = false;
    //             }
    //         }
    //     };
    // });
</script>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Plugin oficial de zoom/pan do Chart.js (Hammer.js habilita gestos de toque) -->
<script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@2.0.1"></script>

<script>

    // O botao de tela cheia ja usa data-bs-toggle="modal", e a inicializacao
    // global so alcanca data-bs-toggle="tooltip": este aqui e criado na mao.
    $(function() {
        const telaCheia = document.getElementById('click_zoom');
        if (telaCheia) {
            bootstrap.Tooltip.getOrCreateInstance(telaCheia, {
                placement: 'top',
                trigger: 'hover'
            });
        }
    });

    // MAPA DE CONTATOS
    let allChains = new Set();
    let allDataPoints = [];
    let datasetsMap = {}; // pontos agrupados por categoria (tipo de contato)
    let scatterChart;
    let colorMap = {};
    let modalViewer = null; // viewer 3Dmol dentro do modal do mapa de contatos
    const cat10Colors = [
        '#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd',
        '#8c564b', '#e377c2', '#7f7f7f', '#bcbd22', '#17becf'
    ];

    // Cadeias exibidas por padrao: o peptideo desta entrada no X e a primeira
    // das cadeias de proteina que interagem com ele no Y
    <?php $mp_cadeias_prot = array_values(array_filter(array_map('trim', explode(':', $info[8])))); ?>
    const defaultChainX = '<?= $info[9] ?>';
    const defaultChainY = '<?= $mp_cadeias_prot[0] ?? $info[9] ?>';

    function populateChainSelectors() {
        const chainX = document.getElementById('chainX');
        const chainY = document.getElementById('chainY');
        chainX.innerHTML = "";
        chainY.innerHTML = "";
        allChains.forEach(chain => {
            const optionX = document.createElement("option");
            optionX.value = optionX.textContent = chain;
            const optionY = document.createElement("option");
            optionY.value = optionY.textContent = chain;
            chainX.appendChild(optionX);
            chainY.appendChild(optionY);
        });
        chainX.value = defaultChainX;
        chainY.value = defaultChainY;
    }

    // Devolve os pontos de uma categoria para o par de cadeias escolhido.
    // O CSV traz cada contato em uma unica orientacao (ex.: sempre A -> B); se o
    // usuario inverter os eixos, o ponto e espelhado (x <-> y) em vez de sumir.
    function pointsForChains(points, cx, cy) {
        const out = [];
        points.forEach(function(p) {
            if (p.c1 === cx && p.c2 === cy) {
                out.push(p);
            } else if (p.c1 === cy && p.c2 === cx) {
                out.push({
                    x: p.y,
                    y: p.x,
                    c1: p.c2,
                    c2: p.c1,
                    aa1: p.aa2,
                    aa2: p.aa1,
                    at1: p.at2,
                    at2: p.at1,
                    category: p.category,
                    backgroundColor: p.backgroundColor,
                    label: `${p.category} | ${p.c2}:${p.aa2}${p.y} (${p.at2}) - ${p.c1}:${p.aa1}${p.x} (${p.at1})`
                });
            }
        });
        return out;
    }

    function updateChart() {
        const selectedX = document.getElementById('chainX').value;
        const selectedY = document.getElementById('chainY').value;

        // Cada dataset corresponde a uma categoria; refiltra pela cadeia escolhida
        scatterChart.data.datasets.forEach(ds => {
            ds.data = pointsForChains(datasetsMap[ds.label] || [], selectedX, selectedY);
        });
        scatterChart.options.scales.x.title.text = `Chain ${selectedX}`;
        scatterChart.options.scales.y.title.text = `Chain ${selectedY}`;
        fitAxesToData();
        scatterChart.update();
    }

    function saveChart() {
        const canvas = document.getElementById('scatterChart');
        const link = document.createElement('a');
        link.href = canvas.toDataURL('image/png');
        link.download = 'contacts_<?= $id ?>.png';
        link.click();
    }

    // Volta o mapa de contatos ao enquadramento original (desfaz o zoom)
    function resetChartZoom() {
        if (scatterChart) {
            scatterChart.resetZoom();
        }
    }

    // Ajusta os eixos ao intervalo real de numeros de residuo dos pontos
    // exibidos. Sem isso o eixo comecaria sempre em 1 e mostraria uma faixa
    // vazia enorme quando a numeracao da estrutura nao comeca em 1.
    function fitAxesToData() {
        if (!scatterChart) { return; }
        const sx = scatterChart.options.scales.x;
        const sy = scatterChart.options.scales.y;
        let minX = Infinity, maxX = -Infinity, minY = Infinity, maxY = -Infinity, n = 0;
        scatterChart.data.datasets.forEach(function(ds) {
            ds.data.forEach(function(p) {
                if (p.x < minX) { minX = p.x; }
                if (p.x > maxX) { maxX = p.x; }
                if (p.y < minY) { minY = p.y; }
                if (p.y > maxY) { maxY = p.y; }
                n++;
            });
        });
        if (!n) { // sem pontos: deixa o Chart.js escalar automaticamente
            sx.min = sx.max = sy.min = sy.max = undefined;
            return;
        }
        const padX = Math.max(1, Math.round((maxX - minX) * 0.03));
        const padY = Math.max(1, Math.round((maxY - minY) * 0.03));
        sx.min = minX - padX; sx.max = maxX + padX;
        sy.min = minY - padY; sy.max = maxY + padY;
    }

    // Converte uma cor hexadecimal (#rrggbb) para rgba com a opacidade indicada
    function hexToRgba(hex, alpha) {
        const h = hex.replace('#', '');
        const r = parseInt(h.substring(0, 2), 16);
        const g = parseInt(h.substring(2, 4), 16);
        const b = parseInt(h.substring(4, 6), 16);
        return `rgba(${r}, ${g}, ${b}, ${alpha})`;
    }

    // Exibe, no viewer 3D do modal, o par de contatos do ponto clicado no mapa.
    // Reutiliza os mesmos padroes visuais do viewer principal.
    function showContactInModal(p) {
        if (!modalViewer) {
            return;
        }

        const res1 = String(p.x);
        const res2 = String(p.y);
        const type = (p.c1 === p.c2) ? 'INTRA' : 'INTER';

        // Destaca o par de residuos uma unica vez (limpa contatos anteriores)
        highlightPair(modalViewer, res1, p.c1, res2, p.c2, type);

        // Um ponto do mapa pode sobrepor varios contatos (atomos/tipos diferentes)
        // entre o mesmo par de residuos: desenha uma linha para cada um deles,
        // colorida conforme o tipo de contato (mesmas cores da legenda do mapa).
        // O ponto clicado pode estar espelhado (eixos invertidos): procura o
        // contato original nas duas orientacoes.
        const pairContacts = allDataPoints.filter(function(q) {
            return (q.c1 === p.c1 && q.c2 === p.c2 && q.x === p.x && q.y === p.y) ||
                (q.c1 === p.c2 && q.c2 === p.c1 && q.x === p.y && q.y === p.x);
        });

        pairContacts.forEach(function(q) {
            drawContact(
                modalViewer,
                String(q.x), q.c1, q.at1,
                String(q.y), q.c2, q.at2,
                colorMap[q.category] || 'orange'
            );
        });

        modalViewer.render();
    }

    // Cria o viewer 3D dentro do modal na primeira vez que ele e aberto.
    // (Precisa ser criado com o modal visivel para o canvas ter dimensoes corretas.)
    document.getElementById('contactMap').addEventListener('shown.bs.modal', function() {
        if (!modalViewer) {
            modalViewer = $3Dmol.createViewer('pdb_modal', {
                defaultcolors: $3Dmol.rasmolElementColors
            });
            modalViewer.setBackgroundColor(0xffffff);
        }

        // Carrega o modelo assim que o PDB estiver disponivel (lazy: pode ainda
        // estar baixando na primeira abertura do modal)
        if (!modalViewer._modelLoaded && moldata) {
            modalViewer.addModel(moldata, 'pdb');
            styleWhole(modalViewer);
            modalViewer.zoomTo();
            modalViewer.render();
            modalViewer._modelLoaded = true;
        }

        // Ajusta o tamanho do canvas do 3Dmol e do grafico agora que estao visiveis
        modalViewer.resize();
        modalViewer.render();
        if (scatterChart) {
            scatterChart.resize();
        }
    });

    fetch('<?php echo base_url(); ?>data/<?= $db ?>/multipro/contacts/<?= $id ?>/<?= substr($id, 0, 4) ?>_contacts.csv')
        .then(response => response.text())
        .then(text => {
            const lines = text.split('\n').map(line => line.trim()).filter(line => line);
            lines.shift(); // Ignorar a primeira linha
            let colorIndex = 0;

            lines.forEach(line => {
                const values = line.split(',');
                if (values.length >= 10) {
                    const c1 = values[0];
                    const x = parseFloat(values[1]);
                    const aa1 = values[2];
                    const at1 = values[3];
                    const c2 = values[4];
                    const y = parseFloat(values[5]);
                    const aa2 = values[6];
                    const at2 = values[7];
                    const category = values[9].trim();
                    const label = `${category} | ${c1}:${aa1}${x} (${at1}) - ${c2}:${aa2}${y} (${at2})`;

                    allChains.add(c1);
                    allChains.add(c2);

                    if (!colorMap[category]) {
                        colorMap[category] = cat10Colors[colorIndex % cat10Colors.length];
                        colorIndex++;
                    }

                    const point = {
                        x,
                        y,
                        c1,
                        c2,
                        aa1,
                        aa2,
                        at1,
                        at2,
                        category,
                        backgroundColor: colorMap[category],
                        label
                    };

                    allDataPoints.push(point);

                    // Agrupa por categoria para gerar um dataset por tipo de contato
                    if (!datasetsMap[category]) {
                        datasetsMap[category] = [];
                    }
                    datasetsMap[category].push(point);
                }
            });

            populateChainSelectors();

            // Um dataset por categoria: assim a legenda nativa do Chart.js
            // permite ocultar/mostrar os pontos de cada tipo ao clicar nela
            const datasets = Object.keys(datasetsMap).map(category => ({
                label: category,
                data: pointsForChains(datasetsMap[category], defaultChainX, defaultChainY),
                backgroundColor: colorMap[category],
                borderWidth: 0,
                pointRadius: 5,
                pointHoverRadius: 7,
            }));

            const ctx = document.getElementById('scatterChart').getContext('2d');
            scatterChart = new Chart(ctx, {
                type: 'scatter',
                data: {
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    // Clique em um ponto: exibe o par de contatos no viewer 3D do modal
                    onClick: function(event, elements) {
                        if (elements.length > 0) {
                            const el = elements[0];
                            const point = scatterChart.data.datasets[el.datasetIndex].data[el.index];
                            showContactInModal(point);
                        }
                    },
                    onHover: function(event, elements) {
                        if (event.native && event.native.target) {
                            event.native.target.style.cursor = elements.length ? 'pointer' : 'default';
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.raw.label;
                                }
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top',
                            // onClick padrao do Chart.js: oculta os pontos da categoria
                            // no grafico e risca o texto correspondente na legenda
                            labels: {
                                usePointStyle: true,
                                // Quando a categoria esta oculta, deixa apenas a
                                // bolinha da legenda semi-transparente
                                generateLabels: function(chart) {
                                    const labels = Chart.defaults.plugins.legend.labels.generateLabels(chart);
                                    labels.forEach(function(label) {
                                        if (label.hidden) {
                                            const c = hexToRgba(colorMap[label.text], 0.3);
                                            label.fillStyle = c;
                                            label.strokeStyle = c;
                                        }
                                    });
                                    return labels;
                                }
                            }
                        },
                        // Zoom por selecao de regiao (arrastar), roda do mouse e pinca
                        zoom: {
                            zoom: {
                                drag: {
                                    enabled: true,
                                    backgroundColor: 'rgba(0, 123, 255, 0.15)',
                                    borderColor: 'rgba(0, 123, 255, 0.6)',
                                    borderWidth: 1
                                },
                                wheel: {
                                    enabled: true
                                },
                                pinch: {
                                    enabled: true
                                },
                                mode: 'xy'
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: `Chain ${defaultChainX}`
                            },
                            beginAtZero: false,
                            ticks: {
                                precision: 0 // apenas numeros inteiros (no. de residuo)
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: `Chain ${defaultChainY}`
                            },
                            beginAtZero: false,
                            ticks: {
                                precision: 0 // apenas numeros inteiros (no. de residuo)
                            }
                        }
                    }
                }
            });

            // Ajusta os eixos ao intervalo real de residuos exibidos
            fitAxesToData();
            scatterChart.update();


        })
        .catch(error => console.error('Erro ao carregar o arquivo CSV:', error));
</script>
<?= $this->endSection() ?>