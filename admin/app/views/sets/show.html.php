<?php 
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
  include ROOT . "app/assets/includes/card_header.php"; 

  $webroot = WEB_ROOT;
?>
<h2>Set Name: <?php echo $set->name; ?></h2>
<div class="row">
  <a class="btn btn-default" href="<?php echo $webroot; ?>card-maker/sets/add_card/<?php echo $set->id; ?>">
    <i class="glyphicon glyphicon-plus"></i> Add Card
  </a>
  <a class="btn btn-success" href="<?php echo $webroot; ?>card-maker/sets/edit/<?php echo $set->id; ?>">Edit</a>
  <a class="btn btn-danger" href="<?php echo $webroot; ?>card-maker/sets/delete/<?php echo $set->id; ?>">Delete</a>
  <a class="btn btn-warning" href="<?php echo $webroot; ?>card-maker/sets/download/?setId=<?php echo $set->id; ?>">Download</a>
</div>
<div class="row">
<?php
  foreach ($cards as $index => $card) {
    $cardId = $card->id;
    $cardInSetId = $cardsInSets[$index]->id;
    echo <<<HTML

<div class="col-md-3 thumbnail">
  <img src="{$webroot}card-maker/cards/preview/$cardId?setId={$set->id}">
  <a class="btn btn-warning" href="{$webroot}card-maker/sets/download/{$cardId}?setId={$set->id}">Download</a>
  <a class="btn btn-danger" href="{$webroot}card-maker/sets/remove_card/$cardInSetId">Remove</a>
</div>

HTML;
  }
?>
  
</div>

<?php 
  include ROOT . "app/assets/includes/card_footer.php"; 
?>