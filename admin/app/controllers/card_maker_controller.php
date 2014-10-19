<?php
require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
require_once(CONTROLLER_ROOT . '/controller.php');
require_once(MODEL_ROOT . '/card.php');
require_once(MODEL_ROOT . '/card_type.php');
require_once(HELPER_ROOT . '/image_helper.php');

/**
 * Card Maker Class.
 * Controls what data and views to render.
 */
class CardMakerController extends Controller {
  /**
   * Returns the Index Page
   * @param array &$command 
   */
  function index(&$command) {
    $cards = Card::all();
    include ROOT . 'app/views/card-maker/index.html.php';
  }

  /**
   * Display the create/edit form with an
   * empty Card object 
   * 
   * @param array &$command 
   */
  function create(&$command) {
    $card = new Card();
    include ROOT . 'app/views/card-maker/create.html.php';
  }

  /**
   * Display the create/edit form with a
   * populated Card object
   * @param array &$command 
   */
  function edit(&$command) {
    $cardId = $command[sizeof($command) - 1];

    $card = new Card();
    $card->load($cardId);
    include ROOT . 'app/views/card-maker/edit.html.php';
  }

  function show(&$command) {
    $cardId = $command[sizeof($command) - 1];

    $card = new Card();
    $card->load($cardId);
    include ROOT . 'app/views/card-maker/show.html.php';
  }

  function delete(&$command) {
    if (isset($_POST['areyousure']) && $_POST['areyousure'] == 'yes') {
      // Delete
      $cardId = $_POST['id'];

      $card = new Card();
      $card->load($cardId);
      $card->delete();

      header("Location: " . WEB_ROOT . 'card-maker/');
      exit;
    } else {
      // Ask
      $cardId = $command[sizeof($command) - 1];

      $card = new Card();
      $card->load($cardId);
      include ROOT . 'app/views/card-maker/delete.html.php';
    }
  }

  /**
   * Generate a JSON object of all the card types.
   * @param array &$command
   */
  function card_types(&$command) {
    $cardTypes = CardType::all();
    include ROOT . 'app/views/card-maker/card_types.json.php';
  }

  /**
   * Take a posted image and move it to the cache.
   * @param type &$command 
   * @return type
   */
  function upload_image(&$command) {
    $info = pathinfo($_FILES['image']['name']);

    $filename = hash_file('md5', $_FILES["image"]["tmp_name"]);
    $newname = $filename.'.png';

    $target = ASSET_ROOT . '/cache_images/'.$newname;
    imagepng(imagecreatefromstring(file_get_contents($_FILES['image']['tmp_name'])), $target);

    // Return a JSON object with a file id
    echo "{ \"hash\" : \"$filename\"}";
  }

  /**
   * Saves card data in the database and 
   * redirects the user home.
   * 
   * TODO add in support for adventure cards and
   * undefined values
   * @param type &$command 
   * @return type
   */
  function save(&$command) {
    // Save all data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $fileId = $_POST['fileId'];
    $condition = $_POST['condition'];
    $effect = $_POST['effect'];
    $strength = $_POST['strength'];
    $type = $_POST['type'];
    $prize = $_POST['prize'];
    $penalty = $_POST['penalty'];
    $questPoints = $_POST['quest_points'];
    $turn_count = $_POST['turn_count'];

    // Set up the image path, $imagePath
    // File id is equal to the hash of the image in the /cache_images/
    if (strpos($fileId,'front_images') !== false) {
      $imagePath = $fileId;
    } else {
      $imagePath = '/front_images/'.$fileId.".png";
      rename ( ASSET_ROOT . '/cache_images/'.$fileId.".png", ASSET_ROOT . $imagePath);
    }

    // determine the card type, $cardTypeId
    $cardType = new CardType();
    $cardType->loadByName($type);
    
    $cardTypeId = $cardType->id;

    $card = new Card(array(
      "id" => $id,
      "name" => $name,
      "image_path" => $imagePath,
      "condition" => $condition,
      "effect" => $effect,
      "prize" => $prize,
      "penalty" => $penalty,
      "strength" => $strength,
      "quest_points" => $questPoints,
      "turn_count" => $turn_count,
      "card_type_id" => $cardTypeId
    ));

    // put the entry in the database
    $card->save();
    header("Location: " . WEB_ROOT . 'card-maker/');
    exit;
  }


  /**
   * Returns an image preview
   * 
   * TODO Move logic to a helper class
   * 
   * @param type &$command 
   * @return type
   */
  function preview(&$command) {
    if (is_numeric($command[sizeof($command) - 1])) {
      $cardId = $command[sizeof($command) - 1];

      $card = new Card();
      $card->load($cardId);

      if (isset($_GET['setId'])) {
        $set = new Set();
        $set->load($_GET['setId']);

        $cardInSet = CardInSet::LoadByIndex($card->id, $set->id)[0];

        $imageHelper = new ImageHelper(
          $card, 
          $set->prefix, 
          $cardInSet->language,
          $cardInSet->card_postfix
          );
      } else {
        $imageHelper = new ImageHelper($card);
      }

    } else {
      $name = $_GET['name'];
      $condition = $_GET['condition'];
      $effect = $_GET['effect'];
      $strength = $_GET['strength'];
      $prize = $_GET['prize'];
      $penalty = $_GET['penalty'];
      $turnCount = $_GET['turn_count'];
      $questPoints = $_GET['quest_points'];
      $type = $_GET['type'];
      $fileId = $_GET['fileId'];

      $frontFilePath = '/chibi_critters_images/love_fg.png';
      if (strpos($fileId,'front_images') !== false) {
        $frontFilePath = $fileId;
      }
      else if (isset($fileId) && !empty($fileId) && $fileId != '0') {
        $frontFilePath =  '/cache_images/'.$fileId.'.png';
      }

      $cardType = new CardType();
      $cardType->loadByName($type);

      $card = new Card(array(
        "name" => $name,
        "condition" => $condition,
        "effect" => $effect,
        "strength" => $strength,
        "prize" => $prize,
        "penalty" => $penalty,
        "turn_count" => $turnCount,
        "quest_points" => $questPoints,
        "card_type" => $type,
        "card_type_id" => $cardType->id,
        "image_path" => $frontFilePath
        ));

      $imageHelper = new ImageHelper($card);

      // Only cache images that we've made, not ones being made in the card creator.
      header('Cache-Control: max-age=3600');
    }

    $im = $imageHelper->generateImage();
    header('Content-Type: image/png');

    imagepng($im);
    imagedestroy($im);
  }

}
?>