<?= $this->extend('template') ?>
<?= $this->section('conteudo') ?>
<!-- Conteúdo personalizado -->

<div class="container-fluid px-4">

	<div id="download">
        <div class="row">
            <div class="col">
		        <h2 class="mt-4"><strong>BLAST results</strong></h2>
            </div>
            <div class="col text-end">
                <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#blast" >New search</button>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6 col-sm-12">
                <h5 class="badge bg-secondary mb-0"><strong>Query sequence:</strong></h5>
                <pre class="border rounded p-2" style="width: 600px; display: inline-block; word-wrap:break-word;"><?php echo $sequence; ?></pre>
            </div>

        <table id="table_search" class="table table-hover table-striped mt-3">
            <thead>
                <tr class="table-secondary">
                    <th class="col-md-1">Subject</th>
                    <th>Similar region in the sequence</th>
                    <th>Length</th>                    
                    <th>Score</th>    
                    <th>Coverage</th>
                    <th class="col-md-2">Identity</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($result as $r){
                    $nome = explode("|",$r[1]);
                ?>
                <tr>
                    <td><a href="<?php echo base_url().'entry/'.$nome[0]; ?>"><strong><?php echo strtoupper($nome[0]); ?></strong></a></td>

                    <td><pre class="mb-0"><?php echo $r[12]; ?></pre></td>     

                    <td><?php echo $r[4]; ?></td>                    
                    <td><?php echo $r[3]; ?></td>
                    <td>
                        <?php $scov = 1+(100*($r[6]-$r[5]+1)/$r[4]); ?>                        
                        <?php $qcov = 1+(100*($r[9]-$r[8]+1)/$r[7]); ?>
                        <?php $pos = (100*$r[11]/$r[7]); ?>

                        <label class="badge bg-secondary">Subject: <span class="badge bg-<?= (intval($scov) - 1 > 95) ? 'primary' : 'dark'; ?>"><?php echo intval($scov)-1; ?>%</span></label>
                        | <label class="badge bg-secondary">Query: <span class="badge bg-<?= (intval($qcov) - 1 > 95) ? 'primary' : 'dark'; ?>"><?php echo intval($qcov)-1; ?>%</span></label>
                    </td>
                    <td>                 
                        <div class="progress" style="height: 25px; margin-bottom: 5px">
                          <div class="progress-bar bg-success" style="width: <?php echo $r[2]; ?>%; padding-top:2px"><?php echo (int)$r[2]; ?>%</div>
                          <div class="progress-bar bg-dark" style="width: <?php echo 100-$r[2]; ?>%"></div>
                        </div>
                    </td>     
                </tr>
                <?php } ?>           
                
            </tbody>
			
        </table>
        <?php if(empty($result)){ echo '<span>No result found. Try doing a substring search using the <a href="'.base_url('/explore?q='.trim($sequence)).'">Explore module</a> <a class="badge bg-dark" href="#" data-bs-placement="bottom" data-bs-toggle="tooltip" data-bs-title="BLAST may not be very efficient at finding peptides that have at least 5 identical residues (parameters used for peptides search: -word_size 2 -task blastp-short -seg no -evalue 100000). Therefore, a substring search may find more results (although it may return a higher number of false positives).">?</a>.</span>'; }    ?>
    </div>
</div>

</div>
<!-- / FIM Conteúdo personalizado -->
<?= $this->endSection() ?>
