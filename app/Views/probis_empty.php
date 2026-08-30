<?= $this->extend('template') ?>
<?= $this->section('conteudo') ?>
<!-- Conteúdo personalizado -->

<?php $ready = ($is_running === 'ready'); ?>

<?php if (!$ready): ?>
   <meta http-equiv="refresh" content="60">
<?php endif; ?>

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

<div class="container py-5 text-secondary">

   <div class="row align-items-center">
      <div class="col-md-3 col-12 text-center">
         <img src="<?= base_url('/img/cocadito2.png') ?>" width="250px" class="rounded img-fluid">
      </div>
      <div class="col-md-9 col-12">

         <?php if ($ready): ?>

            <h1>No results found</h1>
            <p class="lead">The binding site search did not return any similar binding site in Propedia 26.</p>
            <p>
               ProBiS compared the binding site you submitted against the non-redundant set of protein-peptide
               complex surfaces stored in Propedia. An empty result means that none of them reached the minimum
               structural similarity required by the algorithm.
            </p>

            <p class="mb-1"><strong>What you can try:</strong></p>
            <ul>
               <li>Check whether chain <strong><?= esc($chain) ?></strong> is the one that actually contains the binding site.</li>
               <li>Confirm that the residue numbers follow the numbering used in the PDB file <strong><?= esc($pdb) ?></strong>.</li>
               <li>Submit a larger set of residues &mdash; very small sites rarely produce significant structural alignments.</li>
               <li>Search by sequence instead, using the BLAST engine.</li>
            </ul>

            <p class="mt-4">
               <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#probis">New binding site search</a>
               <a href="#" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#blast">Search by sequence</a>
               <a href="<?= base_url('/explore') ?>" class="btn btn-outline-secondary">Explore Propedia</a>
            </p>

         <?php else: ?>

            <h1><i class="bi bi-gear-fill spin text-primary"></i> Search in progress</h1>
            <p class="lead">No similar binding site has been found so far.</p>
            <p>
               This page reloads automatically every 60 seconds. You can also come back later using the
               project link below &mdash; the search keeps running on our server.
            </p>

         <?php endif; ?>

      </div>
   </div>

   <div class="row mt-4">
      <div class="col-md-12">
         <div class="thumbnail" style="border-left: #001858ff 5px solid; padding:20px">
            <h5 class="text-dark"><strong>Project ID:</strong> <a href="<?= base_url('/project/' . $id) ?>"><?= esc($id) ?></a></h5>
            <p class="mb-0 text-muted small">
               <strong>PDB: </strong><?= esc($pdb) ?><br>
               <strong>Chain: </strong><?= esc($chain) ?><br>
               <strong>Created: </strong><?= esc($created) ?><br>
               <strong>Residues: </strong><?= esc($residues) ?><br>
               <strong>Results: </strong><?= (int) $cont_results ?><br>
               <strong>Status: </strong><?= $is_running ?>
            </p>
         </div>
      </div>
   </div>

</div>

<!-- / FIM Conteúdo personalizado -->
<?= $this->endSection() ?>
