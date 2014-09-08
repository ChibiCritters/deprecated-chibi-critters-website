<?php
require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
require_once(CONTROLLER_ROOT . '/controller.php');

class HomeController extends Controller {
  function index(&$command) {
    $command[0] = 'home';
    include ROOT . 'app/views/home/index.html.php';
  }

}
?>