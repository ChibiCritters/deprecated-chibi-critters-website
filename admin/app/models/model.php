<?php
require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
require_once(ROOT . 'lib/spyc.php');

/**
 * Class for Models to inherit from.
 * This class will handle DB queries.
 */
abstract class Model {
  protected static $mysqli;
  // Go ahead and override this in child classes, that's what it is for.
  protected $validate = array();

  private static $ip = null;
  private static $user = null;
  private static $password = null;
  private static $database = null;

  private $tableName = "";

  public function construct($tableName) {
    $this->tableName = $tableName;

    Model::getMysqli();
  }

  public static function getMysqli() {
    if (empty(Model::$mysqli)) {
      $parsed = spyc_load_file(ROOT . 'config/database.yml');
      
      Model::$ip = $parsed['database']['ip'];
      Model::$user = $parsed['database']['username'];
      Model::$password = $parsed['database']['password'];
      Model::$database = $parsed['database']['database'];

      Model::$mysqli = new mysqli(
      Model::$ip,
      Model::$user,
      Model::$password,
      Model::$database);
    }

    return Model::$mysqli;
  }

  public static function resultToArray($result) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
  }


  abstract public function load($id);

  abstract public function save();

  abstract public function delete();

  public function __set($name, $value) {
    if (in_array($name, $this->validate)) {
      $result = $this->validate[$name]($value);

      if (!$result) {
        throw new ValidationException("$name cannot have value [$value]");
      }
    }
    $this[$name] = $value;
  }
}
?>
