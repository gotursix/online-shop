<?php $this->setSiteTitle("Shopping Cart"); ?>

<?php $this->start('body')?>
<h2>
Coșul de cumpărături (<?=$this->itemCount?> item<?=($this->itemCount == 1)?"" : "s"?>)</h2>
<hr />
<div class="row">
  <?php if(sizeof($this->items) == 0): ?>
    <div class="col col-md-8 offset-md-2 text-center">
      <h3>Coșul de cumpărături este gol!</h3>
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
          <a href="<?=PROOT?>products/details/<?=$item->id?>" title="<?=$item->name?>">
            <?=$item->name?>
          </a>
          <p>by <?=$item->brand?></p>
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
          <div>$<?=$item->price?></div>
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
      <a href="<?=PROOT?>cart/checkout/<?=$this->cartId?>" class="btn btn-lg btn-primary btn-block">
Continuați cu verificarea</a>
      <div class="cart-line-item">
        <div>Item<?=($this->itemCount == 1)?"" : "s"?> (<?=$this->itemCount?>)</div>
        <div>$<?=$this->subTotal?></div>
      </div>
      <div class="cart-line-item">
        <div>Livrare</div>
        <div>$<?=$this->shippingTotal?></div>
      </div>
      <hr />
      <div class="cart-line-item grand-total">
        <div>Total:</div>
        <div>$<?=$this->grandTotal?></div>
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
