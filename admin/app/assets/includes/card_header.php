<?php
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
  include ROOT . "app/helpers/auth_helper.php"; 


  $webRoot = WEB_ROOT;
  $viewPath = WEB_ROOT . "card-maker/cards/";
  $createPath = WEB_ROOT . "card-maker/cards/create";
  $setViewPath = WEB_ROOT . "card-maker/sets/";
  $setCreatePath = WEB_ROOT . "card-maker/sets/create";
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
  <!--<![endif]-->
  <head>
    <base href="<?php echo $webRoot ?>">
    <meta name="generator" content="" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title></title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="stylesheet" href="<?php echo $webRoot; ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo $webRoot; ?>assets/css/normalize.css" />
    <link rel="stylesheet" href="<?php echo $webRoot; ?>assets/css/card-maker-main.less.css" />
    <script src="<?php echo $webRoot; ?>assets/javascript/vendor/modernizr-2.6.2.min.js"></script>
  </head>
  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Chibi Critters Card Maker</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo $viewPath; ?>">View Cards</a></li>
            <li><a href="<?php echo $createPath; ?>">Create a Card</a></li>
            <li><a href="<?php echo $setViewPath; ?>">View Sets</a></li>
            <li><a href="<?php echo $setCreatePath; ?>">Create a Set</a></li>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

  <div class="container">
