<?= $this->extend('template') ?>
<?= $this->section('conteudo') ?>
<!-- Conteúdo personalizado -->

<div class="container-fluid">
   <div class="row">
      <div class="col-md-4 col-12">
         <p class="text-center mt-1 mb-1"><strong>Query</strong> <label class="badge bg-primary"><?= $pdb ?></label></p>
         <div id="3Dmol_query" style="min-height: 600px; width: 100%; position: relative;"></div>
      </div>
      <div class="col-md-4 col-12">
         <p class="text-center mt-1 mb-1"><strong>Subject</strong> <label class="badge bg-dark" id="sbj"><?= $results[0]['COMPLEX NAME'] ?></label></p>
         <div id="3Dmol_subject" style="min-height: 600px; width: 100%; position: relative;"></div>
      </div>
      <div class="col-md-4 col-12" style="overflow: auto; height: 1000px;">
         <div class="row">
            <div class="col-md-12">
               <div class="thumbnail" style="border-left: #001858ff 5px solid; color: #ccc; padding:20px">
                  <div class="caption">
                     <div class="row">
                        <h3 class="text-dark"><strong>Project ID:</strong> <a href='<?= base_url() ?>project/<?= $id ?>'><strong><?= $id ?></a></strong></h3>
                        <br>
                        <?php if ($status != 1) { ?>
                           <p><strong>Status</strong></p>
                           <p style="width: 400px; display: inline-block; word-wrap:break-word;" class="text-muted"><?= $log ?></p>
                        <?php } ?>

                        <style>
                        .spin {
                           display: inline-block;
                           animation: spin 2s linear infinite;
                        }

                        @keyframes spin {
                           from { transform: rotate(0deg); }
                           to { transform: rotate(360deg); }
                        }
                        </style>

                        <?php if ($status == 1) { ?>
                           <?php if ($is_running !== "ready"): ?>
                              <meta http-equiv="refresh" content="60">
                           <?php endif; ?>
                           <p class="mb-0 text-muted" style="width: 600px; display: inline-block; word-wrap:break-word;">
                              <strong>PDB: </strong><?= $pdb ?><br>
                              <strong>Chain: </strong><?= $chain ?>
                              <br>
                              <strong>Created: </strong><?= $created ?><br>
                              <strong>Residues: </strong><span class="small"><?= $residues ?></span><br>
                              <strong>Results: </strong><?= $cont_results ?><br>
                              <strong>Status: </strong><?= $is_running ?>
                           </p>

                        <?php } ?>

                        <input id="project_id" value="<?= $id ?>" hidden></input>
                        <input id="query_chain" value="<?= $chain ?>" hidden></input>
                        <input id="query_residues_list" value="<?= $residues ?>" hidden></input>
                        <input id="status" value="<?= $status ?>" hidden></input>

                     </div>
                  </div>
               </div>
            </div>
         </div>

         <?php if ($status == 1) { ?>
            <!-- <div class="row">
               <div class="col-md-4 col-sm-12">
                  <a class="btn btn-success btn-block" href='<?= base_url() . "public/probis/projects/" . $id . "/result.csv"; ?>'>
                  Result CSV&nbsp;<i class="fas fa-download"></i>
                  </a>
               </div>
               <div class="col-md-4 col-sm-12">
                  <a id="btn_download_selected" class="btn btn-info btn-block" href="#" data-toggle="modal" data-target="#modal_download_
selected">
                     Download complex&nbsp;<i class="fas fa-download"></i>
                  </a>                  
               </div>            
               <div class="col-md-4 col-sm-12">
                  <a id="btn_advanced_search" class="btn btn-warning btn-block" href="#" data-toggle="modal">
                     Advanced search&nbsp;<i class="fas fa-filter"></i>
                  </a>
               </div>
            </div> -->
            <div class="row">
               <div class="col-md-12">
                  <table id="dt_probis" class="table table-striped table-bordered">
                     <thead>
                        <tr class="tableheader">
                           <th class="dt-center"><i class="bi bi-eye-fill" title="View in 3dmol"></i></th>
                           <th class="dt-center">Complex</th>
                           <th class="dt-center">Alignment Score<sup></sup></th>
                           <th class="dt-center">RMSD<sup></sup></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($results as $r): ?>
                           <?php if (count($r) == 5): ?>
                              <tr>
                                 <!-- [0] COMPLEX NAME; [1] ALIGNMENT SCORE; [3] RMSD; [4] QUERY ALIGNED RESIDUES; [5] SUBJECT ALIGNED RESIDUES -->
                                 <td><input type="radio" name="compare" value="<?= $r['COMPLEX NAME'] ?>" data="<?= $r['SUBJECT ALIGNED RESIDUES'] ?>" <?php if($results[0]['COMPLEX NAME'] === $r['COMPLEX NAME']){echo 'checked'; }?>></td>
                                 <td><a href="<?= base_url("/entry/{$r['COMPLEX NAME']}") ?>" target="_blank"><?= $r['COMPLEX NAME'] ?></a></td>
                                 <td><?= round($r['ALIGNMENT SCORE'], 2) ?></td>
                                 <td><?= round($r['RMSD'], 2) ?></td>
                              </tr>
                           <?php endif; ?>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         <?php } ?>
      </div>
   </div>
</div>

<script>
   $(() => {
      const pdb_data = "<?= base_url("/data/projects/{$id}/{$pdb}.pdb") ?>";
      const residues_query = "<?= $residues ?>";
      const residues_array = residues_query.split(',').map(Number);
      const chain_query = "<?= $chain ?>";
      document.querySelectorAll('input[name="compare"]').forEach(radio => {
         radio.addEventListener('click', function() {
            let url = '<?= base_url("/data/db/pdb/") ?>' + this.value[0] + '/' + this.value + '.cif';
            let residues = this.getAttribute('data'); 
            residues = residues.split(',').map(Number);
            let cadeia_pep = this.value[5];
            load_subject(url, residues, cadeia_pep); // Quando clicado, chama a função
            $('#sbj').text(this.value)
         });
      });

      // Os dois viewers (Query e Subject) ficam ligados: girar, arrastar ou dar
      // zoom em um aplica a mesma camera no outro. Quem faz isso e o proprio
      // 3Dmol: linkViewer manda a view a cada render (ver linkedViewers em
      // js/3dmol.js). A ligacao e feita uma vez so, quando os dois existirem.
      let viewerQuery = null;
      let viewerSubject = null;
      let viewersLigados = false;

      function ligaViewers() {
         if (viewersLigados || !viewerQuery || !viewerSubject) {
            return;
         }
         viewerQuery.linkViewer(viewerSubject);
         viewerSubject.linkViewer(viewerQuery);
         viewersLigados = true;

         // Estado inicial: os dois partem do enquadramento do Query
         viewerSubject.setView(viewerQuery.getView(), true);
         viewerSubject.render();
      }

      function load_subject(pdb_data2, residues, cadeia_pep) {
         
         $.get(pdb_data2, function(d) {
            const data = d;
            // O viewer e criado uma vez so e reaproveitado nas trocas de subject:
            // criar outro a cada clique empilharia canvas no mesmo div e deixaria
            // a ligacao com o viewer do Query apontando para um viewer morto.
            const primeiraCarga = !viewerSubject;
            if (primeiraCarga) {
               viewerSubject = $3Dmol.createViewer("3Dmol_subject", {
                  defaultcolors: $3Dmol.rasmolElementColors
               });
               viewerSubject.setBackgroundColor(0xffffff);
            } else {
               viewerSubject.removeAllSurfaces();
               viewerSubject.removeAllLabels();
               viewerSubject.removeAllModels();
            }

            // Adiciona modelo
            const m = viewerSubject.addModel(data, "cif");   // subject = a db entry (mmCIF)

            // Cores e cadeias
            const colors = ["white", "orangered", "deepskyblue", "green", "purple", "cyan"];
            const atomsx = m.selectedAtoms({});
            const chains = [...new Set(atomsx.map(atom => atom.chain))];

            // Função utilitária debounce
            // const debounce = (fn, wait = 80) => {
            //    let t;
            //    return function(...args) {
            //       clearTimeout(t);
            //       t = setTimeout(() => fn.apply(this, args), wait);
            //    };
            // };

            // Função segura para remover todas as superfícies
            // function removeAllSurfacesSafe(viewer) {
            //    // Preferir método pronto, se existir
            //    if (typeof viewer.removeAllSurfaces === 'function') {
            //       viewer.removeAllSurfaces();
            //       return;
            //    }
            //    // Fallback: iterar sobre viewer.surfaces (se existir) e tentar remover
            //    if (Array.isArray(viewer.surfaces) && viewer.surfaces.length) {
            //       // copie a lista porque removeSurface pode mutar viewer.surfaces
            //       const existing = viewer.surfaces.slice();
            //       for (const s of existing) {
            //          try {
            //             // tentamos remover pelo objeto/handle — envolver em try para não quebrar
            //             viewer.removeSurface(s);
            //          } catch (err) {
            //             // Algumas versões esperam um índice ou outro formato; ignorar se falhar
            //             console.warn('removeSurface failed for', s, err);
            //          }
            //       }
            //    }
            // }

            // Função que (re)cria todas as superfícies com a opacidade passada
            function createSurfacesWithOpacity(opacity) {
               chains.forEach((chain, i) => {
                  const color = colors[i % colors.length];

                  if(chain == cadeia_pep){
                     viewerSubject.setStyle({ chain: chain }, { line: { color: 'orangered' }, cartoon: { color: color } });
                  }
                  else{
                     viewerSubject.setStyle({ chain: chain }, { cartoon: { color: color } });
            
                     // residues_array deve ser um array de números
                     viewerSubject.setStyle({
                        chain: chain,
                        resi: residues
                     }, {
                        line: {
                           colorscheme: 'greenCarbon'
                        },
                        cartoon: {
                           color: 'green'
                        }
                     });
                     viewerSubject.addSurface(
                        $3Dmol.SurfaceType.VDW, {
                           opacity: 0.7,
                           color: 'green'
                        }, {
                           chain: chain,
                           resi: residues
                        }
                     );
                  }
               });
            }
            const initialOpacity = parseFloat($('#opacityRange').val()) || 0;
            createSurfacesWithOpacity(initialOpacity);

            // restante: marca átomos como clicáveis etc.
            const atoms = m.selectedAtoms({});
            for (let i in atoms) {
               let atom = atoms[i];
               atom.clickable = true;
               atom.callback = atomcallback;
            }
            viewerSubject.mapAtomProperties($3Dmol.applyPartialCharges);
            // Nas trocas de subject a camera atual e mantida, senao o zoomTo
            // seria propagado para o viewer do Query e mexeria nele tambem
            if (primeiraCarga) {
               viewerSubject.zoomTo();
            }
            viewerSubject.render();

            ligaViewers();
         });
      }

      load_subject(
         '<?= base_url("/data/db/pdb/{$results[0]['COMPLEX NAME'][0]}/{$results[0]['COMPLEX NAME']}.cif") ?>',
         '<?=$results[0]['SUBJECT ALIGNED RESIDUES']?>'.split(',').map(Number), // residues
         '<?=$results[0]['COMPLEX NAME'][5]?>' // chain
      ); // carrega o primeiro item por padrão

      // QUERY -------------------------------------------------->
      $.get(pdb_data, function(d) {
         const data = d;
         // Cria viewer
         viewerQuery = $3Dmol.createViewer("3Dmol_query", {
            defaultcolors: $3Dmol.rasmolElementColors
         });
         viewerQuery.setBackgroundColor(0xffffff);

         // Adiciona modelo
         const m = viewerQuery.addModel(data, "pqr");

         // Cores e cadeias
         const colors = ["white"];
         const atomsx = m.selectedAtoms({});
         const chains = [...new Set(atomsx.map(atom => atom.chain))];

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

               // Estilo padrão cartoon + superfície
               viewerQuery.setStyle({
                  chain: chain
               }, {
                  cartoon: {
                     color: color
                  }
               });
               viewerQuery.addSurface($3Dmol.SurfaceType.VDW, {
                  opacity: opacity,
                  color: color
               }, {
                  chain: chain
               });

               // Se for a cadeia que queremos destacar os resíduos
               if (chain === chain_query) {
                  // residues_array deve ser um array de números
                  viewerQuery.setStyle({
                     chain: chain_query,
                     resi: residues_array
                  }, {
                     line: {
                        colorscheme: 'greenCarbon'
                     },
                     cartoon: {
                        color: 'green'
                     }
                  });
                  viewerQuery.addSurface(
                     $3Dmol.SurfaceType.VDW, {
                        opacity: 0.7,
                        color: 'green'
                     }, {
                        chain: chain_query,
                        resi: residues_array
                     }
                  );
               }
            });

            viewerQuery.render();
         }

         // Cria superfícies iniciais usando o valor atual do slider (fallback 0)
         const initialOpacity = parseFloat($('#opacityRange').val()) || 0;
         createSurfacesWithOpacity(initialOpacity);

         // restante: marca átomos como clicáveis etc.
         const atoms = m.selectedAtoms({});
         for (let i in atoms) {
            let atom = atoms[i];
            atom.clickable = true;
            atom.callback = atomcallback;
         }

         viewerQuery.mapAtomProperties($3Dmol.applyPartialCharges);
         viewerQuery.zoomTo();
         viewerQuery.render();

         ligaViewers();
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