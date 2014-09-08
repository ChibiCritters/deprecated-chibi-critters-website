<?php 
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
  include ROOT . "app/assets/includes/card_header.php"; 

  $webroot = WEB_ROOT;
?>
<div class="row">
<?php
  foreach ($cards as $id => $card) {
    $cardId = $card->id;
    echo <<<HTML

<div class="col-md-3 thumbnail">
  <img src="{$webroot}card-maker/cards/preview/$cardId">
  <a class="btn btn-primary" href="{$webroot}card-maker/cards/show/$cardId">View</a>
  <a class="btn btn-success" href="{$webroot}card-maker/cards/edit/$cardId">Edit</a>
  <a class="btn btn-danger" href="{$webroot}card-maker/cards/delete/$cardId">Delete</a>
</div>

HTML;
  }
?>
  
</div>
<?php 
  include ROOT . "app/assets/includes/card_footer.php"; 
?>