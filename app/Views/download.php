<?= $this->extend('template') ?>
<?= $this->section('conteudo') ?>
<!-- Conteúdo personalizado -->

<div class="container-fluid py-4">

    <h1 class="pb-4 text-dark"><strong>Download</strong></h1>

    <hr>

    <h2 class="text-success mt-5">Propedia v26 <label class="badge bg-success">New</label></h2>

    <table class="table table-hover table-striped mb-5">
         <thead>
            <tr class="table-success">
               <th>File</th>
               <th class="text-end">Entries (<em>n</em>)</th>
               <th>Description</th>
               <th>File size</th>
               <th>Download</th>
            </tr>
         </thead>
         <tbody>
            <tr style="font-weight: bold">
               <td>Propedia 26 - PDB complexes</td>
               <td class="text-end">73,392</td>
               <td>ZIP</td>
               <td>3.2GB</td>
               <td><a target="_blank" href="https://doi.org/10.5281/zenodo.21558188">propedia_26.zip</a></td>
            </tr> 
            <tr>
               <td>Propedia 26 - descriptions</td>
               <td class="text-end">73,392</td>
               <td>CSV</td>
               <td>69MB</td>
               <td><a target="_blank" href="<?=base_url('/data/propedia26_v17.csv')?>">propedia_26.csv</a></td>
            </tr>

            <tr>
               <td>Propedia 26 - only peptides</td>
               <td class="text-end">15,356</td>
               <td>ZIP</td>
               <td>52MB</td>
               <td><a target="_blank" href="<?=base_url('/data/db/peptides_pdb.zip')?>">peptides_pdb.zip</a></td>
            </tr>
            
            <tr>
               <td>Propedia26 Multipro - PDB files</td>
               <td class="text-end">19,759</td>
               <td>ZIP</td>
               <td>2.3GB</td>
               <td><a target="_blank" href="<?=base_url('/data/db/multipro_v7.zip')?>">multipro.zip</a></td>
            </tr>  
            <tr>
               <td>Propedia26 Multipro - descriptions</td>
               <td class="text-end">19,759</td>
               <td>CSV (v5)</td>
               <td>33MB</td>
               <td><a target="_blank" href="<?=base_url('/data/multipro_v5.csv')?>">multipro.csv</a></td>
            </tr>  

            <tr>
               <td>Sequence signatures</td>
               <td class="text-end">17,018</td>
               <td>ZIP</td>
               <td>10MB</td>
               <td><a target="_blank" href="<?=base_url('/data/sequence_signature.zip')?>">sequence_signature.zip</a></td>
            </tr>  
            <tr>
               <td>Structural signatures</td>
               <td class="text-end">15,344</td>
               <td>ZIP</td>
               <td>16MB</td>
               <td><a target="_blank" href="<?=base_url('/data/structural_signature.zip')?>">structural_signature.zip</a></td>
            </tr>  

            <tr>
               <td>Clusters</td>
               <td class="text-end">12</td>
               <td>ZIP</td>
               <td>2MB</td>
               <td><a target="_blank" href="<?=base_url('/data/clusters.zip')?>">clusters.zip</a></td>
            </tr>  
         </tbody>
    </table>
    
    <br class="my-5 py-5">
    <hr class="my-5 py-5">

    <div id="download" class="bg-light p-5 border rounded">
        <h2 class="text-center"><strong>Propedia Legacy</strong></h2>
    <p class="text-muted small text-center pb-4">Download old versions of Propedia (we do not provide support).</p>
   <h3 class="text-danger">Propedia v2.3 <label class="badge bg-danger">Legacy</label></h3>
      <table class="table table-hover table-striped">
         <thead>
            <tr class="table-danger">
               <th>File</th>
               <th>Description</th>
               <th>File size</th>
               <th>Download</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Peptides (28,581)</td>
               <td>PDB file (zip)</td>
               <td>97MB</td>
               <td><a target="_blank" href="https://bioinfo.dcc.ufmg.br/propedia2/public/download/peptides2_3.zip">peptides2_3.zip</a></td>
            </tr>          
            
            <tr>
               <td>Receptors (35,478)</td>
               <td>PDB file (zip)</td>
               <td>1.6GB</td>
               <td><a target="_blank" href="https://bioinfo.dcc.ufmg.br/propedia2/public/download/receptor2_3.zip">repeceptor2_3.zip</a></td>
            </tr>      

            <tr>
               <td>Complexes (49,300)</td>
               <td>PDB file (zip)</td>
               <td>2.4GB</td>
               <td><a target="_blank" href="https://bioinfo.dcc.ufmg.br/propedia2/public/download/complex2_3.zip">complex2_3.zip</a></td>
            </tr>      

            <tr>
               <td>Interfaces (49,300)</td>
               <td>PDB file (zip)</td>
               <td>391MB</td>
               <td><a target="_blank" href="https://bioinfo.dcc.ufmg.br/propedia2/public/download/interfaces2_3.zip">interfaces2_3.zip</a></td>
            </tr>     
            
            <tr>
               <td>Sequences</td>
               <td>FASTA file (zip)</td>
               <td>38MB</td>
               <td><a target="_blank" href="https://bioinfo.dcc.ufmg.br/propedia2/public/download/sequences2_3.zip">sequences2_3.zip</a></td>
            </tr>     
<tr><td>Structural signatures (case study 1 and 2)</td>
<td>CSV file (zip)</td>
<td>14MB</td>
<td><a target="_blank" href="https://bioinfo.dcc.ufmg.br/propedia2/public/download/peptides_signature.zip">peptides_signature.zip</a></td>
</tr>         </tbody>
      </table>

      <hr class="my-5">
      
      <h3 class="text-warning">Propedia v1 <label class="badge bg-warning">Legacy</label></h3>
      <h4>Download CSV File</h4>
      <table class="table table-hover table-striped">
         <thead>
            <tr class="table-warning">
               <th>File</th>
               <th>Description</th>
               <th>File size</th>
               <th>Download</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Complexes</td>
               <td>CSV file<br>
                  <!--<code>PDB</code><code>Protein Name</code><code>Resolution</code><code>Classification</code><code>Peptide Chain</code><code>Peptide Size</code><code>Peptide Sequence</code><code>Peptide Description</code><code>Peptide Organism</code><code>Peptide Interface Area</code><code>Peptide Molecular Weight</code><code>Peptide Aromaticity</code><code>Peptide Instability</code><code>Peptide Isoelectric Point</code><code>Receptor Chain</code><code>Receptor Size</code><code>Receptor Sequence</code><code>Receptor Description</code><code>Receptor Organism</code><code>Receptor Interface Area</code><code>Receptor Molecular Weight</code><code>Receptor Aromaticity</code><code>Receptor Instability</code><code>Receptor Isoelectric Point</code><code>Sequence Cluster</code><code>Is Sequence Cluster Centroid</code><code>Interface Cluster</code><code>Is Interface Cluster Centroid</code><code>Binding Cluster</code><code>Is Binding Cluster Centroid</code>-->
               </td>
               <td>12M</td>
               <td><a target="_blank" href="https://bioinfo.dcc.ufmg.br/propedia2/public/download/complex.csv">complex.csv</a></td>
            </tr>            
         </tbody>
      </table>
      <h4>Download PDB Files</h4>
      <table class="table table-hover table-striped">
         <thead>
            <tr class="table-warning">
               <th>File</th>
               <th>Description</th>
               <th>File size</th>
               <th>Download</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Complexes</td>
               <td>PDB format</td>
               <td>860M</td>
               <td><a target="_blank" href="https://bioinfo.dcc.ufmg.br/propedia2/public/download/complex.zip">complex.zip</a>
            </td></tr>
            <tr>
               <td>Peptides</td>
               <td>PDB format</td>
               <td>43M</td>
               <td><a target="_blank" href="https://bioinfo.dcc.ufmg.br/propedia2/public/download/peptide.zip">peptide.zip</a>
            </td></tr>
            <tr>
               <td>Receptors</td>
               <td>PDB format</td>
               <td>592M</td>
               <td><a target="_blank" href="https://bioinfo.dcc.ufmg.br/propedia2/public/download/receptor.zip">receptor.zip</a>
            </td></tr>
            <tr>
               <td>Interfaces</td>
               <td>PDB format</td>
               <td>55M</td>
               <td><a target="_blank" href="https://bioinfo.dcc.ufmg.br/propedia2/public/download/interface.zip">interface.zip</a>
            </td></tr>
         </tbody>
      </table>
      <h4>Download Fasta Files</h4>
      <table class="table table-hover table-striped">
         <thead>
            <tr class="table-warning">
               <th>File</th>
               <th>Description</th>
               <th>File size</th>
               <th>Download</th>
            </tr>
         </thead>
        <tbody>
            <tr>
               <td>Peptides</td>
               <td>Fasta format</td>
               <td>2.2M</td>
               <td><a target="_blank" href="https://bioinfo.dcc.ufmg.br/propedia2/public/download/peptide.fasta">peptide.fasta</a></td>
            </tr>
        </tbody>
         <tbody>
            <tr>
               <td>Receptors</td>
               <td>Fasta format</td>
               <td>6.5M</td>
               <td><a target="_blank" href="https://bioinfo.dcc.ufmg.br/propedia2/public/download/receptor.fasta">receptor.fasta</a>
            </td></tr>
        </tbody>        
      </table>
      <h4>Download Database (MySQL)</h4>
      <table class="table table-hover table-striped">
         <thead>
            <tr class="table-warning">
               <th>File</th>
               <th>Description</th>
               <th>File size</th>
               <th>Download</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Database File</td>
               <td>SQL format</td>
               <td>54M</td>
               <td><a target="_blank" href="https://bioinfo.dcc.ufmg.br/propedia2/public/download/propedia.sql">propedia.sql</a>
            </td></tr>
        </tbody> 
      </table>
   </div>

</div>
<!-- / FIM Conteúdo personalizado -->
<?= $this->endSection() ?>
