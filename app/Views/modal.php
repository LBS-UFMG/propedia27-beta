<!-- MODAL: SOBRE -->
<div class="modal fade" tabindex="-1" id="about" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <div class="text-center">
          <img width="150" class="me-3" src="<?php echo base_url('/img/logo_propedia.svg'); ?>">
        </div>
        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body small">
        <div class="row">
          <p class="text-muted">
            PROPEDIA is a database of peptide-protein complexes clusterized in three methodologies: based on peptide sequences; based on structure interface; and based on binding sites. PROPEDIA main goal is to give new insights into peptide design of biotechnological interests.
          </p>
        </div>
        <div class="row text-secondary">
          <div class="col-md-8">

            <strong># Created by:</strong><br>
            Pedro Martins / Diego Mariano / Raquel C. de Melo-Minardi<br><br>

            <strong># Backend/frontend:</strong><br>
            Diego Mariano
          </div>
        </div>

        <span><label class="badge bg-dark mt-3">Cite:</label></span>
        <p class="small text-muted border-start border-dark mx-3 col-11 bg-light p-2">
          Martins, P.M., Santos, L.H., Mariano, D. et al. <strong>Propedia: a database for protein–peptide identification based on a hybrid clustering algorithm</strong>. BMC Bioinformatics 22, 1 (2021). https://doi.org/10.1186/s12859-020-03881-z
        </p>
      </div>
      <div class="modal-footer">
        <img height="50" class="me-3" src="<?php echo base_url('/img/dcc_b.svg'); ?>">
        <img height="50" class="me-3" src="<?php echo base_url('/img/ufmg_b.svg'); ?>">

        <button type="button" class="btn btn-light py-4 px-5" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal SOBRE -->

<!-- /.modal BLAST -->
<div class="modal fade" tabindex="-1" id="blast" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <form id="form_blast_run" action="<?php echo base_url('/blast'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <div>
            <h3><b><i class="bi bi-search me-2"></i> Search for similar protein or peptide sequences using BLAST</b></h3>
          </div>
          <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-md-6">

              <p class="small text-muted"><strong>BLAST algorithm</strong> searches for similar protein or peptide sequences by identifying short local matches (words) between the query and database sequences <a class="badge bg-dark" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Then extending these matches in both directions to form high-scoring segment pairs (HSPs), and finally scoring and ranking the alignments based on a substitution matrix and statistical significance. Parameters used for peptides search: -word_size 2 -task blastp-short -seg no -evalue 100000">?</a>.</p>
              <h5><b>Input sequence</b></h5>
              <textarea id="txt_sequence" class="form-control" form="form_blast_run" name="sequence" rows="5" placeholder="Insert the sequence here (e.g.: TPYDINQML)"></textarea>
              <div hidden id="feedback_blast" class="alert alert-danger" role="alert">
                Sequence cannot be empty!
              </div>
              <br>
              <h5><b>Search for:</b></h5>

              <input type="radio" class="btn-check" name="search" value="peptides" id="blast_peptides" autocomplete="off" checked>
              <label class="btn btn-lg" for="blast_peptides">Peptides</label>

              <input type="radio" class="btn-check" name="search" value="receptors" id="blast_proteins" autocomplete="off">
              <label class="btn btn-lg" for="blast_proteins">Proteins</label>

              <input type="button" class="btn btn-primary w-100 btn-lg mt-5 mb-4" id="loading_blast" value="Run BLAST">

            </div>

            <div class="col text-center mt-5">
              <img class="w-75 img-thumbnail shadow p-3" src="<?= base_url('/img/blast.png') ?>">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- loading blast -->
<div id="loading-blast">
  <div class="text-center">
    <img src="<?= base_url('/img/cocadito-loading.png') ?>" width="200px"><br>
    <div class="spinner-border spinner-border-sm" role="status"></div>
    <strong class="ms-2">Loading...</strong>
  </div>
</div>

<script>
  // Intercepta o submit do formulário
  document.getElementById("loading_blast").addEventListener("click", e => {
    $('#loading-blast').css('visibility', 'visible').css('display', 'block');
    document.getElementById("form_blast_run").submit();
  });
</script>
<!-- /.modal BLAST -->

<!-- /.modal PROBIS -->
<div class="modal fade" tabindex="-1" id="probis" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <form id="form_probis_run" action="<?php echo base_url('/probis'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <div>
            <h3><b><i class="bi bi-search me-2"></i> Search for similar binding sites</b></h3>
          </div>
          <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form id="form_probis_run" action="<?php echo base_url(); ?>search/binding" method="post" enctype="multipart/form-data">

            <div class="row">
              <div class="col">
                <p class="small text-muted">
                  The search for similar binding sites in Propedia employs the <a class="link-dark" href="#" data-bs-placement="bottom" data-bs-toggle="tooltip" data-bs-title="ProBiS achieves this by aligning surface patches based on geometric and physicochemical properties, followed by statistical scoring of the alignments, thereby enabling the identification of proteins that share structurally conserved binding sites with the protein indicated here."><strong>ProBiS algorithm</strong></a>, which detects local structural similarities by comparing the 3D surface of the queried protein binding site with those of proteins stored in the database.
                </p>
                <!-- Formulario da busca, em uma caixa -->
                <div class="border rounded-3 bg-light p-3">
                  <p class="small text-muted"><strong>Enter the PDB code, target protein chain, and binding site residue numbers separated by commas (use hyphens to indicate ranges) <a class="badge bg-dark" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="E.g.: 100,101,105-110 (i.e.: 100,101,105,106,107,108,109,110)">?</a>.</strong></p>

                  <style>
                    /* textos de apoio do formulario e do viewer */
                    #probis .probis-hint { font-size: 0.72rem; line-height: 1.3; }
                  </style>

                  <!-- Estrutura da consulta: codigo do PDB OU arquivo do usuario -->
                  <div class="row g-2 align-items-end">
                    <div class="col-5">
                      <label class="badge bg-secondary" for="probis_pdb">PDB ID</label>
                      <input id="probis_pdb" name="pdb" type="text" class="form-control" placeholder="e.g.: 1a1m">
                    </div>
                    <div class="col-2 text-center text-muted fw-bold pb-2">or</div>
                    <div class="col-5">
                      <label class="badge bg-secondary" for="probis_file">Your structure</label>
                      <input id="probis_file" name="pdb_file" type="file" class="form-control" accept=".pdb,.ent">
                    </div>
                  </div>
                  <p class="form-text probis-hint mb-3">
                    Use <strong>one or the other</strong>: a PDB code, which Propedia downloads from the RCSB PDB, or your own structure in PDB format (up to 20 MB), used only for this search and not added to the database.
                  </p>
                  <p>
                    <label class="badge bg-secondary" for="probis_chain">Chain</label>
                    <select id="probis_chain" name="chain" class="form-select" required>
                      <option value="">Load a structure to choose the chain</option>
                    </select>
                    <span class="form-text probis-hint">Only the selected chain is displayed in the viewer.</span>
                  </p>

                  <!-- Cadeia de referencia: dispensa digitar a lista de residuos -->
                  <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="probis_use_ref" name="use_reference" value="1">
                    <label class="form-check-label small" for="probis_use_ref">
                      Use a reference chain to define the binding site
                      <a class="badge bg-dark" href="#" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Instead of typing the residue numbers, indicate a chain bound to the target protein — typically a peptide. Propedia reads the structure and uses as the binding site every residue of the target chain within 6 Å of that reference chain, the same criterion used for the interface residues listed in each entry.">?</a>
                    </label>
                  </div>

                  <p id="probis_ref_field" hidden>
                    <label class="badge bg-secondary" for="probis_ref_chain">Reference chain</label>
                    <select id="probis_ref_chain" name="ref_chain" class="form-select">
                      <option value="">Load a structure to choose the chain</option>
                    </select>
                    <span class="form-text probis-hint">Shown with a surface in the viewer. The binding site will be the residues of the target chain within 6 Å of this chain.</span>
                  </p>

                  <p id="probis_residues_field">
                    <label class="badge bg-secondary">Binding site residues</label>
                    <textarea id="probis_residues" name="residues" class="form-control" placeholder="e.g.: 60,62-82,146-171" rows="3" required></textarea>
                  </p>

                  <input name="search_binding_sites" type="submit" value="Search for proteins with similar binding sites" class="btn w-100 btn-primary mb-4 mt-3 btn-lg">
                </div>

              </div>
              <div class="col">
                <img id="probis_img" src="<?= base_url('/img/bindingsite.png') ?>" class="w-75 float-end">

                <!-- Visualizacao da estrutura informada (substitui a figura) -->
                <div id="probis_viewer_box" hidden>
                  <div class="d-flex flex-wrap align-items-center gap-3 mb-1 small">
                    <div class="form-check form-switch mb-0">
                      <input class="form-check-input" type="checkbox" id="probis_lines">
                      <label class="form-check-label" for="probis_lines">Show lines</label>
                    </div>
                    <div class="form-check form-switch mb-0">
                      <input class="form-check-input" type="checkbox" id="probis_sticks">
                      <label class="form-check-label" for="probis_sticks">Sticks</label>
                    </div>
                    <div class="form-check form-switch mb-0">
                      <input class="form-check-input" type="checkbox" id="probis_labels">
                      <label class="form-check-label" for="probis_labels">Labels</label>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary ms-auto" id="probis_clear_sel">Clear selection</button>
                  </div>

                  <div id="probis_viewer" style="height: 520px; width: 100%; position: relative;"></div>

                  <div id="probis_legend" class="small mt-1"></div>
                  <div id="probis_viewer_msg" class="form-text probis-hint">Click a residue to add its number to the binding site list.</div>
                </div>
              </div>
            </div>
            <div id="feedback_upload" class="alert" role="alert" hidden></div>
            <div id="fields" class="row" hidden>
              <div class="col-md-12">
                <h4><b>Protein chain select</b></h4>
                <select id="selected_chain" name="selected_chain" class="form-control" style="width: 100%"></select>
                <h4><b>Input residues id</b></h4>
                <p style="color:gray;font-size:12px;">Separated by comma (',')</p>
                <div class="row">
                  <div class="col-md-8">
                    <textarea id="residues_list" class="form-control" form="form_probis_run" name="residues_list" rows="3" placeho
                      lder=""></textarea>
                  </div>
                  <div class="col-md-4">
                    <label id="highlight_residues" class="btn btn-block btn-primary">Highlight residues surface
                      <br>
                      <i class="fa fa-eye"></i>
                    </label>
                  </div>
                </div>
                <h4><b>Search scope</b></h4>
                <label class="radio-inline">
                  <input type="radio" name="scope" value="ccd" checked>Only CCD <sup><a class="tip" href="#" data-placement="top" dat
                      a-toggle="tooltip" title="Search in <?= number_format(1) //$ccd_number)
                                                          ?> complex of Clustered Complex Dataset (faster).">?</a></sup>
                </label>
                <label class="radio-inline">
                  <input type="radio" name="scope" value="all">Whole database <sup><a class="tip" href="#" data-placement="top" data-
                      toggle="tooltip" title="Search in <?= number_format(1) //$complex_number)
                                                        ?> complex (slower).">?</a></sup>
                </label>
                <div hidden id="feedback_probis" class="alert alert-danger" role="alert">
                  PDB file and residue list cannot by empty!
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <input id="run_probis_btn" type="submit" class="btn btn-success" value="Run ProBiS NOW" style="display: none;">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Modal "Search for similar binding sites": ao marcar a cadeia de referencia,
  // o campo de residuos some (e deixa de ser obrigatorio) e aparece o campo da
  // cadeia de referencia — quem monta a lista e o servidor, lendo a estrutura.
  (function() {
    const marcador = document.getElementById('probis_use_ref');
    if (!marcador) {
      return;
    }
    const campoResiduos = document.getElementById('probis_residues_field');
    const texto = document.getElementById('probis_residues');
    const campoRef = document.getElementById('probis_ref_field');
    const ref = document.getElementById('probis_ref_chain');

    marcador.addEventListener('change', function() {
      campoResiduos.hidden = this.checked;
      texto.required = !this.checked;
      campoRef.hidden = !this.checked;
      ref.required = this.checked;
    });
  })();

  // Visualizacao da estrutura informada: substitui a figura por um 3Dmol e
  // permite montar a lista de residuos clicando na propria estrutura.
  (function() {
    const campoPdb = document.getElementById('probis_pdb');
    const campoArquivo = document.getElementById('probis_file');
    if (!campoPdb || !campoArquivo) {
      return;
    }

    const campoChain = document.getElementById('probis_chain');
    const campoRef = document.getElementById('probis_ref_chain');
    const campoResiduos = document.getElementById('probis_residues');
    const figura = document.getElementById('probis_img');
    const caixa = document.getElementById('probis_viewer_box');
    const legenda = document.getElementById('probis_legend');
    const aviso = document.getElementById('probis_viewer_msg');

    // Clicar em uma LINHA exige precisao de 0.2 Å no 3Dmol, o que na pratica
    // torna o clique impossivel. Como a estrutura e exibida em linhas, afrouxa
    // essa tolerancia.
    if (window.$3Dmol && $3Dmol.Raycaster && $3Dmol.Raycaster.prototype.linePrecision < 0.6) {
      $3Dmol.Raycaster.prototype.linePrecision = 0.6;
    }

    // Uma cor por cadeia
    const cores = ['grey', 'orangered', 'deepskyblue', 'green', 'purple',
      'cyan', 'magenta', 'gold', 'teal', 'salmon'];

    let viewer = null;
    let corDaCadeia = {};
    let residuosDaCadeia = {}; // quantos residuos cada cadeia tem
    let selecionados = [];
    let rotulos = [];
    let superficies = [];

    function mostraViewer() {
      figura.hidden = true;
      caixa.hidden = false;
    }

    function cor(chain) {
      return corDaCadeia[chain] || 'grey';
    }

    // Cadeias exibidas: a alvo e a de referencia. Sem escolha, mostra todas.
    function cadeiasVisiveis() {
      const alvo = campoChain.value;
      const ref = campoRef ? campoRef.value : '';
      if (!alvo && !ref) {
        return Object.keys(corDaCadeia);
      }
      const lista = [];
      if (alvo) {
        lista.push(alvo);
      }
      if (ref && ref !== alvo) {
        lista.push(ref);
      }
      return lista;
    }

    // ---- rotulos ----
    function limpaRotulos() {
      rotulos.forEach(function(l) {
        viewer.removeLabel(l);
      });
      rotulos = [];
    }

    function aplicaRotulos() {
      limpaRotulos();

      const visiveis = cadeiasVisiveis();
      let atomos = [];

      if (document.getElementById('probis_labels').checked) {
        // rotula os residuos das cadeias exibidas
        let total = 0;
        visiveis.forEach(function(chain) {
          total += (residuosDaCadeia[chain] || 0);
        });

        if (total > 500) {
          aviso.textContent = 'Too many residues to label them all (' + total +
            '); only the selected ones are labelled.';
        } else {
          visiveis.forEach(function(chain) {
            atomos = atomos.concat(viewer.selectedAtoms({ chain: chain, atom: 'CA' }));
          });
        }
      }

      // os escolhidos ficam sempre rotulados
      if (selecionados.length && campoChain.value) {
        const marcados = viewer.selectedAtoms({
          chain: campoChain.value,
          resi: selecionados,
          atom: 'CA'
        });
        marcados.forEach(function(a) {
          if (atomos.indexOf(a) === -1) {
            atomos.push(a);
          }
        });
      }

      atomos.forEach(function(a) {
        rotulos.push(viewer.addLabel(a.resn + a.resi, {
          position: { x: a.x, y: a.y, z: a.z },
          fontSize: 10,
          fontColor: 'black',
          backgroundColor: 'white',
          backgroundOpacity: 0.6,
          inFront: true
        }));
      });
    }

    // ---- superficie da cadeia de referencia ----
    function limpaSuperficies() {
      if (typeof viewer.removeAllSurfaces === 'function') {
        viewer.removeAllSurfaces();
      } else {
        superficies.forEach(function(sup) {
          try {
            viewer.removeSurface(sup);
          } catch (err) {
            console.warn('removeSurface falhou', err);
          }
        });
      }
      superficies = [];
    }

    function aplicaSuperficie() {
      limpaSuperficies();
      const ref = campoRef ? campoRef.value : '';
      if (ref) {
        superficies.push(viewer.addSurface($3Dmol.SurfaceType.VDW, {
          opacity: 1.0,
          color: cor(ref)
        }, {
          chain: ref
        }));
      }
    }

    // ---- estilo ----
    function aplicaEstilo() {
      if (!viewer) {
        return;
      }

      const comSticks = document.getElementById('probis_sticks').checked;
      const comLinhas = document.getElementById('probis_lines').checked;
      const visiveis = cadeiasVisiveis();

      // esconde tudo e mostra apenas as cadeias visiveis: cartoon, mais as
      // linhas quando o usuario pedir
      viewer.setStyle({}, {});
      visiveis.forEach(function(chain) {
        const estilo = { cartoon: { color: cor(chain) } };
        if (comLinhas) {
          estilo.line = { color: cor(chain) };
        }
        viewer.setStyle({ chain: chain }, estilo);

        if (comSticks) {
          viewer.addStyle({ chain: chain }, {
            stick: { radius: 0.1, colorscheme: cor(chain) + 'Carbon' }
          });
        }
      });

      // residuos escolhidos viram sticks
      if (selecionados.length && campoChain.value) {
        viewer.addStyle({
          chain: campoChain.value,
          resi: selecionados
        }, {
          stick: { colorscheme: 'yellowCarbon', radius: 0.25 }
        });
      }

      aplicaRotulos();
      viewer.render();
    }

    // ---- selecao ----
    // Le o que estiver escrito no campo (aceita "7, 10-15") para destacar no 3D
    function leResiduosDoCampo() {
      const lista = [];
      String(campoResiduos.value).split(/[,;\s]+/).forEach(function(parte) {
        if (!parte) {
          return;
        }
        const faixa = parte.match(/^(\d+)\s*-\s*(\d+)$/);
        if (faixa) {
          for (let i = parseInt(faixa[1], 10); i <= parseInt(faixa[2], 10); i++) {
            lista.push(i);
          }
        } else if (/^\d+$/.test(parte)) {
          lista.push(parseInt(parte, 10));
        }
      });
      return lista;
    }

    function cliqueEmResiduo(atom) {
      const alvo = campoChain.value;

      if (!alvo) {
        campoChain.value = atom.chain; // primeiro clique define a cadeia alvo
      } else if (alvo !== atom.chain) {
        aviso.textContent = 'Residue ignored: it belongs to chain ' + atom.chain +
          ', and the target chain is ' + alvo + '.';
        return;
      }

      const pos = selecionados.indexOf(atom.resi);
      if (pos >= 0) {
        selecionados.splice(pos, 1); // clicar de novo remove
      } else {
        selecionados.push(atom.resi);
      }
      selecionados.sort(function(a, b) {
        return a - b;
      });

      // O campo espera numeros separados por virgula
      campoResiduos.value = selecionados.join(', ');
      aviso.textContent = selecionados.length +
        ' residue(s) selected in chain ' + campoChain.value +
        '. Click a residue again to remove it.';

      aplicaEstilo();
    }

    // ---- seletores de cadeia ----
    function preencheSeletores() {
      const cadeias = Object.keys(corDaCadeia);

      [campoChain, campoRef].forEach(function(seletor, i) {
        if (!seletor) {
          return;
        }
        const anterior = seletor.dataset.pendente || seletor.value;
        seletor.innerHTML = '';

        const vazia = document.createElement('option');
        vazia.value = '';
        vazia.textContent = (i === 0) ? 'Select a chain' : 'None';
        seletor.appendChild(vazia);

        cadeias.forEach(function(chain) {
          const op = document.createElement('option');
          op.value = chain;
          op.textContent = 'Chain ' + chain + ' (' + (residuosDaCadeia[chain] || 0) + ' residues)';
          seletor.appendChild(op);
        });

        // mantem a escolha anterior, quando ela existe nesta estrutura
        seletor.value = (cadeias.indexOf(anterior) >= 0) ? anterior : '';
        delete seletor.dataset.pendente;
      });
    }

    // ---- carga da estrutura ----
    function carrega(texto, rotulo) {
      if (!texto || texto.indexOf('ATOM') === -1) {
        aviso.textContent = 'Could not read coordinates from ' + rotulo + '.';
        return;
      }

      mostraViewer();

      if (!viewer) {
        viewer = $3Dmol.createViewer('probis_viewer', {
          defaultcolors: $3Dmol.rasmolElementColors
        });
        viewer.setBackgroundColor(0xffffff);
      }

      viewer.clear();
      rotulos = [];
      superficies = [];

      const modelo = viewer.addModel(texto, 'pdb');
      const atomos = modelo.selectedAtoms({});

      // cadeias, cores e numero de residuos de cada uma
      corDaCadeia = {};
      residuosDaCadeia = {};
      const vistos = {};
      let i = 0;
      atomos.forEach(function(a) {
        if (corDaCadeia[a.chain] === undefined) {
          corDaCadeia[a.chain] = cores[i % cores.length];
          residuosDaCadeia[a.chain] = 0;
          i++;
        }
        const chave = a.chain + ':' + a.resi;
        if (!vistos[chave]) {
          vistos[chave] = true;
          residuosDaCadeia[a.chain]++;
        }
      });

      legenda.innerHTML = Object.keys(corDaCadeia).map(function(chain) {
        return '<span class="me-2"><span style="display:inline-block;width:10px;height:10px;background:' +
          cor(chain) + ';border:1px solid #adb5bd"></span> ' + chain + '</span>';
      }).join('');

      preencheSeletores();

      // clique em qualquer atomo escolhe o residuo
      viewer.setClickable({}, true, function(atom) {
        cliqueEmResiduo(atom);
      });

      // mantem o que ja estiver escrito no campo (ex.: vindo de uma entrada)
      selecionados = leResiduosDoCampo();

      aplicaSuperficie();
      aplicaEstilo();
      viewer.zoomTo();
      viewer.render();

      aviso.textContent = rotulo + ': ' + Object.keys(corDaCadeia).length +
        ' chain(s). Click a residue to add it to the binding site list.';
    }

    function carregaDoRcsb(codigo) {
      aviso.textContent = 'Loading ' + codigo.toUpperCase() + ' from the RCSB PDB…';
      mostraViewer();

      fetch('https://files.rcsb.org/download/' + codigo.toUpperCase() + '.pdb')
        .then(function(r) {
          if (!r.ok) {
            throw new Error('not found');
          }
          return r.text();
        })
        .then(function(texto) {
          carrega(texto, codigo.toUpperCase());
        })
        .catch(function() {
          aviso.textContent = 'Could not download ' + codigo.toUpperCase() +
            ' from the RCSB PDB. Check the code or upload the structure.';
        });
    }

    // ---- eventos ----
    let espera = null;
    campoPdb.addEventListener('input', function() {
      const codigo = campoPdb.value.trim();
      clearTimeout(espera);
      if (codigo.length !== 4) {
        return;
      }
      campoArquivo.value = ''; // um ou outro
      espera = setTimeout(function() {
        carregaDoRcsb(codigo);
      }, 400);
    });

    campoArquivo.addEventListener('change', function() {
      const arquivo = this.files && this.files[0];
      if (!arquivo) {
        return;
      }
      campoPdb.value = ''; // um ou outro
      const leitor = new FileReader();
      leitor.onload = function(e) {
        carrega(e.target.result, arquivo.name);
      };
      leitor.readAsText(arquivo);
    });

    // Trocar a cadeia alvo muda o que e exibido e zera a selecao anterior
    campoChain.addEventListener('change', function() {
      selecionados = [];
      campoResiduos.value = '';
      if (viewer) {
        aplicaEstilo();
        viewer.zoomTo({ chain: this.value || undefined });
        viewer.render();
      }
    });

    if (campoRef) {
      campoRef.addEventListener('change', function() {
        if (viewer) {
          aplicaSuperficie();
          aplicaEstilo();
        }
      });
    }

    document.getElementById('probis_lines').addEventListener('change', aplicaEstilo);
    document.getElementById('probis_sticks').addEventListener('change', aplicaEstilo);
    document.getElementById('probis_labels').addEventListener('change', aplicaEstilo);

    document.getElementById('probis_clear_sel').addEventListener('click', function() {
      selecionados = [];
      campoResiduos.value = '';
      aviso.textContent = 'Click a residue to add its number to the binding site list.';
      aplicaEstilo();
    });

    // Editar o campo na mao tambem atualiza o destaque no 3D
    campoResiduos.addEventListener('input', function() {
      selecionados = leResiduosDoCampo();
      aplicaEstilo();
    });

    // API usada por outras paginas (ex.: o botao da pagina de uma entrada) para
    // abrir a busca ja preenchida. Chamada direta de proposito: eventos
    // sinteticos do jQuery (.trigger('input')) nao acionam listeners nativos.
    //   dados = {pdb, chain, residues, pdbText}
    window.probisPreencher = function(dados) {
      dados = dados || {};

      campoPdb.value = dados.pdb || '';
      campoArquivo.value = '';
      campoResiduos.value = dados.residues || '';

      // a cadeia so pode ser escolhida quando o select for preenchido, ao fim
      // da carga da estrutura
      if (dados.chain) {
        campoChain.dataset.pendente = dados.chain;
      }

      // modo "lista de residuos": desliga a cadeia de referencia
      const marcadorRef = document.getElementById('probis_use_ref');
      if (marcadorRef && marcadorRef.checked) {
        marcadorRef.checked = false;
        marcadorRef.dispatchEvent(new Event('change'));
      }

      if (dados.pdbText) {
        carrega(dados.pdbText, dados.pdb || 'structure'); // estrutura ja em maos
      } else if ((dados.pdb || '').length === 4) {
        carregaDoRcsb(dados.pdb);
      }
    };

    // O canvas precisa ser redimensionado quando o modal aparece
    const modalProbis = document.getElementById('probis');
    if (modalProbis) {
      modalProbis.addEventListener('shown.bs.modal', function() {
        if (viewer) {
          viewer.resize();
          viewer.render();
        }
      });
    }
  })();
</script>

<!-- MODAL: CITE -->
<div class="modal fade" tabindex="-1" id="cite-propedia" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <div class="text-center">
          <!-- <img width="150" class="me-3" src="<?php echo base_url('/img/logo_propedia.svg'); ?>"> -->
          <h3 class="orange mb-0 text-center">Please, cite Propedia in your publication</h3>
        </div>
        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <p class="small text-muted">We kindly ask that you cite both the original article and the most recent published article from the database. You can cite the other articles if you use data and functionalities from specific versions.</p>
        <label class="badge bg-dark mt-3">Original paper (2021)</label>
        <p class="small border p-2 rounded bg-light" id="browse1"> Martins, P.M., Santos, L.H., Mariano, D. et al. <strong>Propedia: a database for protein–peptide identification based on a hybrid clustering algorithm.</strong> BMC Bioinformatics 22, 1 (2021). doi: <a href="https://doi.org/10.1186/s12859-020-03881-z" target="_blank">10.1186/s12859-020-03881-z</a>
        </p>

        <label class="badge bg-dark mt-3">Propedia v2.3 (2023)</label>
        <p class="small border p-2 rounded bg-light" id="browse2"> Martins P, Mariano D, Carvalho FC, Bastos LL, Moraes L, Paixão V and Cardoso de Melo-Minardi R (2023). <strong>Propedia v2.3: A novel representation approach for the peptide-protein interaction database using graph-based structural signatures</strong>. Front. Bioinform. 3:1103103. doi: <a href="https://doi.org/10.3389/fbinf.2023.1103103" target="_blank">10.3389/fbinf.2023.1103103</a>
        </p>

        <label class="badge bg-dark mt-3">Propedia 26 (2026)</label>
        <p class="small border p-2 rounded bg-light" id="browse3"><em>In development.</em>
        </p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal cite -->