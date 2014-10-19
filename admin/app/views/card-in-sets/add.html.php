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
              <button class="btn btn-primary" name="cardId" value="$cardId">Add</button>
            </td>
          </tr>
HTML;
      }
    ?>
    </tbody>
    
  </table>

</form>

</div>

<?php
  include ROOT . "app/assets/includes/card_footer.php";  
?>