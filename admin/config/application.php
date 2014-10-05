<?php
/**
 * Application Wide Settings
 */

// CHANGE ME IF YOU MOVE THE PROJECT AROUND!
define("SUB", '');

define("ROOT", realpath(dirname(__FILE__)) . '/../');
define("ASSET_ROOT", ROOT . 'app/assets');
define("CONTROLLER_ROOT", ROOT . 'app/controllers');
define("MODEL_ROOT", ROOT . 'app/models');
define("HELPER_ROOT", ROOT . 'app/helpers');
define("LIB_ROOT", ROOT . 'lib/');

define("WEB_ROOT", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . SUB . '/admin/');

require_once(ROOT . 'lib/spyc.php');

function loadLocale($locale) {
  return spyc_load_file(ROOT . '/locales/' . $locale .  '.yml');
}

function route($routes) {
  // BEGIN ROUTING
  $requestURI = explode('/', $_SERVER['REQUEST_URI']);
  $scriptName = explode('/', $_SERVER['SCRIPT_NAME']);


  for ($i = 0; $i < sizeof($scriptName) && $i < sizeof($requestURI); $i++) {
    if ($requestURI[$i] == $scriptName[$i]) {
      unset($requestURI[$i]);
    } 
  }

  $command = array_values($requestURI);

  for ($i = 0; $i < sizeOf($command); $i++) {
    $command[$i] = preg_replace("/\?(.*)+/", '', $command[$i]);
  }

  // Determine dispatcher
  $route = $routes;
  while (is_array($route) && $route != null) {

    if (0 < sizeof($command) &&
        isset($route[$command[0]])) {

      $leftCommand = array_shift($command);
      $route = $route[$leftCommand];
    }
    else {
      $route = $route['/'];
      break;
    }

  }

  // Readd the last one
  if (isset($leftCommand)) {
    array_unshift($command,$leftCommand);
  }

  $dispatch = $route;


  if (isset($dispatch)) {
    // remove any plans to try to go up directories
    for ($i = 0; $i < sizeof($command); $i++) {
      $command[$i] = str_replace('..', '', $command[$i]);
    }

    $dispatch->route($command);
  }
  else {
    echo '<p>Could not find path!</p>';
  }

  // END ROUTING
}



define('LOCALE', serialize(loadLocale('en')));
?>