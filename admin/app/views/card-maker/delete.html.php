<?php 
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
  include ROOT . "app/assets/includes/card_header.php"; 

  $webroot = WEB_ROOT;
?>
<?php

  echo <<<HTML

<div class="col-md-6">
  <form method="POST" action="./card-maker/cards/delete">
  <input type="hidden" name="id" value="$card->id" />
  <p>Are you sure you want to delete this card?</p>
  <p>You cannot undo this action.</p>
  <button type="submit" name="areyousure" value="yes">Yup! Delete!</button>
  </form>
</div>
<div class="col-md-6 thumbnail">
  <img src="{$webroot}card-maker/cards/preview/{$card->id}">
</div>


HTML;
?>

<?php 
  include ROOT . "app/assets/includes/card_footer.php"; 
?>