<?php $this->setSiteTitle("Favorite"); ?>

<?php $this->start('body')?>
<h2>
Obiecte favorite (<?=$this->itemCount?> rezultate<?=($this->itemCount == 1)?"" : " "?>)</h2>
<hr />
<div class="row">
  <?php if(sizeof($this->items) == 0): ?>
    <div class="col col-md-8 offset-md-2 text-center">
      <h3>Nici un obiect adăugat!</h3>
      <a href="<?=PROOT?>" class="btn btn-lg btn-info">Continuă cumpărăturile</a>
    </div>
<?php else: ?>
  <div class="col col-md-8">
    <?php foreach($this->items as $item):
      $shipping = ($item->shipping == 0)? "Transport gratuit!" : "Transport: Lei " . $item->shipping;
      ?>
      <div class="shopping-cart-item">
        <div class="shopping-cart-item-img">
          <img src="<?=PROOT. $item->url?>" alt="<?=$item->name?>">
        </div>
        <div class="shopping-cart-item-name">
          <a href="<?=PROOT?>products/details/<?=$item->product_id?>" title="<?=$item->name?>">
            <?=$item->name?>
          </a>
          <p>Categoria: <?=$item->brand?></p>
        </div>

        <div class="shopping-cart-item-qty">
          <label>Cantitate</label>
          <?php if($item->qty > 1): ?>
            <a href="<?=PROOT?>cart/changeQty/down/<?=$item->id?>"><i class="fas fa-chevron-down"></i></a>
          <?php endif;?>
          <input class="form-control form-control-sm" readonly value="<?=$item->qty?>"/>
          <a href="<?=PROOT?>cart/changeQty/up/<?=$item->id?>"><i class="fas fa-chevron-up"></i></a>
        </div>

        <div class="shopping-cart-item-price">
          <div>Lei <?=$item->price?></div>
          <div class="shipping"><?=$shipping?></div>
          <div class="remove-item" onclick="confirmRemoveItem('<?=PROOT?>cart/removeItem/<?=$item->id?>')">
            <i class="fas fa-trash-alt"></i> Șterge
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>

  <aside class="col col-md-4 ">
    <div class="shopping-cart-summary">
      <div class="cart-line-item">
        <div>Produs<?=($this->itemCount == 1)?"" : "e"?> (<?=$this->itemCount?>)</div>
        <div>Lei <?=$this->subTotal?></div>
      </div>
      <div class="cart-line-item">
        <div>Livrare</div>
        <div>Lei <?=$this->shippingTotal?></div>
      </div>
      <hr />
      <div class="cart-line-item grand-total">
        <div>Total:</div>
        <div>Lei <?=$this->grandTotal?></div>
      </div>
    </div>
  </aside>
<?php endif; ?>
</div>

<script>
  function confirmRemoveItem(href){
    if(confirm("Sunteți sigur?")){
      window.location.href = href;
    }
    return false;
  }
</script>
<?php $this->end()?>
