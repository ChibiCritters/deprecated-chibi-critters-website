<?php
require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
require_once(MODEL_ROOT . "/card_type.php");
foreach (glob(HELPER_ROOT . "/image_processes/*.php") as $filename)
{ 
    require_once $filename;
}

class ImageHelper {
  public $id = -1;
  public $name = '';
  public $image_path = '';
  public $condition = '';
  public $effect = '';
  public $prize = '';
  public $penalty = '';
  public $strength = '';
  public $quest_points = '';
  public $turn_count = '';
  public $card_type_id = 1;
  public $card_type = "Critter";
  public $prefix;
  public $language;
  public $number;

  public function __construct($card, $prefix = '????', $language = '??', $number = 'XXX') {
    $this->id = $card->id;
    $this->name = $card->name;
    $this->image_path = $card->image_path;
    $this->condition = $card->condition;
    $this->effect = $card->effect;
    $this->prize = $card->prize;
    $this->penalty = $card->penalty;
    $this->strength = $card->strength;
    $this->quest_points = $card->quest_points;
    $this->turn_count = $card->turn_count;
    $this->card_type_id = $card->card_type_id;
    $this->card_type = $card->card_type;
    $this->prefix = $prefix;
    $this->language = $language;
    $this->number = $number;
  }

  public function generateImage() {
    $cardType = new CardType();
    $cardType->load($this->card_type_id);

    switch ($this->card_type) {
    case "Critter":
      $lt = new CritterTemplate(
        $cardType->background_image_path,
        $cardType->foreground_image_path,
        $this->name,
        $this->effect,
        $this->strength,
        $this->prefix,
        $this->language,
        $this->number,
        $this->image_path);
      break;
    case "Spell":
    case "Love":
      $lt = new GenericTemplate(
        $cardType->background_image_path,
        $cardType->foreground_image_path,
        $this->name,
        $this->effect,
        $this->prefix,
        $this->language,
        $this->number,
        $this->image_path);
      break;
    case "Sabotage":
      $lt = new SabotageTemplate(
        $cardType->background_image_path,
        $cardType->foreground_image_path,
        $this->name,
        $this->effect,
        $this->prefix,
        $this->language,
        $this->number,
        $this->image_path);
      break;
    case "Quest":
      $lt = new QuestTemplate(
        $cardType->background_image_path,
        $cardType->foreground_image_path,
        $this->name, 
        $this->condition,
        $this->effect,
        $this->turn_count, 
        $this->prize,
        $this->penalty,
        $this->quest_points,
        $this->prefix,
        $this->language,
        $this->number,
        $this->image_path);
      break;
    }
    return $lt->generateImage();
  }
}

?>