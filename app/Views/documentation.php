<?= $this->extend('template') ?>
<?= $this->section('conteudo') ?>
<div class="container-fluid py-4 text-secondary">
  <!-- Conteúdo personalizado -->

  <h1 class="pb-2 text-dark"><strong>Documentation</strong></h1>

  <!-- conteudo milenna -->
  <style>
    nav.toc {
      background: rgba(255, 255, 255, .03);
      padding: 14px;
      border-radius: 12px;
      margin-bottom: 18px
    }

    nav.toc ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-wrap: wrap;
      gap: 8px
    }

    nav.toc a {
      color: var(--accent);
      text-decoration: none;
      font-weight: 600
    }

    section.docs-card {
      background: rgba(255, 255, 255, .02);
      padding: 18px;
      border-radius: 12px;
      margin-bottom: 16px
    }

    .fig {
      border: 1px dashed rgba(255, 255, 255, .03);
      padding: 12px;
      border-radius: 10px;
      margin: 12px 0;
      color: var(--muted);
      text-align: center
    }

    .muted {
      color: var(--muted)
    }

    @media (min-width:900px) {
      .layout {
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 18px
      }

      .sidebar {
        position: sticky;
        top: 18px;
        height: calc(100vh - 36px);
        overflow: auto;
        padding-right: 6px
      }
    }

    .search {
      background: rgba(255, 255, 255, .02);
      padding: 8px;
      border-radius: 8px;
      margin-bottom: 12px
    }

    .small-btn {
      display: inline-block;
      padding: 6px 10px;
      border-radius: 8px;
      background: rgba(255, 255, 255, .02);
      color: var(--accent);
      text-decoration: none;
      font-weight: 600
    }

    .anchor {
      color: var(--muted);
      font-size: .9rem
    }
  </style>
  <div class="layout">
    <aside class="sidebar">
      <div class="docs-search">
        <strong class="muted">Quick index</strong>
      </div>

      <nav class="toc">
        <ul>
          <li><a href="#intro">1. Introduction</a></li>
          <li><a href="#overview">1.1 Overview</a></li>
          <li><a href="#whats-new">1.2 What's New (v26)</a></li>
          <li><a href="#expanded">1.2.1 Expanded dataset</a></li>
          <li><a href="#redesigned">1.2.2 Redesigned user interface</a></li>
          <li><a href="#analytical">1.2.3 New analytical tools</a></li>
          <li><a href="#improved">1.2.4 Improved search capabilities</a></li>
          <li><a href="#technical">1.2.5 Technical improvements</a></li>
          <li><a href="#how-to-cite">1.3 How to Cite & License</a></li>
          <li><a href="#license1">1.3.1 Article License (2021): CC BY 4.0</a></li>
          <li><a href="#license2">1.3.2 Software policy: LBS-SRC</a></li>
          <li><a href="#using-platform">2. How to Use the Platform</a></li>
          <li><a href="#entry">2.1 Entry Page</a></li>
          <li><a href="#edescription">2.1.1 Entry description</a></li>
          <li><a href="#ephysical">2.1.2 Physicochemical parameters</a></li>
          <li><a href="#einteractive">2.1.3 Interactive 3D structure visualization panel</a></li>
          <li><a href="#ecluster">2.1.4 Clustering information</a></li>
          <li><a href="#eprotein">2.1.5 Protein-peptide interaction information</a></li>
          <li><a href="#blast-tool">2.2 BLAST tool</a></li>
          <li><a href="#parameters-config">2.2.1 Parameters and Configuration</a></li>
          <li><a href="#blast-use">2.2.2 How to use Propedia BLAST?</a></li>
          <li><a href="#other">2.2.3 Other search tools</a></li>
          <li><a href="#clusters">2.3 Clusters</a></li>
          <li><a href="#history">2.3.1 History and evolution of clustering in Propedia</a></li>
          <li><a href="#redundancy">2.3.2 Redundancy and cluster formation in version 26</a></li>
          <li><a href="#practical-app">2.3.3 Practical applications of clusters</a></li>
          <li><a href="#downloads">2.4 Available downloads</a></li>
          <li><a href="#quick">2.4.1 Quick usage recommendations</a></li>
          <li><a href="#explore">2.5 Explore</a></li>
          <li><a href="#practical-examples">2.5.1 Practical search examples, tips and best practices</a></li>
          <li><a href="#troubleshooting1">2.5.2 Troubleshooting</a></li>
          <li><a href="#id-page">2.5.3 ID page: e.g.: 1A0N-A-B</a></li>
          <li><a href="#interpreted">2.5.3.1 How should it be interpreted?</a></li>
          <li><a href="#troubleshooting2">2.5.3.2 Troubleshooting</a></li>
          <li><a href="#binding-sites">2.6 Search for Similar Binding Sites (ProBiS)</a></li>
          <li><a href="#new-probis">2.6.1 What is new in version 26</a></li>
          <li><a href="#example">2.6.2 Example</a></li>
          <li><a href="#source-code">3. Source code and reproducibility</a></li>
          <li><a href="#descriptors">4. Data descriptors</a></li>
          <li><a href="#final">5. Final Considerations</a></li>
          <li><a href="#reference">6. References</a></li>
        </ul>
      </nav>

      <div class="docs-card" style="margin-top:12px">
        <div class="muted" style="font-size:.9rem">Useful links</div>
        <div style="margin-top:8px">
          <a class="small-btn" href="https://bioinfo.dcc.ufmg.br/propedia26/public/" target="_blank">
            Open PROPEDIA
          </a>
        </div>
      </div>
    </aside>
    <article class="text-muted">
      <section id="intro" class="docs-card">
        <h1>1. Introduction</h1>

        <div style="text-align: center; margin-top: 20px;">
          <p style="font-size: 1.4em; font-weight: bold;">
            "Propedia is a database of protein-peptide complexes"
          </p>

          <p style="font-style: italic;">
            Propedia 26 is available at
            <a href="https://bioinfo.dcc.ufmg.br/propedia26">https://bioinfo.dcc.ufmg.br/propedia26</a>
          </p>
        </div>

        <div class="rounded bordered bg-light p-4 my-3 mt-5">
          <h3 class="pb-1">What is Propedia?</h3>
          <p>PROPEDIA is a database of peptide-protein complexes clusterized in three methodologies: based on peptide sequences; based on structure interface; and based on binding sites. PROPEDIA main goal is to give new insights into peptide design of biotechnological interests.</p>
        </div>

        <h3 class="pt-4 pb-1">Propedia 26 stats</h3>

        <div class="table-responsive">
          <table class="table table-hover table-condensed table-striped" class="table table-striped table-bordered table-hover table-sm align-middle text-end">
            <caption class="text-muted">Entries summary</caption>
            <thead class="table-light">
              <tr>
                <th scope="col"></th>
                <th scope="col">pep-pro complexes</th>
                <th scope="col">multipro</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Unique entries</th>
                <td>38,218</td>
                <td>0</td>
                <td>38,218</td>
              </tr>
              <tr>
                <th scope="row">Duplicated entries</th>
                <td>35,174</td>
                <td>19,759</td>
                <td>54,933</td>
              </tr>
            </tbody>
            <tfoot class="table-light">
              <tr>
                <th scope="row">Total</th>
                <td>73,392</td>
                <td>19,759</td>
                <td><strong>93,151</strong></td>
              </tr>
            </tfoot>
          </table>
        </div>


        <h2 id="overview">1.1 Overview</h2>

        <p>Propedia is a publicly accessible, curated database dedicated to protein-peptide interactions. It serves as a central repository for structural, thermodynamic, and functional data of complexes formed between proteins and peptide ligands. Derived from the Protein Data Bank (PDB), Propedia offers a robust platform for researchers in bioinformatics, structural biology, and drug discovery to explore, analyze, and derive insights from these critical molecular interactions.</p>

        <p>Protein-peptide interactions are fundamental to numerous cellular processes, including signal transduction, immune response, and enzyme regulation. Understanding the principles that govern these interactions is crucial for deciphering biological mechanisms and developing novel therapeutics. Propedia addresses this need by providing a systematically organized and enriched dataset that goes beyond the raw structural data available in the PDB.</p>

        <p>The database is equipped with a user-friendly web interface and powerful search tools, allowing users to query complexes by PDB ID, peptide sequence, protein sequence, specific interaction motifs, or thermodynamic parameters. Furthermore, Propedia integrates advanced analytical capabilities, such as multiple sequence alignment and clustering based on peptide similarity, enabling comparative studies and the identification of binding patterns.</p>

        <h3>Key Highlights:</h3>

        <ul>
          <li><strong>Curated Dataset:</strong> A comprehensive collection of protein-peptide complexes from the PDB, carefully validated and annotated.</li>
          <li><strong>Dual Search Modes:</strong> Supports both text-based queries (e.g., PDB ID, UniProt ID) and sequence-based similarity searches (BLAST).</li>
          <li><strong>Advanced Filtering:</strong> Enables refinement of results by experimental method, resolution, interaction energy, and more.</li>
          <li><strong>Integrated Analysis Tools:</strong> Built-in tools for visualizing interfaces, aligning sequences, and clustering complexes.</li>
          <li><strong>Open Access:</strong> All data is freely available for download, supporting reproducible research.</li>
        </ul>
      </section>

      <section id="whats-new" class="docs-card">
        <h2>1.2 What's new in version 26</h2>
        <p>Propedia v26 introduces major updates that significantly expand the database and enhance its analytical power.</p>
      </section>

      <section id="expanded" class="docs-card">
        <h3><em>1.2.1 Expanded dataset</em></h3>
        <ul>
          <li><b> Increased complex count: </b> The updated version of Propedia now includes 73,392 protein-peptide complexes, a 3.7-fold increase in data coverage compared to the previous release (19,813 complexes), as shown in figure 1. Together with the 19,759 multipro entries, the database holds 93,151 entries in total.</li>

          <li><b> Updated PDB sources:</b> Includes structures from the Protein Data Bank collected in September 2025 (the most recent structure was deposited on 18 July 2025), ensuring researchers have access to the most recent structural data.</li>
        </ul>

        <figure>
          <img class="w-75" src="<?= base_url('/img/docs/fig1prop.svg') ?>" alt="Expanding the dataset">
          <figcaption>
            <b>Figure 1.</b> Expanding the dataset. (A) Latest version of Propedia (2026, Propedia v26);
            (B) Original version of Propedia (2020).
          </figcaption>
        </figure>

        <p>
          A dataset of this size is only useful if it can be narrowed down, so the growth in the number of
          complexes was accompanied by a new filter panel on the Explore page. Instead of searching by
          identifier alone, the user combines the properties that were computed for every complex &mdash;
          provenance (PDB classification, structure method, resolution), composition (peptide length,
          canonical amino acids), interface (evidence from PISA, hydrogen bonds, salt bridges, buried area,
          buried peptide, hydrophobicity, positive residues), energy (binding free energy,
          &Delta;G<sub>diss</sub>) and predicted therapeutic class &mdash; and the counter reports how many
          complexes survive the selection before the table is redrawn. The redundancy switch reduces the
          result to one representative per cluster, which is the usual starting point for building a
          dataset. Figure 2 shows the panel; each filter is described in detail in section 2.5.
        </p>

        <figure>
          <img class="shadow bordered w-100 p-2 m-2" src="<?= base_url('/img/docs/doc-explore-filtros.png') ?>" alt="Search filters of the Explore page">
          <figcaption>
            <b>Figure 2.</b> Search filters of the Explore page. The expanded dataset is served with a
            filter panel that combines the structural, energetic and functional properties of every
            complex: PDB classification, structure method, interface evidence, canonical amino acids,
            salt bridges, therapeutic class, peptide length, hydrogen bonds, buried area, buried
            peptide, hydrophobicity, positive residues, resolution, binding free energy and
            &Delta;G<sub>diss</sub>, plus the option of keeping only one representative per cluster.
            The counter in the top right corner reports how many complexes match the current
            selection. The filters are described in section 2.5.
          </figcaption>
        </figure>

      </section>

      <section id="redesigned" class="docs-card">
        <h3><em>1.2.2 Redesigned user interface</em></h3>

        <ul>
          <li><strong>Modernized layout:</strong> Complete visual overhaul with improved navigation and responsive design (Figure 3).</li>
          <li><strong>Enhanced search page:</strong> More intuitive organization of search options and filters.</li>
          <li><strong>Advanced results page:</strong> Redesigned results table with better sorting capabilities and immediate access to key complex information.</li>
        </ul>

        <figure>
          <img class="w-50" src="<?= base_url('/img/docs/fig2prop.svg') ?>" alt="Interface">
          <figcaption>
            <b>Figure 3.</b> Propedia user interface. (A) Latest version of Propedia (2026, Propedia v26); (B) Original version of Propedia (2020, Propedia-legacy).
          </figcaption>
        </figure>

      </section>

      <section id="analytical" class="docs-card">
        <h3><em>1.2.3 New analytical tools</em></h3>
        <ul>
          <li><b>Peptide clustering: </b> Implementation of a novel peptide similarity clustering algorithm that groups complexes based on peptide sequence similarity, enabling evolutionary and functional analysis (Figure 4), more details in section 2.3 and 2.4.</li>

          <li><b>Interface properties from PISA: </b> Each entry now reports the chemical and energetic properties of the interface calculated with PISA, including the Complexation Significance Score, the buried and dissociation areas, the dissociation free energy and the solvation energy gain, more details in section 2.1.5.</li>

        </ul>

        <figure>
          <img class="w-75" src="<?= base_url('/img/docs/fig3prop.svg') ?>" alt="Interface">
          <figcaption>
            <b>Figure 4.</b> Propedia peptide clustering. (A) Latest version of Propedia (2026, Propedia v26); (B) Original version of Propedia (2020).
          </figcaption>
        </figure>

      </section>

      <section id="improved" class="docs-card">
        <h3><em>1.2.4 Improved search capabilities</em></h3>
        <ul>
          <li><b>BLAST Search: </b> Updated sequence search with better performance and more configurable parameters (Figure 5).</li>

        </ul>

        <figure>
          <img class="shadow bordered w-50 p-2 m-2" src="<?= base_url('/img/docs/fig4prop.svg') ?>" alt="Interface">
          <figcaption>
            <b>Figure 5.</b> New tool in Propedia v26: BLAST.
          </figcaption>
        </figure>

      </section>

      <section id="technical" class="docs-card">
        <h3><em>1.2.5 Technical improvements</em></h3>
        <p>
          In version 26, the complex details page has been extensively redesigned to offer a much deeper interaction analysis: it now displays atomic data with precise distance measurements and clear categorization of interaction types (hydrogen bonds, hydrophobic contacts, etc.). In addition, complete structural metrics, such as interface area and interaction energy, which were previously absent or very basic, have been incorporated. The presentation of the data has also been reorganized: in v26, the information is distributed across tabs (structure, energy, sequence) for greater clarity; in the old version, everything was on a single page with less organization. From a computational standpoint, energy calculations have been improved with updated algorithms (e.g., NACCESS or equivalents) with more refined parameterization, while the previous version applied basic calculations with limited validation. These topics are shown in Table 1, and they will be discussed in more detail in the following sections.
        </p>

        <table class="table table-hover table-condensed table-striped">
          <caption style="text-align: left;"><em>Table 1. News in Propedia's property</em></caption>

          <thead>
            <tr>
              <th>Property</th>
              <th>Propedia-legacy</th>
              <th>Propedia v26</th>
            </tr>
          </thead>

          <tbody>

            <!-- Description Box -->
            <tr>
              <th colspan="3" style="text-align: center;">Description Box</th>
            </tr>
            <tr>
              <td>PDB Title</td>
              <td>Yes</td>
              <td>Updated for PDB ID</td>
            </tr>
            <tr>
              <td>Resolution (Å)</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Classification</td>
              <td>Yes</td>
              <td>Updated for “Description”</td>
            </tr>
            <tr>
              <td>Download the complex (PDB file)</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Download contacts</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Download complex data</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Structure method</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Peptide chain</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Protein chain</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Peptide length</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Protein length</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Links to UniProt, PDB, and PubMed</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>

            <!-- Physical-chemical parameters -->
            <tr>
              <th colspan="3" style="text-align: center;">Physical-chemical parameters - Protein/peptide Box</th>
            </tr>
            <tr>
              <td>Description</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Organism</td>
              <td>Yes</td>
              <td>No</td>
            </tr>
            <tr>
              <td>Chain</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Length</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Binding Area (Å²)</td>
              <td>Yes</td>
              <td>Yes* (in a new panel)</td>
            </tr>
            <tr>
              <td>Molecular Weight</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Aromaticity</td>
              <td>Yes</td>
              <td>No</td>
            </tr>
            <tr>
              <td>Instability</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Isoelectric Point</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Sequence</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Aliphatic Index</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>GRAVY</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Hydrophobic (%)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Positive Residues</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Negative Residues</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Atomic Formula</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Total Atoms</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Extinction Coeff. (with disulfide)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Extinction Coeff. (no disulfide)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>

            <!-- Clustering Classification Box -->
            <tr>
              <th colspan="3" style="text-align: center;">Clustering Classification Box</th>
            </tr>
            <tr>
              <td>Sequence cluster</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Contact cluster</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Interface cluster</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Unique complex</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Similar complex</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Similar peptides</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>PDB classification</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>

            <!-- CSM-peptides classes -->
            <tr>
              <th colspan="3" style="text-align: center;">CSM-peptides classes</th>
            </tr>
            <tr>
              <td>Anti-Angiogenic (AAP)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Anti-Bacterial (ABP)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Anti-Cancer (ACP)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Anti-Inflammatory (AIP)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Quorum Sensing (QSP)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Surface Binding (SBP)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>

            <!-- Protein-peptide interactions -->
            <tr>
              <th colspan="3" style="text-align: center;">Protein-peptide interactions Box</th>
            </tr>
            <tr>
              <td>ASA Complex (Naccess)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>ASA (protein)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>ASA (peptide)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>BProA</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>BPepA</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>BPP%</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>BSA</td>
              <td>No</td>
              <td>Yes</td>
            </tr>

            <!-- Interaction energy -->
            <tr>
              <th colspan="3" style="text-align: center;">Interaction energy (Prodigy)</th>
            </tr>
            <tr>
              <td>Number of intermolecular contacts</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Charged–charged contacts</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Charged–polar contacts</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Charged–apolar contacts</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Polar–polar contacts</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Apolar–polar contacts</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Apolar–apolar contacts</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Percentage of apolar NIS residues</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Percentage of charged NIS residues</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Predicted binding affinity (kcal·mol⁻¹)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Predicted dissociation constant (M) at 25°C</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Interface residues (distmax ≤ 6 Å)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Contacts (Calculated using COCaDA)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>

            <!-- Interface properties -->
            <tr>
              <th colspan="3" style="text-align: center;">Interface properties (PISA)</th>
            </tr>
            <tr>
              <td>Interface evidence (strong / moderate / weak)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Complexation significance score (CSS)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Interface area (Å²)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Buried area, peptide and protein (Å²)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Total buried area (Å²)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Complex ASA (Å²)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Dissociation area (Å²)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Dissociation free energy ΔG<sub>diss</sub> (kcal·mol⁻¹)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Solvation energy gain ΔiG (kcal·mol⁻¹)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>ΔiG P-value</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Solvation energy, peptide and protein (kcal·mol⁻¹)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Total interaction energy ΔiG (kcal·mol⁻¹)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Dissociation entropy TΔS (kcal·mol⁻¹)</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Hydrogen bonds and salt bridges at the interface</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Interface residues, peptide and protein</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
            <tr>
              <td>Interface atoms, peptide and protein</td>
              <td>No</td>
              <td>Yes</td>
            </tr>
          </tbody>
        </table>

      </section>

      <section id="how-to-cite" class="docs-card">
        <h1>1.3 How to Cite & Licenses</h1>
        <p>To cite PROPEDIA, we recommend referencing both the original article and the most recent publication in the database. If specific features or previous versions are used, the respective publications may also be cited. The original 2021 article presents the first description of the database:</p>

        <code class="text-dark">
          Martins, P.M., Santos, L.H., Mariano, D. et al. <i>Propedia: a database for protein–peptide identification based on a hybrid clustering algorithm.</i> BMC Bioinformatics 22, 1 (2021). doi: 10.1186/s12859-020-03881-z.
        </code>
        
        <p><br>Version 2.3, published in 2023, introduces a new representation approach based on structural signatures:</p>

        <code class="text-dark">
          Martins P, Mariano D, Carvalho FC, Bastos LL, Moraes L, Paixão V, and docs-cardoso de Melo-Minardi R (2023). <i>Propedia v2.3: A novel representation approach for the peptide-protein interaction database using graph-based structural signatures.</i> Front. Bioinform. 3:1103103. doi: 10.3389/fbinf.2023.1103103.
        </code>

        <p><br>An article for Propedia v26 is currently under development.</p>

      </section>

      <section id="license1" class="docs-card">
        <h2><em>1.3.1 License: CC-BY ND 4.0</em></h2>

        <p>Propedia v26 data is available under the Creative Commons Attribution 4.0 International (CC BY ND 4.0) license. This license allows:</p>

        <ul>
          <li>Unrestricted use, including commercial use.</li>
          <li>Sharing and redistribution of the material in any format.</li>
          <li>Reproduction in any medium.</li>
        </ul>

        <p><strong>Requirements to use the material:</strong></p>

        <ul>
          <li>Give appropriate credit to the original authors (cite the articles).</li>
          <li>Include a link to the license.</li>
          <li>Indicate if changes have been made.</li>
          <li>Cite the papers.</li>
        </ul>

        <p><strong>Exceptions</strong></p>

        <ul>
          <li>Images or third-party materials included in the article may have specific credits or restrictions.</li>
          <li>Content not covered by CC BY 4.0 requires permission from the rights holder.</li>
        </ul>

        <p>You can use the Propedia data freely in your research, but there is a restriction if you wish to create a competing database.</p>

        <p>The code is available on GitHub and is shared under an MIT license.</p>
      </section>

      <section id="license2" class="docs-card">
        <h2><em>1.3.2 Software policy: LBS-SRC</em></h2>

        <p>
          Propedia follows the <a href="https://bioinfo.dcc.ufmg.br/software-policy" target="_blank">LBS-SRC Software Policy</a>, the academic software release cycle adopted by the Laboratory of Bioinformatics and Systems (LBS) of the Federal University of Minas Gerais (UFMG), Brazil, and by its partner groups. The policy defines the support period, the license, the versioning scheme and the authorship of every tool produced in the laboratory.
        </p>

        <p><strong>Support cycle.</strong> Each tool has a five-year life cycle counted from the publication date of the paper associated with it:</p>

        <ul>
          <li><strong>Full support (first two years):</strong> provided by the developers of the tool and the co-authors of the paper. It covers security fixes, bug fixes, interface changes and general user support.</li>

          <li><strong>Extended support (following three years):</strong> provided mainly by the LBS IT team, and it may not involve the original developers. It is limited to keeping the tool available and accessible; fixes to the results produced by the tool, new features and methodological changes are not covered.</li>
        </ul>

        <p>
          More significant changes require a new version, and the support period is renewed from the publication of the paper associated with it. A new major version must not be created during the full support period of the previous one, and a new publication must be justified by new features or substantial changes to the tool, never by a data update alone.
        </p>

        <p><strong>License.</strong> Except where expressly stated otherwise, software produced by the LBS is released as open source under the <a href="https://opensource.org/license/mit" target="_blank">MIT license</a>, and documentation and supplementary materials under the <a href="https://creativecommons.org/licenses/by/4.0" target="_blank">Creative Commons Attribution 4.0 International (CC BY 4.0)</a> license. The Propedia data follow the license described in section 1.3.1.</p>

        <p><strong>Versioning.</strong> Version numbers follow the pattern <code>X.YY.MMDD</code>, where <code>X</code> is the major version associated with the published paper, <code>YY</code> is the last two digits of the year, <code>MM</code> the month without a leading zero and <code>DD</code> the day with two digits. Versions <code>0.YY.MMDD</code> are development versions (alpha and beta); after the publication of the paper the major version becomes 1, and it is only incremented when a new paper directly related to the tool is published. When an update changes only the data, <code>X</code> stays the same and just the <code>YY.MMDD</code> part is updated.</p>

        <p><strong>Authorship and ownership.</strong> The software trademark is attributed to the LBS, UFMG, Brazil. Ownership of each published version belongs, in order, to the first author of that version (or equally to the group of authors credited with the same level of contribution), to the project supervisor identified as the last author, and to the remaining collaborating authors — so different versions may have different ownership. Each version must carry the LBS-SRC license and the corresponding copyright notices, preserving the year of creation, the name of the software and the laboratory, followed by the notice of the current version:</p>

        <code class="text-dark">
          &copy; 2020 PROPEDIA | LBS, UFMG (Brazil)<br>
          &copy; 2026 PROPEDIA v26 | Diego Mariano et al.
        </code>

        <p><br>New versions may be developed by other research groups, provided they are expressly authorised by the last author (project supervisor).</p>


      </section>

      <section id="using-platform" class="docs-card">
        <h1>2. How to use the platform</h1>
        <div style="text-align: center; margin-bottom: 20px;">
          <p><strong>Propedia v26 can be accessed directly through the official website at:</strong></p>
          <p>
            <a href="https://bioinfo.dcc.ufmg.br/propedia26" target="_blank">
              https://bioinfo.dcc.ufmg.br/propedia26
            </a>
          </p>
        </div>

        <p>
          Upon accessing the home page, users will find an intuitive navigation panel that allows them to quickly explore the database's main features, including complex search, structural visualization, interaction analysis, and download tools.
        </p>

        <p>
          The initial interface features a top navigation bar that directs users to the Home, About, Browse, Clusters, Downloads, and Help pages. In addition, there is a quick search field that allows users to search for PDB IDs, peptides, or proteins directly.
        </p>

        <p>
          The page also includes a highlights panel with information on new features and updates in version 26. These details are shown in the Figure below.
        </p>

        <figure>
          <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/fig5prop.svg') ?>" alt="Interface">
          <figcaption>
            <b>Figure 6.</b> Propedia home page.
          </figcaption>
        </figure>

        <p>
          In addition, the home page features a highlights/statistics panel that displays, in a visual and objective manner, the main figures from the database, such as the number of complexes available, the number of clusters, and the total size of the database. This section gives users an immediate sense of the scale and information value of Propedia, enabling them to understand the repository's magnitude on their first visit. The page features a section dedicated to the credibility and authorship of the project, which identifies the developers responsible for Propedia. In a further step, the page includes an area dedicated to use cases and practical examples, illustrating how the user can search using an input code. Users can enter the code for a protein-peptide complex, also known as a “Propedia code” (e.g., 1WRZ-B-A, where the first four characters correspond to the PDB code, the fifth character corresponds to the peptide chain, and the sixth character corresponds to the protein chain) or a multipro (e.g., 1MT1-A), which does not specify the protein chain.
        </p>
        <p>
          At the bottom of the page, institutional support and funding sources linked to the development of Propedia are also indicated, such as the Bioinformatics and Systems Laboratory (LBS), the Department of Computer Science (DCC), and the Federal University of Minas Gerais (UFMG), reinforcing the transparency and academic origin of the platform.
        </p>


      </section>

      <section id="entry" class="docs-card">
        <h2>2.1 Entry page</h2>

        <p>
          In Propedia 26, each complex formed by the protein-peptide pair has an entry page.
          The entry page interface is divided into five parts:
        </p>

        <ul>
          <li><strong>Entry description:</strong> Contains information extracted from the PDB.</li>
          <li><strong>Physicochemical parameters:</strong> Contains predicted information using ProtParam.</li>
          <li><strong>Interactive 3D structure visualization panel:</strong> Enables analysis of the complex's 3D structure.</li>
          <li><strong>Clustering information:</strong> Contains similar structures based on various methods, such as sequence identity, structural alignment, prediction using machine learning models, and classes extracted from Propedia v1.</li>
          <li><strong>Protein-peptide interaction information:</strong> Contains predicted information of the complex, such as interaction surface (predicted with NACCESS), binding energy (predicted with Prodigy), and interface residues and contacts (predicted with COCaDA).</li>
        </ul>
      </section>

      <section id="edescription" class="docs-card">
        <h3><em>2.1.1 Entry description</em></h3>

        <p>
          Contains information extracted from the PDB file, including PDB ID, structure method, resolution, complex, peptide chain, peptide length, protein chain, protein length, and PDB title (description).
        </p>

        <figure>
          <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/figaprop.png') ?>" alt="Interface">
          <figcaption>
            <b>Figure 7.</b> Example of an entry page.
          </figcaption>
        </figure>

        <p>
          The "complex" field contains a link to the multipro page. Peptides that interact with more than one protein chain have an entry in Propedia multipro. A Propedia multipro entry has a 6-character ID: the PDB ID followed by "-" and the peptide chain ID (e.g., 1A1R-C). Information on protein chains complexed to this peptide can be found in the main table on each Propedia multipro entry page.
        </p>

        <figure>
          <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/figbprop.png') ?>" alt="Interface">
          <figcaption>
            <b>Figure 8.</b> Example of an entry page. Physical/chemical parameters are shown below the description section.
          </figcaption>
        </figure>

        <p>
          The contact map button displays a contact map for each pair of chains in the complex. It is shown on both the individual page for each entry and the multipro page. The charts are generated using the chart.js library, and the contacts are calculated using the COCaDA-CLI tool.
        </p>

        <figure>
          <img class="shadow bordered w-100 p-2 m-2" src="<?= base_url('/img/docs/doc-mapa-contatos.png') ?>" alt="Contact map of entry 1WRZ-B-A beside the 3D viewer showing the selected contact">
          <figcaption>
            <b>Figure 9.</b> Contact map of entry 1WRZ-B-A and the 3D viewer displayed beside it. Each point of the map is an atomic contact between a residue of the peptide (x axis) and a residue of the protein (y axis), coloured by contact type; the chains shown on each axis are chosen in the selectors above the chart, and the legend allows each contact type to be shown or hidden. Clicking a point highlights the corresponding pair in the viewer on the right, which draws a dashed line between the two atoms and labels them with the residue, the atom and the distance &mdash; here the hydrogen bond between H317 (NE2) of the peptide and T79 (O) of the protein, 3.56 &Aring; apart.
          </figcaption>
        </figure>

        <figure>
          <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/figcprop.png') ?>" alt="Interface">
          <figcaption>
            <b>Figure 10.</b> Contact map.
          </figcaption>
        </figure>

        <p>
          The download button allows you to download the input data, as well as the predicted contacts and structures. To obtain structural signatures, calculated using aCSM, and sequence signatures, calculated using iFeature, go to the "Download" page.
        </p>
      </section>

      <section id="ephysical" class="docs-card">
        <h3><em>2.1.2 Physicochemical parameters</em></h3>

        <figure>
          <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/figdprop.png') ?>" alt="Interface">
          <figcaption>
            <b>Figure 11.</b> Physical-chemical parameters calculated using ProtParam.
          </figcaption>
        </figure>

        <ul>
          <li><strong>Chain:</strong> Unique identifier assigned to each molecular chain within the same crystallographic structure or PDB entry.</li>

          <li><strong>Description:</strong> Annotated name or description of the polymer chain, as defined in the PDB file (e.g., “Chain A - β-glucosidase”).</li>

          <li><strong>Length (residues):</strong> Total number of amino acid residues observed in the polymer chain.</li>

          <li><strong>Molecular Weight (Da):</strong> Total molecular mass of the chain, expressed in Daltons (Da), calculated as the sum of the atomic masses of all atoms in the protein.</li>

          <li><strong>Isoelectric Point (pI):</strong> The pH value at which the protein carries no net electrical charge, resulting in minimal electrophoretic mobility.</li>

          <li><strong>Instability Index:</strong> A computed value that estimates the <i>in vitro</i> stability of a protein. Proteins with an instability index greater than 40 are predicted to be unstable, while lower values indicate greater stability.</li>

          <li><strong>Aliphatic Index:</strong> A measure of the relative volume occupied by aliphatic side chains (Ala, Val, Ile, and Leu). It is often correlated with the thermostability of the protein.</li>

          <li><strong>GRAVY (Grand Average of Hydropathy):</strong> The average hydropathy score of all amino acids in the sequence, based on the Kyte-Doolittle scale. Positive values indicate a more hydrophobic protein, while negative values suggest a more hydrophilic character.</li>

          <li><strong>Hydrophobic (%):</strong> The proportion of residues in the sequence that are classified as hydrophobic (e.g., Ala, Val, Leu, Ile, Phe, Trp, Met), expressed as a percentage of the total number of residues.</li>

          <li><strong>Positive Residues:</strong> Total number of positively charged amino acids in the sequence (Lys, Arg, and His).</li>

          <li><strong>Negative Residues:</strong> Total number of negatively charged amino acids in the sequence (Asp and Glu).</li>

          <li><strong>Atomic Formula:</strong> The complete elemental formula representing the protein’s overall atomic composition (e.g., C₂₆₄₄H₄₂₀₅N₇₅₇O₈₁₆S₁₂).</li>

          <li><strong>Total Atoms:</strong> The total number of atoms constituting the polypeptide chain.</li>

          <li><strong>Extinction Coefficient (with disulfide):</strong> Molar extinction coefficient (in M⁻¹ cm⁻¹) calculated assuming all cysteine residues form disulfide bonds (Cys–Cys). This value indicates the protein’s absorbance at 280 nm under these conditions.</li>

          <li><strong>Extinction Coefficient (no disulfide):</strong> Molar extinction coefficient (in M⁻¹ cm⁻¹) calculated assuming no disulfide bond formation, i.e., all cysteine residues remain in the reduced form.</li>

          <li><strong>Sequence:</strong> The primary amino acid structure of the protein or peptide, defining its linear arrangement of residues.</li>
        </ul>
      </section>

      <section id="einteractive" class="docs-card">

        <h2><em>2.1.3 Interactive 3D structure visualization panel</em></h2>
        <p>
          Allows you to interact with the 3D structure of the protein-peptide complex. You can click on the atoms to display their labels. Left-click and drag to move the protein. Use the mouse scroll wheel to zoom.
        </p>

        <p>The bar above the structure holds the viewer controls:</p>

        <ul>
          <li><strong>Lines:</strong> shows or hides the bonds of the whole structure, drawn as thin lines over the cartoon.</li>

          <li><strong>Interface:</strong> highlights the protein-peptide interface. The interface residues of both chains are drawn as sticks and spheres and labelled with the one-letter code and the residue number, the interface residues of the protein receive a denser surface, and the atom-atom contacts of the contact table are drawn as thick dashed lines coloured by contact type (green for hydrogen bonds, blue for salt bridges, cyan for attractive, red for repulsive, black for disulfide bonds and grey for aromatic contacts). Hydrophobic contacts are left out of the drawing, since they are numerous and would hide the rest of the interface; they remain in the contact table and in the contact map.</li>

          <li><strong>Surface:</strong> slider that sets the opacity of the surface of each chain, with the current value shown next to it.</li>

          <li><strong>Clear:</strong> returns the viewer to its initial state, removing the labels and any residue or contact that was selected.</li>

          <li><strong>Full screen:</strong> opens the structure in a full-screen viewer with further options — representation, colour scheme, residue selection, surfaces, labels and contact cutoff. Residue labels are displayed by default there.</li>
        </ul>

        <p>
          Further down the page, each button of the <em>Interface residues</em> list highlights a single residue in this viewer. Clicking one of them switches <strong>Interface</strong> off, so that the highlight of the whole interface does not compete with the residue being inspected; clicking a row of the contact table highlights the corresponding pair of residues in the same way.
        </p>

        <figure>
          <img class="shadow bordered w-50 p-2 m-2" src="<?= base_url('/img/docs/figeprop.png') ?>" alt="Interface">
          <figcaption>
            <b>Figure 12.</b> Complex 3D view.
          </figcaption>
        </figure>

        <figure>
          <img class="shadow bordered w-50 p-2 m-2" src="<?= base_url('/img/docs/doc-interface-3d.png') ?>" alt="The Interface switch applied to entry 4BQ7-C-D">
          <figcaption>
            <b>Figure 13.</b> The Interface switch applied to entry 4BQ7-C-D. The interface residues of both chains are shown as sticks and spheres with their labels, the interface residues of the protein are covered by a denser surface, and the atom-atom contacts of the contact table are drawn as dashed lines coloured by contact type (in green, the hydrogen bonds).
          </figcaption>
        </figure>

      </section>

      <section id="ecluster" class="docs-card">

        <h2><em>2.1.4 Clustering information</em></h2>

        <figure>
          <img class="shadow bordered w-50 p-2 m-2" src="<?= base_url('/img/docs/figfprop.png') ?>" alt="Interface">
          <figcaption>
            <b>Figure 14.</b> Clustering box.
          </figcaption>
        </figure>

        <ul>
          <li><strong>Unique complex:</strong> Indicates whether a protein-peptide pair exists with both sequences identical.</li>

          <li><strong>Similar complex:</strong> If there is an identical sequence, it indicates which is the main entry with an exact sequence (if the sequence is unique, the entry itself will be considered the leader).</li>

          <li><strong>Similar peptide:</strong> Indicates a complex that has a peptide with the exact same sequence.</li>

          <li><strong>PDB classification:</strong> Molecular classification according to PDB.</li>

          <li><strong>CSM-peptides classes:</strong> CSM-peptides (<a href="https://biosig.lab.uq.edu.au/csm_peptides">link</a>) is a web tool and machine learning model that predicts peptide classes based on their sequence. Using a machine learning model inspired by CSM-peptides, Propedia built six models to predict the function of therapeutic peptides. Here, we present the probability that the current peptide belongs to each class. Values range from 0 to 1 (0 = low likelihood, 1 = high likelihood). For more details, see <a href="http://doi.org/10.1002/pro.4442">http://doi.org/10.1002/pro.4442</a>.</li>

          <li><strong>Anti-Angiogenic (AAP):</strong> Probability that the peptide belongs to the Anti-Angiogenic class (cutoff ≥ 0.9).
            <br><strong>Function:</strong> Inhibit angiogenesis (formation of new blood vessels).
            <br><strong>Importance:</strong> Prevent tumor growth by limiting nutrient supply.
            <br><strong>Applications:</strong> Antitumor and antiviral therapies.
          </li>

          <li><strong>Anti-Bacterial (ABP):</strong> Probability that the peptide belongs to the Anti-Bacterial class (cutoff ≥ 0.9).
            <br><strong>Function:</strong> Destroy or inhibit bacterial growth.
            <br><strong>Mechanism:</strong> Interact with bacterial membranes, causing lysis.
            <br><strong>Importance:</strong> Potential alternative to antibiotics in the context of resistance.
          </li>

          <li><strong>Anti-Cancer (ACP):</strong> Probability that the peptide belongs to the Anti-Cancer class (cutoff ≥ 0.9).
            <br><strong>Function:</strong> Selectively kill tumor cells.
            <br><strong>Mechanisms:</strong> Alter membrane permeability, trigger apoptosis, modulate signaling pathways.
            <br><strong>Applications:</strong> Next-generation antineoplastic therapies.
          </li>

          <li><strong>Anti-Inflammatory (AIP):</strong> Probability that the peptide belongs to the Anti-Inflammatory class (cutoff ≥ 0.9).
            <br><strong>Function:</strong> Reduce or regulate inflammatory responses.
            <br><strong>Mechanism:</strong> Inhibit pro-inflammatory cytokines or modulate macrophages.
            <br><strong>Applications:</strong> Treatment of chronic inflammatory and autoimmune diseases.
          </li>

          <li><strong>Quorum Sensing (QSP):</strong> Probability that the peptide belongs to the Quorum Sensing class (cutoff ≥ 0.9).
            <br><strong>Function:</strong> Participate in bacterial communication (biofilm formation, virulence).
            <br><strong>Importance:</strong> Target for non-bactericidal infection control strategies.
          </li>

          <li><strong>Surface Binding (SBP):</strong> Probability that the peptide belongs to the Surface Binding class (cutoff ≥ 0.9).
            <br><strong>Function:</strong> Bind to biological or material surfaces (e.g., metals, polymers, minerals).
            <br><strong>Biotechnological Uses:</strong> Immobilization of enzymes, biomaterials, biosensors, nanodevices.
            <br><strong>Examples:</strong> Peptides that bind to gold, silica, metal oxides for nanotechnology.
          </li>
        </ul>
      </section>

      <section id="eprotein" class="docs-card">

        <h2><em>2.1.5 Protein-peptide interaction information</em></h2>

        <figure>
          <img class="shadow bordered w-50 p-2 m-2" src="<?= base_url('/img/docs/figgprop.png') ?>" alt="Interface">
          <figcaption>
            <b>Figure 15.</b> Protein-petide interaction.
          </figcaption>
        </figure>

        <ul>
          <li><strong>Surface (calculated using Naccess):</strong> Accessible surface analyses were performed using the NACCESS program, which implements the classic Lee & Richards algorithm (see <a href="https://doi.org/10.1016/0022-2836(71)90324-X">reference</a>) to calculate the Accessible Surface Area (ASA). This method simulates the path of a 1.4 Å radius spherical probe — equivalent to the approximate size of a water molecule — over the structure's van der Waals surface, estimating the total area exposed to the solvent.</li>

          <li><strong>ASA:</strong> Accessible Surface Area (ASA) is the measure of the entire surface area of the molecule that is exposed and can come into contact with the solvent (usually water).</li>

          <li><strong>ΔASA (protein):</strong> ΔASA<sub>protein</sub> represents the surface area that is no longer exposed to the solvent upon complex formation and is calculated by the equation:
            ΔASA = ASA<sub>unbound</sub> − ASA<sub>bound</sub>.
            (Value given in Å²)</li>

          <li><strong>ΔASA (peptide):</strong> ΔASA<sub>peptide</sub> represents the surface area that is no longer exposed to the solvent upon complex formation and is calculated by the equation:
            ΔASA = ASA<sub>unbound</sub> − ASA<sub>bound</sub>.
            (Value given in Å²)</li>

          <li><strong>BProA:</strong> Buried protein area (value given in Å²).</li>

          <li><strong>BPepA:</strong> Buried peptide area (value given in Å²).</li>

          <li><strong>BPP%:</strong> Buried Peptide Percentage (%), obtained by the expression:
            100 × BPepA / ΔASA<sub>peptide</sub>.</li>

          <li><strong>BSA:</strong> Buried Surface Area represents the area effectively shared at the binding interface and can be calculated using the formula:
            BSA = (ASA<sub>protein</sub> + ASA<sub>peptide</sub> − ASA<sub>complex</sub>) / 2.</li>
        </ul>

        <figure>
          <img class="shadow bordered w-50 p-2 m-2" src="<?= base_url('/img/docs/fighprop.png') ?>" alt="Interface">
          <figcaption>
            <b>Figure 16.</b> Interaction energy.
          </figcaption>
        </figure>


        <ul>
          <li><strong>Interaction Energy (calculated using PRODIGY):</strong> Estimated binding free energy (ΔG) of the protein–peptide complex, predicted by the PRODIGY command-line tool. See the documentation for details. More information about the methodology can be found at the <a href="https://rascar.science.uu.nl/prodigy">Prodigy website</a>.</li>

          <li><strong>Number of Intermolecular Contacts:</strong> Total number of atomic contacts between the protein and peptide within a specified cutoff distance (typically ≤ 5.5 Å). A higher number of contacts generally indicates a more extensive interaction interface.</li>

          <li><strong>Number of Charged–Charged Contacts:</strong> Number of interactions between oppositely charged residues (e.g., Lys–Asp, Arg–Glu) across the interface, contributing significantly to electrostatic stabilization.</li>

          <li><strong>Number of Charged–Polar Contacts:</strong> Count of contacts between charged residues and polar uncharged residues (e.g., Lys–Ser, Asp–Thr), which often form hydrogen bonds or dipole interactions.</li>

          <li><strong>Number of Charged–Apolar Contacts:</strong> Number of contacts between charged residues and hydrophobic residues (e.g., Arg–Leu, Lys–Val). These interactions contribute less to stability but may influence interface geometry.</li>

          <li><strong>Number of Polar–Polar Contacts:</strong> Number of interactions between polar uncharged residues (e.g., Ser–Thr, Asn–Gln), frequently involving hydrogen bonding or dipole alignment across the interface.</li>

          <li><strong>Number of Apolar–Polar Contacts:</strong> Count of interactions between hydrophobic and polar residues, contributing to partial desolvation and interface packing.</li>

          <li><strong>Number of Apolar–Apolar Contacts:</strong> Number of hydrophobic–hydrophobic interactions (e.g., Leu–Val, Phe–Ile) that stabilize the interface through exclusion of water molecules (hydrophobic effect).</li>

          <li><strong>Percentage of Apolar NIS Residues (%):</strong> Proportion of residues in the Non-Interacting Surface (NIS) that are apolar, expressed as a percentage. Indicates the hydrophobic character of the exposed surface outside the binding interface.</li>

          <li><strong>Percentage of Charged NIS Residues (%):</strong> Proportion of residues in the NIS that are charged (positive or negative), indicating the electrostatic character of the surface not involved in binding.</li>

          <li><strong>Predicted Binding Affinity (kcal·mol⁻¹):</strong> Estimated Gibbs free energy of binding (ΔG), in kilocalories per mole. More negative values correspond to stronger binding.</li>

          <li><strong>Predicted Dissociation Constant (M) at 25.0 °C:</strong> Predicted dissociation constant (K<sub>d</sub>), in molar units (M), at 25 °C. Represents the expected concentration at which half of the binding sites are occupied. Lower values indicate stronger affinity.</li>
        </ul>

        <p><strong>Interface properties (calculated using PISA)</strong></p>

        <p>
          The interface is also evaluated with PISA (Protein Interfaces, Surfaces and Assemblies, see <a href="https://www.ebi.ac.uk/pdbe/pisa">PDBePISA</a> and Krissinel &amp; Henrick, 2007), which describes the chemical and energetic properties of the association and estimates how much the interface contributes to the assembly. The entry page presents these values in four groups. When PISA could not process the structure, the page shows a message in place of the table; individual fields that PISA did not compute are shown as “-”.
        </p>

        <p><em>Interface significance</em></p>
        <ul>
          <li><strong>Interface evidence:</strong> reading of the Complexation Significance Score adopted by Propedia. <em>Strong</em> means the interface sustains the assembly (CSS of 0.5 or above), <em>moderate</em> means it contributes to it (CSS between 0 and 0.5) and <em>weak</em> means it plays no role in the assembly (CSS = 0). <em>Not assessed</em> means PISA could not evaluate the structure.</li>

          <li><strong>Complexation Significance Score (CSS):</strong> how much this interface contributes to the formation of the assembly, from 0 to 1. PISA computes it only for structures solved by diffraction, so it is empty for entries solved by electron microscopy, NMR and other methods.</li>
        </ul>

        <p><em>Surface area</em></p>
        <ul>
          <li><strong>Interface area (Å²):</strong> area of one face of the protein-peptide interface. It corresponds to the BSA calculated with NACCESS, reported above.</li>

          <li><strong>Buried area (peptide, Å²) and Buried area (protein, Å²):</strong> surface area of each chain that becomes buried upon formation of the interface.</li>

          <li><strong>Total buried area (Å²):</strong> total surface area buried by the association, counting both faces of the interface. It is therefore about twice the BSA reported by NACCESS, which counts a single face.</li>

          <li><strong>Complex ASA (Å²):</strong> accessible surface area of the complex, the PISA counterpart of the ASA (complex) calculated with NACCESS.</li>

          <li><strong>Dissociation area (Å²):</strong> interface area that is broken when the complex dissociates. It usually coincides with the interface area.</li>
        </ul>

        <p><em>Energy (predicted)</em></p>
        <ul>
          <li><strong>Dissociation free energy ΔG<sub>diss</sub> (kcal/mol):</strong> free energy required to dissociate the complex. Positive values indicate a thermodynamically stable complex. It is the PISA counterpart of the binding affinity predicted by PRODIGY, with the opposite sign.</li>

          <li><strong>Solvation energy gain ΔiG (kcal/mol):</strong> free energy gain obtained on formation of the interface. Negative values indicate a hydrophobic interface, which favours the association. It does not include the contribution of hydrogen bonds and salt bridges across the interface.</li>

          <li><strong>ΔiG P-value:</strong> statistical significance of the solvation energy gain. Values below 0.5 indicate an interface more hydrophobic than would be expected by chance, that is, an interface likely to be interaction-specific rather than a crystal-packing artefact.</li>

          <li><strong>Solvation energy (peptide, kcal/mol) and Solvation energy (protein, kcal/mol):</strong> contribution of each chain to the solvation free energy gain of the interface.</li>

          <li><strong>Total interaction energy ΔiG (kcal/mol):</strong> solvation energy gain summed over all the interfaces of the structure. It is equal to the interface ΔiG when the structure has a single interface.</li>

          <li><strong>Dissociation entropy TΔS (kcal/mol):</strong> entropic cost of the association. It always opposes the formation of the complex and is taken into account in the calculation of ΔG<sub>diss</sub>.</li>
        </ul>

        <p>
          The energies reported by PISA are estimates from an empirical model, not experimental measurements, and are marked as predicted values on the entry page. Use them as an indication and confirm them before drawing conclusions.
        </p>

        <p><em>Contacts</em></p>
        <ul>
          <li><strong>Hydrogen bonds and Salt bridges:</strong> number of hydrogen bonds and of interactions between oppositely charged groups identified by PISA across the interface. They are computed independently of the COCaDA contacts listed below, so the counts may differ.</li>

          <li><strong>Interface residues (peptide) and Interface residues (protein):</strong> number of residues of each chain that take part in the interface, that is, residues that lose accessible surface area upon complex formation.</li>

          <li><strong>Interface atoms (peptide) and Interface atoms (protein):</strong> number of atoms of each chain that take part in the interface.</li>
        </ul>

        <figure>
          <img class="shadow bordered w-50 p-2 m-2" src="<?= base_url('/img/docs/doc-pisa-tabela.png') ?>" alt="Interface properties calculated with PISA for entry 4BQ7-C-D, an interface read as strong (CSS = 1">
          <figcaption>
            <b>Figure 17.</b> Interface properties calculated with PISA for entry 4BQ7-C-D, an interface read as strong (CSS = 1.000). The warning sign marks the predicted energy values.
          </figcaption>
        </figure>

        <figure>
          <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/figiprop.png') ?>" alt="Interface">
          <figcaption>
            <b>Figure 18.</b> Interface residue.
          </figcaption>
        </figure>

        <ul>
          <li><strong>Interface Residues (distmax ≤ 6 Å):</strong> List of residues located within 6 Å of the interacting partner, defining the binding interface between the protein and peptide.</li>
          <li><strong>Contacts (calculated using COCaDA):</strong> Number and type of interatomic contacts calculated by the COCaDA tool (https://bioinfo.dcc.ufmg.br/cocada-web), used to characterize specific atom–atom interactions across the interface.</li>
        </ul>

        <figure>
          <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/figjprop.png') ?>" alt="Interface">
          <figcaption>
            <b>Figure 19.</b> Contacts (calculated using COCaDA).
          </figcaption>
        </figure>

        <p><strong>Contact map captions:</strong></p>
        <ul>
          <li><strong>HB:</strong> Hydrogen bond</li>
          <li><strong>HY:</strong> Hydrophobic</li>
          <li><strong>AT:</strong> Attractive</li>
          <li><strong>RE:</strong> Repulsive</li>
          <li><strong>AR:</strong> Aromatic</li>
          <li><strong>SB:</strong> Salt Bridge</li>
          <li><strong>DS:</strong> Disulfide bonds</li>
          <li><strong>UN:</strong> Unknown</li>
        </ul>

        <p><strong>Criteria for defining contacts:</strong></p>

        <table class="table table-hover table-condensed table-striped">
          <thead>
            <tr>
              <th>Contact Type</th>
              <th>Distance range (Å)</th>
              <th>Description</th>
              <th>Acronym</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Hydrogen Bond</td>
              <td>0 ≤ dist ≤ 3.9</td>
              <td>Acceptor and Donor atom pair</td>
              <td>HB</td>
            </tr>
            <tr>
              <td>Disulfide Bond</td>
              <td>0 ≤ dist ≤ 2.8</td>
              <td>Cys:SG atom pair</td>
              <td>DS</td>
            </tr>
            <tr>
              <td>Hydrophobic</td>
              <td>2.0 ≤ dist ≤ 4.5</td>
              <td>Hydrophobic atom pair</td>
              <td>HY</td>
            </tr>
            <tr>
              <td>Repulsive</td>
              <td>2.0 ≤ dist ≤ 6.0</td>
              <td>Equally charged atoms</td>
              <td>RE</td>
            </tr>
            <tr>
              <td>Attractive</td>
              <td>3.9 ≤ dist ≤ 6.0</td>
              <td>Differently charged atoms</td>
              <td>AT</td>
            </tr>
            <tr>
              <td>Sulft Bridge</td>
              <td>0 ≤ dist ≤ 3.9</td>
              <td>Equally charged atoms AND hydrogen bonding</td>
              <td>SB</td>
            </tr>
            <tr>
              <td>Aromatic Stacking</td>
              <td>2.0 ≤ dist ≤ 5.0</td>
              <td>Centroids of two aromatic rings in parallel or perpendicular orientation</td>
              <td>AS</td>
            </tr>
          </tbody>
        </table>

        <p><em>Source: https://bioinfo.dcc.ufmg.br/cocada-web/public/documentation</em></p>
      </section>


      <section id="blast-tool" class="docs-card">
        <h2>2.2 BLAST tool</h2>
        <p>
          The BLAST (Basic Local Alignment Search Tool) identifies local similarities between protein sequences. It compares a query sequence with sequences stored in a database, evaluating the statistical relevance of the matches found (Mariano et al., 2015; Wheeler; Bhagwat, 2016). The BLAST tool available in PROPEDIA allows users to search for peptides or proteins similar to those present in the database, using local alignment based on sequence similarity. This functionality is essential for identifying structurally or functionally related complexes, locating similar peptides already described in the database, and facilitating comparative studies, evolutionary analyses, and functional inference.
        </p>

        <p>
          The Propedia sequence search system is implemented using the BLAST+ package, as described in Altschul et al. (1990) and Camacho et al. (2009). The tool compares the sequence provided by the user with all sequences deposited in PROPEDIA 26, returning the best local alignments, along with identifiers of the associated complexes, similarity metrics, and coverage and identity information.
        </p>

        <p>
          The search can be performed for both peptides and proteins, and each type of query uses different parameters, adjusted for greater sensitivity according to the size of the sequence analyzed.
        </p>

      </section>

      <section id="parameters-config" class="docs-card">
        <h3><em>2.2.1 Parameters and Configuration</em></h3>

        <p>
          Peptides have short sequences and require specialized parameters to ensure good sensitivity. For this reason, Propedia uses:
        </p>

        <ul>
          <li><strong>word_size 2</strong></li>
        </ul>

        <p>
          The word-size is a NCBI parameter which determines the minimum size of the fragment (“word”) that must match between the query sequence and the database sequences for the algorithm to initiate an alignment extension. A word is the smallest sequence block that BLAST uses to identify possible regions of similarity between the query sequence and the database. The sequence is fragmented into all possible word sizes. For example, if word-size = 3, the protein ACDEFG becomes: ACD, CDE, DEF, EFG. BLAST searches the database for identical or similar occurrences of these words.
        </p>

        <p>
          As described in the NCBI documentation (“BLAST Search Parameters - BlastTopics 0.1.1 documentation”, [s.d.]), BLAST operates heuristically, first identifying “hot spots,” i.e., short local matches, which can then expand into more complete alignments. In protein searches, these matches do not need to be identical and may involve similarity based on the substitution matrix. According to BLAST logic, reducing the word size increases sensitivity, as it allows relevant matches to be detected even when the comparison space is limited. Thus, using word size = 2 favors the detection of small hot spots capable of initiating extensions in peptide queries.
        </p>

        <ul>
          <li><strong>task blastp-short</strong></li>
        </ul>

        <p>
          The task blastp-short parameter activates an optimized version of BLASTP specifically configured to handle short protein sequences, typically with fewer than 30 amino acids (Table C3: [blastp application options. The blastp...].”, 2021). This mode automatically adjusts various internal aspects of the algorithm to maximize sensitivity and detection of real similarity, even when the amount of information (sequence length) is very low.
        </p>

        <p>
          In implementing the sequence search system in Propedia, -word_size 2 was used in conjunction with -task blastp-short. This choice is directly aligned with the expected behavior for searches involving short peptides, whose sequences have few positions for forming larger “words.”
        </p>

        <ul>
          <li><strong>seg no</strong></li>
        </ul>

        <p>
          A tool designed to filter low-complexity segments in amino acid sequences. In alignments, residues that have been masked are displayed as “X.” SEG filtering is no longer the default option in the NCBI blastp service due to the adoption of compositional adjustments for estimating BLAST statistics (Fassler; Cooper, 2011). The -seg no parameter disables complexity masking, which would be undesirable in such short sequences.
        </p>

        <ul>
          <li><strong>evalue 100000</strong></li>
        </ul>

        <p>
          The E-value represents the probability that an observed alignment arose by chance. Under normal conditions, values close to zero indicate highly significant alignments, while high values tend to be disdocs-carded because they represent statistical noise. However, the behavior of the E-value changes dramatically for short sequences, such as peptides, which is exactly the case with Propedia. These settings allow minimal peptides, including fragments with only 5-10 amino acids, to find significant matches in the database.
        </p>

        <p>
          For complete proteins, Propedia uses a more conservative set of parameters that are better suited for long sequences:
        </p>

        <ul>
          <li><strong>word_size 3</strong></li>
        </ul>

        <p>
          When dealing with full-length protein sequences, the search behavior differs substantially from searches involving short peptides. Longer sequences contain a much larger amount of information, allowing BLAST to reliably detect similarity using more stringent initial seeds. In this context, the parameter word_size 3 is more appropriate because it requires longer contiguous matches (3 amino acids) before extending an alignment. This choice reduces noise, improves specificity, and accelerates the search, as larger words decrease the number of initial “hotspots” generated during the seeding phase. Since full proteins typically range from hundreds to thousands of residues, a word-size of 3 does not compromise sensitivity: even distantly related proteins usually share enough local similarity to satisfy this requirement.
        </p>

        <p>
          Therefore, for protein-versus-protein searches, PROPEDIA adopts a more conservative configuration to balance sensitivity and performance. This contrasts with peptide searches, where shorter sequences require extremely permissive parameters. The distinction ensures that each type of query, short peptides versus complete proteins, is processed using criteria tailored to its biological characteristics and statistical behavior under the BLAST algorithm.
        </p>

        <p>
          A summary of all parameters is illustrated in Figure 20. It is important to note that BLAST alignment will always search for peptides if the input is a peptide sequence, or proteins if the input is a protein sequence.
        </p>

        <figure>
          <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/fig6prop.svg') ?>" alt="Interface">
          <figcaption>
            <b>Figure 20.</b> Parameters used for the development of the BLAST tool. On the left are examples of peptide sequence algorithms. The peptide sequence of 9VEI-F-A (available in the Propedia database) was used as input, and the sequence used as a response is a real example of a BLAST run performed by Propedia. The right side shows an example of the protein sequence algorithm (the total sequence has been omitted for better image visualization). The protein sequence 9VEI-F-A was used as input, and the sequence used as a response is a real example of a BLAST run performed by Propedia.
          </figcaption>
        </figure>

      </section>

      <section id="blast-use" class="docs-card">
        <h3><em>2.2.2 How to use Propedia BLAST?</em></h3>
        <p>
          When you access the Propedia website, the home page displays “BLAST” in the navigation bar (Figure 6, 3). Clicking on it will open a window where you can enter your peptide or protein sequence (Figure 5). Before running BLAST, you must indicate whether your sequence is peptide or protein, because, as seen in section 2.1.1, the parameters for alignment are different for each type of sequence. To start, simply click on the “Run Blast” button and wait a few seconds for the result.
        </p>

      </section>

      <section id="other" class="docs-card">

        <h4><em>2.2.3 Other search tools</em></h4>
        <p>
          Propedia allows users to search in three ways: (1) BLAST; (2) based on link sites (uses ProBis); and (3) traditional search bar (uses regular expressions to find entries based on descriptions). We will discuss this further in the following sections.
        </p>


      </section>

      <section id="clusters" class="docs-card">
        <h2>2.3 Clusters</h2>
        <p>
          The Clusters page of Propedia v26 presents an organized view of clusters obtained from different methods of similarity between proteins, peptides, and interaction interfaces. These clusters are fundamental for exploratory navigation, redundancy identification, structural comparison, and functional inference.
        </p>

        <figure>
          <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/figkprop.png') ?>" alt="Interface">
          <figcaption>
            <b>Figure 21.</b> Propedia's v26 clusters.
          </figcaption>
        </figure>

        <p>
          The different clusters are summarized in the table below.
        </p>

        <style>
          .table-caption-left {
            caption-side: top;
            text-align: left;
            font-weight: bold;
          }

          .table-footer {
            text-align: left;
            font-size: 0.85em;
            margin-top: 4px;
          }
        </style>

        <table class="table table-hover table-condensed table-striped">
          <caption class="table-caption-left">Table 2. Propedia's v26 clusters.</caption>
          <thead>
            <tr>
              <th>Cluster Type</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Seq100</td>
              <td>Peptides exhibiting complete sequence identity (100%) are clustered within this category</td>
            </tr>
            <tr>
              <td>Redundant Sequences</td>
              <td>Complexes built from protein–peptide pairs sharing 100% identical sequences are grouped within this category</td>
            </tr>
            <tr>
              <td>Classifications (PDB)</td>
              <td>Entries in this category are grouped based on the classes defined within their respective PDB files</td>
            </tr>
            <tr>
              <td>Sequence (Propedia v1)</td>
              <td>Inherited from Propedia v1; see the seq100 category for the clustering approach used in Propedia26 for new entries*</td>
            </tr>
            <tr>
              <td>Interface (Propedia v1)</td>
              <td>This category originates from Propedia v1*</td>
            </tr>
            <tr>
              <td>Binding Site (Propedia v1)</td>
              <td>This category originates from Propedia v1*</td>
            </tr>
            <tr>
              <td>CSM-peptides inspired</td>
              <td>CSM-peptides is a sequence-based prediction server employing machine learning to assign functional categories to biologically active peptides. Using approaches adapted from Rodrigues et al. (2022), we developed models to classify Propedia26 peptides into six classes: AAP, ABP, ACP, AIP, QSP, and SBP.</td>
            </tr>
          </tbody>
        </table>

        <div class="table-footer">
          *Check the Propedia v1 documentation for more details.
        </div>
      </section>


      <section id="History" class="docs-card">
        <h3><em>2.3.1 History and evolution of clustering in Propedia</em></h3>
        <p>Early versions of Propedia used three main clustering approaches:</p>

        <ol>
          <li>
            <strong>Sequence-based clusters:</strong> constructed with Hammock v1.2, which identified identical or highly similar peptide sequences. In the initial version, 3,495 unique sequences were detected, grouped into 771 clusters and 1,074 singletons, totaling 1,845 peptide clusters.
          </li>
          <li>
            <strong>Interface-based clusters:</strong> generated using MUSTANG, which performs multiple structural alignments. This method identified 535 clusters and 1,356 singletons, resulting in 1,891 interfaces.
          </li>
          <li>
            <strong>Binding-site-based clusters:</strong> defined by the ProBiS algorithm, which detects local similarities between protein surfaces. A total of 521 clusters and 945 singletons were formed, totaling 1,466 distinct binding sites.
          </li>
        </ol>

        <p>
          These methods allowed the user to identify peptides that could interact with the same site or exhibit similar structural properties. Propedia 2.3 introduced the use of structural signatures to detect similarity patterns. However, this was not used for clustering; it was only used to evaluate previous results.
        </p>

        <section id="Redundancy" class="docs-card">
          <h3><em>2.3.2 Redundancy and cluster formation in version 26</em></h3>
          <p>In version 26 of Propedia, the pipeline has been expanded and modernized. The main steps include:</p>

          <ol>
            <li>
              <strong>Redundancy detection by sequence combination:</strong> proteins and peptides have their sequences concatenated, allowing completely identical complexes to be identified. This resulted in 51,416 unique complexes across the protein-peptide and multipro sets (38,218 of them in the protein-peptide set).
            </li>
            <li>
              <strong>Canonical Non-Redundant (CNR) dataset:</strong> from all peptides containing only canonical amino acids, 11,380 unique peptide sequences were extracted, forming the new set of non-redundant peptides (17,440 unique sequences when peptides with non-canonical residues are also counted).
            </li>
            <li>
              <strong>Recalculation of previous clusters:</strong> all clusters from past versions were redone using Python scripts and modern structural analysis tools.
            </li>
            <li>
              <strong>Automated annotation and classification:</strong> structural and functional parameters were extracted directly from PDB files using the Biopython library (Bio.PDB).
            </li>
          </ol>

          <p>As a result, the clustering process became more robust, scalable, and reproducible.</p>

        </section>


        <section id="Practical-app" class="docs-card">
          <h3><em>2.3.3 Practical applications of clusters</em></h3>
          <p>
            The clusters provided by Propedia v26 are a central tool for exploring, comparing, and selecting protein-peptide complexes. In the Clusters tab, users can browse clusters organized by three complementary criteria: peptide sequence similarity, interface structural similarity, and binding site similarity. For each cluster, the interface displays the group size, its members, and similarity metrics. It is also possible to directly access the page for each complex, where relevant structural, physicochemical, and functional properties are available.
          </p>

          <p>These features not only facilitate exploration of the database, but also support several practical applications:</p>

          <ul>
            <li>
              <strong>Identification of peptides with similar binding patterns:</strong> integrated visualization of interfaces, sites, and alignments allows you to quickly locate peptides that share modes of interaction, helping to identify conserved hotspots and understand the molecular determinants of recognition.
            </li>
            <li>
              <strong>Detection and control of redundancy in experiments and computational analyses:</strong> by displaying the composition of clusters and allowing the selection of centroids, the system helps remove redundant complexes before statistical analyses, machine learning training, or docking benchmarks, reducing biases and increasing data representativeness.
            </li>
            <li>
              <strong>Structural comparisons in evolutionary and functional studies:</strong> Structural and site clusters allow exploration of relationships between complexes that maintain similar binding modes, even when they have low sequence identity.
            </li>
            <li>
              <strong>Selection of candidates for molecular repositioning or rational peptide design:</strong> the combination of sequence, interface, and intra-cluster variability information helps identify peptides with the potential to be reused in new target proteins or as a starting point for rational engineering. Clusters reveal peptides that are structurally compatible or capable of mimicking specific interactions.
            </li>
          </ul>

          <p>By integrating visualization, similarity metrics, and direct access to the structural characteristics of the complexes, the Clusters tab provides a solid foundation for <em>in silico</em> screening, structural biology studies, bioinformatics, and the discovery of new therapeutic molecules. Also, at the bottom of the page, you will find a download button that allows you to download the entire cluster of interest.</p>


        </section>

        <section id="downloads" class="docs-card">
          <h2>2.4 Available downloads</h2>

          <p>The Downloads section provides access to key files and resources derived from the database. The main list (Propedia v26 - New) is illustrated in the Figure below.</p>

          <figure>
            <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/fig7prop.svg') ?>" alt="Interface">
            <figcaption>
              <b>Figure 22.</b> Available downloads of Propedia v26.
            </figcaption>
          </figure>


          <p>In addition to the main section, the page provides legacy versions (Propedia v2.3 and Propedia v1) with historical files (summarized in Figure 23), for example:</p>

          <ul>
            <li><strong>Propedia v2.3:</strong> separate sets of PDBs (peptides, receptors, complexes), signatures, and FASTA files. Useful for reproducibility of previous work.</li>
            <li><strong>Propedia v1:</strong> complete CSV files, PDBs, and SQL dumps from the original database.</li>
          </ul>

        </section>

        <section id="quick" class="docs-card">
          <h2><em>2.4.1 Quick usage recommendations</em></h2>
          <ul>
            <li>For tabular analysis and subset selection: download propedia_26.csv and open with pandas/R.</li>
            <li>For batch structural reprocessing: download propedia_26.zip (or multipro_v6.zip if working with multiprotein inputs).</li>
            <li>For peptide-focused studies (peptide signatures/FASTA/PDB): use peptides_pdb.zip, sequence_signature.zip, and structural_signature.zip.</li>
            <li>For clustering and redundancy analysis: download clusters.zip and, if necessary, legacy files for historical comparison.</li>
          </ul>

          <figure>
            <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/fig8prop.png') ?>" alt="Interface">
            <figcaption>
              <b>Figure 23.</b> Downloads available on Propedia Legacy.
            </figcaption>
          </figure>

          <p>
            Some important considerations include file sizes and the number of entries specified on the Download page, which may be updated as new versions become available. Furthermore, when reusing the data, please respect the licenses and citations indicated in the “How to cite” section 1.3.
          </p>

        </section>

        <section id="explore" class="docs-card">
          <h2>2.5 Explore Page</h2>
          <p>
            The Explore page is the main interface for browsing and filtering Propedia protein-peptide complexes. It brings together interactive filters, options to reduce redundancy, and a table of entries that allows quick inspection and direct download of associated files. A quick tutorial is illustrated in the figure below.
          </p>

          <p>
            The <em>Filter search</em> panel combines selection fields and sliders. Every filter is optional: a field left on <em>All</em>, or a slider left at its neutral end (shown as <em>any</em>), does not restrict the results. The filters currently available are:
          </p>

          <ul>
            <li><strong>Structural and functional description:</strong> PDB classification, Structure method, Canonical amino acids, Therapeutic class and the peptide length range (Min peptide size and Max peptide size).</li>

            <li><strong>Interface and contacts:</strong> Interface evidence (the PISA reading described in section 2.1.5: strong, moderate or weak), Salt bridges, Min hydrogen bonds, Min buried area (Å²), Min buried peptide (%), Min hydrophobic (%) and Min positive residues.</li>

            <li><strong>Quality and energy:</strong> Min resolution (Å), Min bind. free energy (the affinity predicted by PRODIGY) and Min ΔG<sub>diss</sub> (the dissociation free energy estimated by PISA). The last two are predicted values and are marked with a warning sign on the page.</li>

            <li><strong>Remove redundancy:</strong> keeps only the leader of each cluster of complexes with similar sequences (see section 2.3).</li>
          </ul>

          <p>
            Filters are applied together, and take effect when you click <strong>Apply filters</strong>; <strong>Clear</strong> puts every field back to its neutral state. The counter above the panel reports how many complexes match the current selection.
          </p>

          <figure>
            <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/fig9prop.svg') ?>" alt="Interface">
            <figcaption>
              <b>Figure 24.</b> Quick step-by-step guide: how to use the Explore page. When you open the Explore page, you will: (1, Optional) Set the length range in Min peptide size and Max peptide size. (2) Select one or more categories in PDB Classification to filter by function/structure. (3) Check Only canonical amino acids if you want only canonical sequences. (4) Check Remove redundancy to get only non-redundant entries. (5) Click Apply filters. The table will be updated with entries that meet the criteria. For a specific entry, click ID to open the complex details page or use Download to obtain the PDB.
            </figcaption>
          </figure>
        </section>

        <section id="practical-examples" class="docs-card">
          <h3><em>2.5.1 Practical search examples, tips and best practices</em></h3>
          <p>In the table below, we list some examples for you to practice different ways of exploring in Propedia v26.</p>
          <table class="table table-hover table-condensed table-striped">
            <caption style="text-align: left; font-weight: bold;">Table 3. Practical examples to explore in Propedia v26.</caption>
            <thead>
              <tr>
                <th>Objectives</th>
                <th>What to do</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Find short antimicrobial peptides (2-10 aa)</td>
                <td>Set Min = 2, Max = 10; select classifications related to ANTIMICROBIAL or ANTIBIOTIC; apply filters</td>
              </tr>
              <tr>
                <td>Search for peptides that interact with transcription proteins</td>
                <td>Filter by TRANSCRIPTION and then inspect sequences and interfaces on the detail pages</td>
              </tr>
              <tr>
                <td>Extract non-redundant canonical set</td>
                <td>Check Only canonical amino acids + Remove redundancy and export the list (via Individual download or using propedia_26.csv for batch processing)</td>
              </tr>
            </tbody>
          </table>

          <p>
            For large-scale analyses, we recommend downloading propedia_26.csv from the Downloads page and applying filters locally (pandas/R), it is faster and more reproducible. Use the Remove redundancy option before generating statistics to avoid bias from repeated entries. Combine filters (size + classification + canonicity) to reduce results and facilitate manual inspection. If you want to compare similar groups, use the Clusters tab after identifying relevant hits in Explore.
          </p>

        </section>

        <section id="troubleshooting1" class="docs-card">
          <h3><em>2.5.2 Troubleshooting</em></h3>
          <p>
            If no results are displayed after applying filters, check that the size range or combination of classifications is not too restrictive; if necessary, remove some filters and try again. If the list displayed is too long or the page appears slow, consider reducing the filters or using the local CSV file to perform the filtering, especially on slower connections where downloading individual PDB files may take time. If the download does not work, check the Download link corresponding to the selected row and, if the problem persists, use the Downloads section to obtain the files in batches. Finally, discrepancies observed in the “Unique?” field are expected, as this attribute reflects the internal methodology for removing redundancy, based on the concatenation of protein and peptide sequences,whose details and criteria can be found in the Clusters area or in the technical documentation.
          </p>

        </section>

        <section id="id-page" class="docs-card">
          <h3><em>2.5.3 ID page: e.g.: 1A0N-A-B</em></h3>

          <p>The ID page (Figure 25) displays all available data and analyses for a specific protein-peptide complex: metadata (PDB, experimental method, description), sequences, calculated physicochemical properties, cluster classification, surface and energy metrics, atomic contact table, contact map, and 3D viewer. It also provides download links and shortcuts to external resources (RCSB PDB, UniProt, PubMed).</p>

          <p>The header and metadata include the Identifier (ID), for example, 1A0N-A-B, which indicates the PDB code accompanied by the peptide and protein chains, as well as external links that provide direct access to the corresponding entries in RCSB PDB, UniProt, and PubMed. The structural method is also presented, containing the experimental technique used (such as SOLUTION NMR) and, when available, the resolution of the structure, as well as a concise description of the complex, such as in “Calmodulin complexed with a peptide...”. The page shows two columns (Protein/Peptide) with automatically calculated sequences and properties, for example: sequence (complete receptor chain and peptide sequence), length, molecular weight, isoelectric point (pI), instability index, aliphatic index, GRAVY, % Hydrophobicity, Residues + / -, atomic formula, total atoms and extinction coefficient. All of these properties are shown in Figure 25. These values are useful for rapid assessment of physicochemical properties and for filtering in pipelines.</p>

          <figure>
            <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/fig10prop.png') ?>" alt="Interface">
            <figcaption>
              <b>Figure 25.</b> Propedia v26 ID page.
            </figcaption>
          </figure>

          <section id="interpreted" class="docs-card">
            <h3><em>2.5.3.1 How should it be interpreted?</em></h3>
            <p>
              In section 2.1, you saw the description of all items in the column that biochemically characterize the protein-peptide complex. The “Classification and Clusters” section presents information on structural similarities and the classification generated by clustering, indicating whether the complex is considered unique and listing other similar complexes or peptides identified by sequence, interface, or binding site grouping methods. It also includes CSM-peptides classes, which provide predictive scores for different functional categories, such as antibacterial, anticancer, or quorum sensing activities, accompanied by their respective confidence values. In practice, this section can be used to locate related complexes, for example, to identify alternative candidates that share the same binding site.
            </p>

            <p>
              The protein-peptide interaction analysis section presents surface metrics calculated by Naccess, including the solvent-accessible area (ASA) for the complex, the protein, and the peptide, as well as interface-related parameters such as BProA, BPepA, BPP%, and BSA, which describe the contribution of each chain and the buried area in the interaction. For formal details on the formulas Naccess uses to calculate ASA and BSA, we recommend consulting its official documentation. The page also provides energy information generated by Prodigy, displaying the number of intermolecular contacts by type, the predicted affinity in kcal/mol, and the estimated Kd, although some fields may remain empty depending on the structure or availability of calculations. Complementing these analyses, the system lists the interface residues identified by COCaDA and presents a detailed contact table containing atomic or residual pairs, distances in angstroms, interaction type and class, such as hydrogen bonds (HB) or hydrophobic contacts (HY), with the possibility of filtering by backbone, side chain, or interaction category. In practice, it is recommended to observe contacts with a distance of less than 3.5 Å and marked as “HB” to identify potential hydrogen bonds, while “HY” interactions often indicate hydrophobic components relevant to affinity. The contact map should be analyzed in conjunction with the interactive 3D viewer on the page, which allows you to rotate the structure, inspect the interface, highlight residues present in the table, and save images configured from these views. These characteristics are illustrated in the figure below.
            </p>

            <figure>
              <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/fig11prop.svg') ?>" alt="Interface">
              <figcaption>
                <b>Figure 26.</b> Graphical summary of protein-peptide complex interaction analyses.
              </figcaption>
            </figure>

            <p>The Download / PDB file buttons in the header allow you to download the complex PDB (or open the entry in RCSB) and download any associated reports shown on the page.</p>

          </section>

          <section id="Troubleshooting2" class="docs-card">
            <h3><em>2.5.3.2 Troubleshooting</em></h3>
            <p>Some energy fields or contact counts may appear empty. This can occur when the calculation failed or was not applicable to the input (e.g., NMR ensemble without a standard model). Check for the presence of expected atomic coordinates in the PDB.</p>
            <p>Legends/abbreviations in the contact table may vary; if there is no explicit legend, use the website documentation or inspect the names to infer (HB → Hydrogen Bond, HY → Hydrophobic, etc.).</p>

          </section>

          <section id="binding-sites" class="docs-card">
            <h2>2.6 Search for Similar Binding Sites (ProBiS)</h2>
            <p>
              The Search for Similar Binding Sites tool allows you to identify binding sites that are structurally similar to the one you specify. This feature is handy for:
            </p>

            <ul>
              <li>Finding peptides that bind to equivalent regions in different proteins.</li>
              <li>Detecting functional structural conservation even among proteins with low sequence similarity.</li>
              <li>Exploring possible molecular recognition mechanisms in distant families.</li>
            </ul>

            <p>The search is based on the ProBiS (Protein Binding Sites) algorithm, which performs local structural alignment between protein surfaces. Unlike global methods, ProBiS searches for local 3D patterns of physicochemical properties, including geometry, functional groups, curvature, and electrostatic characteristics. A tutorial is shown in Figure 27.</p>


            <figure>
              <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/figmprop.png') ?>" alt="Interface">
              <figcaption>
                <b>Figure 27.</b> Graphical tutorial of Propedia v26 search for similar binding sites.
              </figcaption>
            </figure>

            <h3 id="new-probis"><em>2.6.1 What is new in version 26</em></h3>

            <p>
              In version 26 the search stopped being a form that only accepts typed text. The structure is
              now loaded into the window itself, and everything the search needs &mdash; the chain and the
              residues of the binding site &mdash; can be taken from the structure instead of being written
              by hand.
            </p>

            <ul>
              <li>
                <strong>Reachable from an entry.</strong> The <em>Find a similar binding site</em> button on
                the page of a complex opens the search already filled in with the PDB code, the protein
                chain and the interface residues of that entry, so the site being queried is the one the
                user was looking at.
              </li>
              <li>
                <strong>Your own structure.</strong> Besides a PDB code, which Propedia downloads from the
                RCSB PDB, the user can upload a structure in PDB format (up to 20 MB). The file is used only
                for that search and is not added to the database.
              </li>
              <li>
                <strong>Asynchronous loading and list of chains.</strong> The structure is fetched in the
                background, without blocking the form. As soon as it is parsed, the <em>Chain</em> field
                becomes a list of the chains found in the file, each with the number of residues it
                contains, and only the selected chain is displayed in the viewer.
              </li>
              <li>
                <strong>Interactive viewer.</strong> The structure is shown in a 3D viewer, with one colour
                per chain. Clicking a residue adds its number to the binding site list and draws it as
                sticks with a label; clicking it again removes it. Switches control the display of lines,
                sticks and labels for the whole chain, and <em>Clear selection</em> empties the list.
              </li>
              <li>
                <strong>Reference chain.</strong> Instead of listing the residues, the user can point to a
                second chain &mdash; a peptide, for instance &mdash; as a reference. Propedia then takes the
                binding site to be the residues of the target chain within 6 &Aring; of that chain, and the
                reference chain is drawn as a surface in the viewer.
              </li>
            </ul>

            <figure>
              <img class="shadow bordered w-100 p-2 m-2" src="<?= base_url('/img/docs/doc-probis-form.png') ?>" alt="The binding site search form">
              <figcaption>
                <b>Figure 28.</b> The binding site search. The PDB code and the upload of the user's own
                structure sit side by side, and one or the other is used. The chain field only offers the
                chains after a structure has been loaded, and the switch below it replaces the list of
                binding site residues with a reference chain.
              </figcaption>
            </figure>

            <figure>
              <img class="shadow bordered w-100 p-2 m-2" src="<?= base_url('/img/docs/doc-probis-viewer.png') ?>" alt="The binding site search with a structure loaded">
              <figcaption>
                <b>Figure 29.</b> The search with the structure of entry 1WRZ-B-A loaded. (A) Opened from
                the entry page: the chain list reports chain A with 147 residues, the binding site residues
                of the entry are already filled in and appear as sticks with labels in the viewer, where
                clicking a residue adds it to or removes it from the list. (B) Reference chain mode: chain B,
                the peptide of the complex, is drawn as a surface, and the binding site becomes the residues
                of chain A within 6 &Aring; of it.
              </figcaption>
            </figure>

            <p>This tool should be used to locate other experimental complexes in which the peptide interacts with equivalent sites, as well as to predict cross-reactivity, identifying peptides capable of binding to multiple proteins that have similar surfaces. It is also useful for exploring mutations, allowing the evaluation of whether structural changes at the site modify its similarity to already known sites, in addition to assisting in the identification of functional analogues in proteins that have not yet been characterized.</p>

          </section>

          <section id="example" class="docs-card">
            <h3><em>2.6.2 Example (ProBiS)</em></h3>
            <p>
              To perform a search for binding sites, click the option in the top menu. Enter the PDB ID used in the search, including the chain, and the residues that compose the desired binding site. The figure below shows an example for the 1a1m (chain A) structure and their binding site: 60,62-82,146-171.
            </p>

            <figure>
              <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/figlprop.png') ?>" alt="Interface">
              <figcaption>
                <b>Figure 30.</b> ProBiS example.
              </figcaption>
            </figure>

            <p>
              Wait for the result. Propedia uses the ProBis algorithm to perform parallelized searches (on average, searches take about 10 minutes).
            </p>
            <p>
              At the end, Propedia returns a list of structures with similar binding sites. Note that similar regions are highlighted in green (the input is displayed on the left, and the result is displayed on the right). Click on the radio input fields to change the structure shown on the right.
            </p>
            <figure>
              <img class="shadow bordered w-75 p-2 m-2" src="<?= base_url('/img/docs/figmprop.png') ?>" alt="Interface">
              <figcaption>
                <b>Figure 31.</b> Second example of ProBiS.
              </figcaption>
            </figure>
          </section>
          <section id="source-code" class="docs-card">
            <h2>3. Source code and reproducibility</h2>

            <p>
              Everything needed to inspect, reuse or rebuild Propedia is publicly available:
            </p>

            <ul>
              <li>The source code for the web tool is available at <a href="https://github.com/LBS-UFMG/propedia26" target="_blank" rel="noopener">https://github.com/LBS-UFMG/propedia26</a>.</li>
              <li>Full supplementary material is available at <a href="https://github.com/LBS-UFMG/propedia26-sm" target="_blank" rel="noopener">https://github.com/LBS-UFMG/propedia26-sm</a>.</li>
              <li>The complete Python pipeline for reproducing Propedia is available at <a href="https://github.com/LBS-UFMG/propedia-pipeline" target="_blank" rel="noopener">https://github.com/LBS-UFMG/propedia-pipeline</a>.</li>
            </ul>
          </section>

          <section id="descriptors" class="docs-card">
            <h2>4. Data descriptors</h2>

            <p>
              The CSV distributed on the Download page carries one row per complex and 94 columns, listed
              below in the order in which they appear in the file. The descriptions here are deliberately
              short; the full descriptor, with the complete definition of each field, is Supplementary
              Table S9 of the Propedia 26 paper and is also available in the supplementary material
              repository. Fields marked as predicted come from computational models, not from experiment,
              and the sections referenced in the text explain how each one is obtained: physicochemical
              properties in 2.1.2, therapeutic classes in 2.1.4, surface, energy and interface properties
              in 2.1.5, and clustering in 2.3.
            </p>

            <div class="table-responsive" style="max-height: 620px; overflow-y: auto;">
              <table class="table table-hover table-condensed table-striped">
                <caption style="text-align: left; font-weight: bold;">Table 4. Data descriptors of the entries dataset, summarised from Supplementary Table S9.</caption>
                <colgroup>
                  <col style="width: 4%">
                  <col style="width: 22%">
                  <col style="width: 49%">
                  <col style="width: 9%">
                  <col style="width: 16%">
                </colgroup>
                <thead class="table-light" style="position: sticky; top: 0; z-index: 1;">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Column</th>
                    <th scope="col">Description</th>
                    <th scope="col">Type</th>
                    <th scope="col">Source</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>0</td>
                    <td><code>id</code></td>
                    <td>PDB code followed by the peptide and the protein chain (e.g. 1A0N-A-B).</td>
                    <td>String (8)</td>
                    <td>Propedia 26</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td><code>AAP</code></td>
                    <td>Probability that the peptide is anti-angiogenic (cutoff 0.9). Predicted.</td>
                    <td>Float</td>
                    <td>CSM-peptides</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><code>ABP</code></td>
                    <td>Probability that the peptide is antibacterial (cutoff 0.9). Predicted.</td>
                    <td>Float</td>
                    <td>CSM-peptides</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><code>ACP</code></td>
                    <td>Probability that the peptide is anticancer (cutoff 0.9). Predicted.</td>
                    <td>Float</td>
                    <td>CSM-peptides</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><code>AIP</code></td>
                    <td>Probability that the peptide is anti-inflammatory (cutoff 0.9). Predicted.</td>
                    <td>Float</td>
                    <td>CSM-peptides</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><code>ASA_Complex</code></td>
                    <td>Accessible surface area of the complex (&Aring;&sup2;).</td>
                    <td>Float</td>
                    <td>NACCESS</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td><code>ASA_Peptide</code></td>
                    <td>Accessible surface area of the isolated peptide (&Aring;&sup2;).</td>
                    <td>Float</td>
                    <td>NACCESS</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td><code>ASA_Protein</code></td>
                    <td>Accessible surface area of the isolated protein (&Aring;&sup2;).</td>
                    <td>Float</td>
                    <td>NACCESS</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td><code>BPP%</code></td>
                    <td>Percentage of the peptide surface buried at the interface: 100 &times; BPepA / ASA_Peptide.</td>
                    <td>Int</td>
                    <td>NACCESS</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td><code>BPepA</code></td>
                    <td>Peptide area buried upon binding (&Aring;&sup2;).</td>
                    <td>Int</td>
                    <td>NACCESS</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td><code>BProA</code></td>
                    <td>Protein area buried upon binding (&Aring;&sup2;).</td>
                    <td>Int</td>
                    <td>NACCESS</td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td><code>BSA</code></td>
                    <td>Buried surface area of the interface (&Aring;&sup2;): (ASA_Protein + ASA_Peptide &minus; ASA_Complex) / 2.</td>
                    <td>Int</td>
                    <td>NACCESS</td>
                  </tr>
                  <tr>
                    <td>12</td>
                    <td><code>CLASSIFICATION</code></td>
                    <td>Classification of the entry as annotated in the PDB.</td>
                    <td>String</td>
                    <td>PDB</td>
                  </tr>
                  <tr>
                    <td>13</td>
                    <td><code>DEPOSITION_DATE</code></td>
                    <td>Date the structure was deposited in the PDB (YYYY-MM-DD).</td>
                    <td>String</td>
                    <td>PDB</td>
                  </tr>
                  <tr>
                    <td>14</td>
                    <td><code>Interface Residues</code></td>
                    <td>Residue numbers of the protein chain within 6 &Aring; of the peptide, comma separated.</td>
                    <td>String</td>
                    <td>COCaDA</td>
                  </tr>
                  <tr>
                    <td>15</td>
                    <td><code>No. of apolar-apolar contacts</code></td>
                    <td>Contacts between two apolar residues.</td>
                    <td>Int</td>
                    <td>PRODIGY</td>
                  </tr>
                  <tr>
                    <td>16</td>
                    <td><code>No. of apolar-polar contacts</code></td>
                    <td>Contacts between an apolar and a polar residue.</td>
                    <td>Int</td>
                    <td>PRODIGY</td>
                  </tr>
                  <tr>
                    <td>17</td>
                    <td><code>No. of charged-apolar contacts</code></td>
                    <td>Contacts between a charged and an apolar residue.</td>
                    <td>Int</td>
                    <td>PRODIGY</td>
                  </tr>
                  <tr>
                    <td>18</td>
                    <td><code>No. of charged-charged contacts</code></td>
                    <td>Contacts between two charged residues.</td>
                    <td>Int</td>
                    <td>PRODIGY</td>
                  </tr>
                  <tr>
                    <td>19</td>
                    <td><code>No. of charged-polar contacts</code></td>
                    <td>Contacts between a charged and a polar residue.</td>
                    <td>Int</td>
                    <td>PRODIGY</td>
                  </tr>
                  <tr>
                    <td>20</td>
                    <td><code>No. of intermolecular contacts</code></td>
                    <td>Total protein-peptide contacts within 5.5 &Aring;.</td>
                    <td>Int</td>
                    <td>PRODIGY</td>
                  </tr>
                  <tr>
                    <td>21</td>
                    <td><code>No. of polar-polar contacts</code></td>
                    <td>Contacts between two polar residues.</td>
                    <td>Int</td>
                    <td>PRODIGY</td>
                  </tr>
                  <tr>
                    <td>22</td>
                    <td><code>PDB_ID</code></td>
                    <td>PDB code of the structure.</td>
                    <td>String (4)</td>
                    <td>PDB</td>
                  </tr>
                  <tr>
                    <td>23</td>
                    <td><code>PEPTIDE_CHAIN</code></td>
                    <td>Chain identifier of the peptide.</td>
                    <td>String (1)</td>
                    <td>PDB</td>
                  </tr>
                  <tr>
                    <td>24</td>
                    <td><code>PEPTIDE_DESC</code></td>
                    <td>Name of the peptide chain as annotated in the PDB.</td>
                    <td>String</td>
                    <td>PDB</td>
                  </tr>
                  <tr>
                    <td>25</td>
                    <td><code>PEPTIDE_SEQ</code></td>
                    <td>Peptide sequence in one-letter code.</td>
                    <td>String</td>
                    <td>PDB</td>
                  </tr>
                  <tr>
                    <td>26</td>
                    <td><code>PEPTIDE_SIZE</code></td>
                    <td>Number of residues observed in the peptide chain.</td>
                    <td>Int</td>
                    <td>PDB</td>
                  </tr>
                  <tr>
                    <td>27</td>
                    <td><code>PROTEIN_CHAIN</code></td>
                    <td>Chain identifier of the protein.</td>
                    <td>String (1)</td>
                    <td>PDB</td>
                  </tr>
                  <tr>
                    <td>28</td>
                    <td><code>PROTEIN_DESC</code></td>
                    <td>Name of the protein chain as annotated in the PDB.</td>
                    <td>String</td>
                    <td>PDB</td>
                  </tr>
                  <tr>
                    <td>29</td>
                    <td><code>PROTEIN_SEQ</code></td>
                    <td>Protein sequence in one-letter code.</td>
                    <td>String</td>
                    <td>PDB</td>
                  </tr>
                  <tr>
                    <td>30</td>
                    <td><code>PROTEIN_SIZE</code></td>
                    <td>Number of residues observed in the protein chain.</td>
                    <td>String</td>
                    <td>PDB</td>
                  </tr>
                  <tr>
                    <td>31</td>
                    <td><code>Percentage of apolar NIS residues</code></td>
                    <td>Apolar fraction of the non-interacting surface (%).</td>
                    <td>Float</td>
                    <td>PRODIGY</td>
                  </tr>
                  <tr>
                    <td>32</td>
                    <td><code>Percentage of charged NIS residues</code></td>
                    <td>Charged fraction of the non-interacting surface (%).</td>
                    <td>Float</td>
                    <td>PRODIGY</td>
                  </tr>
                  <tr>
                    <td>33</td>
                    <td><code>Predicted binding affinity (kcal.mol-1)</code></td>
                    <td>Free energy of binding &Delta;G (kcal/mol); the more negative, the stronger. Predicted.</td>
                    <td>Float</td>
                    <td>PRODIGY</td>
                  </tr>
                  <tr>
                    <td>34</td>
                    <td><code>Predicted dissociation constant (M) at 25.0&#730;C</code></td>
                    <td>Dissociation constant K<sub>d</sub> (M) at 25 &deg;C. Predicted.</td>
                    <td>String</td>
                    <td>PRODIGY</td>
                  </tr>
                  <tr>
                    <td>35</td>
                    <td><code>QSP</code></td>
                    <td>Probability that the peptide is quorum sensing (cutoff 0.9). Predicted.</td>
                    <td>Float</td>
                    <td>CSM-peptides</td>
                  </tr>
                  <tr>
                    <td>36</td>
                    <td><code>RESOLUTION</code></td>
                    <td>Resolution of the structure (&Aring;); empty for methods without resolution.</td>
                    <td>String</td>
                    <td>PDB</td>
                  </tr>
                  <tr>
                    <td>37</td>
                    <td><code>SBP</code></td>
                    <td>Probability that the peptide is surface binding (cutoff 0.9). Predicted.</td>
                    <td>Float</td>
                    <td>CSM-peptides</td>
                  </tr>
                  <tr>
                    <td>38</td>
                    <td><code>STRUCTURE_METHOD</code></td>
                    <td>Experimental method used to solve the structure.</td>
                    <td>String</td>
                    <td>PDB</td>
                  </tr>
                  <tr>
                    <td>39</td>
                    <td><code>TITLE</code></td>
                    <td>Title of the PDB entry.</td>
                    <td>String</td>
                    <td>PDB</td>
                  </tr>
                  <tr>
                    <td>40</td>
                    <td><code>binding-cluster</code></td>
                    <td>Cluster of structures with a similar binding site.</td>
                    <td>String</td>
                    <td>Propedia v1</td>
                  </tr>
                  <tr>
                    <td>41</td>
                    <td><code>interface-cluster</code></td>
                    <td>Cluster of structures with a similar interface.</td>
                    <td>String</td>
                    <td>Propedia v1</td>
                  </tr>
                  <tr>
                    <td>42</td>
                    <td><code>is_leader</code></td>
                    <td><em>yes</em> when the complex is the representative of its sequence cluster.</td>
                    <td>String</td>
                    <td>Propedia 26</td>
                  </tr>
                  <tr>
                    <td>43</td>
                    <td><code>leader_id</code></td>
                    <td>Identifier of the representative of the cluster the complex belongs to.</td>
                    <td>String</td>
                    <td>Propedia 26</td>
                  </tr>
                  <tr>
                    <td>44</td>
                    <td><code>organism</code></td>
                    <td>Source organism of the structure.</td>
                    <td>String</td>
                    <td>PDB</td>
                  </tr>
                  <tr>
                    <td>45</td>
                    <td><code>peptide_AliphaticIndex</code></td>
                    <td>Relative volume of the aliphatic side chains of the peptide.</td>
                    <td>Float</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>46</td>
                    <td><code>peptide_ExtCoeff_Disulfide</code></td>
                    <td>Extinction coefficient of the peptide (M&#8315;&sup1; cm&#8315;&sup1;) with cysteines paired.</td>
                    <td>Int</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>47</td>
                    <td><code>peptide_ExtCoeff_NoDisulfide</code></td>
                    <td>Extinction coefficient of the peptide (M&#8315;&sup1; cm&#8315;&sup1;) with cysteines reduced.</td>
                    <td>Int</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>48</td>
                    <td><code>peptide_Formula</code></td>
                    <td>Atomic formula of the peptide.</td>
                    <td>String</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>49</td>
                    <td><code>peptide_GRAVY</code></td>
                    <td>Average hydropathy of the peptide (Kyte-Doolittle); positive is hydrophobic.</td>
                    <td>Float</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>50</td>
                    <td><code>peptide_HydrophobicPercent</code></td>
                    <td>Percentage of hydrophobic residues in the peptide.</td>
                    <td>Float</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>51</td>
                    <td><code>peptide_InstabilityIndex</code></td>
                    <td>Estimated <em>in vitro</em> instability of the peptide; above 40 is unstable.</td>
                    <td>Float</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>52</td>
                    <td><code>peptide_MW</code></td>
                    <td>Molecular weight of the peptide (Da).</td>
                    <td>Float</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>53</td>
                    <td><code>peptide_NegativeResidues</code></td>
                    <td>Number of Asp and Glu residues in the peptide.</td>
                    <td>Int</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>54</td>
                    <td><code>peptide_PositiveResidues</code></td>
                    <td>Number of Lys, Arg and His residues in the peptide.</td>
                    <td>Int</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>55</td>
                    <td><code>peptide_TotalAtoms</code></td>
                    <td>Number of atoms in the peptide.</td>
                    <td>Int</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>56</td>
                    <td><code>peptide_pI</code></td>
                    <td>Isoelectric point of the peptide.</td>
                    <td>Float</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>57</td>
                    <td><code>protein_AliphaticIndex</code></td>
                    <td>Relative volume of the aliphatic side chains of the protein.</td>
                    <td>Float</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>58</td>
                    <td><code>protein_ExtCoeff_Disulfide</code></td>
                    <td>Extinction coefficient of the protein (M&#8315;&sup1; cm&#8315;&sup1;) with cysteines paired.</td>
                    <td>Int</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>59</td>
                    <td><code>protein_ExtCoeff_NoDisulfide</code></td>
                    <td>Extinction coefficient of the protein (M&#8315;&sup1; cm&#8315;&sup1;) with cysteines reduced.</td>
                    <td>Int</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>60</td>
                    <td><code>protein_Formula</code></td>
                    <td>Atomic formula of the protein.</td>
                    <td>String</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>61</td>
                    <td><code>protein_GRAVY</code></td>
                    <td>Average hydropathy of the protein (Kyte-Doolittle); positive is hydrophobic.</td>
                    <td>Float</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>62</td>
                    <td><code>protein_HydrophobicPercent</code></td>
                    <td>Percentage of hydrophobic residues in the protein.</td>
                    <td>Float</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>63</td>
                    <td><code>protein_InstabilityIndex</code></td>
                    <td>Estimated <em>in vitro</em> instability of the protein; above 40 is unstable.</td>
                    <td>Float</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>64</td>
                    <td><code>protein_MW</code></td>
                    <td>Molecular weight of the protein (Da).</td>
                    <td>Float</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>65</td>
                    <td><code>protein_NegativeResidues</code></td>
                    <td>Number of Asp and Glu residues in the protein.</td>
                    <td>Int</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>66</td>
                    <td><code>protein_PositiveResidues</code></td>
                    <td>Number of Lys, Arg and His residues in the protein.</td>
                    <td>Int</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>67</td>
                    <td><code>protein_TotalAtoms</code></td>
                    <td>Number of atoms in the protein.</td>
                    <td>Int</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>68</td>
                    <td><code>protein_pI</code></td>
                    <td>Isoelectric point of the protein.</td>
                    <td>Float</td>
                    <td>ProtParam</td>
                  </tr>
                  <tr>
                    <td>69</td>
                    <td><code>seq100_clusters</code></td>
                    <td>Identifier of the cluster of peptides with 100% sequence identity.</td>
                    <td>String</td>
                    <td>Propedia 26</td>
                  </tr>
                  <tr>
                    <td>70</td>
                    <td><code>sequence-cluster</code></td>
                    <td>Cluster of structures whose sequences have high identity.</td>
                    <td>String</td>
                    <td>Propedia v1</td>
                  </tr>
                  <tr>
                    <td>71</td>
                    <td><code>PISA_status</code></td>
                    <td><em>ok</em> when PISA analysed the interface; otherwise the reason it did not.</td>
                    <td>String</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>72</td>
                    <td><code>PISA_chain_1</code></td>
                    <td>Chain PISA treated as the first partner (the peptide).</td>
                    <td>String (1)</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>73</td>
                    <td><code>PISA_chain_2</code></td>
                    <td>Chain PISA treated as the second partner (the protein).</td>
                    <td>String (1)</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>74</td>
                    <td><code>PISA_area</code></td>
                    <td>Interface area, one face (&Aring;&sup2;).</td>
                    <td>Int</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>75</td>
                    <td><code>PISA_solv_en</code></td>
                    <td>Solvation energy gain &Delta;iG of the interface (kcal/mol). Predicted.</td>
                    <td>Float</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>76</td>
                    <td><code>PISA_pvalue</code></td>
                    <td>Significance of &Delta;iG; below 0.5 the interface is more hydrophobic than by chance.</td>
                    <td>Float</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>77</td>
                    <td><code>PISA_n_hbonds</code></td>
                    <td>Hydrogen bonds across the interface.</td>
                    <td>Int</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>78</td>
                    <td><code>PISA_n_saltbridges</code></td>
                    <td>Salt bridges across the interface.</td>
                    <td>Int</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>79</td>
                    <td><code>PISA_nres_1</code></td>
                    <td>Peptide residues that take part in the interface.</td>
                    <td>Int</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>80</td>
                    <td><code>PISA_natoms_1</code></td>
                    <td>Peptide atoms that take part in the interface.</td>
                    <td>Int</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>81</td>
                    <td><code>PISA_area_1</code></td>
                    <td>Peptide area buried at the interface (&Aring;&sup2;).</td>
                    <td>Int</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>82</td>
                    <td><code>PISA_solv_en_1</code></td>
                    <td>Contribution of the peptide to &Delta;iG (kcal/mol). Predicted.</td>
                    <td>Float</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>83</td>
                    <td><code>PISA_nres_2</code></td>
                    <td>Protein residues that take part in the interface.</td>
                    <td>Int</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>84</td>
                    <td><code>PISA_natoms_2</code></td>
                    <td>Protein atoms that take part in the interface.</td>
                    <td>Int</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>85</td>
                    <td><code>PISA_area_2</code></td>
                    <td>Protein area buried at the interface (&Aring;&sup2;).</td>
                    <td>Int</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>86</td>
                    <td><code>PISA_solv_en_2</code></td>
                    <td>Contribution of the protein to &Delta;iG (kcal/mol). Predicted.</td>
                    <td>Float</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>87</td>
                    <td><code>PISA_diss_energy</code></td>
                    <td>Dissociation free energy &Delta;G<sub>diss</sub> (kcal/mol); positive means a stable complex. Predicted.</td>
                    <td>Float</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>88</td>
                    <td><code>PISA_entropy</code></td>
                    <td>Entropic cost of the association T&Delta;S (kcal/mol). Predicted.</td>
                    <td>Float</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>89</td>
                    <td><code>PISA_int_energy</code></td>
                    <td>&Delta;iG summed over every interface of the structure (kcal/mol). Predicted.</td>
                    <td>Float</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>90</td>
                    <td><code>PISA_asa</code></td>
                    <td>Accessible surface area of the complex (&Aring;&sup2;).</td>
                    <td>Int</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>91</td>
                    <td><code>PISA_bsa</code></td>
                    <td>Total area buried by the association, both faces (&Aring;&sup2;).</td>
                    <td>Int</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>92</td>
                    <td><code>PISA_diss_area</code></td>
                    <td>Interface area broken on dissociation (&Aring;&sup2;).</td>
                    <td>Int</td>
                    <td>PISA</td>
                  </tr>
                  <tr>
                    <td>93</td>
                    <td><code>PISA_CSS</code></td>
                    <td>Complexation Significance Score, 0 to 1; read as the interface evidence.</td>
                    <td>Float</td>
                    <td>PISA</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <p class="small">
              The multipro dataset is distributed as a separate file with a header of its own (64 columns).
              It shares the structural, physicochemical, surface, contact and energy columns described
              above and adds the cluster identifier and the complexes that belong to it, but it does not
              carry the therapeutic classes, the clustering columns or the interface properties calculated
              with PISA.
            </p>
          </section>

          <section id="final" class="docs-card">
            <h2>5. Final Considerations</h2>
            <p>This documentation presented the structure, functionalities, and usage flows of Propedia v26, including navigation, data models, structural analyses, algorithms employed, and search methods by interaction and binding sites.</p>
            <p>As a database dedicated to protein-peptide complexes, Propedia remains in active development, maintaining its commitment to transparency, reproducibility, and continuous updating. We hope that this tool will provide solid support for research in structural bioinformatics, peptide design, biomolecular interaction mining, and the development of computational methods.</p>
            <p>For questions, suggestions, or feature requests, users can contact the team at the address listed on the project's official website.</p>
            <p>We appreciate your use of the platform and hope that Propedia will contribute significantly to the advancement of your research.</p>

          </section>

          <section id="reference" class="docs-card">
            <h2>6. References</h2>

            <p>ALTSCHUL, S. F., GISH, W., MILLER, W., MYERS, E. W. & LIPMAN, D. J. Basic local alignment search tool. <em>J. Mol. Biol.</em> v. 215, p. 403-410, 1990.</p>

            <p>BANK, Protein Data. Protein data bank. <em>Nature New Biol</em>, v. 233, n. 223, p. 10-1038, 1971.</p>

            <p>BERMAN, Helen M., et al. “The protein data bank.” <em>Biological Crystallography</em> 58.6 (2002): 899–907.</p>

            <p>BLAST Search Parameters - BlastTopics 0.1.1 documentation. Disponível em: &lt;https://blast.ncbi.nlm.nih.gov/doc/blast-topics/blastsearchparams.html#word-size&gt;.</p>

            <p>CAMACHO, C. et al. BLAST+: architecture and applications. <em>BMC Bioinformatics</em>. v. 10, p. 421, 2009.</p>

            <p>FASSLER, J.; COOPER, P. BLAST Glossary. Disponível em: &lt;https://www.ncbi.nlm.nih.gov/books/NBK62051/&gt;.</p>

            <p>GASTEIGER, E. et al. Protein identification and analysis tools on the ExPASy server. In: <em>The proteomics protocols handbook</em>, p. 571–607 (Springer, 2005).</p>

            <p>HUBBARD, S. J.; THORNTON, J. M. (1993). "NACCESS", Computer Program, Department of Biochemistry and Molecular Biology, University College London.</p>

            <p>KRISSINEL, E.; HENRICK, K. “Inference of macromolecular assemblies from crystalline state.” <em>Journal of Molecular Biology</em> 372.3 (2007): 774–797.</p>

            <p>LEMOS, Rafael Pereira, et al. “COCαDA - A fast and scalable algorithm for interatomic contact detection in proteins using Cα distance matrices.” <em>Frontiers in Bioinformatics</em> 5 (2025): 1630078.</p>

            <p>LEMOS, Rafael P., et al. “Cocαda - large-scale protein interatomic contact cutoff optimization by Cα distance matrices.” <em>Simpósio Brasileiro de Bioinformática (BSB)</em>. SBC, 2024.</p>

            <p>MARIANO, D. C. B.; BARROSO, J. R. P. M.; CORREIA, T. S.; DE MELO-MINARDI, R. C. <em>Introdução à Programação para Bioinformática com Biopython</em>. 3. ed. North Charleston, SC (EUA): CreateSpace Independent Publishing Platform, v. 1. 230 p. 2015.</p>

            <p>Table C3: [blastp application options. The blastp...]. Disponível em: &lt;https://www.ncbi.nlm.nih.gov/books/NBK279684/table/appendices.T.blastp_application_options/&gt;.</p>

            <p>WHEELER, D.; BHAGWAT, M. BLAST QuickStart. Disponível em: &lt;https://www.ncbi.nlm.nih.gov/books/NBK1734/&gt;.</p>

            <p>XUE, Li C., et al. “PRODIGY: a web server for predicting the binding affinity of protein–protein complexes.” <em>Bioinformatics</em> 32.23 (2016): 3676–3678.</p>

          </section>
    </article>
  </div>
</div>
<!-- fim conteudo milenna -->

<!-- / FIM Conteúdo personalizado -->
</div>
<?= $this->endSection() ?>