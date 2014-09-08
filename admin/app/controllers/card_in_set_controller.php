<?php
require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php');
require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
require_once(CONTROLLER_ROOT . '/controller.php');
require_once(MODEL_ROOT . '/set.php');
require_once(MODEL_ROOT . '/card.php');
require_once(MODEL_ROOT . '/card_in_set.php');
require_once(MODEL_ROOT . '/card_type.php');
require_once(HELPER_ROOT . '/image_helper.php');

/**
 * Card Maker Class.
 * Controls what data and views to render.
 */
class CardInSetController extends Controller {
  function add_card(&$command) {
    $setId = $command[sizeof($command) - 1];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // add
      $cardInSet = new CardInSet();
      $cardInSet->card_id = $_POST["cardId"];
      $cardInSet->set_id = $_POST["id"];
      $cardInSet->save();

      header("Location: " . WEB_ROOT . 'card-maker/sets/show/' . $_POST["id"]);
      exit;

    } else  if (is_numeric($setId)){
      // ask
      $set = new Set();
      $set->load($setId);

      $cards = Card::NotInSet($setId);

      include ROOT . 'app/views/card-in-sets/add.html.php';
    }
  }

  function remove_card(&$command) {
    $cardInSetId = $command[sizeof($command) - 1];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // add
      $cardInSet = new CardInSet();
      $cardInSet->load($_POST['id']);
      $cardInSet->delete();

      header("Location: " . WEB_ROOT . 'card-maker/sets/show/' . $cardInSet->set_id);
      exit;

    } else  if (is_numeric($cardInSetId)){
      // ask
      $cardInSet = new CardInSet();
      $cardInSet->load($cardInSetId);

      include ROOT . 'app/views/card-in-sets/remove.html.php';
    }
  }
}

?>