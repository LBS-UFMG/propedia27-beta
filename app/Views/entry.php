<?= $this->extend('template') ?>
<?= $this->section('conteudo') ?>
<!-- Conteúdo personalizado -->

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
                                <li><a class="dropdown-item mt-2" href="<?php echo base_url(); ?>data/db/contacts/<?= $id ?>/<?= substr($id,0,4) ?>_contacts.csv">Contacts</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('/data/' . $db . '/pdb/' . $id[0] . '/' . $id . '.pdb'); ?>">PDB file</a></li>
                                <hr>
                                <li><a class="dropdown-item" href="<?php echo base_url('/data/' . $db . '/csv/' . $id[0] . '/' . $id . '.csv'); ?>">Complex data</a></li>

                                <!-- <li><a class="dropdown-item" href="<?= base_url("/export/pdb-to-pymol/$id") ?>">Export to PyMOL</a></li> -->
                            </ul>
                        </div>
                    </div>

                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#contactMap">
                        Contact map <i class="bi bi-image"></i>
                    </button>

                    <!-- Busca por sitio de ligacao semelhante, ja preenchida com
                         o PDB, a cadeia da proteina e os residuos da interface -->
                    <button type="button" class="btn btn-secondary" id="btn_binding_site"
                        data-bs-toggle="modal" data-bs-target="#probis"
                        title="Search for proteins with a binding site similar to this one"
                        data-pdb="<?= esc($pdb_id, 'attr') ?>"
                        data-chain="<?= esc($info[27], 'attr') ?>"
                        data-residues="<?= esc(str_replace('<br>', '', $info[14]), 'attr') ?>">
                        Find a similar binding site <i class="bi bi-search"></i>
                    </button>
                </h1>

                <script>
                    // Abre a busca por sitio de ligacao ja preenchida com esta
                    // entrada, para o usuario nao redigitar os residuos da interface.
                    document.getElementById('btn_binding_site').addEventListener('click', function() {
                        if (typeof window.probisPreencher !== 'function') {
                            return;
                        }
                        window.probisPreencher({
                            pdb: this.dataset.pdb,
                            chain: this.dataset.chain,
                            residues: this.dataset.residues,
                            // o PDB desta entrada ja esta carregado na pagina:
                            // evita baixar de novo do RCSB
                            pdbText: (typeof moldata !== 'undefined' && moldata) ? moldata : null
                        });
                    });
                </script>

                <div class="mb-3">
                    <a target="_blank" class="badge link-multipro text-light" title="Search in PDB" href="https://www.rcsb.org/structure/<?= $pdb_id ?>">PDB</a>

                    <a target="_blank" class="badge link-multipro text-light" title="Search in UniProt" href="https://www.uniprot.org/uniprot/?query=<?= $pdb_id ?>+database:pdb">UniProt</a>

                    <a target="_blank" class="badge link-multipro text-light" title="Search in PubMed" href="https://www.ncbi.nlm.nih.gov/pubmed/?term=<?= $pdb_id ?>">PubMed</a>
                </div>

                <div class="row mb-1">
                    <div class="col">
                        <strong>PDB ID: </strong><span><?= $info[22] ?></span>
                    </div>
                    <div class="col">
                        <strong>Structure method: </strong><span><?= $info[38] ?></span>
                    </div>
                    <div class="col">
                        <strong>Resolution: </strong><span><?= $info[36] ?></span>
                    </div>
                    <div class="col">
                        <strong>Multipro: </strong>
                        <span>
                            <a class="badge bg-primary link-multipro" href="<?=base_url('/multipro/'.substr($info[0],0,6))?>" title="See this peptide with every protein chain it binds">
                                <?= substr($info[0],0,6) ?>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <strong>Peptide chain: </strong><span><?= $info[23] ?></span>
                    </div>
                    <div class="col">
                        <strong>Peptide length: </strong><span><?= $info[26] ?></span>
                    </div>
                    <div class="col">
                        <strong>Protein chain: </strong><span><?= $info[27] ?></span>
                    </div>
                    <div class="col">
                        <strong>Protein length: </strong><span><?= $info[30] ?></span>
                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col-12">
                        <strong>Description: </strong> <?= $info[39] ?>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-12">
                        <strong>Organism: </strong><span><em><?= ucfirst($info[44]) ?></em></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-8 col-12" ng-if="cttlok" id="col1">

            <div class="row"><!--
            0 id, 1 AAP, 2 ABP, 3 ACP, 4 AIP
            5 ASA_Complex, 6 ASA_Peptide, 7 ASA_Protein, 8 BPP%, 9 BPepA
            10 BProA, 11 BSA, 12 CLASSIFICATION, 13 DEPOSITION_DATE, 14 Interface Residues
            15 No. of apolar-apolar contacts, 16 No. of apolar-polar contacts, 17 No. of charged-apolar contacts, 18 No. of charged-charged contacts, 19 No. of charged-polar contacts
            20 No. of intermolecular contacts, 21 No. of polar-polar contacts, 22 PDB_ID, 23 PEPTIDE_CHAIN, 24 PEPTIDE_DESC
            25 PEPTIDE_SEQ, 26 PEPTIDE_SIZE, 27 PROTEIN_CHAIN, 28 PROTEIN_DESC, 29 PROTEIN_SEQ
            30 PROTEIN_SIZE, 31 Percentage of apolar NIS residues, 32 Percentage of charged NIS residues, 33 Predicted binding affinity (kcal.mol-1), 34 Predicted dissociation constant (M) at 25.0
            35 QSP, 36 RESOLUTION, 37 SBP, 38 STRUCTURE_METHOD, 39 TITLE
            40 binding-cluster, 41 interface-cluster, 42 is_leader, 43 leader_id, 44 organism
            45 peptide_AliphaticIndex, 46 peptide_ExtCoeff_Disulfide, 47 peptide_ExtCoeff_NoDisulfide, 48 peptide_Formula, 49 peptide_GRAVY
            50 peptide_HydrophobicPercent, 51 peptide_InstabilityIndex, 52 peptide_MW, 53 peptide_NegativeResidues, 54 peptide_PositiveResidues
            55 peptide_TotalAtoms, 56 peptide_pI, 57 protein_AliphaticIndex, 58 protein_ExtCoeff_Disulfide, 59 protein_ExtCoeff_NoDisulfide
            60 protein_Formula, 61 protein_GRAVY, 62 protein_HydrophobicPercent, 63 protein_InstabilityIndex, 64 protein_MW
            65 protein_NegativeResidues, 66 protein_PositiveResidues, 67 protein_TotalAtoms, 68 protein_pI, 69 seq100_clusters
            70 sequence-cluster
            -->
                <div class="table-responsive">

                    <table class="table table-striped small">
                        <thead>
                            <tr>
                                <th style="width: 25%;"></th>
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
                                <th>Chain 
                                    <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Chain: Unique identifier assigned to each molecular chain within the same crystallographic structure or PDB entry."><i class="bi bi-question-circle-fill opacity-25"></i></a>
                                </th>
                                <td><?= $info[27] ?></td>
                                <td><?= $info[23] ?></td>
                            </tr>
                            <tr>
                                <th>Description
                                    <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Description: Annotated name or description of the polymer chain, as defined in the PDB file (e.g., 'Chain A - Insulin')."><i class="bi bi-question-circle-fill opacity-25"></i></a>
                                </th>
                                <td><?= $info[28] ?></td>
                                <td><?= $info[24] ?></td>
                            </tr>
                            <tr>
                                <th>Length (residues)
                                    <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Length (residues): Total number of amino acid residues observed in the polymer chain."><i class="bi bi-question-circle-fill opacity-25"></i></a>
                                </th>
                                <td><?= $info[30] ?></td>
                                <td><?= $info[26] ?></td>
                            </tr>
                            <tr>
                                <th>Molecular Weight (Da)
                                    <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Molecular Weight (Da): Total molecular mass of the chain, expressed in Daltons (Da), calculated as the sum of the atomic masses of all atoms in the protein."><i class="bi bi-question-circle-fill opacity-25"></i></a>
                                </th>
                                <td><?= $info[64] ?></td>
                                <td><?= $info[52] ?></td>
                            </tr>
                            <tr>
                                <th>Isoelectric Point (pI)
                                    <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Isoelectric Point (pI): The pH value at which the protein carries no net electrical charge, resulting in minimal electrophoretic mobility."><i class="bi bi-question-circle-fill opacity-25"></i></a>
                                </th>
                                <td><?= $info[68] ?></td>
                                <td><?= $info[56] ?></td>
                            </tr>
                            <tr>
                                <th>Instability Index
                                    <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Instability Index: A computed value that estimates the in vitro stability of a protein. Proteins with an instability index greater than 40 are predicted to be unstable, while lower values indicate greater stability."><i class="bi bi-question-circle-fill opacity-25"></i></a>
                                </th>
                                <td><?= $info[63] ?></td>
                                <td><?= $info[51] ?></td>
                            </tr>
                            <tr>
                                <th>Aliphatic Index
                                    <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Aliphatic Index: A measure of the relative volume occupied by aliphatic side chains (Ala, Val, Ile, and Leu). It is often correlated with the thermostability of the protein."><i class="bi bi-question-circle-fill opacity-25"></i></a>
                                </th>
                                <td><?= $info[57] ?></td>
                                <td><?= $info[45] ?></td>
                            </tr>
                            <tr>
                                <th>GRAVY
                                    <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="GRAVY (Grand Average of Hydropathy): The average hydropathy score of all amino acids in the sequence, based on the Kyte-Doolittle scale. Positive values indicate a more hydrophobic protein, while negative values suggest a more hydrophilic character."><i class="bi bi-question-circle-fill opacity-25"></i></a>
                                </th>
                                <td><?= $info[61] ?></td>
                                <td><?= $info[49] ?></td>
                            </tr>
                            <tr>
                                <th>Hydrophobic (%)
                                    <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Hydrophobic (%): The proportion of residues in the sequence that are classified as hydrophobic (e.g., Ala, Val, Leu, Ile, Phe, Trp, Met), expressed as a percentage of the total number of residues."><i class="bi bi-question-circle-fill opacity-25"></i></a>
                                </th>
                                <td><?= $info[62] ?></td>
                                <td><?= $info[50] ?></td>
                            </tr>
                            <tr>
                                <th>Positive Residues
                                    <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Positive Residues: Total number of positively charged amino acids in the sequence (Lys, Arg, and His)."><i class="bi bi-question-circle-fill opacity-25"></i></a>
                                </th>
                                <td><?= $info[66] ?></td>
                                <td><?= $info[54] ?></td>
                            </tr>
                            <tr>
                                <th>Negative Residues
                                    <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Negative Residues: Total number of negatively charged amino acids in the sequence (Asp and Glu)."><i class="bi bi-question-circle-fill opacity-25"></i></a>
                                </th>
                                <td><?= $info[65] ?></td>
                                <td><?= $info[53] ?></td>
                            </tr>                           
                            <tr>
                                <th>Atomic Formula
                                    <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Atomic Formula: The complete elemental formula representing the protein’s overall atomic composition (e.g., C₂₆₄₄H₄₂₀₅N₇₅₇O₈₁₆S₁₂)."><i class="bi bi-question-circle-fill opacity-25"></i></a>
                                </th>
                                <?php function formata_formula($f){
                                    preg_match('/([0-9]*[+-]+)$/', $f, $m); $c = $m[1] ?? ''; if($c) $f = substr($f, 0, -strlen($c));
                                    return preg_replace('/(\d+)/','<sub>$1</sub>',htmlspecialchars($f)).($c?'<sup>'.$c.'</sup>':'');
                                }?>
                                <td><?= formata_formula($info[60]) ?></td>
                                <td><?= formata_formula($info[48]) ?></td>
                            </tr>
                            <tr>
                                <th>Total Atoms
                                    <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Total Atoms: The total number of atoms constituting the polypeptide chain."><i class="bi bi-question-circle-fill opacity-25"></i></a>
                                </th>
                                <td><?= $info[67] ?></td>
                                <td><?= $info[55] ?></td>
                            </tr>
                            <tr>
                                <th>Extinction Coeff. (with disulfide)
                                    <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Extinction Coefficient (with disulfide): Molar extinction coefficient (in M⁻¹ cm⁻¹) calculated assuming all cysteine residues form disulfide bonds (Cys–Cys). This value indicates the protein’s absorbance at 280 nm under these conditions."><i class="bi bi-question-circle-fill opacity-25"></i></a>
                                </th>
                                <td><?= $info[58] ?></td>
                                <td><?= $info[46] ?></td>
                            </tr>
                            <tr>
                                <th>Extinction Coeff. (no disulfide)
                                    <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Extinction Coefficient (no disulfide): Molar extinction coefficient (in M⁻¹ cm⁻¹) calculated assuming no disulfide bond formation, i.e., all cysteine residues remain in the reduced form."><i class="bi bi-question-circle-fill opacity-25"></i></a>
                                </th>
                                <td><?= $info[59] ?></td>
                                <td><?= $info[47] ?></td>
                            </tr>
                            <?php function quebra40($text) { return wordwrap($text, 40, "<br>", true); } ?>
                            <tr>
                                <th>Sequence
                                    <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Sequence: The primary amino acid structure of the protein or peptide, defining its linear arrangement of residues."><i class="bi bi-question-circle-fill opacity-25"></i></a>
                                </th>
                                <td>
                                    <pre><?= quebra40($info[29]) ?></pre>
                                </td>
                                <td>
                                    <pre><?= quebra40($info[25]) ?></pre>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h2>Classifications</h2>
                </div>
                <hr>
                <div class="col-12">
                    <h4 class="mt-3">Structural similiarities  <sup><a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="This section presents entries that have structural similarities to this entry."><i class="bi bi-question-circle-fill opacity-25"></i></a></sup></h4>
                    <div class="table-responsive">
                    <table class="table table-striped small">
                        <tbody>
                        <tr>
                            <th style="width: 25%;">Cluster leader <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Cluster leader: structures with similar sequences are clustered together, and one of them represents the cluster. "Yes" means this entry is the leader of its cluster; "no" points to the entry that is."><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><label class="badge bg-<?php echo ($info[42] == 'yes') ? 'propedia' : 'danger'; ?>"><?= $info[42] ?></label></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">Similar complex <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Similar complex: If there is an identical sequence, it indicates which is the main entry with an exact sequence (if the sequence is unique, the entry itself will be considered the leader)."><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><a class="badge link-multipro text-light" href="<?= base_url('/entry/' . $info[43]) ?>"><?= $info[43] ?></a></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">Similar peptide <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Similar peptide: Indicates a complex that has a peptide with the exact same sequence."><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><a class="badge link-multipro text-light" href="<?= base_url('/entry/' . $info[69]) ?>"><?= $info[69] ?></a></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">PDB classification <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="PDB classification: Molecular classification according to PDB."><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= $info[12] ?></span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                    <?php
                    // Marca um dado obtido por predicao/estimativa computacional.
                    // O tooltip e inicializado no fim da pagina, junto dos demais.
                    function aviso_predicao($mensagem = '')
                    {
                        $padrao = 'Predicted value: this result was estimated by a computational model and is not experimental data. Use it as an indication and confirm it before drawing conclusions.';
                        $texto = ($mensagem !== '') ? $mensagem : $padrao;
                        echo '<a class="text-warning" style="text-decoration: none" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'
                            . esc($texto, 'attr')
                            . '"><i class="bi bi-exclamation-triangle-fill"></i></a>';
                    }
                    ?>

                    <?php
                    // Marca da classe terapeutica: so o simbolo aparece na tabela;
                    // a probabilidade prevista fica no tooltip.
                    function avalia($valor)
                    {
                        $marca = ($valor >= 0.9) ? '✅' : '❌';
                        $probabilidade = trim((string) $valor);
                        if ($probabilidade === '') {
                            $probabilidade = 'not available';
                        }

                        return '<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'
                            . esc('Predicted probability: ' . $probabilidade, 'attr') . '">' . $marca . '</span>';
                    }
                    ?>
                    <h4 class="mt-3">Therapeutic classes <sup><a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="CSM-peptides classes: CSM-peptides (https://biosig.lab.uq.edu.au/csm_peptides) is a web tool and machine learning model that predicts peptide classes based on their sequence. Using a machine learning model inspired by CSM-peptides, Propedia built six models to predict the function of therapeutic peptides. See the documentation for details on how the AI ​​models were developed. Here, we present the probability that the current peptide belongs to each class, as calculated by our models. Predictive classification of peptide therapeutic functions, index range from 0 to 1, where 0 indicates a low likelihood of belonging to the class and 1 indicates a high probability. For more details, see http://doi.org/10.1002/pro.4442"><i class="bi bi-question-circle-fill opacity-25"></i></a></sup></h4>
                    <div class="table-responsive">
                    <table class="table table-striped small">
                        <tbody>
                        <tr>
                            <th style="width: 25%;"><?php aviso_predicao('Predicted value: this probability comes from a machine learning model trained on peptide sequences, not from an experimental assay. Treat it as an indication and confirm it experimentally.'); ?> Anti-Angiogenic (AAP) <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Anti-Angiogenic (AAP): This value indicates the probability that the peptide sequence belongs to this class. Propedia 26 uses a minimum cutoff value of 0.9 to indicate a high likelihood of belonging to the Anti-Angiogenic class. About Anti-Angiogenic peptide class – Function: They inhibit angiogenesis, that is, the formation of new blood vessels. Importance: Blocking angiogenesis is a strategy used to prevent tumor growth, since cancer depends on blood supply to obtain nutrients. Example of use: Development of antitumor and antiviral therapies. See the documentation for details on how this machine learning model was developed."><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= avalia($info[1]) ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;"><?php aviso_predicao('Predicted value: this probability comes from a machine learning model trained on peptide sequences, not from an experimental assay. Treat it as an indication and confirm it experimentally.'); ?> Antibacterial (ABP) <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Anti-Bacterial (ABP): This value indicates the probability that the peptide sequence belongs to this class. Propedia 26 uses a minimum cutoff value of 0.9 to indicate a high likelihood of belonging to the Anti-Bacterial class. About Anti-Bacterial peptide class – Function: They are antimicrobial peptides that destroy or inhibit the growth of bacteria. Common mechanism: They interact with bacterial membranes, leading to cell lysis (rupture). Importance: They are promising alternatives to traditional antibiotics, especially in the face of bacterial resistance. See the documentation for details on how this machine learning model was developed. "><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= avalia($info[2]) ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;"><?php aviso_predicao('Predicted value: this probability comes from a machine learning model trained on peptide sequences, not from an experimental assay. Treat it as an indication and confirm it experimentally.'); ?> Anticancer (ACP) <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Anti-Cancer (ACP): This value indicates the probability that the peptide sequence belongs to this class. Propedia 26 uses a minimum cutoff value of 0.9 to indicate a high likelihood of belonging to the Anti-Cancer class. About Anti-Cancer peptide class – Function: They induce selective death of tumor cells without significantly affecting normal cells. Mechanism: They can act by altering the permeability of cancer cell membranes, activating apoptosis, or modulating signaling pathways. Application: Development of next-generation antineoplastic therapies. See the documentation for details on how this machine learning model was developed. "><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= avalia($info[3]) ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;"><?php aviso_predicao('Predicted value: this probability comes from a machine learning model trained on peptide sequences, not from an experimental assay. Treat it as an indication and confirm it experimentally.'); ?> Anti-Inflammatory (AIP) <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Anti-Inflammatory (AIP): This value indicates the probability that the peptide sequence belongs to this class. Propedia 26 uses a minimum cutoff value of 0.9 to indicate a high likelihood of belonging to the Anti-Inflammatory class. About Anti-Inflammatory peptide class – Function: They reduce or regulate exaggerated inflammatory responses. Mechanism: They can inhibit pro-inflammatory cytokines (such as TNF-α, IL-6) or modulate macrophage activity. Application: Treatment of chronic inflammatory and autoimmune diseases. See the documentation for details on how this machine learning model was developed. "><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= avalia($info[4]) ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;"><?php aviso_predicao('Predicted value: this probability comes from a machine learning model trained on peptide sequences, not from an experimental assay. Treat it as an indication and confirm it experimentally.'); ?> Quorum Sensing (QSP) <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Quorum Sensing (QSP): This value indicates the probability that the peptide sequence belongs to this class. Propedia 26 uses a minimum cutoff value of 0.9 to indicate a high likelihood of belonging to the Quorum Sensing class. About Quorum Sensing peptide class – Function: They participate in bacterial communication (quorum sensing), regulating collective behaviors such as biofilm formation and virulence. Importance: Understanding and manipulating these peptides can lead to strategies to control bacterial infections without necessarily killing the bacteria (reducing selective pressure for resistance). See the documentation for details on how this machine learning model was developed. "><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= avalia($info[35]) ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;"><?php aviso_predicao('Predicted value: this probability comes from a machine learning model trained on peptide sequences, not from an experimental assay. Treat it as an indication and confirm it experimentally.'); ?> Surface Binding (SBP) <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Surface Binding (SBP): This value indicates the probability that the peptide sequence belongs to this class. Propedia 26 uses a minimum cutoff value of 0.9 to indicate a high likelihood of belonging to the Surface Binding class. About Surface Binding peptide class – Function: They bind to biological surfaces or materials, such as metals, polymers, or minerals. Biotechnological use: They can be used to immobilize enzymes, design biomaterials, biosensors, or nanodevices. Example: Peptides that bind strongly to gold, silica, or metal oxides for use in nanotechnology. See the documentation for details on how this machine learning model was developed. "><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= avalia($info[37]) ?></span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                    <h4 class="mt-3">Propedia v1 classes <sup><a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Classes inherited from Propedia 1.  For more details, see https://doi.org/10.1186/s12859-020-03881-z"><i class="bi bi-question-circle-fill opacity-25"></i></a></sup></h4>
                    <div class="table-responsive">
                    <table class="table table-striped small">
                        <tbody>
                        <tr>
                            <th style="width: 25%;">Binding site <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Structures with similar binding site. For more details, see https://doi.org/10.1186/s12859-020-03881-z"><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= empty($info[40])?'-':$info[40] ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">Interface <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Structures with similar interface. For more details, see https://doi.org/10.1186/s12859-020-03881-z"><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= empty($info[41])?'-':$info[41] ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">Sequence <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Structures with sequences with high identity. For more details, see https://doi.org/10.1186/s12859-020-03881-z"><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= empty($info[70])?'-':$info[70] ?></span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            <div class="row mt-4">
                <h2>Protein-peptide interactions</h2>
            </div>
            <hr>
            <h4 class="mt-3">Surface (calculated using Naccess) <sup><a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="We used naccess to calculate the protein-peptide interaction interface. To more details, see https://www.bioinf.manchester.ac.uk/naccess/nac_intro.html"><i class="bi bi-question-circle-fill opacity-25"></i></a></sup></h4>
            <div class="table-responsive">
                    <table class="table table-striped small">
                        <tbody>
                        <tr>
                            <th style="width: 25%;">ASA (complex)<a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="ASA: Accessible Surface Area (ASA) is the measure of the entire surface area of the molecule that is exposed and can come into contact with the solvent, usually water (value given in Å²)"><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= (int)$info[5] ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">ASA (protein) <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="ΔASA (protein): ΔASA_protein represents the surface area that is no longer exposed to the solvent upon complex formation and is calculated by the equation: ΔASA = ASA_unbound - ASA_bound. (Value given in Å²)"><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= (int)$info[7] ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">ASA (peptide) <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="ΔASA (peptide): ΔASA_peptide represents the surface area that is no longer exposed to the solvent upon complex formation and is calculated by the equation: ΔASA = ASA_unbound - ASA_bound. (Value given in Å²)"><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= (int)$info[6] ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">BProA <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Buried protein area (value given in Å²)"><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= (int)$info[10] ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">BPepA <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Buried peptide area (value given in Å²)"><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= (int)$info[9] ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">BPP% <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Buried Peptide Percentage (%)"><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= (int)$info[8] ?>%</span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">BSA <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Buried Surface Area represents the area effectively shared at the binding interface and was calculated according to the expression. It can be calculated using the formula: BSA = (ASA_protein + ASA_peptide − ASA_complex) / 2 (value given in Å²)"><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= (int)$info[11] ?></span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            <h4 class="mt-3">Interaction energy (calculated using Prodigy) <sup><a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Estimated binding free energy (ΔG) of the protein–peptide complex, predicted by the PRODIGY command line tool. See the documentation to obtain more details. Check the Prodigy website for details about their methodology:  https://rascar.science.uu.nl/prodigy. For more details, see https://doi.org/10.7554/eLife.07454"><i class="bi bi-question-circle-fill opacity-25"></i></a></sup></h4>
            <div class="table-responsive">
                    <table class="table table-striped small">
                        <tbody>
                        <tr>
                            <th style="width: 25%;">Intermolecular contacts <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Number of Intermolecular Contacts: Total number of atomic contacts between the protein and the peptide within a specified cutoff distance (typically ≤ 5.5 Å). A higher number of contacts usually indicates a more extensive interaction interface.
"><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= (int)$info[20] ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">Charged-charged <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Number of Charged–Charged Contacts: Number of interactions between oppositely charged residues (e.g., Lys–Asp, Arg–Glu) across the binding interface, contributing significantly to electrostatic stabilization."><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= (int)$info[18] ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">Charged-polar <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Number of Charged–Polar Contacts: Count of contacts between charged residues and polar uncharged residues (e.g., Lys–Ser, Asp–Thr), which often form hydrogen bonds or dipole interactions."><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= (int)$info[19] ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">Charged-apolar <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Number of Charged–Apolar Contacts: Number of contacts between charged residues and hydrophobic residues (e.g., Arg–Leu, Lys–Val). These interactions typically contribute less to stability but may influence interface geometry."><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= (int)$info[17] ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">Polar-polar <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Number of Polar–Polar Contacts: Number of interactions between polar uncharged residues (e.g., Ser–Thr, Asn–Gln), frequently involving hydrogen bonding or dipole alignment across the interface."><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= (int)$info[21] ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">Apolar-polar <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Number of Apolar–Polar Contacts: Count of interactions between hydrophobic and polar residues at the interface, which can contribute to partial desolvation and interface packing."><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= (int)$info[16] ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">Apolar-apolar <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Number of Apolar–Apolar Contacts: Number of hydrophobic–hydrophobic interactions (e.g., Leu–Val, Phe–Ile) that promote interface stabilization through the exclusion of water molecules (hydrophobic effect)."><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= (int)$info[15] ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">Apolar NIS residues <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Percentage of Apolar NIS Residues (%): Proportion of residues in the Non-Interacting Surface (NIS) that are classified as apolar, expressed as a percentage. This value helps assess the hydrophobic character of the exposed surface outside the binding interface."><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= $info[31] ?>%</span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">Charged NIS residues <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Percentage of Charged NIS Residues (%): Proportion of residues in the Non-Interacting Surface that are charged (either positively or negatively), expressed as a percentage. It reflects the electrostatic nature of the surface not involved in binding."><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= $info[32] ?>%</span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;"><?php aviso_predicao('Predicted value: estimated by the PRODIGY model from the structure of the complex, not measured experimentally. Confirm it before drawing conclusions.'); ?> Predicted free energy of binding (kcal/mol) <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Predicted Binding Affinity (kcal·mol⁻¹): Estimated Gibbs free energy of binding (ΔG), in kilocalories per mole. More negative values indicate stronger predicted binding between the protein and peptide."><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= $info[33] ?></span></td>
                        </tr>
                        <tr>
                            <th style="width: 25%;"><?php aviso_predicao('Predicted value: estimated by the PRODIGY model from the structure of the complex, not measured experimentally. Confirm it before drawing conclusions.'); ?> Predicted dissociation constant (M, 25 ˚C) <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Predicted Dissociation Constant (M) at 25.0 °C: Predicted equilibrium dissociation constant (K_d), expressed in molar units (M), at 25 °C. It represents the expected concentration of the complex at which half of the binding sites are occupied. Lower values correspond to higher binding affinity."><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                            <td><span><?= $info[34] ?></span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            <?php // ---- Interface properties (PISA) ----------------------------
            // As 22 colunas do PISA sao as ultimas do CSV (indices 71 a 92) e so
            // existem a partir da versao 16 da base: entradas antigas, com 71
            // campos, simplesmente nao exibem esta secao.
            if (isset($info[92])): ?>

                <h4 class="mt-3">Interface properties (calculated using PISA) <sup><a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Interface properties (calculated using PISA): Chemical and energetic properties of the protein-peptide interface, calculated with PISA (Protein Interfaces, Surfaces and Assemblies). PISA evaluates the interface and the energetics of the association to estimate how stable the complex is. For more details, see https://www.ebi.ac.uk/pdbe/pisa and https://doi.org/10.1016/j.jmb.2007.05.022"><i class="bi bi-question-circle-fill opacity-25"></i></a></sup></h4>

                <?php if (trim($info[71]) !== 'ok'): ?>
                    <p class="bg-light p-3 rounded small text-muted">PISA could not calculate the interface properties for this entry.</p>
                <?php else: ?>
                    <?php
                    // As colunas 1 do PISA sao as do peptideo e as 2 as da proteina
                    $pisa_pep  = '(peptide)';
                    $pisa_prot = '(protein)';

                    // O CSS nao esta no CSV da entrada; o controller o le do
                    // arquivo resumido. Entra aqui como um indice extra para
                    // caber no mesmo laco das demais linhas.
                    $info[93] = $pisa_css ?? '';

                    // Leitura do CSS: a partir de 0.5 a interface sustenta a
                    // montagem, 0 = nenhum papel nela, vazio = o PISA nao avaliou
                    $css_valor = trim($info[93]);
                    if ($css_valor === '') {
                        $info[94] = '<span class="badge bg-secondary bg-opacity-50">not assessed</span>';
                    } elseif ((float) $css_valor >= 0.5) {
                        $info[94] = '<span class="badge bg-success">strong</span>';
                    } elseif ((float) $css_valor > 0) {
                        $info[94] = '<span class="badge bg-secondary">moderate</span>';
                    } else {
                        $info[94] = '<span class="badge bg-danger">weak</span>';
                    }

                    // [rotulo, texto de ajuda, indice no CSV], agrupados por tipo de medida
                    $pisa_grupos = [
                        ['Interface significance', [
                            ['Interface evidence',
                                'Interface Evidence: reading of the Complexation Significance Score. Strong means the interface sustains the assembly (CSS of 0.5 or above), moderate means it contributes to it (CSS between 0 and 0.5) and weak means it plays no role in the assembly (CSS = 0). Not assessed means PISA could not evaluate the structure.',
                                94, true],
                            ['Complexation significance score (CSS)',
                                'Complexation Significance Score (CSS): how much this interface contributes to the formation of the assembly, from 0 to 1. Propedia reads 0.5 or above as a strong interface and 0 as one that plays no role in the assembly. PISA computes it only for diffraction structures, so it is empty for entries solved by electron microscopy, NMR and other methods.',
                                93],
                        ]],
                        ['Surface area', [
                            ['Interface area (Å²)',
                                'Interface Area: Area of one face of the protein-peptide interface, given in Å². It corresponds to the BSA calculated with NACCESS, reported in the Surface section above.',
                                74],
                            ['Buried area (peptide, Å²)',
                                'Buried Area (peptide): Peptide surface area that becomes buried upon formation of the interface (value given in Å²).',
                                81],
                            ['Buried area (protein, Å²)',
                                'Buried Area (protein): Protein surface area that becomes buried upon formation of the interface (value given in Å²).',
                                85],
                            ['Total buried area (Å²)',
                                'Total Buried Area: Total surface area buried by the association, counting both faces of the interface, in Å². It is therefore about twice the BSA reported by NACCESS, which counts a single face.',
                                91],
                            ['Complex ASA (Å²)',
                                'Complex ASA: Accessible surface area of the complex, given in Å². It corresponds to the ASA (complex) calculated with NACCESS, reported in the Surface section above.',
                                90],
                            ['Dissociation area (Å²)',
                                'Dissociation Area: Interface area that is broken when the complex dissociates, given in Å². It usually coincides with the interface area.',
                                92],
                        ]],
                        ['Energy (predicted)', [
                            ['Dissociation free energy ΔGdiss (kcal/mol)',
                                'Dissociation Free Energy (ΔGdiss): Free energy required to dissociate the complex, in kcal/mol. Positive values indicate a thermodynamically stable complex. It is the PISA counterpart of the binding affinity predicted by PRODIGY, reported in the Interaction energy section above with the opposite sign.',
                                87],
                            ['Solvation energy gain ΔiG (kcal/mol)',
                                'Solvation Energy Gain (ΔiG): Free energy gain, in kcal/mol, obtained on formation of the interface. Negative values indicate a hydrophobic interface, which favours the association. It does not include the contribution of hydrogen bonds and salt bridges across the interface.',
                                75],
                            ['ΔiG P-value',
                                'ΔiG P-value: Statistical significance of the solvation energy gain. Values below 0.5 indicate an interface more hydrophobic than would be expected by chance, that is, an interface likely to be interaction-specific rather than a crystal-packing artefact.',
                                76],
                            ['Solvation energy (peptide, kcal/mol)',
                                'Solvation Energy (peptide): Contribution of the peptide to the solvation free energy gain of the interface (value given in kcal/mol).',
                                82],
                            ['Solvation energy (protein, kcal/mol)',
                                'Solvation Energy (protein): Contribution of the protein to the solvation free energy gain of the interface (value given in kcal/mol).',
                                86],
                            ['Total interaction energy ΔiG (kcal/mol)',
                                'Total Interaction Energy: Solvation energy gain summed over all the interfaces of the structure, in kcal/mol. It is equal to the interface ΔiG when the structure has a single interface.',
                                89],
                            ['Dissociation entropy TΔS (kcal/mol)',
                                'Dissociation Entropy (TΔS): Entropic cost of the association, in kcal/mol. It always opposes the formation of the complex and is taken into account in the calculation of ΔGdiss.',
                                88],
                        ], 'Predicted value: the energies reported by PISA are estimates from an empirical model, not experimental measurements. Use this value as an indication and confirm it before drawing conclusions.'],
                        ['Contacts', [
                            ['Hydrogen bonds',
                                'Hydrogen Bonds: Number of hydrogen bonds identified by PISA between the protein and the peptide across the interface.',
                                77],
                            ['Salt bridges',
                                'Salt Bridges: Number of salt bridges (interactions between oppositely charged groups) identified by PISA across the interface.',
                                78],
                            ['Interface residues ' . $pisa_pep,
                                'Interface Residues (peptide): Number of peptide residues that take part in the interface, that is, residues that lose accessible surface area upon complex formation.',
                                79],
                            ['Interface atoms ' . $pisa_pep,
                                'Interface Atoms (peptide): Number of peptide atoms that take part in the interface.',
                                80],
                            ['Interface residues ' . $pisa_prot,
                                'Interface Residues (protein): Number of protein residues that take part in the interface, that is, residues that lose accessible surface area upon complex formation.',
                                83],
                            ['Interface atoms ' . $pisa_prot,
                                'Interface Atoms (protein): Number of protein atoms that take part in the interface.',
                                84],
                        ]],
                    ];
                    ?>

                    <div class="table-responsive">
                        <table class="table table-striped small">
                            <?php foreach ($pisa_grupos as $pisa_grupo): ?>
                                <tbody>
                                    <tr>
                                        <th colspan="2" class="table-secondary"><?= $pisa_grupo[0] ?></th>
                                    </tr>
                                    <?php foreach ($pisa_grupo[1] as $pisa_linha): ?>
                                        <?php $pisa_valor = trim($info[$pisa_linha[2]]); ?>
                                        <tr>
                                            <th style="width: 25%;"><?php if (isset($pisa_grupo[2])) { aviso_predicao($pisa_grupo[2]); echo ' '; } ?><?= $pisa_linha[0] ?> <a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="<?= esc($pisa_linha[1], 'attr') ?>"><i class="bi bi-question-circle-fill opacity-25"></i></a></th>
                                            <?php // o quarto item da linha, quando existe, diz que o valor ja e HTML ?>
                                        <td><?= ($pisa_valor === '') ? '-' : (isset($pisa_linha[3]) ? $pisa_valor : esc($pisa_valor)) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <h4 class="mt-3">Interface residues <sup><a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Interface Residues (distmax ≤ 6 Å): List of residues located within 6 Å of the interacting partner, defining the binding interface between the protein and peptide."><i class="bi bi-question-circle-fill opacity-25"></i></a></sup></h4>

            <style>
                /* Botoes do topo (Download, Contact map, Find a similar binding site):
                   viram orangered no hover, como os badges-link */
                .title_h2 .btn-secondary:hover,
                .title_h2 .btn-secondary:focus,
                .title_h2 .btn-secondary.show {
                    background-color: orangered;
                    border-color: orangered;
                }

                /* Chave "Lines": ligada no azul do cabecalho, e nao no azul do Bootstrap */
                #show_lines:checked {
                    background-color: #031430;
                    border-color: #031430;
                }
                #show_lines:focus {
                    border-color: #031430;
                    box-shadow: 0 0 0 .25rem rgba(3, 20, 48, .25);
                }

                /* Badges que sao links (Multipro, PDB, UniProt, PubMed, entradas
                   semelhantes): azul do cabecalho, virando orangered no hover */
                .link-multipro {
                    text-decoration: none;
                    background-color: #031430 !important;
                    transition: background-color .15s;
                }
                .link-multipro:hover,
                .link-multipro:focus {
                    background-color: orangered !important;
                }

                /* Botoes dos residuos da interface: no maximo 10 por linha */
                .interface-residues {
                    display: grid; gap: 4px; justify-content: start;
                    /* max-content: cada botao fica do tamanho do seu conteudo,
                       em vez de esticar para preencher a largura da coluna */
                    grid-template-columns: repeat(10, max-content);
                }
                @media (max-width: 575.98px) {
                    .interface-residues { grid-template-columns: repeat(5, max-content); }
                }
                .btn-resi {
                    border: 1px solid #adb5bd; background: #fff; color: #212529;
                    font-size: 0.75rem; padding: 2px 7px; border-radius: 4px;
                    font-weight: 600; line-height: 1.2; cursor: pointer; text-align: center;
                    font-variant-numeric: tabular-nums; transition: background-color .15s;
                }
                .btn-resi:hover { background: #f1f3f5; }
                .btn-resi.active { background: #212529; color: #fff; border-color: #212529; }
            </style>

            <div class="bg-light p-3 rounded small">
                <label class="badge bg-dark">Interface: <?= substr_count($info[14],",")+1 ?> residues</label>
                <label class="badge bg-secondary">Chain: <?= $info[27] ?></label>
                <span class="text-muted ms-1">Click a residue to show it in the 3D viewer.</span>

                <?php
                // Cada residuo da interface vira um botao. O codigo de 1 letra do
                // aminoacido nao esta no CSV: e preenchido pelo JavaScript a partir
                // da estrutura carregada no 3Dmol (ver preencheResiduosInterface).
                $residuos_interface = array_filter(
                    array_map('trim', explode(',', str_replace('<br>', '', $info[14]))),
                    'strlen'
                );
                ?>
                <div class="interface-residues pt-2">
                    <?php foreach ($residuos_interface as $resi): ?>
                        <button type="button" class="btn-resi" data-resi="<?= $resi ?>" data-chain="<?= $info[27] ?>" title="Show residue <?= $resi ?> of chain <?= $info[27] ?> in the 3D viewer"><span class="resi-aa"></span><?= $resi ?></button>
                    <?php endforeach; ?>
                </div>
            </div>

            <h4 class="mt-4">Contacts (calculated using COCaDA)  <sup><a data-bs-toggle="popover" data-bs-title="Help" data-bs-trigger="hover focus" data-bs-content="Contacts (calculated using COCaDA): Number and type of interatomic contacts calculated by the COCaDA tool (https://bioinfo.dcc.ufmg.br/cocada-web), used to characterize specific atom–atom interactions across the interface."><i class="bi bi-question-circle-fill opacity-25"></i></a></sup></h4>
            <?php
            // Contagem de contatos por tipo, exibida nos botões de filtro.
            // Os padrões são os mesmos das buscas aplicadas à tabela (DataTables),
            // para que o número do botão corresponda ao total de linhas filtradas.
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
                <?php // INTRA/INTER so aparecem quando ha os dois tipos: nas entradas
                // pep-pro os contatos sao sempre da interface (INTER)
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
                       espacamento interno menor que o da linha de controles.
                       A margem inferior repete a folga que o .form-check tem por
                       causa do min-height, para o texto "Surface:" ficar alinhado
                       com "Lines" e "Interface". */
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

                        <!-- Destaca a interface: residuos em sticks, superficie por cima
                             e os contatos atomo-atomo da tabela desenhados como linhas -->
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" role="switch" id="show_interface">
                            <label class="form-check-label" for="show_interface" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Interface residues as sticks, covered by a surface, with the atom contacts drawn as lines">
                                <i class="bi bi-intersect d-xxl-none"></i><span class="d-none d-xxl-inline">Interface</span>
                            </label>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-1 surface-group">
                        <label class="mb-0" for="opacityRange">Surface:</label>
                        <input class="form-range" style="max-width: 3.5rem" type="range" id="opacityRange" min="0" max="1" step="0.1" value="0.3">
                        <span class="badge bg-secondary px-1" id="opacityValue">30%</span>
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


<!-- Modal: estrutura 3D em tela cheia, com painel de controles -->
<div class="modal fade" id="zoom" tabindex="-1" aria-labelledby="title3d" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="title3d">3D structure – <?= $id ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <style>
                    #pdbModalViewer canvas { position: relative !important; }
                    #fs_painel .form-label { margin-bottom: 2px; font-weight: 600; }
                    #fs_painel h6 {
                        font-size: 0.75rem; text-transform: uppercase; letter-spacing: .04em;
                        color: #6c757d; margin: 0 0 6px 0;
                    }
                    #fs_painel .fs-bloco { border-top: 1px solid #dee2e6; padding-top: 10px; margin-top: 10px; }
                </style>

                <div class="row g-3">
                    <!-- Painel de controles -->
                    <div class="col-lg-3 col-12 small" id="fs_painel" style="max-height: calc(100vh - 210px); overflow-y: auto;">

                        <h6>Representation</h6>
                        <label class="form-label" for="fs_rep">Style</label>
                        <select id="fs_rep" class="form-select form-select-sm mb-2">
                            <option value="cartoon" selected>Cartoon</option>
                            <option value="cartoon_stick">Cartoon + sticks</option>
                            <option value="stick">Sticks</option>
                            <option value="sphere">Spheres</option>
                            <option value="line">Lines</option>
                        </select>
                        <label class="form-label" for="fs_color">Color</label>
                        <select id="fs_color" class="form-select form-select-sm mb-2">
                            <option value="chain" selected>By chain</option>
                            <option value="ss">By secondary structure</option>
                            <option value="spectrum">Spectrum (N → C)</option>
                            <option value="element">By element</option>
                        </select>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="fs_iface" checked>
                            <label class="form-check-label" for="fs_iface">Interface residues as sticks</label>
                        </div>

                        <div class="fs-bloco">
                            <h6>Surface</h6>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="fs_surface">
                                <label class="form-check-label" for="fs_surface">Show surface</label>
                            </div>
                            <label class="form-label" for="fs_surface_sel">Chains</label>
                            <select id="fs_surface_sel" class="form-select form-select-sm mb-2">
                                <option value="all" selected>All</option>
                                <option value="protein">Protein (<?= $info[27] ?>)</option>
                                <option value="peptide">Peptide (<?= $info[23] ?>)</option>
                            </select>
                            <label class="form-label" for="fs_surface_op">Opacity <span class="badge bg-secondary" id="fs_surface_op_val">40%</span></label>
                            <input class="form-range" type="range" id="fs_surface_op" min="0.1" max="1" step="0.1" value="0.4">
                        </div>

                        <div class="fs-bloco">
                            <h6>Labels</h6>
                            <select id="fs_labels" class="form-select form-select-sm">
                                <option value="none">None</option>
                                <option value="interface" selected>Interface (protein + peptide)</option>
                                <option value="peptide">Peptide only</option>
                                <option value="all">All residues</option>
                            </select>
                        </div>

                        <div class="fs-bloco">
                            <h6>Selection</h6>
                            <div class="d-flex flex-wrap gap-1 mb-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary fs-preset" data-preset="peptide">Peptide</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary fs-preset" data-preset="protein">Protein</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary fs-preset" data-preset="interface">Interface</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="fs_sel_limpar">Clear</button>
                            </div>
                            <div class="input-group input-group-sm">
                                <select id="fs_chain" class="form-select form-select-sm" style="max-width: 5rem;"></select>
                                <input type="text" class="form-control" id="fs_resis" placeholder="e.g. 7, 10-15, 32">
                                <button class="btn btn-dark" type="button" id="fs_sel_aplicar">Show</button>
                            </div>
                            <div class="form-text" id="fs_sel_info">Select residues by number or range.</div>
                        </div>

                        <div class="fs-bloco">
                            <h6>Interface contacts</h6>
                            <label class="form-label" for="fs_cutoff">Cutoff <span class="badge bg-secondary" id="fs_cutoff_val">6.0 Å</span></label>
                            <input class="form-range" type="range" id="fs_cutoff" min="3" max="8" step="0.5" value="6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="fs_contatos">
                                <label class="form-check-label" for="fs_contatos">Show residue pairs</label>
                            </div>
                            <div class="form-text" id="fs_contatos_info">Dashed lines between protein and peptide residues within the cutoff.</div>
                        </div>

                        <div class="fs-bloco">
                            <h6>View</h6>
                            <div class="d-flex flex-wrap gap-1">
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="fs_reset"><i class="bi bi-arrow-counterclockwise"></i> Reset view</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="fs_spin"><i class="bi bi-arrow-repeat"></i> Spin</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="fs_png"><i class="bi bi-download"></i> Save image</button>
                            </div>
                        </div>
                    </div>

                    <!-- Contêiner do 3Dmol -->
                    <div class="col-lg-9 col-12">
                        <div id="pdbModalViewer" style="height: calc(100vh - 210px); min-height: 420px; width: 100%; position: relative;"></div>
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    // ============ Viewer 3D em tela cheia (#zoom) ============
    // Funciona de forma independente dos outros dois viewers da pagina: tudo o
    // que ele cria (superficies, formas, labels) fica guardado nas listas abaixo.
    let glviewerModal = null;
    let fsSuperficies = [];      // superficies criadas
    let fsFormas = [];           // cilindros dos contatos
    let fsRotulosRes = [];       // labels de residuo
    let fsRotulosCont = [];      // labels de distancia dos contatos
    let fsSelecao = null;        // {chain: 'A', resis: [7, 10, ...]}
    let fsIfacePep = [];         // residuos do peptideo na interface
    let fsIfaceProt = [];        // residuos da proteina na interface
    let fsGirando = false;

    const fsCadeiaPep = '<?= $info[23] ?>';
    const fsCadeiaProt = '<?= $info[27] ?>';
    const fsResIface = [<?= implode(',', array_map('intval', $residuos_interface ?? [])) ?>];

    // Cadeias do modelo (usa o mapa de cores do viewer principal quando disponivel)
    function fsCadeias() {
        const doMapa = Object.keys(chainColorMap);
        if (doMapa.length) {
            return doMapa;
        }
        return [fsCadeiaProt, fsCadeiaPep].filter(function(c, i, a) {
            return c && a.indexOf(c) === i;
        });
    }

    function fsCor(chain) {
        return chainColorMap[chain] || (chain === fsCadeiaPep ? 'orangered' : 'grey');
    }

    // Cor do cartoon, conforme o seletor Color. O nome do esquema de estrutura
    // secundaria no 3Dmol e 'ssPyMol' (helice vermelha, folha amarela, alca verde).
    function fsSpecCor(chain) {
        const cor = $('#fs_color').val();
        if (cor === 'element') {
            return {}; // cores padrao por elemento
        }
        if (cor === 'spectrum') {
            return { color: 'spectrum' };
        }
        if (cor === 'ss') {
            return { colorscheme: 'ssPyMol' };
        }
        return { color: fsCor(chain) };
    }

    // Cor de sticks/esferas/linhas. Em "By chain" usa o esquema <cor>Carbon: os
    // carbonos ficam na cor da cadeia e os heteroatomos (N, O, S) nas cores
    // padrao do elemento, em vez de tudo pintado de uma cor so.
    function fsSpecAtomos(chain) {
        const cor = $('#fs_color').val();
        if (cor === 'element') {
            return {};
        }
        if (cor === 'spectrum') {
            return { color: 'spectrum' };
        }
        if (cor === 'ss') {
            return { colorscheme: 'ssPyMol' };
        }
        return { colorscheme: fsCor(chain) + 'Carbon' };
    }

    // Estilo base da estrutura inteira, cadeia por cadeia
    function fsEstiloBase() {
        const rep = $('#fs_rep').val();
        fsCadeias().forEach(function(chain) {
            const cartoon = fsSpecCor(chain);
            const atomos = fsSpecAtomos(chain);
            let estilo;
            if (rep === 'cartoon') {
                estilo = { cartoon: cartoon };
            } else if (rep === 'cartoon_stick') {
                estilo = { cartoon: cartoon, stick: Object.assign({ radius: 0.12 }, atomos) };
            } else if (rep === 'stick') {
                estilo = { stick: Object.assign({ radius: 0.15 }, atomos) };
            } else if (rep === 'sphere') {
                estilo = { sphere: Object.assign({ scale: 0.3 }, atomos) };
            } else {
                estilo = { line: atomos };
            }
            glviewerModal.setStyle({ chain: chain }, estilo);
        });
    }

    // Residuos da interface (as duas cadeias) em sticks, por cima do cartoon.
    // Somados com addStyle para nao partir a fita do cartoon.
    function fsEstiloInterface() {
        if (!$('#fs_iface').prop('checked')) {
            return;
        }
        if (fsIfacePep.length) {
            glviewerModal.addStyle({
                chain: fsCadeiaPep,
                resi: fsIfacePep
            }, {
                stick: Object.assign({ radius: 0.15 }, fsSpecAtomos(fsCadeiaPep))
            });
        }
        if (fsIfaceProt.length) {
            glviewerModal.addStyle({
                chain: fsCadeiaProt,
                resi: fsIfaceProt
            }, {
                stick: Object.assign({ radius: 0.15 }, fsSpecAtomos(fsCadeiaProt))
            });
        }
    }

    // Residuos da interface das duas cadeias, pelo mesmo criterio da lista da
    // pagina (atomos a 6 Å ou menos da outra cadeia).
    function fsCalculaInterface() {
        const corte2 = 6.0 * 6.0;
        const pep = glviewerModal.selectedAtoms({ chain: fsCadeiaPep });
        const prot = glviewerModal.selectedAtoms({ chain: fsCadeiaProt });
        const naPep = {};
        const naProt = {};
        pep.forEach(function(a) {
            prot.forEach(function(b) {
                const dx = a.x - b.x;
                const dy = a.y - b.y;
                const dz = a.z - b.z;
                if (dx * dx + dy * dy + dz * dz <= corte2) {
                    naPep[a.resi] = true;
                    naProt[b.resi] = true;
                }
            });
        });
        fsIfacePep = Object.keys(naPep).map(Number);
        fsIfaceProt = Object.keys(naProt).map(Number);
    }

    // Sticks amarelos sobre os residuos selecionados. Usa addStyle para nao
    // partir o cartoon da cadeia (ver o comentario em styleHighlight).
    function fsEstiloSelecao() {
        if (!fsSelecao || !fsSelecao.resis.length) {
            return;
        }
        glviewerModal.addStyle({
            chain: fsSelecao.chain,
            resi: fsSelecao.resis
        }, {
            stick: { colorscheme: 'yellowCarbon', radius: 0.2 }
        });
    }

    // Reaplica estilo base + selecao (nao mexe em superficies, labels e contatos)
    function fsAtualiza() {
        if (!glviewerModal) {
            return;
        }
        fsEstiloBase();
        fsEstiloInterface();
        fsEstiloSelecao();
        glviewerModal.render();
    }

    // ---- Superficie ----
    function fsRemoveSuperficies() {
        if (typeof glviewerModal.removeAllSurfaces === 'function') {
            glviewerModal.removeAllSurfaces();
        } else {
            fsSuperficies.forEach(function(sup) {
                try {
                    glviewerModal.removeSurface(sup);
                } catch (err) {
                    console.warn('removeSurface falhou', err);
                }
            });
        }
        fsSuperficies = [];
    }

    function fsAplicaSuperficie() {
        if (!glviewerModal) {
            return;
        }
        fsRemoveSuperficies();
        if ($('#fs_surface').prop('checked')) {
            const opacidade = parseFloat($('#fs_surface_op').val());
            const alvo = $('#fs_surface_sel').val();
            let cadeias = fsCadeias();
            if (alvo === 'protein') {
                cadeias = [fsCadeiaProt];
            } else if (alvo === 'peptide') {
                cadeias = [fsCadeiaPep];
            }
            cadeias.forEach(function(chain) {
                fsSuperficies.push(glviewerModal.addSurface($3Dmol.SurfaceType.VDW, {
                    opacity: opacidade,
                    color: fsCor(chain)
                }, {
                    chain: chain
                }));
            });
        }
        glviewerModal.render();
    }

    // ---- Labels de residuo ----
    function fsLimpaRotulosRes() {
        fsRotulosRes.forEach(function(l) {
            glviewerModal.removeLabel(l);
        });
        fsRotulosRes = [];
    }

    function fsAplicaLabels() {
        if (!glviewerModal) {
            return;
        }
        fsLimpaRotulosRes();

        const modo = $('#fs_labels').val();
        if (modo !== 'none') {
            let atomos = glviewerModal.selectedAtoms({ atom: 'CA' });
            if (modo === 'peptide') {
                atomos = atomos.filter(function(a) {
                    return a.chain === fsCadeiaPep;
                });
            } else if (modo === 'interface') {
                // Residuos da interface das duas cadeias
                atomos = atomos.filter(function(a) {
                    return (a.chain === fsCadeiaPep && fsIfacePep.indexOf(a.resi) >= 0) ||
                        (a.chain === fsCadeiaProt && fsIfaceProt.indexOf(a.resi) >= 0);
                });
            }
            atomos.forEach(function(a) {
                fsRotulosRes.push(glviewerModal.addLabel(three2one(a.resn) + a.resi, {
                    position: { x: a.x, y: a.y, z: a.z },
                    fontSize: 10,
                    fontColor: 'black',
                    backgroundColor: 'white',
                    backgroundOpacity: 0,
                    inFront: true
                }));
            });
        }
        glviewerModal.render();
    }

    // ---- Pares de residuos dentro do corte (linha pontilhada + distancia) ----
    function fsLimpaContatos() {
        fsFormas.forEach(function(sh) {
            glviewerModal.removeShape(sh);
        });
        fsRotulosCont.forEach(function(l) {
            glviewerModal.removeLabel(l);
        });
        fsFormas = [];
        fsRotulosCont = [];
    }

    function fsAplicaContatos() {
        if (!glviewerModal) {
            return;
        }
        fsLimpaContatos();

        if (!$('#fs_contatos').prop('checked')) {
            $('#fs_contatos_info').text('Dashed lines between protein and peptide residues within the cutoff.');
            glviewerModal.render();
            return;
        }

        const corte = parseFloat($('#fs_cutoff').val());
        const corte2 = corte * corte;
        const pep = glviewerModal.selectedAtoms({ chain: fsCadeiaPep });
        const prot = glviewerModal.selectedAtoms({ chain: fsCadeiaProt });

        // Guarda, para cada par de residuos, apenas o par de atomos mais proximo
        const pares = {};
        pep.forEach(function(a) {
            prot.forEach(function(b) {
                const dx = a.x - b.x;
                const dy = a.y - b.y;
                const dz = a.z - b.z;
                const d2 = dx * dx + dy * dy + dz * dz;
                if (d2 > corte2) {
                    return;
                }
                const chave = a.resi + ':' + b.resi;
                if (!pares[chave] || d2 < pares[chave].d2) {
                    pares[chave] = { a: a, b: b, d2: d2 };
                }
            });
        });

        const chaves = Object.keys(pares);
        chaves.forEach(function(chave) {
            const par = pares[chave];
            const dist = Math.sqrt(par.d2);

            fsFormas.push(glviewerModal.addCylinder({
                dashed: true,
                start: { x: par.a.x, y: par.a.y, z: par.a.z },
                end: { x: par.b.x, y: par.b.y, z: par.b.z },
                radius: 0.08,
                fromCap: 1,
                toCap: 1,
                color: 'black'
            }));

            fsRotulosCont.push(glviewerModal.addLabel(dist.toFixed(2), {
                position: {
                    x: (par.a.x + par.b.x) / 2,
                    y: (par.a.y + par.b.y) / 2,
                    z: (par.a.z + par.b.z) / 2
                },
                fontSize: 9,
                fontColor: 'white',
                backgroundColor: 'black',
                backgroundOpacity: 0.7,
                inFront: true
            }));
        });

        $('#fs_contatos_info').text(chaves.length + ' residue pairs within ' + corte.toFixed(1) + ' Å (distances in Å).');
        glviewerModal.render();
    }

    // ---- Selecao de residuos ----
    // Aceita numeros e intervalos: "7, 10-15, 32"
    function fsLeResiduos(texto) {
        const resis = [];
        String(texto).split(/[,;\s]+/).forEach(function(parte) {
            if (!parte) {
                return;
            }
            const faixa = parte.match(/^(\d+)\s*-\s*(\d+)$/);
            if (faixa) {
                for (let i = parseInt(faixa[1], 10); i <= parseInt(faixa[2], 10); i++) {
                    resis.push(i);
                }
            } else if (/^\d+$/.test(parte)) {
                resis.push(parseInt(parte, 10));
            }
        });
        return resis;
    }

    function fsSeleciona(chain, resis, descricao) {
        fsSelecao = (resis && resis.length) ? { chain: chain, resis: resis } : null;
        fsAtualiza();
        if (fsSelecao) {
            glviewerModal.zoomTo({ chain: chain, resi: resis });
            glviewerModal.render();
            $('#fs_sel_info').text(descricao || (resis.length + ' residues of chain ' + chain));
        } else {
            $('#fs_sel_info').text('Select residues by number or range.');
        }
    }

    // Todos os residuos de uma cadeia
    function fsResiduosDaCadeia(chain) {
        const vistos = {};
        glviewerModal.selectedAtoms({ chain: chain }).forEach(function(a) {
            vistos[a.resi] = true;
        });
        return Object.keys(vistos).map(Number);
    }

    // ---- Inicializacao (na primeira vez que o modal e aberto) ----
    document.getElementById('zoom').addEventListener('shown.bs.modal', function() {
        if (!glviewerModal) {
            glviewerModal = $3Dmol.createViewer('pdbModalViewer', {
                defaultcolors: $3Dmol.rasmolElementColors
            });
            glviewerModal.setBackgroundColor(0xffffff);
        }

        if (!glviewerModal._modelLoaded) {
            const carrega = function(pdb) {
                glviewerModal.addModel(pdb, 'pdb');
                glviewerModal._modelLoaded = true;

                // Seletor de cadeias do painel
                const seletor = document.getElementById('fs_chain');
                seletor.innerHTML = '';
                fsCadeias().forEach(function(chain) {
                    const op = document.createElement('option');
                    op.value = op.textContent = chain;
                    seletor.appendChild(op);
                });
                seletor.value = fsCadeiaProt;

                fsCalculaInterface();
                fsAtualiza();
                fsAplicaLabels();
                glviewerModal.zoomTo();
                glviewerModal.render();
            };

            if (moldata) {
                carrega(moldata); // reaproveita o PDB ja baixado pelo viewer da pagina
            } else {
                $.get('<?php echo base_url('/data/' . $db . '/pdb/' . $id[0] . '/' . $id . '.pdb'); ?>', carrega);
            }
        }

        glviewerModal.resize();
        glviewerModal.render();
    });

    // ---- Eventos do painel ----
    $('#fs_rep, #fs_color, #fs_iface').on('change', fsAtualiza);

    $('#fs_surface, #fs_surface_sel').on('change', fsAplicaSuperficie);
    $('#fs_surface_op').on('input', function() {
        $('#fs_surface_op_val').text((parseFloat(this.value) * 100).toFixed(0) + '%');
        if ($('#fs_surface').prop('checked')) {
            fsAplicaSuperficie();
        }
    });

    $('#fs_labels').on('change', fsAplicaLabels);

    $('#fs_contatos').on('change', fsAplicaContatos);
    $('#fs_cutoff').on('input', function() {
        $('#fs_cutoff_val').text(parseFloat(this.value).toFixed(1) + ' Å');
    });
    $('#fs_cutoff').on('change', function() {
        if ($('#fs_contatos').prop('checked')) {
            fsAplicaContatos();
        }
    });

    $('#fs_sel_aplicar').on('click', function() {
        const chain = $('#fs_chain').val();
        const resis = fsLeResiduos($('#fs_resis').val());
        if (!resis.length) {
            $('#fs_sel_info').text('No valid residue number in the field.');
            return;
        }
        fsSeleciona(chain, resis);
    });

    $('#fs_resis').on('keydown', function(e) {
        if (e.key === 'Enter') {
            $('#fs_sel_aplicar').click();
        }
    });

    $('.fs-preset').on('click', function() {
        const preset = this.dataset.preset;
        if (preset === 'peptide') {
            fsSeleciona(fsCadeiaPep, fsResiduosDaCadeia(fsCadeiaPep), 'Peptide chain ' + fsCadeiaPep);
        } else if (preset === 'protein') {
            fsSeleciona(fsCadeiaProt, fsResiduosDaCadeia(fsCadeiaProt), 'Protein chain ' + fsCadeiaProt);
        } else if (preset === 'interface') {
            fsSeleciona(fsCadeiaProt, fsResIface, fsResIface.length + ' interface residues of chain ' + fsCadeiaProt);
        }
    });

    $('#fs_sel_limpar').on('click', function() {
        $('#fs_resis').val('');
        fsSeleciona(null, []);
        glviewerModal.zoomTo();
        glviewerModal.render();
    });

    $('#fs_reset').on('click', function() {
        if (!glviewerModal) {
            return;
        }
        fsSelecao = null;
        $('#fs_resis').val('');
        $('#fs_surface').prop('checked', false);
        $('#fs_contatos').prop('checked', false);
        $('#fs_iface').prop('checked', true);
        $('#fs_labels').val('interface');
        fsRemoveSuperficies();
        fsLimpaContatos();
        fsAtualiza();
        fsAplicaLabels();
        glviewerModal.zoomTo();
        glviewerModal.render();
        $('#fs_sel_info').text('Select residues by number or range.');
        $('#fs_contatos_info').text('Dashed lines between protein and peptide residues within the cutoff.');
    });

    $('#fs_spin').on('click', function() {
        if (!glviewerModal) {
            return;
        }
        fsGirando = !fsGirando;
        glviewerModal.spin(fsGirando ? 'y' : false);
        $(this).toggleClass('active btn-dark', fsGirando);
    });

    $('#fs_png').on('click', function() {
        if (!glviewerModal) {
            return;
        }
        const link = document.createElement('a');
        link.href = glviewerModal.pngURI();
        link.download = '<?= $id ?>.png';
        link.click();
    });
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

    /* Select ID (usado pela tabela): destaca o par e desenha um unico contato */
    function selectID(glviewer, residues, type, chain1, chain2, a1, a2) {

        residues = residues.split("/");

        var res1 = residues[0].substr(1);
        var res2 = residues[1].substr(1);

        highlightPair(glviewer, res1, chain1, res2, chain2, type);
        drawContact(glviewer, res1, chain1, a1, res2, chain2, a2);

        glviewer.render();
    }

    // Cadeia do peptideo, usada para achar o contato mais proximo de um residuo
    // da interface (a lista da interface e sempre da cadeia da proteina).
    const cadeiaPeptideo = '<?= $info[23] ?>';

    // Par de atomos mais proximo entre um residuo (da proteina) e o peptideo.
    // Devolve {a: atomo do residuo, b: atomo do peptideo, dist} ou null.
    function atomoPeptideoMaisProximo(viewer, chain, resi) {
        var resAtoms = viewer.selectedAtoms({
            chain: chain,
            resi: resi
        });
        var pepAtoms = viewer.selectedAtoms({
            chain: cadeiaPeptideo
        });
        var melhor = null;

        resAtoms.forEach(function(a) {
            pepAtoms.forEach(function(b) {
                var dx = a.x - b.x;
                var dy = a.y - b.y;
                var dz = a.z - b.z;
                var d2 = dx * dx + dy * dy + dz * dz;
                if (melhor === null || d2 < melhor.d2) {
                    melhor = {
                        a: a,
                        b: b,
                        d2: d2
                    };
                }
            });
        });

        if (melhor) {
            melhor.dist = Math.sqrt(melhor.d2);
        }
        return melhor;
    }

    // Destaca UM residuo (botoes da lista de residuos da interface): limpa a
    // selecao anterior e mostra o residuo junto com o residuo mais proximo do
    // peptideo, com a distancia entre os dois.
    function highlightResidue(viewer, chain, resi) {
        if (!viewer) {
            return;
        }

        resi = parseInt(resi, 10);

        // Mesma bookkeeping dos contatos, para que uma selecao substitua a outra
        // e o botao Clear limpe tudo
        (viewer._contactLabels || []).forEach(function(l) {
            viewer.removeLabel(l);
        });
        (viewer._contactShapes || []).forEach(function(sh) {
            viewer.removeShape(sh);
        });
        viewer._contactLabels = [];
        viewer._contactShapes = [];

        var perto = atomoPeptideoMaisProximo(viewer, chain, resi);

        if (perto) {
            // Destaca os dois residuos e desenha a distancia entre os atomos
            // mais proximos, no mesmo padrao dos contatos da tabela
            styleHighlight(viewer, resi, chain, perto.b.resi, cadeiaPeptideo);

            // Residuo do peptideo na mesma cor do cartoon da cadeia (orangered):
            // carbonos nessa cor, heteroatomos com as cores padrao do elemento.
            // addStyle (e nao setStyle) para nao partir o cartoon da cadeia.
            var corPeptideo = chainColorMap[cadeiaPeptideo] || 'orangered';
            viewer.addStyle({
                chain: cadeiaPeptideo,
                resi: perto.b.resi
            }, {
                stick: {
                    colorscheme: corPeptideo + 'Carbon'
                }
            });

            drawContact(viewer, resi, chain, perto.a.atom, perto.b.resi, cadeiaPeptideo, perto.b.atom);

            // Enquadra o par (residuo da interface + residuo do peptideo)
            viewer.zoomTo({
                or: [{
                    chain: chain,
                    resi: resi
                }, {
                    chain: cadeiaPeptideo,
                    resi: perto.b.resi
                }]
            });
        } else {
            // Sem peptideo por perto: destaca so o residuo, com um label no CA
            styleWhole(viewer);
            viewer.addStyle({
                resi: resi,
                chain: chain
            }, {
                stick: {
                    colorscheme: 'whiteCarbon'
                }
            });

            var atoms = viewer.selectedAtoms({
                resi: resi,
                chain: chain
            });
            if (atoms.length) {
                var atom = atoms.filter(function(a) {
                    return a.atom === 'CA';
                })[0] || atoms[0];

                viewer._contactLabels.push(viewer.addLabel(
                    three2one(atom.resn) + atom.resi + " (" + chain + ")", {
                        position: {
                            x: atom.x,
                            y: atom.y,
                            z: atom.z
                        },
                        fontSize: 12,
                        fontColor: "white",
                        backgroundColor: "black",
                        backgroundOpacity: 0.8,
                        inFront: true,
                        borderThickness: 0.5,
                        borderColor: "white"
                    }
                ));
            }

            viewer.zoomTo({
                resi: resi,
                chain: chain
            });
        }

        viewer.render();
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

    // Preenche o codigo de 1 letra do aminoacido nos botoes da interface. O CSV
    // guarda so o numero do residuo; o nome vem da estrutura carregada no 3Dmol,
    // que ja traz a numeracao correta (a sequencia sozinha nao serve porque a
    // numeracao do PDB nem sempre comeca em 1).
    function preencheResiduosInterface(atoms) {
        var resn = {};
        atoms.forEach(function(a) {
            resn[a.chain + ':' + a.resi] = a.resn;
        });
        document.querySelectorAll('.btn-resi').forEach(function(b) {
            var nome = resn[b.dataset.chain + ':' + b.dataset.resi];
            if (nome) {
                b.querySelector('.resi-aa').textContent = three2one(nome);
            }
        });
    }

    // Clique em um residuo da interface: exibe-o no viewer 3D da pagina
    $(document).on('click', '.btn-resi', function() {
        $('.btn-resi').removeClass('active');
        $(this).addClass('active');

        // O botao destaca um residuo so, entao a chave "Interface", que destaca a
        // interface inteira, e desligada antes (o change limpa sticks, linhas e
        // rotulos e devolve o estilo base)
        if ($('#show_interface').prop('checked')) {
            $('#show_interface').prop('checked', false).trigger('change');
        }

        highlightResidue(
            (typeof glviewer !== 'undefined') ? glviewer : null,
            this.dataset.chain,
            this.dataset.resi
        );
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
        // Tira o destaque do residuo da interface que estivesse selecionado. Vem
        // antes de ifaceAplica, para a superficie da interface voltar.
        $('.btn-resi').removeClass('active');

        if (typeof glviewer !== 'undefined' && glviewer) {
            resetViewer(glviewer);
            // resetViewer removeu todos os labels do viewer, inclusive os da
            // interface: refaz o destaque para ele nao ficar pela metade
            ifaceRotulos = [];
            ifaceAplica();
        }
    }

    // ============ Destaque da interface no viewer principal (#pdb) ============
    // A chave "Interface", acima da estrutura, poe os residuos da interface em
    // sticks e esferas, cobre os da proteina com uma superficie densa (os do
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

    const ifaceCadeiaProt = '<?= $info[27] ?>';

    <?php
    // Contatos entre cadeias diferentes (proteina x peptideo), no formato do CSV
    // da tabela de contatos: 0 cadeia1, 1 numero1, 2 nome1, 3 atomo1, 4 cadeia2,
    // 5 numero2, 6 nome2, 7 atomo2, 8 distancia, 9 tipo.
    $contatos_interface = [];
    foreach ($contacts as $contact) {
        $c = explode(',', $contact);
        if ((count($c) < 9) or ($c[0] == 'Chain1') or (trim($c[0]) === trim($c[4]))) {
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

    // Residuos da interface por cadeia: os que aparecem nos contatos entre as
    // duas cadeias, mais a lista da interface calculada pelo Naccess (proteina),
    // que e a mesma exibida nos botoes de "Interface residues".
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
        [<?= implode(',', array_map('intval', $residuos_interface ?? [])) ?>].forEach(function(resi) {
            guarda(ifaceCadeiaProt, resi);
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
        var resis = ifaceResiduos[ifaceCadeiaProt];
        if (!resis || !resis.length) {
            return;
        }
        // addSurface devolve uma promise com o id da superficie em .surfid, que
        // e o que removeSurface espera
        var sup = glviewer.addSurface($3Dmol.SurfaceType.VDW, {
            opacity: IFACE_OPACIDADE_PROT,
            color: chainColorMap[ifaceCadeiaProt] || 'grey'
        }, {
            chain: ifaceCadeiaProt,
            resi: resis
        });
        ifaceSuperficies.push((sup && sup.surfid !== undefined) ? sup.surfid : sup);
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
        const pdb_data = "<?php echo base_url('/data/' . $db . '/pdb/' . $id[0] . '/' . $id . '.pdb'); ?>";

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
            // viewer 3D do mapa de contatos
            chains.forEach((chain, i) => {
                chainColorMap[chain] = colors[i % colors.length];
            });

            // Nomes dos residuos da interface (botoes acima da tabela de contatos)
            preencheResiduosInterface(atomsx);

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
                chains.forEach((chain, i) => {
                    const color = colors[i % colors.length];
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

    // Cadeias exibidas por padrao: peptideo (X) e proteina (Y) desta entrada
    const defaultChainX = '<?= substr($id, 5, 1) ?>';
    const defaultChainY = '<?= substr($id, 7, 1) ?>';

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

    fetch('<?php echo base_url(); ?>data/<?= $db ?>/contacts/<?= $id ?>/<?= substr($id, 0, 4) ?>_contacts.csv')
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