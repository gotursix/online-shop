<?php
use App\Models\Users;
?>
<?php $this->setSiteTitle($this->product->name);?>
<?php $this->start('body');?>
<div class="row">
  <div class="col col-md-6 product-details-slideshow">
    <p>
      <a style="color: white" class="back-to-results btn btn-info ml-5" href="<?=PROOT?>home"><i class="fas fa-arrow-left "></i> 
Înapoi la rezultate</a>
    </p>
    <!-- slideshow -->
    <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php for($i = 0; $i < sizeof($this->images); $i++):
          $active = ($i == 0)? "active" : "";
          ?>
          <li data-target="#carouselIndicators" data-slide-to="<?=$i?>" class="<?=$active?>" style="background-color:#101820;"></li>
        <?php endfor;?>
      </ol>
      <div class="carousel-inner">
        <?php for($i = 0; $i < sizeof($this->images); $i++):
          $active = ($i == 0)? " active" : "";
          ?>
          <div class="carousel-item<?=$active?>">
            <img src="<?= PROOT.$this->images[$i]->url?>" class="d-block image-fluid" style="max-height:500px;margin:0 auto;" alt="<?=$this->product->name?>">
          </div>
        <?php endfor;?>
      </div>
      <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
        <span class="sr-only">Înapoi</span>
      </a>
      <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
        <span class="sr-only">Următorul</span>
      </a>
    </div>
  </div>

  <div class="col col-md-6">
    <h3><?= $this->product->name?></h3>
    <span class="product-details-label">Categoria:</span> <?=$this->product->getBrandName()?><br>
    <span class="product-details-label">Adaugat de: </span> <?=$this->product->username?><br>
    <span class="product-details-label">Nr. tel: </span> <?=$this->product->phone?><br>
    <span class="product-details-label">Email: </span> <?=$this->product->email?><Br>
    <span class="product-details-label">Oraș: </span> <?=$this->product->city?><Br>
    <span class="product-details-label">Județ: </span> <?=$this->product->city?><Br>

    <div>
      <span class="product-details-label">Preț: </span>
      <span class="product-details-price">Lei <?=$this->product->price?></span> <br>
      <?php if($this->product->shipping != 0):?>
        <span class="product-details-label">Transport: </span>
      <?php endif;?>
      <?=$this->product->displayShipping()?>
    </div>
    <hr />
    <div class="product-details-body"><?= html_entity_decode($this->product->body)?></div>
    <div>
      <?php if( Users::currentUser()!=NULL ): ?>
      <a href="<?=PROOT?>cart/addToCart/<?=$this->product->id?>" class="btn btn-info">
        <i class="fas fa-cart-plus"></i> 
Adaugă la favorite
      </a>
    <?php endif;?>
    </div>
  </div>
</div>

<?php $this->end(); ?>
