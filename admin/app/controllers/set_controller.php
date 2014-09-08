<?php
require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
require_once(CONTROLLER_ROOT . '/controller.php');
require_once(MODEL_ROOT . '/set.php');
require_once(MODEL_ROOT . '/card.php');
require_once(MODEL_ROOT . '/card_type.php');
require_once(HELPER_ROOT . '/image_helper.php');
require_once(HELPER_ROOT . '/filename_helper.php');
require_once(HELPER_ROOT . '/zip_helper.php');

/**
 * Card Maker Class.
 * Controls what data and views to render.
 */
class SetController extends Controller {
  /**
   * Returns the Index Page
   * @param array &$command 
   */
  function index(&$command) {
    $sets = Set::all();
    include ROOT . 'app/views/sets/index.html.php';
  }

  /**
   * Display the create/edit form with an
   * empty Card object 
   * 
   * @param array &$command 
   */
  function create(&$command) {
    $set = new Set();
    include ROOT . 'app/views/sets/create.html.php';
  }

  /**
   * Display the create/edit form with a
   * populated Card object
   * @param array &$command 
   */
  function edit(&$command) {
    $setId = $command[sizeof($command) - 1];

    $set = new Set();
    $set->load($setId);
    include ROOT . 'app/views/sets/edit.html.php';
  }

  function show(&$command) {
    $setId = $command[sizeof($command) - 1];

    $set = new Set();
    $set->load($setId);
    
    $results = Card::InSet($set->id);
    $cards = $results[0];
    $cardsInSets = $results[1];
    include ROOT . 'app/views/sets/show.html.php';
  }

  function delete(&$command) {
    if (isset($_POST['areyousure']) && $_POST['areyousure'] == 'yes') {
      // Delete
      $setId = $_POST['id'];

      $set = new Set();
      $set->load($setId);
      $set->delete();

      header("Location: " . WEB_ROOT . 'card-maker/sets');
      exit;
    } else {
      // Ask
      $setId = $command[sizeof($command) - 1];

      $set = new Set();
      $set->load($setId);
      include ROOT . 'app/views/sets/delete.html.php';
    }
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
    $id = $_POST['id'];
    $name = $_POST['name'];
    $prefix = $_POST['prefix'];

    $set = new Set(array(
      "id" => $id,
      "name" => $name,
      "prefix" => $prefix
    ));

    $set->save();
    header("Location: " . WEB_ROOT . 'card-maker/sets');
    exit;
  }

  /**
   * Download
   */
  function download(&$command) {
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

    } else if (isset($_GET['setId'])) {
      // Download all
      $imageResources = array();
      $filenames = array();

      $set = new Set();
      $set->load($_GET['setId']);

      $results = Card::InSet($set->id);
      $cards = $results[0];
      $cardsInSets = $results[1];

      foreach ($cards as $index => $card) {
        $cardInSet = $cardsInSets[$index];

        $imageResources[] = (new ImageHelper(
          $card, 
          $set->prefix, 
          $cardInSet->language,
          $cardInSet->card_postfix
          ))->generateImage();
        $filenames[] = FileNameHelper::generateSlug($card, $set).'.png';
      }
    } else {
      $name = $_GET['name'];
      $effect = $_GET['effect'];
      $strength = $_GET['strength'];
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
        "effect" => $effect,
        "strength" => $strength,
        "card_type" => $type,
        "card_type_id" => $cardType->id,
        "image_path" => $frontFilePath
        ));

      $imageHelper = new ImageHelper($card);
    }
   
    
    if (isset($imageHelper)) {
      $im = $imageHelper->generateImage();

      ob_start(); //Turn on output buffering
      imagepng($im); //Generate your image

      $output = ob_get_contents(); // get the image as a string in a variable

      ob_end_clean(); //Turn off output buffering and clean it
      $filesize = strlen($output); //size in bytes

      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename='.FileNameHelper::generateSlug($card, $set).'.png');
      header('Content-Transfer-Encoding:binary');
      header('Expires: 0');
      header('Cache-Control: must-revalidate,post-check=0,pre-check=0');
      header('Pragma: public');
      header('Content-Length:'.$filesize);
      ob_clean();
      flush();

      echo $output;
      imagedestroy($im);
    }

    if (isset($imageResources)) {
      // TODO 
      $zip = ZipHelper::createZipFromImageResources($filenames, $imageResources);

      ob_start(); //Turn on output buffering
      echo $zip->file();

      $output = ob_get_contents(); // get the image as a string in a variable

      ob_end_clean(); //Turn off output buffering and clean it
      $filesize = strlen($output); //size in bytes

      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename='.FileNameHelper::generateSlug($set).'.zip');
      header('Content-Transfer-Encoding:binary');
      header('Expires: 0');
      header('Cache-Control: must-revalidate,post-check=0,pre-check=0');
      header('Pragma: public');
      header('Content-Length:'.$filesize);
      ob_clean();
      flush();

      echo $output;

      // TODO destroy imageresources
    }
  }

}
?>