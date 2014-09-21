<?php
require_once 'model.php';

/**
 * User Model
 * 
 * Contains users for the adminstrator section that is
 * separate from the Wordpress part of the site.
 * 
 * @author Ivan Montiel
 * 
 * @package Model
 */
class User extends Model {
  public $id = -1;
  public $username = '';
  public $role = 'none';
  public $password = '';
  public $salt = "atleastit'sasalt!42";


  protected $validate = array(
    );

  public function __construct($paramMap = []) {
    parent::construct("user");

    if (isset($paramMap) && !empty($paramMap)) {
      foreach ($paramMap as $key => $value) {
        $this->$key = $value;
      }
    }
  }

  /**
   * Password is protected and must be set through this
   * function.
   *
   * This method will take care of generating a salt and 
   * hashing
   * @param String password - the raw password
   */
  public function setPassword($password) {
    // generate Salt
    $this->salt = uniqid(mt_rand(), true);

    // Set the password
    $this->password = password_hash($password, PASSWORD_BCRYPT, array(
      'salt' => $this->salt
      ));
  }

  /**
   * Check if the given password is equal the the one in this
   * object after being salted and hashed.
   * 
   * @param String password - the password to check
   * @return Boolean
   */
  public function checkPassword($password) {
    $result = password_hash($password, PASSWORD_BCRYPT, array(
      'salt' => $this->salt
      ));

    return (strcmp($result, $this->password) === 0);
  }

  /**
   * @override
   * @see Model
   */
  public function load($id) {
    $sql = <<<SQL
      SELECT
        `user`.id,
        `user`.username,
        `user`.role,
        `user`.password,
        `user`.salt
      FROM
        `user`
      WHERE
        `user`.id = ?
SQL;
    if ($stmt = Model::getMysqli()->prepare($sql)) {
      $stmt->bind_param('i', $id);
      $stmt->execute();
      $stmt->bind_result(
        $id,
        $username,
        $role,
        $password,
        $salt
        );

      $stmt->fetch();

      $this->id = $id;
      $this->username = $username;
      $this->role = $role;
      $this->password = $password;
      $this->salt = $salt;
    }
  }

  /**
   * New users will throw an exception! You must create new
   * users through the database interface!
   * 
   * @override
   * @see Model
   */
  public function save() {
    if ($this->id < 0) {
      throw new Exception('Cannot create a new user!'); 
    } else {
      // Update
      $sql = <<<SQL
        UPDATE
          `user`
        SET
          `user`.username = ?,
          `user`.role = ?,
          `user`.password = ?,
          `user`.salt = ?
        WHERE
          `user`.id = ?
SQL;
      if ($stmt = Model::$mysqli->prepare($sql)) {
        $stmt->bind_param('ssssi',
          $this->username,
          $this->role,
          $this->password,
          $this->salt,
          $this->id);

        $stmt->execute();
      }
    }
  }

  /**
   * Deleting users will throw an exception! You must delete
   * users through the database interface!
   * 
   * @override
   * @see Model
   */
  public function delete() {
    throw new Exception('Cannot delete a user!');
  }

  public static function HasUsername($username) {
    $sql = <<<SQL
      SELECT
        `user`.id,
        `user`.username,
        `user`.role,
        `user`.password,
        `user`.salt
      FROM
        `user`
      WHERE
        `user`.username = ?
SQL;
    
    if ($stmt = Model::getMysqli()->prepare($sql)) {
      $stmt->bind_param('s', $username);
      $stmt->execute();
      $stmt->bind_result(
        $id,
        $username,
        $role,
        $password,
        $salt
        );
      $result = $stmt->fetch();

      $user = new User(array(
        'id' => $id,
        'username' => $username,
        'role' => $role,
        'password' => $password,
        'salt' => $salt
        ));

      return $user;
    }
  }

  /**
   * Check if the database has a user with the username
   * and password provided. 
   * 
   * @param String $username
   * @param String $password
   * @return Boolean
   */
  public static function CheckUserCredentials($username, $password) {
    $user = User::HasUsername($username);

    return $user->checkPassword($password);
  }
}