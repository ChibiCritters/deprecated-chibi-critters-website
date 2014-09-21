<?php
require_once 'model.php';

class Card extends Model {
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


  protected $validate = array(
    );

  public function __construct($paramMap = []) {
    parent::construct("Card");

    if (isset($paramMap) && !empty($paramMap)) {
      foreach ($paramMap as $key => $value) {
        $this->$key = $value;
      }
    }
  }

  /**
   * Override
   */
  public function load($id) {
    $sql = <<<SQL
      SELECT 
        `card`.id, 
        `card`.name, 
        `image_path`, 
        `condition`, 
        effect, 
        prize, 
        penalty,
        strength, 
        quest_points, 
        turn_count, 
        card_type_id, 
        card_type.name as card_type 
      FROM 
        `card`, `card_type`
      WHERE 
        `card`.id = ? and 
        `card`.card_type_id = `card_type`.id
SQL;

    if ($stmt = Model::getMysqli()->prepare($sql)) {
      $stmt->bind_param('i', $id);
      $stmt->execute();
      $stmt->bind_result(
        $id,
        $name,
        $image_path,
        $condition,
        $effect,
        $prize,
        $penalty,
        $strength,
        $quest_points,
        $turn_count,
        $card_type_id,
        $card_type
      );

      $stmt->fetch();

      $this->id = $id;
      $this->name = $name;
      $this->image_path = $image_path;
      $this->condition = $condition;
      $this->effect = $effect;
      $this->prize = $prize;
      $this->penalty = $penalty;
      $this->strength = $strength;
      $this->quest_points = $quest_points;
      $this->turn_count = $turn_count;
      $this->card_type_id = $card_type_id;
      $this->card_type = $card_type;
    }
  }

  /**
   * Override
   */
  public function save() {
    if ($this->id < 0) {
      // Create
      if ($stmt = Model::getMysqli()->prepare("INSERT into `card` " .
                                 "(`name`, `image_path`, `condition`, `effect`, " .
                                 "`strength`, `prize`, `penalty`, `turn_count`, ".
                                 "`quest_points`, `card_type_id`) VALUES (" .
                                 "?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
                                 )) {
        $stmt->bind_param('sssssssssi', 
          $this->name, 
          $this->image_path, 
          $this->condition, 
          $this->effect, 
          $this->strength, 
          $this->prize, 
          $this->penalty, 
          $this->turn_count, 
          $this->quest_points, 
          $this->card_type_id);

        $stmt->execute();

        $id = Model::getMysqli()->insert_id;
        $this->load($id);
      } 
    } else {
      // Update
      if ($stmt = Model::$mysqli->prepare("UPDATE `card` SET " .
                                  "name=?, image_path=?, `condition`=?, effect=?, prize=?, penalty=?, " .
                                 "strength=?, quest_points=?, turn_count=? WHERE id=?")) {
        $stmt->bind_param('sssssssssi', 
          $this->name, 
          $this->image_path, 
          $this->condition, 
          $this->effect, 
          $this->prize, 
          $this->penalty, 
          $this->strength, 
          $this->quest_points, 
          $this->turn_count, 
          $this->id);

        $stmt->execute();
      }
    }
  }

  /**
   * Override
   */
  public function delete() {
    if ($this->id > 0) {
      // delete
      if ($stmt = Model::$mysqli->prepare("DELETE FROM `card` WHERE id=?")) {
        $stmt->bind_param('i', $this->id);

        $stmt->execute();
      }
    }
  }

  public static function All() {
    $query = "SELECT * " .
             "FROM `card` WHERE 1=1";

    $result = Model::getMysqli()->query($query);
    if ($result === false) { echo Model::getMysqli()->error; }
    $rows = Model::resultToArray($result);

    $results = array();

    foreach ($rows as $row) {
      $card = new Card();
      $card->id = $row["id"];
      $card->name = $row["name"];
      $card->image_path = $row["image_path"];
      $card->condition = $row["condition"];
      $card->effect = $row["effect"];
      $card->prize = $row["prize"];
      $card->penalty = $row["penalty"];
      $card->strength = $row["strength"];
      $card->quest_points = $row["quest_points"];
      $card->turn_count = $row["turn_count"];
      $card->card_type_id = $row["card_type_id"];
      $results[] = $card;
    }

    return $results;
  }

   public static function InSet($setId) {
    $sql = <<<SQL
SELECT 
  `card`.id, 
  `card`.name, 
  image_path, 
  `condition`, 
  effect, 
  prize, 
  penalty,
  strength, 
  quest_points, 
  turn_count, 
  card_type_id, 
  `card_type`.name as card_type,
  `card_in_set`.id as card_in_set_id,
  `card_in_set`.set_id as card_in_set_set_id,
  `card_in_set`.language_id as card_in_set_language_id
FROM 
  `card`, `card_type`, `card_in_set`
WHERE 
  `card`.card_type_id = `card_type`.id and
  `card`.id = `card_in_set`.card_id and 
  `card_in_set`.set_id = ?
SQL;

    if ($stmt = Model::getMysqli()->prepare($sql)) {

      $stmt->bind_param('i', $setId);

      $stmt->execute();
      $result = $stmt->get_result();
      $rows = Model::resultToArray($result);

      $results = array();
      $results2 = array();

      foreach ($rows as $row) {
        $card = new Card();
        $card->id = $row["id"];
        $card->name = $row["name"];
        $card->image_path = $row["image_path"];
        $card->condition = $row["condition"];
        $card->effect = $row["effect"];
        $card->prize = $row["prize"];
        $card->penalty = $row["penalty"];
        $card->strength = $row["strength"];
        $card->quest_points = $row["quest_points"];
        $card->turn_count = $row["turn_count"];
        $card->card_type_id = $row["card_type_id"];
        $card->card_type = $row["card_type"];
        $results[] = $card;

        // TODO add language
        $cardInSet = CardInSet::LoadByIndex($card->id, $setId)[0];
        $results2[] = $cardInSet;
      }

      return array($results, $results2);
    }
  }

  public static function NotInSet($setId) {
    $sql = <<<SQL
SELECT *
FROM
  `card`
LEFT JOIN
  (SELECT 
      `card`.id as card_id
    FROM 
      `card_type`, `card`
    LEFT JOIN 
      `card_in_set` ON `card_in_set`.card_id = `card`.id
    WHERE 
      `card`.card_type_id = `card_type`.id and
      `card_in_set`.set_Id = ?
     ) as `card_exists`
  ON `card_exists`.card_id = `card`.id
WHERE
  `card_exists`.card_id IS NULL
SQL;

    if ($stmt = Model::$mysqli->prepare($sql)) {

      $stmt->bind_param('i', 
        $setId);

      $stmt->execute();
      $result = $stmt->get_result();
      $rows = Model::resultToArray($result);

      $results = array();

      foreach ($rows as $row) {
        $card = new Card();
        $card->id = $row["id"];
        $card->name = $row["name"];
        $card->image_path = $row["image_path"];
        $card->condition = $row["condition"];
        $card->effect = $row["effect"];
        $card->prize = $row["prize"];
        $card->penalty = $row["penalty"];
        $card->strength = $row["strength"];
        $card->quest_points = $row["quest_points"];
        $card->turn_count = $row["turn_count"];
        $card->card_type_id = $row["card_type_id"];
        $results[] = $card;
      }

      return $results;
    }
  }
}


  ?>
