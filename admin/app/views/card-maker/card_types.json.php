<?php
require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
require_once(MODEL_ROOT . '/card_type.php');

  $i = 0;
  echo '{ "card_types" : [';
  foreach($cardTypes as $id => $card_type) {

    if ($i != 0) {
      echo ',';
    }
    echo '"' . $card_type->name . '"';
    $i += 1;
  }
  echo ']}';
  ?>
