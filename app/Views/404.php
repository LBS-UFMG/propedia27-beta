<?= $this->extend('template') ?>
<?= $this->section('conteudo') ?>
<!-- Conteúdo personalizado -->

<div class="container py-5 text-secondary">

<div class="row">
    <div class="col-3">
        <img src="<?= base_url('/img/cocadito2.png') ?>" width="300px" class="rounded">
    </div>
    <div class="col">
    <h1 style="font-size:100px;">Error 404</h1>
    <p>Entry not found in Propedia.</p>
    <p><strong>A Propedia-ID has at least eight characters, <em>e.g.</em>, <a href="<?=base_url('/entry/1A1M-B-A')?>">1A1M-B-A</a></p>

    </div>
</div>
    
    

</div>

<!-- / FIM Conteúdo personalizado -->
<?= $this->endSection() ?>
