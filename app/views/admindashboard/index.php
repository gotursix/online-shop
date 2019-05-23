<?php
  use Core\H;
?>
<?php $this->start('head')?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
  <script type="text/javascript" src="<?=PROOT?>js/moment.min.js?v=<?=VERSION?>"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<?php $this->end()?>

<?php //H::dnd($this->users); ?>

<?php $this->start('body')?>

<br><h1>Allow users to forum</h1><hr /><br> 

<table class="table table-bordered table-hover table-striped table-sm text-center">
  <thead>
    <th>Created at</th>
    <th>Username</th>
    <th>Email</th>
    <th>First name</th>
    <th>Last name</th>
    <th>Rank</th>
    <th></th>
  </thead>
  <tbody>
    <?php foreach($this->users as $user): ?>
      <?php if($user->acl !='["SuperAdmin"]'): ?>
      <tr data-id="<?=$user->id?>">
        <td><?=$user->created_at ?></td>
        <td><?=$user->username ?></td>
        <td><?=$user->email ?></td>
        <td><?=$user->fname ?></td>
        <td><?=$user->lname ?></td>
        <?php if($user->acl =='["User"]'): ?>
          <td><p class="text-important">Allowed</p></td>
          <?php else: ?>
          <td><p class="text-danger">Denied</p></td>
         <?php endif; ?>
        <td class="text-center">
          <a class="btn btn-sm btn-secondary mr-1" href="<?=PROOT?>admindashboard/changerank/<?=$user->id?>"><i class="fas fa-edit"></i></a>   
        </td>
      </tr>

      <?php endif; ?>
    <?php endforeach; ?>
  </tbody>
</table>


<br><br><br><br><br><br><h1>Allow announces</h1><hr /><br> 

<?php $this->end(); ?>