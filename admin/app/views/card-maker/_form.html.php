<?php 
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
  $webroot = WEB_ROOT;
?>
<script>
  window.card = {
    "id"           : <?php echo $card->id ?>,
    "name"         : <?php echo json_encode( $card->name ); ?>,
    "image_path"   : <?php echo json_encode( $card->image_path ); ?>, 
    "condition"    : <?php echo json_encode( $card->condition ); ?>,
    "effect"       : <?php echo json_encode( $card->effect ); ?>,
    "prize"        : <?php echo json_encode( $card->prize ); ?>,
    "penalty"      : <?php echo json_encode( $card->penalty ); ?>,
    "strength"     : <?php echo json_encode( $card->strength ); ?>,
    "quest_points" : <?php echo json_encode( $card->quest_points ); ?>,
    "turn_count"   : <?php echo json_encode( $card->turn_count ); ?>,
    "card_type_id" : <?php echo json_encode( $card->card_type_id ); ?>,
    "card_type"    : <?php echo json_encode( $card->card_type ); ?>
  };
</script>

<div class="row">
  <div class="col-md-6">
    <form class="form-horizontal" method="POST" action="./card-maker/cards/save">
    <fieldset>

    <!-- Form Name -->
    <legend>Card Entry Form</legend>
    <input type="hidden" name="id" data-bind="value:id" />

    <!-- Select Basic -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="type">Card Type</label>
      <div class="col-md-5">
       <select data-bind="options: cardTypes,
               optionsText: 'name',
               optionsValue: 'value',
               value: cardType" name="type"></select>


      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="name">Name</label>
      <div class="col-md-5">
      <input data-bind='value : instantaneousName, valueUpdate: ["input", "afterkeydown"]' id="name" name="name" type="text" placeholder="Critter/Spell/etc Name" class="form-control input-md" required="">
      <span class="help-block">The name for the critter</span>
      </div>
    </div>

    <!-- Textarea -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="condition">Condition</label>
      <div class="col-md-5">
      <textarea data-bind='value : instantaneousCondition, valueUpdate: ["input", "afterkeydown"]' class="form-control" id="condition" name="condition">The condition that the card will have</textarea>
      </div>
    </div>

    <!-- Textarea -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="effect">Effect</label>
      <div class="col-md-5">
      <textarea data-bind='value : instantaneousEffect, valueUpdate: ["input", "afterkeydown"]' class="form-control" id="effect" name="effect">The effect that the card will have</textarea>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="strength">Strength</label>
      <div class="col-md-5">
      <input data-bind='value : strength, valueUpdate: ["input", "afterkeydown"]' id="strength" name="strength" type="text" placeholder="Strength (usually a number)" class="form-control input-md">
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="prize">Prize</label>
      <div class="col-md-5">
      <textarea data-bind='value : instantaneousPrize, valueUpdate: ["input", "afterkeydown"]' class="form-control" id="prize" name="prize">The prize that the card will have</textarea>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="penalty">Penalty</label>
      <div class="col-md-5">
      <textarea data-bind='value : instantaneousPenalty, valueUpdate: ["input", "afterkeydown"]' class="form-control" id="penalty" name="penalty">The penalty that the card will have</textarea>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="turn_count">Turn Count</label>
      <div class="col-md-5">
      <input data-bind='value : turn_count, valueUpdate: ["input", "afterkeydown"]' id="turn_count" name="turn_count" type="text" placeholder="Turn Count (usually a number)" class="form-control input-md">
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="quest_points">Quest Points</label>
      <div class="col-md-5">
      <input data-bind='value : quest_points, valueUpdate: ["input", "afterkeydown"]' id="quest_points" name="quest_points" type="text" placeholder="Quest Points (usually a number)" class="form-control input-md">
      </div>
    </div>

    <!-- File Button -->
    <div class="form-group" >
      <label class="col-md-4 control-label" for="image">Image</label>
      <div class="col-md-4">
        <input id="image" name="image" class="input-file" type="file" data-action="./card-maker/cards/upload_image">
            <input name="fileId" class="input-file" type="hidden" data-bind="value: fileHash ">
      </div>
    </div>
    <button class="btn btn-success" type="submit">Save</button>
    </fieldset>
    </form>

  </div>
  <div class="col-md-6">
    <img data-bind="attr : { src: imageUrl }" src="./card-maker/preview/?name=Critter&effect=Effect&strength=4&type=critter&fileId=0" class="img-thumbnail"/>
  </div>
</div>
