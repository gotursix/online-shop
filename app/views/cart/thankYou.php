<?php $this->setSiteTitle('Thank You!');?>

<?php $this->start('body')?>
<div class="row">
  <div class="col-md-8 offset-md-2 text-center">
    <h2 class="text-info">Mulțumim!</h2>
    <p>Achiziția dvs. de $<?=number_format($this->tx->amount,2)?> a avut succes.</p>
    <p>Achiziția dvs. va fi expediată la următoarea adresă.</p>
    <p>
      <?=$this->tx->name?> <br />
      <?= $this->tx->shipping_address1?> <br />
      <?php if($this->tx->shipping_address2):?>
        <?=$this->tx->shipping_address2?><br />
      <?php endif;?>
      <?=$this->tx->shipping_city?>, <?=$this->tx->shipping_state?> <?=$this->tx->shipping_zip?>
    </p>
    <a href="<?=PROOT?>" class="btn btn-lg btn-primary">Continuă</a>
  </div>
</div>
<?php $this->end()?>
