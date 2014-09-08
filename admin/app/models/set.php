<?php
require_once 'model.php';

class Set extends Model {
  public $id = -1;
  public $name = '';
  public $prefix = '';

  public function __construct($paramMap = []) {
    parent::construct("Set");

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
    if ($stmt = Model::getMysqli()->prepare("SELECT * from `set` Where id=?"
                                )) {
      $stmt->bind_param('i', $id);
      $stmt->execute();
      $stmt->bind_result(
        $id,
        $name,
        $prefix
      );

      $stmt->fetch();

      $this->id = $id;
      $this->name = $name;
      $this->prefix = $prefix;
    }
  }

  /**
   * Override
   */
  public function save() {
    if ($this->id < 0) {
      // Create
      if ($stmt = Model::getMysqli()->prepare("INSERT into `set` " .
                                 "(`name`, `prefix`) VALUES (" .
                                 "?, ?)"
                                 )) {
        $stmt->bind_param('ss', 
          $this->name, 
          $this->prefix);

        $stmt->execute();

        $id = Model::getMysqli()->insert_id;
        $this->load($id);
      } 
    } else {
      // Update
      if ($stmt = Model::$mysqli->prepare("UPDATE `set` SET " .
                                  "name=?, prefix=? WHERE id=?")) {
        $stmt->bind_param('ssi', 
          $this->name, 
          $this->prefix, 
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
      if ($stmt = Model::$mysqli->prepare("DELETE FROM `set` WHERE id=?")) {
        $stmt->bind_param('i', $this->id);

        $stmt->execute();
      }
    }
  }

  public static function All() {
    $query = "SELECT * " .
             "FROM `set` WHERE 1=1";

    $result = Model::getMysqli()->query($query);

    $rows = Model::resultToArray($result);

    $results = array();

    foreach ($rows as $row) {
      $set = new Set();
      $set->id = $row["id"];
      $set->name = $row["name"];
      $set->prefix = $row["prefix"];

      $results[] = $set;
    }

    return $results;
  }
}

  ?>
