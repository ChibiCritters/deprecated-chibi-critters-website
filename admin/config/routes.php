<?php
/**
 * Routes
 */


require_once('application.php'); 
foreach (glob(CONTROLLER_ROOT . "/*.php") as $filename)
{ 
    require_once $filename;
}

$cardMakerController = new CardMakerController();
$setController = new SetController();
$cardInSetController = new CardInSetController();
$userController = new UserController();

$routes = array (
  'card-maker' => array(
    'cards' => array(
      'edit' => $cardMakerController,
      'create' => $cardMakerController,
      'show' => $cardMakerController,
      'delete' => $cardMakerController,
      'preview' => $cardMakerController,
      'card_types' => $cardMakerController,
      'upload_image' => $cardMakerController,
      'save' => $cardMakerController,
      '/' => $cardMakerController
      ),
    'sets' => array(
      'edit' => $setController,
      'create' => $setController,
      'show' => $setController,
      'delete' => $setController,
      'save' => $setController,
      'add_card' => $cardInSetController,
      'remove_card' => $cardInSetController,
      'download' => $setController,
      '/' => $setController
      ),
    '/' => new $cardMakerController
    ),
  'user' => array(
      'login' => $userController,
      '/' => $userController
    ),
  '/' => new HomeController()
  );


route($routes);
?>