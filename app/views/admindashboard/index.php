<?php
  use Core\H;
?>
<?php $this->start('head')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
<script type="text/javascript" src="<?=PROOT?>js/moment.min.js?v=<?=VERSION?>"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<?php $this->end()?>

<?php //H::dnd($this); ?>

<?php $this->start('body')?>
<?php
$deleted = 0;
    foreach($this->products as $product)
       if($product->deleted == 1)
        $deleted++;

?>
<br>
<div class="container">
    <div class="row">
        <br><br><br>
        <h1>Anunțuri permise</h1>
        <hr />
                <table class="table table-bordered table-hover table-striped table-sm">
            <thead>
                <th>Nume</th>
                <th>Preț</th>
                <th>Transport</th>
                <th></th>
            </thead>
            <tbody>
                <?php foreach($this->products as $product): ?>
                 <?php if($product->deleted == 0): ?>
                <tr data-id="<?=$product->id?>">
                    <td><?=$product->name ?></td>
                    <td><?=$product->price ?></td>
                    <td><?=$product->shipping ?></td>
                    <td class="text-right">
                    <a class="btn btn-sm btn-danger" href="#" onclick="deleteProduct('<?=$product->id?>');return false;"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                 <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
    <?php $this->end(); ?>
