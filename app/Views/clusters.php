<?= $this->extend('template') ?>
<?= $this->section('conteudo') ?>
<!-- Conteúdo personalizado -->

<div class="container-fluid">
    <h1><strong>Clusters</strong></h1>
    <p class="text-muted small">
        Propedia is a database geared toward machine learning applications. Therefore, it presents data grouped using different clustering methods.
    </p>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-0" type="button" role="tab" aria-selected="true">Seq100</button>

            <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-1" type="button" role="tab" aria-selected="true">Redundant sequences</button>

            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-2" type="button" role="tab" aria-selected="false">Classifications (PDB)</button>

            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-3" type="button" role="tab" aria-selected="false">Sequence (Propedia v1)</button>

            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-4" type="button" role="tab" aria-selected="false">Interface (Propedia v1)</button>

            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-5" type="button" role="tab" aria-selected="false">Binding site (Propedia v1)</button>

            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-6" type="button" role="tab" aria-selected="false">CSM-peptides inspired</button>
        </div>
    </nav>

    <div class="tab-content small" id="nav-tabContent">
       
        <div class="tab-pane fade show active p-4" id="nav-0" role="tabpanel" tabindex="0">
             <!-- seq100 -->
        <p class="text-muted small bg-light rounded p-3">This category clusters all peptides with a 100% identical sequence.</p>

            <table class="table table-hover table-striped table-condensed" id="seq100">
                <thead>
                    <th>Leader</th>
                    <th>Identical peptide sequences</th>
                </thead>
                <tbody></tbody>
            </table>

            <a href="<?= base_url('/data/clusters/seq100_clusters-NR.tsv') ?>" class="btn btn-primary btn-lg mt-5 w-100">Download seq100 dataset (tsv file: ~800KB)</a>
        </div>

        <!-- REDUNDANT SEQUENCES -->
        <div class="tab-pane fade p-4" id="nav-1" role="tabpanel" tabindex="0">
            <p class="text-muted small bg-light rounded p-3">This category groups together all complexes formed with protein-peptide pairs where both sequences are 100% identical.</p>

            <table class="table table-hover table-striped table-condensed w-100" id="redundant">
                <thead>
                    <th>Leader</th>
                    <th><em>n</em>
                    <th>Redundant sequences (+leader)</th>
                </thead>
                <tbody></tbody>
            </table>

            <a href="<?= base_url('/data/clusters/redundant.tsv') ?>" class="btn btn-primary btn-lg mt-5 w-100">Download redundant sequences (tsv file: ~1MB)</a>
        </div>
        <!-- PDB CLASSES -->
        <div class="tab-pane fade p-4" id="nav-2" role="tabpanel" tabindex="0">
            <p class="text-muted small bg-light rounded p-3">This category groups entries based on the classes assigned in the PDB files.</p>

            <table class="table table-hover table-striped table-condensed w-100" id="pdb_classes">
                <thead>
                    <th>Class</th>
                    <th><em>n</em>
                    <th class="w-75">Structures</th>
                </thead>
                <tbody></tbody>
            </table>
            <a href="<?= base_url('/data/clusters/pdb_classes.tsv') ?>" class="btn btn-primary btn-lg mt-5 w-100">Download PDB classes (tsv file: ~800KB)</a>
        </div>
        <!-- sequence -->
        <div class="tab-pane fade p-4" id="nav-3" role="tabpanel" tabindex="0">
            <p class="text-muted small bg-light rounded p-3">Category inherited from Propedia v1. Check category seq100 to see how Propedia26 clusters its new entries.</p>

            <table class="table table-hover table-striped table-condensed w-100" id="sequence">
                <thead>
                    <th>Cluster</th>
                    <th><em>n</em>
                    <th class="w-75">Structures</th>
                </thead>
                <tbody></tbody>
            </table>
            <a href="<?= base_url('/data/clusters/sequence.tsv') ?>" class="btn btn-primary btn-lg mt-5 w-100">Download sequence clusters (tsv file: ~72KB)</a>
        </div>
        <!-- interface -->
        <div class="tab-pane fade p-4" id="nav-4" role="tabpanel" tabindex="0">
            <p class="text-muted small bg-light rounded p-3">Category inherited from Propedia v1.</p>

            <table class="table table-hover table-striped table-condensed w-100" id="interface">
                <thead>
                    <th>Cluster</th>
                    <th><em>n</em>
                    <th class="w-75">Structures</th>
                </thead>
                <tbody></tbody>
            </table>
            <a href="<?= base_url('/data/clusters/interface.tsv') ?>" class="btn btn-primary btn-lg mt-5 w-100">Download interface clusters (tsv file: ~72KB)</a>
        </div>
        <!-- binding -->
        <div class="tab-pane fade p-4" id="nav-5" role="tabpanel" tabindex="0">
            <p class="text-muted small bg-light rounded p-3">Category inherited from Propedia v1. </p>

            <table class="table table-hover table-striped table-condensed w-100" id="binding">
                <thead>
                    <th>Cluster</th>
                    <th><em>n</em></th>
                    <th class="w-75">Structures</th>
                </thead>
                <tbody></tbody>
            </table>
            <a href="<?= base_url('/data/clusters/binding.tsv') ?>" class="btn btn-primary btn-lg mt-5 w-100">Download binding clusters (tsv file: ~70KB)</a>
        </div>
        <!-- csm-peptide -->
        <div class="tab-pane fade p-4" id="nav-6" role="tabpanel" tabindex="0">

            <p class="text-muted small bg-light rounded p-3"><a href="https://biosig.lab.uq.edu.au/csm_peptides/" target="_blank"><strong>CSM-peptides</strong></a> is a machine learning-based prediction server for functional classification of biologically active peptides based on sequence. We built machine learning models based on the work of <a href="https://onlinelibrary.wiley.com/doi/10.1002/pro.4442" target="_blank">Rodrigues et al. (2022)</a> to classify Propedia26 peptides into six categories: Anti-Angiogenic (AAP), Anti-Bacterial (ABP), Anti-Cancer (ACP), Anti-Inflammatory (AIP), Quorum Sensing (QSP), and Surface Binding (SBP).</p>

            <ul class="nav nav-underline" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#AAP" type="button" role="tab" aria-controls="AAP" aria-selected="true">Anti-Angiogenic (AAP)</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#ABP" type="button" role="tab" aria-controls="ABP" aria-selected="false">Anti-Bacterial (ABP)</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#ACP" type="button" role="tab" aria-controls="ACP" aria-selected="false">Anti-Cancer (ACP)</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#AIP" type="button" role="tab" aria-controls="AIP" aria-selected="false">Anti-Inflammatory (AIP)</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#QSP" type="button" role="tab" aria-controls="QSP" aria-selected="false">Quorum Sensing (QSP)</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#SBP" type="button" role="tab" aria-controls="SBP" aria-selected="false">Surface Binding (SBP)</button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="AAP" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                    <p class="small text-muted p-3 bg-light rounded mt-1"><strong>Function:</strong> They inhibit angiogenesis, that is, the formation of new blood vessels. <strong>Importance:</strong> Blocking angiogenesis is a strategy used to prevent tumor growth, since cancer depends on blood supply to obtain nutrients. <strong>Example of use:</strong> Development of antitumor and antiviral therapies.</p>

                    <table class="table table-hover table-striped table-condensed w-100" id="aap">
                        <thead>
                            <th>ID</th>
                            <th>Class</th>
                            <th>Negative (Probability)</th>
                            <th>Positive (Probability)</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <a href="<?= base_url('/data/clusters/AAP.tsv') ?>" class="btn btn-primary btn-lg mt-5 w-100">Download AAP clusters (tsv file: ~600KB)</a>

                </div>
                <div class="tab-pane fade" id="ABP" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

                    <p class="small text-muted p-3 bg-light rounded mt-1"><strong>Function:</strong> They are antimicrobial peptides that destroy or inhibit the growth of bacteria. <strong>Common mechanism:</strong> They interact with bacterial membranes, leading to cell lysis (rupture). <strong>Importance:</strong> They are promising alternatives to traditional antibiotics, especially in the face of bacterial resistance.</p>

                    <table class="table table-hover table-striped table-condensed w-100" id="abp">
                        <thead>
                            <th>ID</th>
                            <th>Class</th>
                            <th>Negative (Probability)</th>
                            <th>Positive (Probability)</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <a href="<?= base_url('/data/clusters/ABP.tsv') ?>" class="btn btn-primary btn-lg mt-5 w-100">Download ABP clusters (tsv file: ~600KB)</a>


                </div>
                <div class="tab-pane fade" id="ACP" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">

                    <p class="small text-muted p-3 bg-light rounded mt-1"><strong>Function:</strong> They induce selective death of tumor cells without significantly affecting normal cells. <strong>Mechanism:</strong> They can act by altering the permeability of cancer cell membranes, activating apoptosis, or modulating signaling pathways. <strong>Application:</strong> Development of next-generation antineoplastic therapies.</p>

                    <table class="table table-hover table-striped table-condensed w-100" id="acp">
                        <thead>
                            <th>ID</th>
                            <th>Class</th>
                            <th>Negative (Probability)</th>
                            <th>Positive (Probability)</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <a href="<?= base_url('/data/clusters/ACP.tsv') ?>" class="btn btn-primary btn-lg mt-5 w-100">Download ACP clusters (tsv file: ~600KB)</a>


                </div>
                <div class="tab-pane fade" id="AIP" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

                    <p class="small text-muted p-3 bg-light rounded mt-1"><strong>Function:</strong> They reduce or regulate exaggerated inflammatory responses. <strong>Mechanism:</strong> They can inhibit pro-inflammatory cytokines (such as TNF-α, IL-6) or modulate macrophage activity. <strong>Application:</strong> Treatment of chronic inflammatory and autoimmune diseases.</p>

                    <table class="table table-hover table-striped table-condensed w-100" id="aip">
                        <thead>
                            <th>ID</th>
                            <th>Class</th>
                            <th>Negative (Probability)</th>
                            <th>Positive (Probability)</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <a href="<?= base_url('/data/clusters/AIP.tsv') ?>" class="btn btn-primary btn-lg mt-5 w-100">Download AIP clusters (tsv file: ~600KB)</a>


                </div>
                <div class="tab-pane fade" id="QSP" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">

                    <p class="small text-muted p-3 bg-light rounded mt-1"><strong>Function:</strong> They participate in bacterial communication (quorum sensing), regulating collective behaviors such as biofilm formation and virulence. <strong>Importance:</strong> Understanding and manipulating these peptides can lead to strategies to control bacterial infections without necessarily killing the bacteria (reducing selective pressure for resistance).</p>

                    <table class="table table-hover table-striped table-condensed w-100" id="qsp">
                        <thead>
                            <th>ID</th>
                            <th>Class</th>
                            <th>Negative (Probability)</th>
                            <th>Positive (Probability)</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <a href="<?= base_url('/data/clusters/QSP.tsv') ?>" class="btn btn-primary btn-lg mt-5 w-100">Download QSP clusters (tsv file: ~600KB)</a>


                </div>
                <div class="tab-pane fade" id="SBP" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

                    <p class="small text-muted p-3 bg-light rounded mt-1"><strong>Function:</strong> They bind to biological surfaces or materials, such as metals, polymers, or minerals. <strong>Biotechnological use:</strong> They can be used to immobilize enzymes, design biomaterials, biosensors, or nanodevices. <strong>Example:</strong> Peptides that bind strongly to gold, silica, or metal oxides for use in nanotechnology.</p>

                    <table class="table table-hover table-striped table-condensed w-100" id="sbp">
                        <thead>
                            <th>ID</th>
                            <th>Class</th>
                            <th>Negative (Probability)</th>
                            <th>Positive (Probability)</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <a href="<?= base_url('/data/clusters/SBP.tsv') ?>" class="btn btn-primary btn-lg mt-5 w-100">Download SBP clusters (tsv file: ~600KB)</a>

                </div>
            </div>

        </div>
    </div>
</div><!-- / container fluid -->


<script>
    // seq100
    const tabela_seq100 = fetch('<?= base_url('/data/clusters/seq100_clusters-NR.tsv') ?>');
    tabela_seq100.then(d => d.text()).then((dados) => {
        const linhas = dados.trim().split('\n').map(linha => linha.split('\t'));
        const table = $("#seq100").DataTable({
            data: linhas,
            paging: true,
            pageLength: 10,
            deferRender: true,
            processing: true,
            columnDefs: [{
                targets: 0, // primeira coluna
                render: function(data, type, row) {
                    return `<a href="<?= base_url('/entry') ?>/${data}" target="_blank">${data}</a>`;
                }
            }]
        });
    });

    // REDUNDANT CLASSES
    const tabela_redundante = fetch('<?= base_url('/data/clusters/redundant.tsv') ?>');
    tabela_redundante.then(d => d.text()).then((dados) => {
        const linhas = dados.trim().split('\n').map(linha => linha.split('\t'));
        const table = $("#redundant").DataTable({
            data: linhas,
            paging: true,
            pageLength: 10,
            deferRender: true,
            processing: true,
            columnDefs: [{
                targets: 0, // primeira coluna
                render: function(data, type, row) {
                    return `<a href="<?= base_url('/entry') ?>/${data}" target="_blank">${data}</a>`;
                }
            }]
        });
    });

    // PDB CLASSES
    const tabela_pdb_classes = fetch('<?= base_url('/data/clusters/pdb_classes.tsv') ?>');
    tabela_pdb_classes.then(d => d.text()).then((dados) => {
        const linhas = dados.trim().split('\n').map(linha => linha.split('\t'));
        const table = $("#pdb_classes").DataTable({
            data: linhas,
            paging: true,
            pageLength: 10,
            deferRender: true,
            processing: true,
            columnDefs: [{
                targets: 0, // primeira coluna
                render: function(data, type, row) {
                    // return `<a href="<?= base_url('/entry') ?>/${data}" target="_blank">${data}</a>`;
                    return '<strong>' + data + '</strong>';
                }
            }]
        });
    });

    // sequences
    const tabela_sequence = fetch('<?= base_url('/data/clusters/sequence.tsv') ?>');
    tabela_sequence.then(d => d.text()).then((dados) => {
        const linhas = dados.trim().split('\n').map(linha => linha.split('\t'));
        const table = $("#sequence").DataTable({
            data: linhas,
            paging: true,
            pageLength: 10,
            deferRender: true,
            processing: true,
            order: [
                [1, 'desc']
            ],
            columnDefs: [{
                targets: 0, // primeira coluna
                render: function(data, type, row) {
                    // return `<a href="<?= base_url('/entry') ?>/${data}" target="_blank">${data}</a>`;
                    return '<strong>' + data + '</strong>';
                }
            }]
        });
    });

    // interface
    const tabela_interface = fetch('<?= base_url('/data/clusters/interface.tsv') ?>');
    tabela_interface.then(d => d.text()).then((dados) => {
        const linhas = dados.trim().split('\n').map(linha => linha.split('\t'));
        const table = $("#interface").DataTable({
            data: linhas,
            paging: true,
            pageLength: 10,
            deferRender: true,
            processing: true,
            order: [
                [1, 'desc']
            ],
            columnDefs: [{
                targets: 0, // primeira coluna
                render: function(data, type, row) {
                    // return `<a href="<?= base_url('/entry') ?>/${data}" target="_blank">${data}</a>`;
                    return '<strong>' + data + '</strong>';
                }
            }]
        });
    });

    // binding
    const tabela_binding = fetch('<?= base_url('/data/clusters/binding.tsv') ?>');
    tabela_binding.then(d => d.text()).then((dados) => {
        const linhas = dados.trim().split('\n').map(linha => linha.split('\t'));
        const table = $("#binding").DataTable({
            data: linhas,
            paging: true,
            pageLength: 10,
            deferRender: true,
            processing: true,
            order: [
                [1, 'desc']
            ],
            columnDefs: [{
                targets: 0, // primeira coluna
                render: function(data, type, row) {
                     return `<a href="<?= base_url('/entry') ?>/${data}" target="_blank">${data}</a>`;
                    //return '<strong>' + data + '</strong>';
                }
            }]
        });
    });


    // AAP
    const tabela_AAP = fetch('<?= base_url('/data/clusters/AAP.tsv') ?>');
    tabela_AAP.then(d => d.text()).then((dados) => {
        const linhas = dados.trim().split('\n').map(linha => linha.split('\t'));
        const table = $("#aap").DataTable({
            data: linhas,
            paging: true,
            pageLength: 10,
            deferRender: true,
            processing: true,
            order: [
                [1, 'desc']
            ],
            columnDefs: [{
                targets: 0, // primeira coluna
                render: function(data, type, row) {
                    return `<a href="<?= base_url('/entry') ?>/${data}" target="_blank">${data}</a>`;
                    //return '<strong>' + data + '</strong>';
                }
            }]
        });
    });

    // ABP
    const tabela_ABP = fetch('<?= base_url('/data/clusters/ABP.tsv') ?>');
    tabela_ABP.then(d => d.text()).then((dados) => {
        const linhas = dados.trim().split('\n').map(linha => linha.split('\t'));
        const table = $("#abp").DataTable({
            data: linhas,
            paging: true,
            pageLength: 10,
            deferRender: true,
            processing: true,
            order: [
                [1, 'desc']
            ],
            columnDefs: [{
                targets: 0, // primeira coluna
                render: function(data, type, row) {
                    return `<a href="<?= base_url('/entry') ?>/${data}" target="_blank">${data}</a>`;
                    //return '<strong>' + data + '</strong>';
                }
            }]
        });
    });

    // AAP
    const tabela_ACP = fetch('<?= base_url('/data/clusters/ACP.tsv') ?>');
    tabela_ACP.then(d => d.text()).then((dados) => {
        const linhas = dados.trim().split('\n').map(linha => linha.split('\t'));
        const table = $("#acp").DataTable({
            data: linhas,
            paging: true,
            pageLength: 10,
            deferRender: true,
            processing: true,
            order: [
                [1, 'desc']
            ],
            columnDefs: [{
                targets: 0, // primeira coluna
                render: function(data, type, row) {
                     return `<a href="<?= base_url('/entry') ?>/${data}" target="_blank">${data}</a>`;
                    //return '<strong>' + data + '</strong>';
                }
            }]
        });
    });

    // AIP
    const tabela_AIP = fetch('<?= base_url('/data/clusters/AIP.tsv') ?>');
    tabela_AIP.then(d => d.text()).then((dados) => {
        const linhas = dados.trim().split('\n').map(linha => linha.split('\t'));
        const table = $("#aip").DataTable({
            data: linhas,
            paging: true,
            pageLength: 10,
            deferRender: true,
            processing: true,
            order: [
                [1, 'desc']
            ],
            columnDefs: [{
                targets: 0, // primeira coluna
                render: function(data, type, row) {
                    return `<a href="<?= base_url('/entry') ?>/${data}" target="_blank">${data}</a>`;
                    //return '<strong>' + data + '</strong>';
                }
            }]
        });
    });

    // AAP
    const tabela_QSP = fetch('<?= base_url('/data/clusters/QSP.tsv') ?>');
    tabela_QSP.then(d => d.text()).then((dados) => {
        const linhas = dados.trim().split('\n').map(linha => linha.split('\t'));
        const table = $("#qsp").DataTable({
            data: linhas,
            paging: true,
            pageLength: 10,
            deferRender: true,
            processing: true,
            order: [
                [1, 'desc']
            ],
            columnDefs: [{
                targets: 0, // primeira coluna
                render: function(data, type, row) {
                    return `<a href="<?= base_url('/entry') ?>/${data}" target="_blank">${data}</a>`;
                    //return '<strong>' + data + '</strong>';
                }
            }]
        });
    });

    // AAP
    const tabela_SBP = fetch('<?= base_url('/data/clusters/SBP.tsv') ?>');
    tabela_SBP.then(d => d.text()).then((dados) => {
        const linhas = dados.trim().split('\n').map(linha => linha.split('\t'));
        const table = $("#sbp").DataTable({
            data: linhas,
            paging: true,
            pageLength: 10,
            deferRender: true,
            processing: true,
            order: [
                [1, 'desc']
            ],
            columnDefs: [{
                targets: 0, // primeira coluna
                render: function(data, type, row) {
                    return `<a href="<?= base_url('/entry') ?>/${data}" target="_blank">${data}</a>`;
                    //return '<strong>' + data + '</strong>';
                }
            }]
        });
    });
</script>
<!-- / FIM Conteúdo personalizado -->
<?= $this->endSection() ?>