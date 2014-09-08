<?php 
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
  $webroot = WEB_ROOT;
?>

<?php
  include ROOT . "app/assets/includes/card_header.php";  
?>

<div class="row">

<form class="form-horizontal" method="POST" action="./card-maker/sets/add_card">
    <fieldset>

    <!-- Form Name -->
    <legend>Add Cards to Set: (<?php echo $set->name; ?>)</legend>
    <input type="hidden" name="id" value="<?php echo $set->id; ?>" />
    </fieldset>

    <div class="row">
    <?php
      foreach ($cards as $id => $card) {
        $cardId = $card->id;
        echo <<<HTML

    <div class="col-md-3 thumbnail">
      <img src="{$webroot}card-maker/cards/preview/$cardId">
      <button class="btn btn-primary" name="cardId" value="$cardId">Add</button>
    </div>

HTML;
      }
    ?>
      
    </div>


</form>

</div>

<?php
  include ROOT . "app/assets/includes/card_footer.php";  
?>