<?php
use Core\FH;
?>
<form action="<?=$this->formAction?>" method="POST" enctype="multipart/form-data">
  <?= FH::csrfInput();?>
  <?= FH::displayErrors($this->displayErrors)?>
  <div class="row">
    <?= FH::inputBlock('text','Nume anunț','name',$this->product->name,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
    <?= FH::inputBlock('text','Preț','price',$this->product->price,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-2'],$this->displayErrors) ?>
    <?= FH::inputBlock('text','Preț vechi','list',$this->product->list,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-2'],$this->displayErrors) ?>
    <?= FH::inputBlock('text','Transport','shipping',$this->product->shipping,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-2'],$this->displayErrors) ?>
    <?= FH::inputBlock('text','Nume','username',$this->product->username,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-2'],$this->displayErrors) ?>
    <?= FH::inputBlock('text','Email','email',$this->product->email,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-2'],$this->displayErrors) ?>
    <?= FH::inputBlock('text','Numarul de telefon','phone',$this->product->phone,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-2'],$this->displayErrors) ?>
    <?= FH::inputBlock('text','Județ','region',$this->product->region,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-2'],$this->displayErrors) ?>
    <?= FH::inputBlock('text','Oras','city',$this->product->city,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-2'],$this->displayErrors) ?>
    <?= FH::selectBlock('Categorie','brand_id',$this->product->brand_id,$this->brands,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-3'],$this->displayErrors) ?>
  </div>
  <div class="row">
    <?= FH::textareaBlock('Descriere - date de contact, adresă, stare etc.','body',$this->product->body,['class'=>'form-control','rows'=>'6'],['class'=>'form-group col-md-12'],$this->displayErrors) ?>
    <?= FH::checkboxBlock('Recomandat','featured',$this->product->isChecked(),['class'=>'form-controll'],['class'=>'form-group col-md-12'],$this->displayErrors) ?>
  </div>
  <div class="row">
    <?= FH::inputBlock('file',"Încarcă imaginea produsului:",'productImages[]','',['class'=>'form-control','multiple'=>'multiple'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
  </div>
  <div class="row">
    <?= FH::submitBlock('Salvează',['class'=>'btn btn-large btn-primary'],['class'=>'text-right col-md-12']); ?>
  </div>
</form>