<?php
use Core\FH;
?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="row align-items-center justify-content-center">
  <div class="col-md-6 bg-light p-3">
    <h3 class="text-center">Înregistrează-te</h3><hr>
    <form class="form" action="" method="post">
      <?= FH::csrfInput() ?>
      <?= FH::inputBlock('text','Nume','fname',$this->newUser->fname,['class'=>'form-control input-sm'],['class'=>'form-group'],$this->displayErrors) ?>
      <?= FH::inputBlock('text','Prenume','lname',$this->newUser->lname,['class'=>'form-control input-sm'],['class'=>'form-group'],$this->displayErrors) ?>
      <?= FH::inputBlock('text','Email','email',$this->newUser->email,['class'=>'form-control input-sm'],['class'=>'form-group'],$this->displayErrors) ?>
      <?= FH::inputBlock('text','Nume de utilizator','username',$this->newUser->username,['class'=>'form-control input-sm'],['class'=>'form-group'],$this->displayErrors) ?>
      <?= FH::inputBlock('password','Parolă','password',$this->newUser->password,['class'=>'form-control input-sm'],['class'=>'form-group'],$this->displayErrors) ?>
      <?= FH::inputBlock('password','Reintroduceți parola','confirm',$this->newUser->confirm,['class'=>'form-control input-sm'],['class'=>'form-group'],$this->displayErrors) ?>
      <div class="d-flex justify-content-end">
        <div class="text-dk flex-grow-1">Aveți deja un cont? <a href="<?=PROOT?>register/login">Conectează-te</a></div>
        <?= FH::submitTag('Înregistrează-te',['class'=>'btn btn-primary']) ?>
      </div>
    </form>
  </div>
</div>
<?php $this->end(); ?>
