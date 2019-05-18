<?php use Core\FH;?>
<?php $this->start('body'); ?>
<div class="d-flex two-column-wrapper" id="two-column-wrapper">
  <div id="expand-filters">
    <i id="toggleIcon" class="fas fa-search"></i>
  </div>
<aside class="filters-wrapper">
  <form action="" method="post" autocomplete="off">
    <div class="form-group">
      <label class="sr-only" for="search">Searach</label>
      <div class="input-group">
        <input class="form-control" id="search" name="search" value="<?=$this->search?>" placeholder="Search..."/>
        <button class="input-group-append btn btn-info"><i class="fas fa-search"></i></button>
      </div>
    </div>
    <div class="row">
      <?= FH::selectBlock('Brand','brand',$this->brand,$this->brandOptions,['class'=>'form-control form-control-sm'],['class'=>'form-group col-12'])?>
      <?= FH::inputBlock('number','Price Min','min_price',$this->min_price,['class'=>'form-control form-control-sm','step'=>'any'],['class'=>'form-group col-6'])?>
      <?= FH::inputBlock('number','Price Max','max_price',$this->max_price,['class'=>'form-control form-control-sm','step'=>'any'],['class'=>'form-group col-6'])?>
    </div>
    <div class="row">
      <div class="col-12">
        <button class="btn btn-info w-100">Search</button>
      </div>
    </div>
  </form>
</aside>
<main class="products-wrapper">
  <h1 class="text-center text-secondary w-100">Welcome to Ruah MVC Framework!</h1>
  <?php foreach($this->products as $product):
    $shipping = ($product->shipping == '0.00')? 'Free Shipping!' : 'Shipping: $'.$product->shipping;
    $list = ($product->list != '0.00')? '$'.$product->list : '';
   ?>
    <div class="card">
      <img src="<?= PROOT .$product->url?>" class="card-img-top" alt="<?=$product->name?>">
      <div class="card-body">
        <h5 class="card-title"><a href="<?=PROOT?>products/details/<?=$product->id?>"><?=$product->name?></a></h5>
        <p class="products-brand">By: <?=$product->brand?></p>
        <p class="card-text">$<?=$product->price?> <span class="list-price"><?=$list?></span></p>
        <p class="card-text"><?= $shipping?></p>
        <a href="<?=PROOT?>products/details/<?=$product->id?>" class="btn btn-primary">See Details</a>
      </div>
    </div>
  <?php endforeach; ?>
</main>
</div>

<script>
  function toggleExpandFilters(){
    var wrapper = document.getElementById('two-column-wrapper');
    var toggleIcon = document.getElementById('toggleIcon');
    wrapper.classList.toggle('open');
    if(wrapper.classList.contains('open')){
      toggleIcon.classList.remove('fa-search');
      toggleIcon.classList.add('fa-chevron-left');
    } else{
      toggleIcon.classList.remove('fa-chevron-left');
      toggleIcon.classList.add('fa-search');
    }
  }
  document.getElementById('expand-filters').addEventListener('click',toggleExpandFilters);
</script>
<?php $this->end(); ?>
