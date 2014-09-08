<?php 
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
  include ROOT . "app/assets/includes/card_header.php"; 

  $webroot = WEB_ROOT;
?>
<?php

  echo <<<HTML

<div class="col-md-6">
  <form method="POST" action="./card-maker/sets/remove_card">
  <input type="hidden" name="id" value="$cardInSet->id" />
  <p>Are you sure you want to delete this card from this set?</p>
  <p>You cannot undo this action.</p>
  <button type="submit" name="areyousure" value="yes">Yup! Remove!</button>
  </form>
</div>
<div class="col-md-6 thumbnail">
  <img src="{$webroot}card-maker/cards/preview/{$cardInSet->card_id}?setId={$cardInSet->set_id}">
</div>


HTML;
?>

<?php 
  include ROOT . "app/assets/includes/card_footer.php"; 
?>