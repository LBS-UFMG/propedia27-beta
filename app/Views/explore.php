<?= $this->extend('template') ?>
<?= $this->section('conteudo') ?>
<!-- Conteúdo personalizado -->

<div id="loading">
    <div class="text-center">
        <img src="<?= base_url('/img/cocadito-loading.png') ?>" width="200px"><br>
        <div class="spinner-border spinner-border-sm" role="status"></div>
        <strong class="ms-2">Loading...</strong>
    </div>
</div>

<div class="container-fluid py-4 px-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <h1 class="text-dark mb-1">Explore</h1>
        <p class="mb-0" id="contador-resultados">
            <span class="badge bg-propedia" id="contador-valor">…</span>
            <span class="text-muted small">complexes found<span id="contador-detalhe"></span></span>
        </p>
    </div>

    <!-- ============ FILTROS ============ -->
    <style>
        /* Sliders dos filtros: a trilha padrao do Bootstrap quase some sobre o
           fundo claro do painel, entao ela e redesenhada aqui em tons de cinza.
           A parte ja percorrida usa a variavel --pct, atualizada no JS. */
        #filtros-explore .form-range {
            --pct: 0%;
            height: 1.1rem;
            padding: 0;
        }
        #filtros-explore .form-range:focus {
            outline: none;
        }
        #filtros-explore .form-range::-webkit-slider-runnable-track {
            height: .35rem;
            border-radius: 1rem;
            background: linear-gradient(to right, #adb5bd var(--pct), #e9ecef var(--pct));
            border: 1px solid #dee2e6;
        }
        #filtros-explore .form-range::-moz-range-track {
            height: .35rem;
            border-radius: 1rem;
            background: linear-gradient(to right, #adb5bd var(--pct), #e9ecef var(--pct));
            border: 1px solid #dee2e6;
        }
        #filtros-explore .form-range::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: .9rem;
            height: .9rem;
            margin-top: -.32rem;
            border-radius: 50%;
            background: #adb5bd;
            border: 2px solid #fff;
            box-shadow: 0 0 0 1px #ced4da;
        }
        #filtros-explore .form-range::-moz-range-thumb {
            width: .9rem;
            height: .9rem;
            border-radius: 50%;
            background: #adb5bd;
            border: 2px solid #fff;
            box-shadow: 0 0 0 1px #ced4da;
        }
        #filtros-explore .form-range:hover::-webkit-slider-thumb,
        #filtros-explore .form-range:focus::-webkit-slider-thumb { background: #6c757d; }
        #filtros-explore .form-range:hover::-moz-range-thumb,
        #filtros-explore .form-range:focus::-moz-range-thumb { background: #6c757d; }
    </style>

    <div class="p-3 bg-light rounded small mb-4" id="filtros-explore">

        <div class="d-flex align-items-center mb-3">
            <h6 class="mb-0 text-muted text-uppercase" style="font-size: .75rem; letter-spacing: .05em">
                <i class="bi bi-funnel-fill me-1"></i> Filter search
            </h6>
        </div>

        <!-- 6 filtros por linha em telas grandes, 2 em telas pequenas -->
        <div class="row g-3 small">

            <!-- os seis campos de selecao -->
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <label class="form-label mb-1" for="classification">PDB classification <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Molecular classification of the structure, as annotated in the PDB. Start typing to see the available classifications; the value must match one of them.">?</a></label>
                <input class="form-control form-control-sm" id="classification" list="lista-classificacoes" placeholder="All" autocomplete="off">
                <datalist id="lista-classificacoes">
                        <option value="ALLERGEN" label="33 complexes"></option>
                        <option value="ANTIBIOTIC" label="60 complexes"></option>
                        <option value="ANTIBIOTIC/LIPID TRANSPORT" label="10 complexes"></option>
                        <option value="ANTIMICROBIAL PROTEIN" label="129 complexes"></option>
                        <option value="ANTITOXIN" label="12 complexes"></option>
                        <option value="ANTITUMOR PROTEIN" label="107 complexes"></option>
                        <option value="ANTITUMOR PROTEIN/LIGASE" label="17 complexes"></option>
                        <option value="ANTIVIRAL PROTEIN" label="54 complexes"></option>
                        <option value="ANTIVIRAL PROTEIN, IMMUNE SYSTEM" label="10 complexes"></option>
                        <option value="APOPTOSIS" label="577 complexes"></option>
                        <option value="APOPTOSIS INHIBITOR" label="29 complexes"></option>
                        <option value="APOPTOSIS/APOPTOSIS INHIBITOR" label="12 complexes"></option>
                        <option value="APOPTOSIS/APOPTOSIS REGULATOR" label="39 complexes"></option>
                        <option value="apoptosis/inhibitor" label="34 complexes"></option>
                        <option value="BIOSYNTHETIC PROTEIN" label="220 complexes"></option>
                        <option value="BIOSYNTHETIC PROTEIN, LIGASE" label="198 complexes"></option>
                        <option value="BIOSYNTHETIC PROTEIN,Structural Protein" label="12 complexes"></option>
                        <option value="biotin binding protein" label="21 complexes"></option>
                        <option value="BIOTIN BINDING PROTEIN" label="40 complexes"></option>
                        <option value="Biotin binding protein" label="28 complexes"></option>
                        <option value="BLOOD CLOTTING" label="266 complexes"></option>
                        <option value="BLOOD CLOTTING, hydrolase" label="14 complexes"></option>
                        <option value="BLOOD CLOTTING,HYDROLASE/INHIBITOR" label="10 complexes"></option>
                        <option value="BLOOD CLOTTING/HYDROLASE INHIBITOR" label="26 complexes"></option>
                        <option value="Blood Clotting/Hydrolase Inhibitor" label="14 complexes"></option>
                        <option value="BLOOD COAGULATION" label="15 complexes"></option>
                        <option value="CALCIUM-BINDING PROTEIN" label="13 complexes"></option>
                        <option value="Calcium-binding protein" label="21 complexes"></option>
                        <option value="CALCIUM-BINDING PROTEIN/MEMBRANE PROTEIN" label="30 complexes"></option>
                        <option value="CARBOHYDRATE" label="12 complexes"></option>
                        <option value="CELL ADHESION" label="564 complexes"></option>
                        <option value="CELL ADHESION/IMMUNE SYSTEM" label="26 complexes"></option>
                        <option value="CELL ADHESION/IMMUNE SYSTEM/PEPTIDE" label="25 complexes"></option>
                        <option value="CELL ADHESION/PROTEIN BINDING" label="15 complexes"></option>
                        <option value="CELL ADHESION/STRUCTURAL PROTEIN" label="15 complexes"></option>
                        <option value="CELL CYCLE" label="1,032 complexes"></option>
                        <option value="CELL CYCLE/DNA" label="11 complexes"></option>
                        <option value="CELL CYCLE/Peptide" label="11 complexes"></option>
                        <option value="CELL CYCLE/SIGNALING PROTEIN" label="24 complexes"></option>
                        <option value="CELL INVASION" label="23 complexes"></option>
                        <option value="CHAPERONE" label="707 complexes"></option>
                        <option value="CHAPERONE, HYDROLASE" label="58 complexes"></option>
                        <option value="Chaperone, Peptide Binding Protein" label="16 complexes"></option>
                        <option value="CHAPERONE/Antibiotic" label="11 complexes"></option>
                        <option value="CHAPERONE/HYDROLASE" label="29 complexes"></option>
                        <option value="CHAPERONE/PEPTIDE" label="36 complexes"></option>
                        <option value="CHAPERONE/PEPTIDE BINDING PROTEIN" label="25 complexes"></option>
                        <option value="CHAPERONE/PROTEIN BINDING" label="23 complexes"></option>
                        <option value="CHOLINE BINDING PROTEIN/TOXIN" label="10 complexes"></option>
                        <option value="CHOLINE-BINDING PROTEIN" label="10 complexes"></option>
                        <option value="COMPLEX (BIOTIN-BINDING PROTEIN/PEPTIDE)" label="23 complexes"></option>
                        <option value="COMPLEX (HYDROLASE/INHIBITOR)" label="12 complexes"></option>
                        <option value="COMPLEX (ISOMERASE/PEPTIDE)" label="21 complexes"></option>
                        <option value="COMPLEX (OXIDOREDUCTASE/PEPTIDE)" label="30 complexes"></option>
                        <option value="COMPLEX (SERINE PROTEASE/INHIBITOR)" label="34 complexes"></option>
                        <option value="COMPLEX (SIGNAL TRANSDUCTION/PEPTIDE)" label="21 complexes"></option>
                        <option value="COMPLEX (TRANSFERASE/PEPTIDE)" label="22 complexes"></option>
                        <option value="CONTRACTILE PROTEIN" label="137 complexes"></option>
                        <option value="CONTRACTILE PROTEIN/ACTIN BINDING PROTEIN" label="24 complexes"></option>
                        <option value="CONTRACTILE PROTEIN/PEPTIDE" label="33 complexes"></option>
                        <option value="CONTRACTILE PROTEIN/PROTEIN BINDING" label="45 complexes"></option>
                        <option value="CYTOKINE" label="29 complexes"></option>
                        <option value="CYTOKINE, HORMONE/GROWTH FACTOR receptor" label="12 complexes"></option>
                        <option value="CYTOSOLIC PROTEIN" label="134 complexes"></option>
                        <option value="DE NOVO PROTEIN" label="191 complexes"></option>
                        <option value="DNA BINDING PROTEIN" label="653 complexes"></option>
                        <option value="DNA BINDING PROTEIN/DNA" label="153 complexes"></option>
                        <option value="DNA BINDING PROTEIN/DNA/RNA" label="27 complexes"></option>
                        <option value="DNA BINDING PROTEIN/RNA/DNA" label="16 complexes"></option>
                        <option value="ELECTRON TRANSPORT" label="1,855 complexes"></option>
                        <option value="ELECTRON TRANSPORT, PHOTOSYNTHESIS" label="348 complexes"></option>
                        <option value="ELECTRON TRANSPORT,PHOTOSYNTHESIS" label="232 complexes"></option>
                        <option value="ELECTRON TRANSPORT/INHIBITOR" label="10 complexes"></option>
                        <option value="ENDOCYTOSIS" label="184 complexes"></option>
                        <option value="ENDOCYTOSIS/EXOCYTOSIS" label="27 complexes"></option>
                        <option value="ENTEROTOXIN" label="36 complexes"></option>
                        <option value="EXOCYTOSIS" label="17 complexes"></option>
                        <option value="GENE REGULATION" label="535 complexes"></option>
                        <option value="GENE REGULATION/DNA" label="39 complexes"></option>
                        <option value="HISTOCOMPATIBILITY ANTIGEN" label="24 complexes"></option>
                        <option value="HORMONE" label="107 complexes"></option>
                        <option value="HORMONE RECEPTOR" label="70 complexes"></option>
                        <option value="HORMONE RECEPTOR/HORMONE/IMMUNE SYSTEM" label="21 complexes"></option>
                        <option value="HORMONE RECEPTOR/PEPTIDE" label="26 complexes"></option>
                        <option value="HORMONE,TOXIN" label="32 complexes"></option>
                        <option value="HORMONE/GROWTH FACTOR" label="25 complexes"></option>
                        <option value="HORMONE/GROWTH FACTOR RECEPTOR" label="35 complexes"></option>
                        <option value="HYDROLASE" label="3,671 complexes"></option>
                        <option value="HYDROLASE (SERINE PROTEINASE)" label="28 complexes"></option>
                        <option value="HYDROLASE ACTIVATOR" label="13 complexes"></option>
                        <option value="HYDROLASE INHIBITOR" label="13 complexes"></option>
                        <option value="HYDROLASE INHIBITOR/HYDROLASE" label="10 complexes"></option>
                        <option value="HYDROLASE RECEPTOR" label="16 complexes"></option>
                        <option value="HYDROLASE/ANTIBIOTIC" label="234 complexes"></option>
                        <option value="hydrolase/antibiotic" label="84 complexes"></option>
                        <option value="HYDROLASE/DNA" label="13 complexes"></option>
                        <option value="HYDROLASE/DNA BINDING PROTEIN" label="12 complexes"></option>
                        <option value="HYDROLASE/HORMONE" label="22 complexes"></option>
                        <option value="Hydrolase/Hormone" label="10 complexes"></option>
                        <option value="HYDROLASE/HYDROLASE ACTIVATOR" label="14 complexes"></option>
                        <option value="Hydrolase/Hydrolase Inhibitor" label="88 complexes"></option>
                        <option value="HYDROLASE/HYDROLASE INHIBITOR" label="1,854 complexes"></option>
                        <option value="HYDROLASE/HYDROLASE inhibitor" label="23 complexes"></option>
                        <option value="hydrolase/hydrolase inhibitor" label="92 complexes"></option>
                        <option value="HYDROLASE/hydrolase inhibitor" label="12 complexes"></option>
                        <option value="Hydrolase/Hydrolase inhibitor" label="21 complexes"></option>
                        <option value="HYDROLASE/HYDROLASE INHIBITOR/DNA" label="12 complexes"></option>
                        <option value="hydrolase/hydrolase product" label="14 complexes"></option>
                        <option value="HYDROLASE/HYDROLASE REGULATOR" label="17 complexes"></option>
                        <option value="HYDROLASE/HYDROLASE SUBSTRATE" label="39 complexes"></option>
                        <option value="HYDROLASE/INHIBITOR" label="100 complexes"></option>
                        <option value="HYDROLASE/LIGASE" label="13 complexes"></option>
                        <option value="Hydrolase/Peptide" label="19 complexes"></option>
                        <option value="HYDROLASE/PEPTIDE" label="126 complexes"></option>
                        <option value="HYDROLASE/PROTEIN BINDING" label="47 complexes"></option>
                        <option value="HYDROLASE/RNA" label="12 complexes"></option>
                        <option value="HYDROLASE/SUBSTRATE" label="11 complexes"></option>
                        <option value="HYDROLASE/TRANSPORT PROTEIN" label="75 complexes"></option>
                        <option value="Hydrolase/Viral Protein" label="20 complexes"></option>
                        <option value="IMMUNE RESPONSE" label="21 complexes"></option>
                        <option value="IMMUNE SYSTEM" label="6,671 complexes"></option>
                        <option value="Immune system/agonist" label="18 complexes"></option>
                        <option value="IMMUNE SYSTEM/ANTIGEN" label="16 complexes"></option>
                        <option value="IMMUNE SYSTEM/INHIBITOR" label="56 complexes"></option>
                        <option value="IMMUNE SYSTEM/PEPTIDE" label="28 complexes"></option>
                        <option value="IMMUNE SYSTEM/TOXIN" label="16 complexes"></option>
                        <option value="Immune system/transcription" label="11 complexes"></option>
                        <option value="IMMUNE SYSTEM/VIRAL PROTEIN" label="117 complexes"></option>
                        <option value="Immune System/Viral Protein" label="20 complexes"></option>
                        <option value="immune system/viral protein" label="16 complexes"></option>
                        <option value="IMMUNE SYSTEM/Viral Protein" label="28 complexes"></option>
                        <option value="IMMUNOGLOBULIN" label="24 complexes"></option>
                        <option value="ISOMERASE" label="93 complexes"></option>
                        <option value="ISOMERASE, CHAPERONE" label="27 complexes"></option>
                        <option value="ISOMERASE/ISOMERASE INHIBITOR" label="18 complexes"></option>
                        <option value="LECTIN" label="80 complexes"></option>
                        <option value="LIGASE" label="475 complexes"></option>
                        <option value="Ligase, chaperone" label="44 complexes"></option>
                        <option value="Ligase/APOPTOSIS" label="10 complexes"></option>
                        <option value="LIGASE/LIGASE INHIBITOR" label="50 complexes"></option>
                        <option value="ligase/ligase inhibitor" label="10 complexes"></option>
                        <option value="LIGASE/PEPTIDE" label="16 complexes"></option>
                        <option value="LIGASE/SIGNALING PROTEIN" label="11 complexes"></option>
                        <option value="LIGASE/TRANSFERASE/DNA" label="20 complexes"></option>
                        <option value="LIGHT HARVESTING COMPLEX" label="10 complexes"></option>
                        <option value="LIPID BINDING PROTEIN" label="26 complexes"></option>
                        <option value="LYASE" label="300 complexes"></option>
                        <option value="MAJOR HISTOCOMPATIBILITY COMPLEX" label="12 complexes"></option>
                        <option value="MEMBRANE PROTEIN" label="3,251 complexes"></option>
                        <option value="MEMBRANE PROTEIN, PHOTOSYNTHESIS" label="27 complexes"></option>
                        <option value="MEMBRANE PROTEIN, PROTEIN TRANSPORT" label="17 complexes"></option>
                        <option value="MEMBRANE PROTEIN/EXOCYTOSIS" label="61 complexes"></option>
                        <option value="Membrane protein/Immune system" label="10 complexes"></option>
                        <option value="MEMBRANE PROTEIN/IMMUNE SYSTEM" label="46 complexes"></option>
                        <option value="MEMBRANE PROTEIN/INHIBITOR" label="14 complexes"></option>
                        <option value="MEMBRANE PROTEIN/SIGNALING PROTEIN" label="16 complexes"></option>
                        <option value="MEMBRANE PROTEIN/TRANSCRIPTION" label="10 complexes"></option>
                        <option value="MEMBRANE PROTEIN/TRANSPORT PROTEIN" label="31 complexes"></option>
                        <option value="METAL BINDING PROTEIN" label="268 complexes"></option>
                        <option value="METAL BINDING PROTEIN/TOXIN" label="41 complexes"></option>
                        <option value="METAL TRANSPORT" label="17 complexes"></option>
                        <option value="microtubule binding protein" label="20 complexes"></option>
                        <option value="MOTOR PROTEIN" label="757 complexes"></option>
                        <option value="MOTOR PROTEIN, HYDROLASE/PROTEIN BINDING" label="22 complexes"></option>
                        <option value="MOTOR PROTEIN/HYDROLASE" label="11 complexes"></option>
                        <option value="MOTOR PROTEIN/SIGNALING PROTEIN" label="12 complexes"></option>
                        <option value="NUCLEAR PROTEIN" label="296 complexes"></option>
                        <option value="NUCLEAR PROTEIN/DNA" label="11 complexes"></option>
                        <option value="NUCLEAR PROTEIN/INHIBITOR" label="15 complexes"></option>
                        <option value="NUCLEAR PROTEIN/PROTEIN BINDING" label="20 complexes"></option>
                        <option value="NUCLEAR TRANSPORT" label="16 complexes"></option>
                        <option value="ONCOPROTEIN" label="49 complexes"></option>
                        <option value="OXIDOREDUCTASE" label="2,522 complexes"></option>
                        <option value="OXIDOREDUCTASE (CYTOCHROME(C)-OXYGEN)" label="18 complexes"></option>
                        <option value="OXIDOREDUCTASE, ELECTRON TRANSPORT" label="61 complexes"></option>
                        <option value="OXIDOREDUCTASE/ELECTRON TRANSPORT" label="49 complexes"></option>
                        <option value="OXIDOREDUCTASE/MEMBRANE PROTEIN" label="30 complexes"></option>
                        <option value="OXIDOREDUCTASE/OXIDOREDUCTASE INHIBITOR" label="12 complexes"></option>
                        <option value="OXIDOREDUCTASE/PEPTIDE" label="19 complexes"></option>
                        <option value="OXIDOREDUCTASE/PROTEIN BINDING" label="40 complexes"></option>
                        <option value="Oxidoreductase/Structural Protein" label="12 complexes"></option>
                        <option value="OXIDOREDUCTASE/TRANSFERASE" label="20 complexes"></option>
                        <option value="PEPTIDE BINDING PROTEIN" label="1,030 complexes"></option>
                        <option value="PEPTIDE BINDING PROTEIN/PROTEIN BINDING" label="15 complexes"></option>
                        <option value="PHOTOSYNTHESIS" label="10,308 complexes"></option>
                        <option value="PHOTOSYNTHESIS,ELECTRON TRANSPORT" label="117 complexes"></option>
                        <option value="PLANT PROTEIN" label="265 complexes"></option>
                        <option value="PLANT PROTEIN, Lyase" label="32 complexes"></option>
                        <option value="PROTEIN BINDING" label="1,746 complexes"></option>
                        <option value="PROTEIN BINDING/HYDROLASE" label="19 complexes"></option>
                        <option value="PROTEIN BINDING/INHIBITOR" label="24 complexes"></option>
                        <option value="PROTEIN BINDING/Inhibitor" label="11 complexes"></option>
                        <option value="PROTEIN BINDING/LIPID BINDING PROTEIN" label="10 complexes"></option>
                        <option value="PROTEIN BINDING/METAL BINDING PROTEIN" label="27 complexes"></option>
                        <option value="PROTEIN BINDING/PEPTIDE" label="17 complexes"></option>
                        <option value="protein binding/peptide" label="16 complexes"></option>
                        <option value="PROTEIN BINDING/TRANSFERASE" label="40 complexes"></option>
                        <option value="PROTEIN FIBRIL" label="116 complexes"></option>
                        <option value="PROTEIN TRANSPORT" label="829 complexes"></option>
                        <option value="PROTEIN TRANSPORT, TRANSCRIPTION" label="14 complexes"></option>
                        <option value="PROTEIN TRANSPORT/INHIBITOR" label="33 complexes"></option>
                        <option value="protein transport/inhibitor" label="21 complexes"></option>
                        <option value="PROTEIN TRANSPORT/LIGASE" label="14 complexes"></option>
                        <option value="PROTEIN TRANSPORT/VIRAL PROTEIN" label="12 complexes"></option>
                        <option value="PROTON TRANSPORT" label="206 complexes"></option>
                        <option value="RECEPTOR" label="12 complexes"></option>
                        <option value="RECEPTOR/INHIBITOR" label="10 complexes"></option>
                        <option value="RECEPTOR/TOXIN" label="36 complexes"></option>
                        <option value="RECOMBINATION" label="109 complexes"></option>
                        <option value="RECOMBINATION/DNA" label="20 complexes"></option>
                        <option value="RECOMBINATION/INHIBITOR" label="52 complexes"></option>
                        <option value="REPLICATION" label="195 complexes"></option>
                        <option value="REPLICATION/DNA" label="12 complexes"></option>
                        <option value="RIBOSOMAL PROTEIN" label="51 complexes"></option>
                        <option value="RIBOSOME" label="3,467 complexes"></option>
                        <option value="RIBOSOME,TRANSCRIPTION/TRANSLATION" label="24 complexes"></option>
                        <option value="Ribosome/Antibiotic" label="18 complexes"></option>
                        <option value="RIBOSOME/ANTIBIOTIC" label="66 complexes"></option>
                        <option value="RIBOSOME/INHIBITOR" label="20 complexes"></option>
                        <option value="RIBOSOME/LIGASE" label="11 complexes"></option>
                        <option value="Ribosome/RNA" label="20 complexes"></option>
                        <option value="RIBOSOME/RNA" label="10 complexes"></option>
                        <option value="RIBOSOME/VIRAL PROTEIN" label="10 complexes"></option>
                        <option value="RIM-BINDING PROTEIN" label="43 complexes"></option>
                        <option value="RNA" label="28 complexes"></option>
                        <option value="RNA BINDING PROTEIN" label="308 complexes"></option>
                        <option value="RNA BINDING PROTEIN/RNA" label="26 complexes"></option>
                        <option value="RNA BINDING PROTEIN/TRANSCRIPTION" label="15 complexes"></option>
                        <option value="RNA BINDING/Metal Binding protein" label="10 complexes"></option>
                        <option value="SERINE PROTEASE" label="28 complexes"></option>
                        <option value="SIGNALING PROTEIN" label="1,837 complexes"></option>
                        <option value="SIGNALING PROTEIN/CELL ADHESION" label="14 complexes"></option>
                        <option value="SIGNALING PROTEIN/HORMONE" label="77 complexes"></option>
                        <option value="SIGNALING PROTEIN/IMMUNE SYSTEM" label="68 complexes"></option>
                        <option value="SIGNALING PROTEIN/INHIBITOR" label="54 complexes"></option>
                        <option value="SIGNALING PROTEIN/PEPTIDE" label="57 complexes"></option>
                        <option value="Signaling Protein/Peptide" label="19 complexes"></option>
                        <option value="SIGNALING PROTEIN/PROTEIN BINDING" label="29 complexes"></option>
                        <option value="SIGNALING PROTEIN/TRANSFERASE" label="17 complexes"></option>
                        <option value="SPLICING" label="346 complexes"></option>
                        <option value="SPLICING/RNA" label="11 complexes"></option>
                        <option value="STRUCTURAL PROTEIN" label="1,106 complexes"></option>
                        <option value="STRUCTURAL PROTEIN, SIGNALING PROTEIN" label="14 complexes"></option>
                        <option value="STRUCTURAL PROTEIN/DNA" label="15 complexes"></option>
                        <option value="structural protein/dna" label="15 complexes"></option>
                        <option value="STRUCTURAL PROTEIN/PROTEIN BINDING" label="15 complexes"></option>
                        <option value="STRUCTURAL PROTEIN/VIRUS LIKE PARTICLE" label="10 complexes"></option>
                        <option value="SUGAR BINDING PROTEIN" label="437 complexes"></option>
                        <option value="SUGAR BINDING PROTEIN, PLANT PROTEIN" label="12 complexes"></option>
                        <option value="SUGAR BINDING PROTEIN/INHIBITOR" label="12 complexes"></option>
                        <option value="TOXIN" label="210 complexes"></option>
                        <option value="TOXIN/ANTITOXIN" label="54 complexes"></option>
                        <option value="Toxin/CELL Adhesion" label="19 complexes"></option>
                        <option value="TRANSCRIPTION" label="4,023 complexes"></option>
                        <option value="TRANSCRIPTION REGULATOR" label="42 complexes"></option>
                        <option value="TRANSCRIPTION REPRESSOR" label="22 complexes"></option>
                        <option value="Transcription, Peptide binding protein" label="12 complexes"></option>
                        <option value="TRANSCRIPTION, TRANSFERASE/DNA" label="40 complexes"></option>
                        <option value="TRANSCRIPTION, TRANSFERASE/DNA-RNA HYBRID" label="26 complexes"></option>
                        <option value="TRANSCRIPTION, TRANSFERASE/DNA/RNA" label="30 complexes"></option>
                        <option value="TRANSCRIPTION, TRANSFERASE/RNA/DNA" label="55 complexes"></option>
                        <option value="TRANSCRIPTION,TRANSFERASE/DNA-RNA HYBRID" label="48 complexes"></option>
                        <option value="TRANSCRIPTION,TRANSFERASE/DNA/RNA HYBRID" label="24 complexes"></option>
                        <option value="TRANSCRIPTION/DNA" label="51 complexes"></option>
                        <option value="Transcription/DNA" label="10 complexes"></option>
                        <option value="transcription/dna" label="28 complexes"></option>
                        <option value="TRANSCRIPTION/DNA-RNA HYBRID" label="20 complexes"></option>
                        <option value="transcription/dna/rna" label="10 complexes"></option>
                        <option value="TRANSCRIPTION/DNA/RNA" label="166 complexes"></option>
                        <option value="Transcription/DNA/RNA" label="13 complexes"></option>
                        <option value="TRANSCRIPTION/INHIBITOR" label="52 complexes"></option>
                        <option value="Transcription/Inhibitor" label="13 complexes"></option>
                        <option value="TRANSCRIPTION/PEPTIDE" label="18 complexes"></option>
                        <option value="TRANSCRIPTION/PROTEIN BINDING" label="13 complexes"></option>
                        <option value="TRANSCRIPTION/RNA" label="23 complexes"></option>
                        <option value="TRANSCRIPTION/RNA/DNA" label="150 complexes"></option>
                        <option value="TRANSCRIPTION/TOXIN" label="10 complexes"></option>
                        <option value="TRANSCRIPTION/TRANSCRIPTION ACTIVATOR" label="13 complexes"></option>
                        <option value="TRANSCRIPTION/TRANSCRIPTION INHIBITOR" label="10 complexes"></option>
                        <option value="transcription/transcription inhibitor" label="14 complexes"></option>
                        <option value="Transcription/Transcription Inhibitor" label="18 complexes"></option>
                        <option value="TRANSCRIPTION/TRANSFERASE" label="23 complexes"></option>
                        <option value="Transcription/Transferase" label="20 complexes"></option>
                        <option value="TRANSFERASE" label="2,092 complexes"></option>
                        <option value="TRANSFERASE/ANTIBIOTIC" label="20 complexes"></option>
                        <option value="TRANSFERASE/DNA" label="13 complexes"></option>
                        <option value="Transferase/DNA" label="10 complexes"></option>
                        <option value="TRANSFERASE/DNA BINDING PROTEIN" label="11 complexes"></option>
                        <option value="TRANSFERASE/DNA/RNA" label="28 complexes"></option>
                        <option value="TRANSFERASE/INHIBITOR" label="94 complexes"></option>
                        <option value="TRANSFERASE/LIPID BINDING PROTEIN" label="12 complexes"></option>
                        <option value="TRANSFERASE/PEPTIDE" label="63 complexes"></option>
                        <option value="Transferase/Peptide" label="17 complexes"></option>
                        <option value="transferase/peptide" label="13 complexes"></option>
                        <option value="TRANSFERASE/PROTEIN BINDING" label="24 complexes"></option>
                        <option value="Transferase/Protein Binding" label="15 complexes"></option>
                        <option value="TRANSFERASE/SIGNALING PROTEIN" label="33 complexes"></option>
                        <option value="TRANSFERASE/signaling protein" label="10 complexes"></option>
                        <option value="Transferase/Signaling Protein" label="15 complexes"></option>
                        <option value="TRANSFERASE/STRUCTURAL PROTEIN" label="25 complexes"></option>
                        <option value="TRANSFERASE/TRANSCRIPTION" label="35 complexes"></option>
                        <option value="Transferase/Transcription" label="17 complexes"></option>
                        <option value="TRANSFERASE/TRANSFERASE INHIBITOR" label="240 complexes"></option>
                        <option value="TRANSFERASE/TRANSFERASE inhibitor" label="16 complexes"></option>
                        <option value="Transferase/Transferase Inhibitor" label="33 complexes"></option>
                        <option value="transferase/transferase inhibitor" label="33 complexes"></option>
                        <option value="TRANSFERASE/TRANSFERASE SUBSTRATE" label="14 complexes"></option>
                        <option value="Transferase/unknown function" label="49 complexes"></option>
                        <option value="TRANSLATION" label="519 complexes"></option>
                        <option value="TRANSLOCASE" label="204 complexes"></option>
                        <option value="TRANSPORT PROTEIN" label="793 complexes"></option>
                        <option value="TRANSPORT PROTEIN/SIGNALING PROTEIN" label="27 complexes"></option>
                        <option value="TRANSPORT PROTEIN/STRUCTURAL PROTEIN" label="28 complexes"></option>
                        <option value="TRANSPORT PROTEIN/TOXIN" label="17 complexes"></option>
                        <option value="UNKNOWN FUNCTION" label="61 complexes"></option>
                        <option value="VIRAL PROTEIN" label="2,053 complexes"></option>
                        <option value="VIRAL PROTEIN, TRANSFERASE" label="18 complexes"></option>
                        <option value="VIRAL PROTEIN/DNA" label="14 complexes"></option>
                        <option value="VIRAL PROTEIN/DNA/INHIBITOR" label="46 complexes"></option>
                        <option value="Viral protein/Immune system" label="22 complexes"></option>
                        <option value="VIRAL PROTEIN/IMMUNE SYSTEM" label="192 complexes"></option>
                        <option value="VIRAL PROTEIN/IMMUNE SYSTEM/INHIBITOR" label="22 complexes"></option>
                        <option value="VIRAL PROTEIN/INHIBITOR" label="70 complexes"></option>
                        <option value="VIRAL PROTEIN/PEPTIDE" label="14 complexes"></option>
                        <option value="Viral Protein/Peptide" label="16 complexes"></option>
                        <option value="VIRAL PROTEIN/PROTEIN TRANSPORT" label="75 complexes"></option>
                        <option value="VIRAL PROTEIN/RNA" label="10 complexes"></option>
                        <option value="VIRAL PROTEIN/TRANSFERASE" label="33 complexes"></option>
                        <option value="VIRUS" label="1,247 complexes"></option>
                        <option value="VIRUS LIKE PARTICLE" label="214 complexes"></option>
                        <option value="VIRUS LIKE PARTICLE/PROTEIN BINDING" label="24 complexes"></option>
                        <option value="VIRUS/IMMUNE SYSTEM" label="29 complexes"></option>
                        <option value="Virus/Receptor" label="10 complexes"></option>
                        <option value="Virus/RNA" label="11 complexes"></option>
                        <option value="VIRUS/VIRAL PROTEIN" label="10 complexes"></option>
                </datalist>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <label class="form-label mb-1" for="method">Structure method <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Experimental method used to determine the structure.">?</a></label>
                <select class="form-select form-select-sm" id="method">
                    <option value="">All</option>
                    <option value="XRAY">X-ray diffraction (46,228)</option>
                    <option value="EM">Electron microscopy (26,418)</option>
                    <option value="NMR">NMR (738)</option>
                    <option value="NEUTRON">Neutron diffraction (6)</option>
                    <option value="SCATT">Solution scattering (1)</option>
                    <option value="ECRYST">Electron crystallography (1)</option>
                </select>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <label class="form-label mb-1" for="interfaceEvidence">Interface evidence <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="PISA Complexation Significance Score (CSS), which measures how much the interface contributes to the assembly: strong = 0.5 or above (the interface sustains the assembly), moderate = between 0 and 0.5, weak = 0 (no role in the assembly). PISA computes it only for diffraction structures, so entries solved by electron microscopy, NMR and other methods appear as not assessed.">?</a></label>
                <select class="form-select form-select-sm" id="interfaceEvidence">
                    <option value="">All</option>
                    <option value="strong">Strong – CSS ≥ 0.5 (15,911)</option>
                    <option value="moderate">Moderate – 0 &lt; CSS &lt; 0.5 (17,967)</option>
                    <option value="weak">Weak – CSS = 0 (9,789)</option>
                    <option value="not_assessed">Not assessed (29,725)</option>
                </select>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <label class="form-label mb-1" for="aminoAcids">Canonical amino acids <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Peptides with non-standard residues carry an X in the sequence. Choose whether to keep only the canonical ones, only those containing non-standard residues, or all of them.">?</a></label>
                <select class="form-select form-select-sm" id="aminoAcids">
                    <option value="">All</option>
                    <option value="canonical">Only canonical</option>
                    <option value="noncanonical">With non-canonical (X)</option>
                </select>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <label class="form-label mb-1" for="saltBridges">Salt bridges <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Salt bridges are attractive contacts between oppositely charged groups across the interface, as identified by PISA. Choose whether to keep only complexes that have them, only those without, or all of them.">?</a></label>
                <select class="form-select form-select-sm" id="saltBridges">
                    <option value="">All</option>
                    <option value="with">With salt bridges</option>
                    <option value="without">Without salt bridges</option>
                </select>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <label class="form-label mb-1" for="therapeutic">Therapeutic class <span class="text-warning" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Predicted value: estimated by a computational model, not measured experimentally."><i class="bi bi-exclamation-triangle-fill"></i></span> <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Keeps peptides whose predicted probability for the class is above 0.9, the cutoff Propedia adopts for a high likelihood. Predicted by machine learning models, not experimental data.">?</a></label>
                <select class="form-select form-select-sm" id="therapeutic">
                    <option value="">All</option>
                    <option value="AAP">Anti-Angiogenic &gt; 0.9</option>
                    <option value="ABP">Antibacterial &gt; 0.9</option>
                    <option value="ACP">Anticancer &gt; 0.9</option>
                    <option value="AIP">Anti-Inflammatory &gt; 0.9</option>
                    <option value="QSP">Quorum Sensing &gt; 0.9</option>
                    <option value="SBP">Surface Binding &gt; 0.9</option>
                </select>
            </div>

            <!-- medidas do peptideo e da interface -->
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <label class="form-label mb-0" for="minSize">Min peptide size <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Keeps complexes whose peptide has at least this many residues (from 2 to 50).">?</a> <span class="badge bg-secondary" id="minSize_val">2</span></label>
                <input type="range" class="form-range filtro-range" id="minSize" min="2" max="50" step="1" value="2" data-neutro="min">
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <label class="form-label mb-0" for="maxSize">Max peptide size <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Keeps complexes whose peptide has at most this many residues (from 2 to 50).">?</a> <span class="badge bg-secondary" id="maxSize_val">50</span></label>
                <input type="range" class="form-range filtro-range" id="maxSize" min="2" max="50" step="1" value="50" data-neutro="max">
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <label class="form-label mb-0" for="minHbonds">Min hydrogen bonds <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Minimum number of hydrogen bonds across the protein-peptide interface, as identified by PISA (0 to 93).">?</a> <span class="badge bg-secondary" id="minHbonds_val">0</span></label>
                <input type="range" class="form-range filtro-range" id="minHbonds" min="0" max="93" step="1" value="0" data-neutro="min">
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <label class="form-label mb-0" for="minBsa">Min buried area (Å²) <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Minimum buried surface area of the interface, in Å², calculated with NACCESS (1 to 3,856).">?</a> <span class="badge bg-secondary" id="minBsa_val">0</span></label>
                <input type="range" class="form-range filtro-range" id="minBsa" min="0" max="3856" step="50" value="0" data-neutro="min">
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <label class="form-label mb-0" for="minBpp">Min buried peptide (%) <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Minimum percentage of the peptide surface that becomes buried upon complex formation.">?</a> <span class="badge bg-secondary" id="minBpp_val">0</span></label>
                <input type="range" class="form-range filtro-range" id="minBpp" min="0" max="100" step="5" value="0" data-neutro="min">
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <label class="form-label mb-0" for="minHydrophobic">Min hydrophobic (%) <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Minimum percentage of hydrophobic residues in the peptide sequence.">?</a> <span class="badge bg-secondary" id="minHydrophobic_val">0</span></label>
                <input type="range" class="form-range filtro-range" id="minHydrophobic" min="0" max="100" step="5" value="0" data-neutro="min">
            </div>

            <!-- resolucao, energias preditas, redundancia e acoes -->
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <label class="form-label mb-0" for="minPositive">Min positive residues <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Minimum number of positively charged residues in the peptide (0 to 22).">?</a> <span class="badge bg-secondary" id="minPositive_val">0</span></label>
                <input type="range" class="form-range filtro-range" id="minPositive" min="0" max="22" step="1" value="0" data-neutro="min">
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <label class="form-label mb-0" for="maxResolution">Min resolution (Å) <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Keeps structures determined at this resolution or better, in Å: the lower the number, the sharper the structure. Leave it at the left (any) to accept every resolution. Entries without a resolution value, such as those solved by NMR, are left out when this filter is used.">?</a> <span class="badge bg-secondary" id="maxResolution_val">any</span></label>
                <input type="range" class="form-range filtro-range" id="maxResolution" data-neutro-rotulo="any" min="0" max="36" step="0.1" value="0" data-neutro="min">
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <label class="form-label mb-0" for="maxAffinity">Min bind. free energy <span class="text-warning" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Predicted value: estimated by a computational model, not measured experimentally."><i class="bi bi-exclamation-triangle-fill"></i></span> <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Binding affinity predicted by PRODIGY, in kcal/mol. The stronger the binding, the more negative the value, so choosing 10 keeps complexes with affinity of -10 kcal/mol or stronger. Predicted value, not experimental data.">?</a> <span class="badge bg-secondary" id="maxAffinity_val">0</span></label>
                <input type="range" class="form-range filtro-range" id="maxAffinity" data-neutro-rotulo="any" data-inverte="1" min="0" max="40" step="0.5" value="0" data-neutro="min">
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <label class="form-label mb-0" for="minDiss">Min ΔGdiss <span class="text-warning" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Predicted value: estimated by a computational model, not measured experimentally."><i class="bi bi-exclamation-triangle-fill"></i></span> <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Dissociation free energy estimated by PISA, in kcal/mol, from -19.7 to +68.9. Positive values indicate a thermodynamically stable complex. Predicted value, not experimental data.">?</a> <span class="badge bg-secondary" id="minDiss_val">-20</span></label>
                <input type="range" class="form-range filtro-range" id="minDiss" data-neutro-rotulo="any" min="-20" max="69" step="1" value="-20" data-neutro="min">
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2 d-flex align-items-end">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" role="switch" id="onlyUnique">
                    <label class="form-check-label" for="onlyUnique">Remove redundancy <a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Keeps only the leader of each cluster of complexes with similar sequences.">?</a></label>
                </div>
            </div>

            <!-- acoes: Apply por ultimo, a direita. O ms-md-auto encosta a coluna
                 na borda direita da linha, senao ela para logo depois do ultimo
                 filtro e sobra espaco a direita (acontecia no breakpoint lg). -->
            <div class="col-12 col-md-4 col-lg-3 col-xl-2 d-flex align-items-end justify-content-md-end gap-2 flex-wrap ms-md-auto">
                <button type="button" id="btn-limpar" class="btn btn-outline-secondary">Clear</button>
                <button type="button" id="btn-filtrar" class="btn btn-primary">Apply filters</button>
            </div>
        </div>
    </div>

    <div id="explore">
        <div class="container-fluid mt-5">
            <div class="table-responsive small">
                <table id="table_explore" class="table table-striped table-hover " style="width:100%; ">
                    <thead>
                        <tr class="tableheader">
                            <th class="dt-center" style="width: 8%">ID <sup><a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Propedia ID: PDB - Peptide chain - Protein chain">?</a></sup></th><!-- 0 -->

                            <th>PROTEIN SIZE</th>
                            <th>PEPTIDE SIZE</th>
                            <th>PEPTIDE SEQUENCE</th>
                            <th style="width: 30%">TITLE</th>
                            <th>CLASSIFICATION</th>
                            <th>Leader<sup><a class="badge bg-secondary" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Structures with similar sequences are clustered together. 'Yes' marks the leader, the entry that represents its cluster; 'no' links to the leader.">?</a></sup></th>
                            <th class="dt-center">Download</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <center id="loading-data">
                    <p class="text-center text-muted small">Wait... loading data...</p>
                    <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                </center>

                <div class="d-grid pt-4 mt-5 mb-5">
                    <button type="button" id="btn-export-baixo" class="btn btn-success btn-lg">
                        <i class="bi bi-download me-1"></i> Download CSV
                        <span class="d-block small fw-normal">every complex matching the current filters</span>
                    </button>
                </div>
            </div>

            <hr class="mt-5 mb-4">


            <!-- BAIXAR E FILTRAR A BASE COMPLETA LOCALMENTE (Python) -->
            <!-- padding no lugar de margem: margens irmas colapsam entre si -->
            <div class="pt-4">
                <div class="card mt-5 mb-2">
                    <div class="card-header bg-secondary text-light">
                        <strong><i class="bi bi-filetype-py me-1"></i> Download &amp; filter the full dataset locally</strong>
                    </div>
                    <div class="card-body bg-light">
                        <p class="small">
                            The <strong>Download CSV</strong> button above exports the summary table for your current filters.
                            To retrieve the structures themselves, download the complete database from the
                            <a href="<?= base_url('download') ?>">Download page</a> and filter it locally &mdash; building custom
                            packages on our server is too resource-intensive.
                        </p>
                        <p class="small text-muted mb-2">
                            Run the script below in <a href="https://colab.research.google.com" target="_blank" rel="noopener">Google Colab</a>
                            or any local Python environment (requires <code>pandas</code>). It keeps only the entries matching the filters
                            you selected above &mdash; click <strong>Apply filters</strong> to refresh it. The structures are organized as
                            <code>pdb/&lt;first_char&gt;/&lt;ID&gt;.pdb</code>.
                        </p>
                        <div class="position-relative">
                            <button id="btnCopyPy" type="button" class="btn btn-sm btn-outline-secondary position-absolute top-0 end-0 m-2">
                                <i class="bi bi-clipboard"></i> Copy
                            </button>
                            <pre class="bg-dark text-light p-3 rounded small mb-0"><code id="pyScript"></code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- / FIM Conteúdo personalizado -->
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>

<script>
    $(() => {
        const BASE_URL = '<?= base_url() ?>';

        // busca vinda da URL (?q= ou ?query=)
        const urlParams = new URLSearchParams(window.location.search);
        const buscaInicial = (urlParams.get('q') || urlParams.get('query') || '').trim();

        // mostra a busca corrente no campo do topo, para o usuario poder edita-la
        if (buscaInicial) {
            $('#urlInput').val(buscaInicial);
        }

        const valor = (id) => ($('#' + id).val() || '').trim();
        const marcado = (id) => ($('#' + id).is(':checked') ? '1' : '');

        // Um range na ponta neutra (min para filtros "a partir de", max para
        // filtros "ate") significa "sem filtro", e nao e enviado ao servidor.
        const noNeutro = (el) => (el.dataset.neutro === 'min') ? (el.value === el.min) : (el.value === el.max);
        // O slider da afinidade corre de 0 a 40 para que o "sem filtro" fique na
        // esquerda como nos demais; o valor enviado e o negativo dele, porque
        // ligacao mais forte significa ΔG mais negativo.
        const valorDaFaixa = (el) => el.dataset.inverte ? String(-parseFloat(el.value)) : el.value;
        const faixa = (id) => {
            const el = document.getElementById(id);
            return (!el || noNeutro(el)) ? '' : valorDaFaixa(el);
        };
        const rotuloDaFaixa = (el) => (noNeutro(el) && el.dataset.neutroRotulo)
            ? el.dataset.neutroRotulo
            : valorDaFaixa(el);

        // mostra o valor corrente ao lado do rotulo e pinta a trilha percorrida
        const atualizadores = {};
        $('.filtro-range').each(function() {
            const badge = document.getElementById(this.id + '_val');
            const atualiza = () => {
                if (badge) {
                    badge.textContent = rotuloDaFaixa(this);
                }
                // no estado neutro a trilha fica toda cinza: sem filtro, sem destaque
                const min = parseFloat(this.min);
                const max = parseFloat(this.max);
                const pct = (noNeutro(this) || max <= min)
                    ? 0
                    : ((parseFloat(this.value) - min) / (max - min)) * 100;
                this.style.setProperty('--pct', pct.toFixed(1) + '%');
            };
            atualizadores[this.id] = atualiza;
            atualiza();
            $(this).on('input', atualiza);
        });

        // O tamanho minimo do peptideo nunca passa do maximo: o cursor empurrado
        // para alem do outro para no valor dele.
        $('#minSize').on('input', function() {
            const maximo = document.getElementById('maxSize');
            if (parseFloat(this.value) > parseFloat(maximo.value)) {
                this.value = maximo.value;
                atualizadores.minSize();
            }
        });
        $('#maxSize').on('input', function() {
            const minimo = document.getElementById('minSize');
            if (parseFloat(this.value) < parseFloat(minimo.value)) {
                this.value = minimo.value;
                atualizadores.maxSize();
            }
        });

        // Filtros enviados ao servidor (mesmos nomes lidos em Home::exploreFiltros)
        const filtrosAtuais = () => ({
            minSize: faixa('minSize'),
            maxSize: faixa('maxSize'),
            classification: valor('classification'),
            aminoAcids: valor('aminoAcids'),
            onlyUnique: marcado('onlyUnique'),
            minHbonds: faixa('minHbonds'),
            saltBridges: valor('saltBridges'),
            minBsa: faixa('minBsa'),
            minBpp: faixa('minBpp'),
            maxResolution: faixa('maxResolution'),
            method: valor('method'),
            interfaceEvidence: valor('interfaceEvidence'),
            minHydrophobic: faixa('minHydrophobic'),
            minPositive: faixa('minPositive'),
            therapeutic: valor('therapeutic'), // corte fixo de 0.9 no servidor
            maxAffinity: faixa('maxAffinity'),
            minDiss: faixa('minDiss')
        });

        // DataTables em modo server-side: o PHP le o TSV e devolve so a pagina
        // pedida. Antes o arquivo inteiro (16 MB) era carregado no navegador.
        const table = $('#table_explore').DataTable({
            serverSide: true,
            processing: true,
            // 'lrtip' = tudo menos o campo de busca ('f'): quem busca na tabela e
            // o campo do topo da pagina, que envia ?q= para esta mesma rota
            dom: 'lrtip',
            pageLength: 10,
            order: [[0, 'asc']],
            search: { search: buscaInicial },
            ajax: {
                url: BASE_URL + 'explore/data',
                data: function(d) {
                    Object.assign(d, filtrosAtuais());
                }
            },
            columnDefs: [
                {
                    // ID -> link para a entrada
                    targets: 0,
                    render: function(data, type) {
                        if (type !== 'display') { return data; }
                        return `<strong><a href="${BASE_URL}entry/${data}">${data}</a></strong>`;
                    }
                },
                {
                    // is_leader -> badge; quando "no", aponta para a entrada lider
                    targets: 6,
                    render: function(data, type, row) {
                        if (type !== 'display') { return data; }
                        const v = String(data || '').trim().toLowerCase();
                        if (v === 'yes') {
                            return `<label class="badge bg-propedia">yes</label>`;
                        }
                        if (v === 'no') {
                            const ref = row[7] || row[0];
                            return `<a class="badge bg-danger link-light" href="${BASE_URL}entry/${ref}" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Similar to ${ref}">no</a>`;
                        }
                        return data;
                    }
                },
                {
                    // leader_id -> botao de download do PDB
                    targets: 7,
                    orderable: false,
                    className: 'dt-center',
                    render: function(data, type, row) {
                        if (type !== 'display') { return data; }
                        const id = row[0];
                        return `<a href="${BASE_URL}data/db/pdb/${id.charAt(0)}/${id}.pdb" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Click to download the file: ${id}.pdb"><strong><i class="bi bi-download"></i></strong></a>`;
                    }
                }
            ],
            initComplete: function() {
                $('#loading-data').hide();
            },
            drawCallback: function(settings) {
                // quantidade de resultados, no alto da pagina
                const total = settings.fnRecordsTotal();
                const exibidas = settings.fnRecordsDisplay();
                $('#contador-valor').text(exibidas.toLocaleString('en-US'));
                $('#contador-detalhe').text(
                    (exibidas === total) ? '' : ' of ' + total.toLocaleString('en-US') + ' (filtered)'
                );

                // sem resultado nao ha o que exportar
                $('#btn-export-baixo')
                    .prop('disabled', exibidas === 0)
                    .attr('title', (exibidas === 0)
                        ? 'No complex matches the current filters'
                        : 'Export every row matching the current filters');
            }
        });

        // ---- aplicar / limpar / exportar ----
        let timerDoAlerta = null;

        const avisar = (mensagem) => {
            const alert = `
            <div class="alert alert-success alert-dismissible fade show mb-0 small text-center rounded-0" role="alert">
                ${mensagem}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
            clearTimeout(timerDoAlerta);
            $('#alert-container').html(alert);
            timerDoAlerta = setTimeout(() => {
                const elemento = document.querySelector('#alert-container .alert');
                if (elemento) {
                    bootstrap.Alert.getOrCreateInstance(elemento).close();
                }
            }, 4000);
        };

        const aplicarFiltros = () => {
            table.ajax.reload(function(json) {
                const exibidas = (json && json.recordsFiltered) || 0;
                const total = (json && json.recordsTotal) || 0;
                avisar(`Filters applied: ${exibidas.toLocaleString('en-US')} of ${total.toLocaleString('en-US')} complexes.`);
            });
            atualizarScriptPython();
        };

        $('#btn-filtrar').on('click', aplicarFiltros);

        $('#btn-limpar').on('click', function() {
            $('.filtro-range').each(function() {
                this.value = (this.dataset.neutro === 'min') ? this.min : this.max;
                $(this).trigger('input'); // atualiza o rotulo
            });
            $('#classification, #method, #interfaceEvidence, #therapeutic, #aminoAcids, #saltBridges').val('');
            $('#onlyUnique').prop('checked', false);
            table.search('');
            table.ajax.reload();
            atualizarScriptPython();
        });

        // Enter em qualquer campo dos filtros aplica a busca
        $('#filtros-explore').on('keydown', 'input', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                aplicarFiltros();
            }
        });

        // Exporta TODAS as linhas que passam pelos filtros (nao so a pagina)
        $('#btn-export-baixo').on('click', function() {
            const parametros = filtrosAtuais();
            parametros.search = table.search();
            window.location = BASE_URL + 'explore/export?' + new URLSearchParams(parametros).toString();
        });

        // ---- script Python que reproduz os filtros correntes ----
        const py = (v) => JSON.stringify(String(v)); // literal valido em Python

        const construirScriptPython = () => {
            const f = filtrosAtuais();
            const L = [];

            L.push('import pandas as pd, os, shutil');
            L.push('');
            L.push('# Summary table of the database (same file used by the Explore page)');
            L.push('cols = ["id","PROTEIN_SIZE","PEPTIDE_SIZE","PEPTIDE_SEQ","TITLE","CLASSIFICATION",');
            L.push('        "is_leader","leader_id","PISA_n_hbonds","PISA_n_saltbridges","BSA","BPP",');
            L.push('        "RESOLUTION","STRUCTURE_METHOD","peptide_HydrophobicPercent","peptide_PositiveResidues",');
            L.push('        "AAP","ABP","ACP","AIP","QSP","SBP","PISA_CSS",');
            L.push('        "binding_affinity","PISA_diss_energy"]');
            L.push('df = pd.read_csv("propedia26_v17.tsv", sep="\\t", header=None, names=cols)');
            L.push('');
            L.push('# --- Filters (matching your current selection on the website) ---');
            L.push('mask = pd.Series(True, index=df.index)');

            const busca = table.search();
            if (busca) {
                L.push('mask &= df.astype(str).apply(lambda r: ' + py(busca.toLowerCase()) + ' in "\\t".join(r.values).lower(), axis=1)');
            }
            if (f.minSize) { L.push('mask &= df["PEPTIDE_SIZE"] >= ' + f.minSize); }
            if (f.maxSize) { L.push('mask &= df["PEPTIDE_SIZE"] <= ' + f.maxSize); }
            if (f.classification) { L.push('mask &= df["CLASSIFICATION"] == ' + py(f.classification)); }
            if (f.aminoAcids === 'canonical') { L.push('mask &= ~df["PEPTIDE_SEQ"].str.contains("x", case=False, na=False)'); }
            if (f.aminoAcids === 'noncanonical') { L.push('mask &= df["PEPTIDE_SEQ"].str.contains("x", case=False, na=False)'); }
            if (f.onlyUnique) { L.push('mask &= df["is_leader"] == "yes"'); }
            if (f.minHbonds) { L.push('mask &= df["PISA_n_hbonds"] >= ' + f.minHbonds); }
            if (f.saltBridges === 'with') { L.push('mask &= df["PISA_n_saltbridges"] > 0'); }
            if (f.saltBridges === 'without') { L.push('mask &= df["PISA_n_saltbridges"] == 0'); }
            if (f.minBsa) { L.push('mask &= df["BSA"] >= ' + f.minBsa); }
            if (f.minBpp) { L.push('mask &= df["BPP"] >= ' + f.minBpp); }
            if (f.maxResolution) { L.push('mask &= df["RESOLUTION"] <= ' + f.maxResolution); }
            if (f.method) { L.push('mask &= df["STRUCTURE_METHOD"] == ' + py(f.method)); }
            if (f.interfaceEvidence === 'strong') { L.push('mask &= df["PISA_CSS"] >= 0.5'); }
            if (f.interfaceEvidence === 'moderate') { L.push('mask &= df["PISA_CSS"].between(0, 0.5, inclusive="neither")'); }
            if (f.interfaceEvidence === 'weak') { L.push('mask &= df["PISA_CSS"] == 0'); }
            if (f.interfaceEvidence === 'not_assessed') { L.push('mask &= df["PISA_CSS"].isna()'); }
            if (f.minHydrophobic) { L.push('mask &= df["peptide_HydrophobicPercent"] >= ' + f.minHydrophobic); }
            if (f.minPositive) { L.push('mask &= df["peptide_PositiveResidues"] >= ' + f.minPositive); }
            if (f.therapeutic) {
                L.push('mask &= df["' + f.therapeutic + '"] > 0.9');
            }
            if (f.maxAffinity) { L.push('mask &= df["binding_affinity"] <= ' + f.maxAffinity); }
            if (f.minDiss) { L.push('mask &= df["PISA_diss_energy"] >= ' + f.minDiss); }

            L.push('');
            L.push('selected = df[mask]');
            L.push('print(f"{len(selected)} complexes selected")');
            L.push('selected.to_csv("filtered_list.csv", index=False)');
            L.push('');
            L.push('# --- Copy the matching structures (folder layout: pdb/<first_char>/<ID>.pdb) ---');
            L.push('os.makedirs("filtered_pdb", exist_ok=True)');
            L.push('for pid in selected["id"]:');
            L.push('    src = os.path.join("pdb", pid[0], pid + ".pdb")');
            L.push('    if os.path.isfile(src):');
            L.push('        shutil.copy(src, os.path.join("filtered_pdb", pid + ".pdb"))');

            return L.join('\n');
        };

        const atualizarScriptPython = () => {
            document.getElementById('pyScript').textContent = construirScriptPython();
        };

        atualizarScriptPython(); // versao inicial, sem filtros

        $('#btnCopyPy').on('click', function() {
            const codigo = document.getElementById('pyScript').textContent;
            const botao = $(this);
            const original = botao.html();
            navigator.clipboard.writeText(codigo).then(() => {
                botao.html('<i class="bi bi-check2"></i> Copied!');
                setTimeout(() => botao.html(original), 1500);
            });
        });

        // tooltips das linhas recem-desenhadas
        $('#table_explore').on('draw.dt', function() {
            if (typeof loadTooltip === 'function') {
                loadTooltip();
            }
        });
    });
</script>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    $(() => {
        setTimeout(() => $('#loading').fadeOut(), 1000);
    });
</script>

<!-- DataTables JS + botões de exportação -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<?= $this->endSection() ?>