<?php
require_once 'model.php';

// TODO some how increment the card postfix per set

class CardInSet extends Model {
  public $id = -1;
  public $card_id = -1;
  public $set_id = -1;
  public $card_postfix = "000";
  public $language_id = 1;
  public $language = 'en'; // TODO

  public function __construct($paramMap = []) {
    parent::construct("Card_In_Set");

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
    $query = <<<SQL
SELECT
  `id`,
  `card_id`,
  `set_id`,
  `language`,
  LPAD(`rank`, 3, '0') as `rank`,
  `language_id`
FROM 
  (SELECT 
    `card_in_set`.id as id,
    `card_id`,
    `set_id`,
    `prefix` as `language`,
    @rn:=@rn+1 AS rank,
    `language`.id as `language_id`
  FROM 
    `card_in_set`, `language`, (SELECT @rn:=0) as t2
  WHERE 
    `card_in_set`.language_id = `language`.id and
    `card_in_set`.set_id = (SELECT
      `set_id`
    FROM
      `card_in_set`
    WHERE
      `card_in_set`.id = ?
    )
  ORDER BY
    `card_in_set`.id) as `card_in_set_temp`
WHERE
  `card_in_set_temp`.id = ?
SQL;

    if ($stmt = Model::getMysqli()->prepare($query
                                )) {
      $stmt->bind_param('ii', $id, $id);
      $stmt->execute();
      $stmt->bind_result(
        $id,
        $card_id,
        $set_id,
        $language,
        $rank,
        $language_id
      );

      $stmt->fetch();

      $this->id = $id;
      $this->card_id = $card_id;
      $this->set_id = $set_id;
      $this->card_postfix = $rank;
      $this->language_id = $language_id;
      $this->language = $language;
    }
  }

  /**
   * Override
   */
  public function save() {
    if ($this->id < 0) {
      // Create
      if ($stmt = Model::getMysqli()->prepare("INSERT into `card_in_set` " .
                                 "(`card_id`, `set_id`, `language_id`) VALUES (" .
                                 "?, ?, ?)"
                                 )) {
        $stmt->bind_param('iii', 
          $this->card_id, 
          $this->set_id,
          $this->language_id);

        $stmt->execute();

        $id = Model::getMysqli()->insert_id;
        $this->load($id);
      } 
    } else {
      // Update
      if ($stmt = Model::$mysqli->prepare("UPDATE `card_in_set` SET " .
                                  "card_id=?, set_id=?, language_id=? WHERE id=?")) {
        $stmt->bind_param('iisi', 
          $this->card_id, 
          $this->set_id,
          $this->language_id);

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
      if ($stmt = Model::$mysqli->prepare("DELETE FROM `card_in_set` WHERE id=?")) {
        $stmt->bind_param('i', $this->id);

        $stmt->execute();
      }
    }
  }

  public static function All() {
    $query = "SELECT * " .
             "FROM `card_in_set` WHERE 1=1";

    $result = Model::getMysqli()->query($query);

    $rows = Model::resultToArray($result);

    $results = array();

    foreach ($rows as $row) {
      $cardInSet = new CardInSet();
      $cardInSet->id = $row["id"];
      $cardInSet->card_id = $row["card_id"];
      $cardInSet->set_id = $row["set_id"];
      $cardInSet->card_postfix = $row["card_postfix"];
      $cardInSet->language_id= $row["language_id"];

      $results[] = $cardInSet;
    }

    return $results;
  }

  public static function LoadByIndex($cardId, $setId, $language = 'en') {
    // TODO add language check
    $query = <<<SQL
SELECT
  `id`,
  `card_id`,
  `set_id`,
  `language`,
  LPAD(`rank`, 3, '0') as `rank`,
  `language_id`
FROM 
  (SELECT 
    `card_in_set`.id as id,
    `card_id`,
    `set_id`,
    `prefix` as `language`,
    @rn:=@rn+1 AS rank,
    `language`.id as `language_id`
  FROM 
    `card_in_set`, `language`, (SELECT @rn:=0) as t2
  WHERE 
    `card_in_set`.language_id = `language`.id and
    `card_in_set`.set_id = ?
  ORDER BY
    `card_in_set`.id) as `card_in_set_temp`
WHERE
  `card_in_set_temp`.card_id = ?
SQL;

    if ($stmt = Model::$mysqli->prepare($query)) {
      $stmt->bind_param('ii', $setId, $cardId);

      $stmt->execute();
      $result = $stmt->get_result();
      $rows = Model::resultToArray($result);

      $results = array();

      foreach ($rows as $row) {
        $cardInSet = new CardInSet();
        $cardInSet->id = $row["id"];
        $cardInSet->card_id = $row["card_id"];
        $cardInSet->set_id = $row["set_id"];
        $cardInSet->card_postfix = $row["rank"];
        $cardInSet->language_id= $row["language_id"];
        $cardInSet->language = $row["language"];

        $results[] = $cardInSet;
      }

       return $results;
    }
  }
}

  ?>
