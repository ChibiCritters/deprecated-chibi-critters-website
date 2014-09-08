<?php
require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
require_once(MODEL_ROOT . '/card.php');

class CardTest extends PHPUnit_Framework_TestCase {
  public function testValidDefaults() {
    $card = new Card();

    $this->assertEquals(-1, $card->id);
    $this->assertEquals(1, $card->card_type_id);
  }
}

?>