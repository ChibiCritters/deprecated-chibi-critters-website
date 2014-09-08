<?php 
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
  include ROOT . "app/assets/includes/card_header.php"; 

  $webroot = WEB_ROOT;
?>
<?php

  $cardArray = get_object_vars($card);

  $cardTable = "";

  foreach ($cardArray as $key => $value) {
    $cardTable .= "<tr><td>$key</td><td>$value</td></tr>";
  }

  echo <<<HTML

<div class="col-md-6">
  <table  class="table table-striped table-bordered">
    $cardTable
  </table>
</div>
<div class="col-md-6 thumbnail">
  <img src="{$webroot}card-maker/cards/preview/$cardId">
  <a class="btn btn-success" href="{$webroot}card-maker/cards/edit/$cardId">Edit</a>
  <a class="btn btn-danger" href="{$webroot}card-maker/cards/delete/$cardId">Delete</a>
</div>


HTML;
?>

<?php 
  include ROOT . "app/assets/includes/card_footer.php"; 
?>