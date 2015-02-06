<?php
require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php');

class CardMakerViewTest extends PHPUnit_Framework_TestCase {
  public function testCardWithQuotes() {
    $card = new Card(
        array(
          'id' => 1,
          'name' => "\"'\"\"'",
          'image_path' => '"image_path"',
          'condition' => "'condition'",
          'effect' => 'effect ""',
          'prize' => '"prize"',
          'penalty' => '"penalty"',
          'strength' => '"strength"',
          'quest_points' => '"quest_points"',
          'turn_count' => '"turn_count"',
          'card_type_id' => '"card_type_id"',
          'card_type' => '"card_type"'
        )
    );

    ob_start();
    include( VIEW_ROOT . '/card-maker/_form.html.php' );
    $html = ob_get_contents();
    ob_end_clean();

    $this->assertContains("\\\"'\\\"\\\"'", $html);
    $this->assertContains("\"image_path\"", $html);
    $this->assertContains("'condition'", $html);
    $this->assertContains("effect \\\"\\\"", $html);
    $this->assertContains("\\\"prize\\\"", $html);
    $this->assertContains("\\\"penalty\\\"", $html);
    $this->assertContains("\\\"strength\\\"", $html);
    $this->assertContains("\\\"quest_points\\\"", $html);
    $this->assertContains("\\\"card_type_id\\\"", $html);
    $this->assertContains("\\\"turn_count\\\"", $html);
    $this->assertContains("\\\"card_type\\\"", $html);
  }
}
