<?php use Core\FH;?>

<?php $this->start('body')?>
  <div class="row">
    <div class="col-md-8">
      <h3>Detaliile de cumpărare</h3>
      <form action="<?=PROOT?>cart/checkout/<?=$this->cartId?>" method="post">
        <?=FH::csrfInput()?>
        <div class="row">
          <input type="hidden" name="step" value="1" />
          <?=FH::inputBlock('input','Nume','name',$this->tx->name,['class'=>'form-control form-control-sm'],['class'=>'form-group col-md-12'],$this->formErrors)?>
          <?=FH::inputBlock('input','Adresa de transport
','shipping_address1',$this->tx->shipping_address1,['class'=>'form-control form-control-sm'],['class'=>'form-group col-md-12'],$this->formErrors)?>
          <?=FH::inputBlock('input','Adresa de contact','shipping_address2',$this->tx->shipping_address2,['class'=>'form-control form-control-sm'],['class'=>'form-group col-md-12'],$this->formErrors)?>
          <?=FH::inputBlock('input','Oraș','shipping_city',$this->tx->shipping_city,['class'=>'form-control form-control-sm'],['class'=>'form-group col-md-6'],$this->formErrors)?>
          <?=FH::inputBlock('input','Țară','shipping_state',$this->tx->shipping_state,['class'=>'form-control form-control-sm'],['class'=>'form-group col-md-3'],$this->formErrors)?>
          <?=FH::inputBlock('input','Cod poștal','shipping_zip',$this->tx->shipping_zip,['class'=>'form-control form-control-sm'],['class'=>'form-group col-md-3'],$this->formErrors)?>
        </div>
        <button class="btn btn-lg btn-primary">Continuă</button>
      </form>
    </div>

    <div class="col-md-4"><?php $this->partial('cart','product_preview')?></div>
  </div>
<?php $this->end() ?>
