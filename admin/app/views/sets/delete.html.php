<?php 
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
  include ROOT . "app/assets/includes/card_header.php"; 

  $webroot = WEB_ROOT;
?>
<?php

  echo <<<HTML

<div class="col-md-6">
  <form method="POST" action="./card-maker/sets/delete">
  <input type="hidden" name="id" value="$set->id" />
  <p>Are you sure you want to delete this set ($set->name)?</p>
  <p>You cannot undo this action.</p>
  <button type="submit" name="areyousure" value="yes">Yup! Delete!</button>
  </form>
</div>


HTML;
?>

<?php 
  include ROOT . "app/assets/includes/card_footer.php"; 
?>