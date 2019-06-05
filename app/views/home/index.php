<?php use Core\FH;?>
<?php $this->start('body'); ?>
<?php
  $openClass = $this->hasFilters? " open" : "";
  $openIcon = $this->hasFilters ? "fa-chevron-left" : "fa-search";
?>
<div class="row">
<div class="col-lg-2 col-md-6 col-md-offset-3 col-lg-offset-0" style="margin-left: 30px ">
    <h1 class="text-center text-secondary w-100"><img src="<?=PROOT?>images/euro.png"><img src="<?=PROOT?>images/click.png">
        <br> Adaugă anunțul tău GRATUIT
    </h1>
      </div>
<div style=" margin-left: auto; margin-right: auto;">
    <div id="demo" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?=PROOT?>images/1.jpg" class="img-fluid" alt="Responsive image" style="max-width:1100px; max-height:300px;">
            </div>
            <div class="carousel-item">
                <img src="<?=PROOT?>images/2.jpg" class="img-fluid" alt="Responsive image" style="max-width:1100px; max-height:300px;">
            </div>
            <div class="carousel-item">
                <img src="<?=PROOT?>images/3.jpg" class="img-fluid" alt="Responsive image" style="max-width:1100px; max-height:300px;">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</div>
  <div class="col-lg-2 col-md-6 col-md-offset-3 col-lg-offset-0">
    </div>
</div>
    
<div class="d-flex two-column-wrapper open <?=$openClass?>" id="two-column-wrapper">
    <div class="col-lg-2 col-md-6 col-md-offset-3 col-lg-offset-0" style="padding: 30px; margin-left: 30px ">
        <aside>
            <form id="filter-form" action="" method="post" autocomplete="off">
                <div class="form-group">
                    <label class="sr-only" for="search">Caută</label>
                    <div class="input-group">
                        <input class="form-control" id="search" name="search" value="<?=$this->search?>" placeholder="Caută..." />
                        <button class="input-group-append btn btn-info"><i class="fas fa-search"></i></button>
                    </div>
                </div>

                <div class="row">
                    <?= FH::hiddenInput('page',$this->page)?>
                    <?= FH::selectBlock('Categorii','brand',$this->brand,$this->brandOptions,['class'=>'form-control form-control-sm'],['class'=>'form-group col-12'])?>
                    <?= FH::inputBlock('number','Preț minim','min_price',$this->min_price,['class'=>'form-control form-control-sm','step'=>'any'],['class'=>'form-group col-6'])?>
                    <?= FH::inputBlock('number','Preț maxim','max_price',$this->max_price,['class'=>'form-control form-control-sm','step'=>'any'],['class'=>'form-group col-6'])?>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-info w-100">Caută</button>
                    </div>
                </div>
            </form>
        </aside>
    </div>
    <main class="products-wrapper">
        <?php foreach($this->products as $product):
      $shipping = ($product->shipping == '0.00')? 'Transport gratuit!' : 'Transport: Lei '.$product->shipping;
      $list = ($product->list != '0.00')? 'Lei '.$product->list : '';
     ?>
        <div class="card">
            <img src="<?= PROOT .$product->url?>" class="card-img-top" alt="<?=$product->name?>">
            <div class="card-body">
                <h5 class="card-title"><a href="<?=PROOT?>products/details/<?=$product->id?>"><?=$product->name?></a></h5>
                <p class="products-brand">Categoria: <?=$product->brand?></p>
                <p class="card-text">Lei <?=$product->price?> <span class="list-price"><?=$list?></span></p>
                <p class="card-text"><?= $shipping?></p>
                <a href="<?=PROOT?>products/details/<?=$product->id?>" class="btn btn-primary">
                    Vezi detalii</a>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="d-flex justify-content-center align-items-center mt-3 w-100">
            <?php
        $disableBack = ($this->page == 1)? ' disabled="disabled"' : '';
        $disableNext = ($this->page == $this->totalPages)? ' disabled="disabled"' : '';
        ?>
            <button class="btn btn-light mr-3" <?=$disableBack?> onclick="pager('back')"><i class="fas fa-chevron-left"></i></button>
            <?=$this->page?> of <?=$this->totalPages?>
            <button class="btn btn-light ml-3" <?=$disableNext?> onclick="pager('next')"><i class="fas fa-chevron-right"></i></button>
        </div>
    </main>
    
     <div class="col-lg-2 col-md-6 col-md-offset-3 col-lg-offset-0">
         <div style="margin-top: 30px; margin-left: auto; margin-right: auto;">
    <div id="demo2" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li data-target="#demo2" data-slide-to="0" class="active"></li>
            <li data-target="#demo2" data-slide-to="1"></li>
            <li data-target="#demo2" data-slide-to="2"></li>
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?=PROOT?>images/4.jpg" class="img-fluid" alt="Responsive image" style="max-width:273px; max-height:458px;">
            </div>
            <div class="carousel-item">
                <img src="<?=PROOT?>images/5.jpg" class="img-fluid" alt="Responsive image" style="max-width:273px; max-height:458px;">
            </div>
            <div class="carousel-item">
                <img src="<?=PROOT?>images/6.jpg" class="img-fluid" alt="Responsive image" style="max-width:273px; max-height:458px;">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo2" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo2" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</div>
    </div>
    
</div>

<script>
    function toggleExpandFilters() {
        var wrapper = document.getElementById('two-column-wrapper');
        var toggleIcon = document.getElementById('toggleIcon');
        wrapper.classList.toggle('open');
        if (wrapper.classList.contains('open')) {
            toggleIcon.classList.remove('fa-search');
            toggleIcon.classList.add('fa-chevron-left');
        } else {
            toggleIcon.classList.remove('fa-chevron-left');
            toggleIcon.classList.add('fa-search');
        }
    }

    function pager(direction) {
        var form = document.getElementById('filter-form');
        var input = document.getElementById('page');
        var page = parseInt(input.value, 10);
        var newPageValue = (direction === 'next') ? page + 1 : page - 1;
        input.value = newPageValue;
        form.submit();
    }

    document.getElementById('filter-form').addEventListener('submit', function(evt) {
        var form = evt.target;
        evt.preventDefault();
        document.getElementById('page').value = 1;
        form.submit();
    });

    document.getElementById('expand-filters').addEventListener('click', toggleExpandFilters);

</script>
<?php $this->end(); ?>
