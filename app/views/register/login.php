<?php
use Core\FH;
?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="row align-items-center justify-content-center">
    <div class="col-md-6 bg-light p-3">
    <h3 class="text-center">Conectează-te</h3>
    <form class="form" action="<?=PROOT?>register/login" method="post">
      <?= FH::csrfInput() ?>
      <?= FH::displayErrors($this->displayErrors) ?>
      <?= FH::inputBlock('text','Nume de utilizator','username',$this->login->username,['class'=>'form-control'],['class'=>'form-group'],$this->displayErrors) ?>
      <?= FH::inputBlock('password','Parolă','password',$this->login->password,['class'=>'form-control'],['class'=>'form-group'],$this->displayErrors) ?>
      <?= FH::checkboxBlock('Reține datele','remember_me',$this->login->getRememberMeChecked(),[],['class'=>'form-group'],$this->displayErrors) ?>
      <div class="d-flex justify-content-end">
        <div class="flex-grow-1 text-body">Nu aveți un cont? <a href="<?=PROOT?>register/register">Înregistrează-te</a></div>
        <?= FH::submitTag('Login',['class'=>'btn btn-primary']) ?>
      </div>
    </form>
  </div>
</div>
<?php $this->end(); ?>
