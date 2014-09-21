<?php
require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
require_once(MODEL_ROOT . '/user.php');

$webRoot = WEB_ROOT;

$realm = 'Card Maker: Restricted area';
$restrictedHtml = <<<HTML
  <html>
    <head>
      <base href="$webRoot">
    </head>
    <body>
      <h1>Restricted access!</h1>
      <form method="POST" action="user/login">
      Username <input type="text" name="username" /><br/>
      Password <input type="password" name="password" /><br/>
      <input type="submit" />
      </form>
    </body>
  </html>
HTML;


// Check that the user has a session with a user set
// If the user does NOT, die with form
session_start(); 
if (empty($_SESSION['user'])) {
  die($restrictedHtml);
}


?>
