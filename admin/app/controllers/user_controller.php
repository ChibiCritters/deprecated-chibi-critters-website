<?php
require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
require_once(CONTROLLER_ROOT . '/controller.php');
require_once(MODEL_ROOT . '/user.php');

class UserController extends Controller {
  function index(&$command) {
    $command[0] = 'example';
    include ROOT . 'app/views/user/index.html.php';
  }

  function login(&$command) {
    $command[0] = 'login';

    if (!array_key_exists('username', $_POST) ||
      !array_key_exists('password', $_POST)) {
      die();
    }

    // log the user in
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = User::HasUsername($username);
    print_r($user);
    if (isset($user)) {
      if ($user->checkPassword($password)) {
        session_start();
        $_SESSION['user'] = $user;
        // redirect to card-maker
        header("Location: " . WEB_ROOT . 'card-maker/');
      }
    }

  }

}
?>