<?php $this->setSiteTitle("Add Product") ?>
<?php $this->start('head') ?>
  <script src='<?=PROOT?>vendor/tinymce/tinymce/tinymce.min.js'></script>
<?php $this->end() ?>

<?php $this->start('body') ?>
<div class="row align-items-center justify-content-center">
  <div class="col-md-8 bg-light p-3">
    <h1 class="text-center">Adaugă un nou produs</h1>
    <?php $this->partial('adminproducts','form') ?>
  </div>
</div>
<?php $this->end() ?>
