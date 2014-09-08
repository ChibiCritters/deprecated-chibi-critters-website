<?php 
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
  $webroot = WEB_ROOT;
?>

<div class="row">

<form class="form-horizontal" method="POST" action="./card-maker/sets/save">
    <fieldset>

    <!-- Form Name -->
    <legend>Set Entry Form</legend>
    <input type="hidden" name="id" value="<?php echo $set->id; ?>" />
    </fieldset>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="name">Name</label>
      <div class="col-md-5">
      <input id="name" name="name" type="text" placeholder="Chibi Critters Starter Deck" class="form-control input-md" required="" value="<?php echo $set->name; ?>">
      <span class="help-block">The name for the set</span>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="prefix">Prefix</label>
      <div class="col-md-5">
      <input id="name" name="prefix" type="text" placeholder="CCSD" class="form-control input-md" required="" value="<?php echo $set->prefix; ?>">
      <span class="help-block">The prefix for the set</span>
      </div>
    </div>

    <button class="btn btn-success" type="submit">Save</button>
</form>

</div>