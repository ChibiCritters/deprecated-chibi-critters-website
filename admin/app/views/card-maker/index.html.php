<?php 
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
  include ROOT . "app/assets/includes/card_header.php"; 

  $webroot = WEB_ROOT;
?>
<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th>Name</th>
      <th>Effect</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
    foreach ($cards as $id => $card) {
      $cardId = $card->id;
      echo <<<HTML
        <tr>
          <td>{$card->name}</td>
          <td>{$card->effect}</td>
          <td>
            <a class="btn btn-primary" href="{$webroot}card-maker/cards/show/$cardId">View</a>
            <a class="btn btn-success" href="{$webroot}card-maker/cards/edit/$cardId">Edit</a>
            <a class="btn btn-danger" href="{$webroot}card-maker/cards/delete/$cardId">Delete</a>
          </td>
        </tr>
HTML;
    }
  ?>
  </tbody>
  
</table>
<?php 
  include ROOT . "app/assets/includes/card_footer.php"; 
?>