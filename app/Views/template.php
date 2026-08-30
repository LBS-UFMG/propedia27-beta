<!doctype html>
<html lang="pt-br">

<head>
    <title>Propedia – The Protein-Peptide Interaction Database</title>
    <?php $version = "3.26.830"; // 8-ago-2026 
    ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="<?= base_url('img/favicon.png') ?>" type="image/x-icon">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="<?= base_url('css/estilo.css') ?>">

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

</head>

<body>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show mb-0 small text-center rounded-0" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-0 small text-center rounded-0" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div id="alert-container"></div>

    <nav class="py-2 bg-body-tertiary menu link-light navbar-expand-md">
        <div class="px-4 container-fluid d-flex flex-wrap">

            <!-- Botão hamburger -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuCollapse"
                aria-controls="menuCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <h1 class="mb-0"><i class="bi bi-list text-white"></i></h1>
            </button>
            <div class="collapse navbar-collapse" id="menuCollapse">


                <ul class="nav me-auto">
                    <li class="nav-item"><a title="Home page" href="<?= base_url('/') ?>" class="nav-link link-body-emphasis px-2"><i class="bi bi-house-door-fill"></i></a></li>
                    <li class="nav-item"><a title="About Propedia" href="#" data-bs-toggle="modal" data-bs-target="#about" class="nav-link link-body-emphasis px-2">About</a></li>
                    <li class="nav-item"><a href="#" title="Search for similar sequences using BLAST" data-bs-toggle="modal" data-bs-target="#blast" class="nav-link link-body-emphasis px-2">BLAST</a></li>
                    <li class="nav-item"><a title="Collected data grouped by different methods" href="<?= base_url('clusters') ?>" class="nav-link link-body-emphasis px-2">Clusters</a></li>
                    <li class="nav-item"><a title="See the Propedia complete documentation" href="<?= base_url('documentation') ?>" class="nav-link link-body-emphasis px-2">Documentation</a></li>
                    <li class="nav-item"><a title="Download Propedia data" href="<?= base_url('download') ?>" class="nav-link link-body-emphasis px-2">Download</a></li>
                    <li class="nav-item"><a title="Explore all Propedia protein-peptide entries" href="<?= base_url('explore') ?>" class="nav-link link-body-emphasis px-2">Explore</a></li>
                    <li class="nav-item"><a href="#" title="Find proteins with similar binding site" data-bs-toggle="modal" data-bs-target="#probis" class="nav-link link-body-emphasis px-2 orange">Search<sup><span class="badge bg-dark">by binding site</span></sup></a></li>
                </ul>
                <ul class="nav">
                    <li class="nav-item"><a data-bs-toggle="modal" data-bs-target="#cite-propedia" title="Please, cite the original Propedia paper (Martins et al., 2021) and the more recent publication (Martins et al., 2023)." href="#" class="nav-link link-body-emphasis px-2">How to cite Propedia</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="py-3 mb-4 border-bottom bg-light">
        <div class="px-4 container-fluid d-flex flex-wrap justify-content-center">
            <a href="<?= base_url() ?>" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                <img src="<?= base_url('/img/logo_propedia2.svg') ?>" width="250">
                <label class="bg-dark badge">v27-beta</label>
            </a>
            <form method="get" class="col-12 col-md-auto mb-3 mb-md-0" role="search" action="<?= base_url('/explore') ?>">
                <input name="q" type="search" class="form-control form-control-md mt-2" placeholder="Search..." aria-label="Search" id="urlInput"><!--onkeydown="redirectToURL(event)" >-->
            </form>
        </div>
    </header>

    <!-- PARTE DINÂMICA -->
    <main class="container-fluid">
        <?= $this->renderSection('conteudo') ?>
    </main>
    <!-- / FIM PARTE DINÂMICA -->

    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 ps-4">
                    <img src="<?= base_url('/img/logo_propedia.svg') ?>" width="200px">
                    <p class="text-light small pt-3 col-9">PROPEDIA is a database of protein-peptide interactions. PROPEDIA main goal is to give new insights into peptide design of biotechnological interests. </p>

                    <p style="font-size: 0.6em;color:#ccc">©<?= date('Y') ?> Propedia v<?= $version ?> | Laboratory of Bioinformatics and Systems, UFMG (Brazil)<br><a class="text-white" href="https://bioinfo.dcc.ufmg.br/software-policy">License</a>  | <a class="text-white" href="https://github.com/LBS-UFMG/propedia-pipeline">GitHub</a> | <a class="text-white" href="https://bioinfo.dcc.ufmg.br/propedia1">Propedia v1</a> | <a class="text-white" href="https://bioinfo.dcc.ufmg.br/propedia2">Propedia v2</a>
                </div>

                <div class="col-12 col-md-6">
                    <div class="row pt-5">
                        <div class="col me-4"><a href="http://bioinfo.dcc.ufmg.br" target="_blank"><img src="<?= base_url('/img/lbs-new-logo.svg') ?>" width="240px"></a></div>
                        <div class="col"><img src="<?= base_url('/img/dcc_w.svg') ?>" width="170px"></div>
                        <div class="col"><img src="<?= base_url('/img/ufmg_w.svg') ?>" width="200px"></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- HTML MODALS -->
    <?= $this->include('modal') ?>
    <!-- /fim HTML MODALS -->

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script src="<?php echo base_url('DataTables/datatables.min.js'); ?>"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <script src="<?php echo base_url('js/3dmol.js'); ?>"></script>

    <?= $this->renderSection('scripts') ?>
    <script>
        function loadPopover() {
            const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });
        };
        loadPopover();

        // Tooltips: o modal (e outros trechos do template) tem tooltips em
        // qualquer pagina, entao a inicializacao precisa morar aqui. As views
        // entry/multipro/project inicializam as suas antes; o Bootstrap aceita
        // apenas uma instancia por elemento, por isso o getInstance.
        function loadTooltip() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return bootstrap.Tooltip.getInstance(tooltipTriggerEl) || new bootstrap.Tooltip(tooltipTriggerEl);
            });
        };
        loadTooltip();
    </script>

</body>

</html>