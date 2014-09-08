<?php
require_once 'model.php';

class CardType extends Model {
  public $id = -1;
  public $name = '';
  public $background_image_path = '';
  public $foreground_image_path = '';

  public function __construct($paramMap = []) {
    parent::construct("CardType");

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
    if ($stmt = Model::getMysqli()->prepare("SELECT " .
                                 "id, name, background_image_path, foreground_image_path " .
                                 "FROM Card_Type WHERE id = ?"
                                )) {
      $stmt->bind_param('i', $id);

      $stmt->execute();

      $stmt->bind_result(
        $id,
        $name,
        $background_image_path,
        $foreground_image_path
      );
      $stmt->fetch();

      $this->id = $id;
      $this->name = $name;
      $this->background_image_path = $background_image_path;
      $this->foreground_image_path = $foreground_image_path;

    }
  }

  public function loadByName($name) {
    if ($stmt = Model::getMysqli()->prepare("SELECT " .
                                 "id, name, background_image_path, foreground_image_path " .
                                 "FROM Card_Type WHERE name = ?"
                                )) {
      $stmt->bind_param('s', $name);

      $stmt->execute();

      $stmt->bind_result(
        $id,
        $name,
        $background_image_path,
        $foreground_image_path
      );

      $stmt->fetch();

      $this->id = $id;
      $this->name = $name;
      $this->background_image_path = $background_image_path;
      $this->foreground_image_path = $foreground_image_path;

    }
  }

  /**
   * Override
   */
  public function save() {
    // NO NEW ENTRIES ALLOWED
    return;
  }

  /**
   * Override
   */
  public function delete() {
    // NO DELETING ENTRIES ALLOWED
    return;
  }

  public static function All() {
    $query = "SELECT id, name, background_image_path, foreground_image_path " .
             "FROM Card_Type WHERE 1=1";

    $result = Model::getMysqli()->query($query);

    $rows = Model::resultToArray($result);

    $results = array();

    foreach ($rows as $row) {
      $cardType = new CardType();
      $cardType->id = $row["id"];
      $cardType->name = $row["name"];
      $cardType->background_image_path = $row["background_image_path"];
      $cardType->foreground_image_path = $row["foreground_image_path"];

      $results[] = $cardType;
    }

    return $results;
  }
}


  ?>
