<?php
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 

  // Using locales
  $locale = unserialize(LOCALE);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Chibi Critters</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="assets/css/styles.css" rel="stylesheet">
  </head>
  <body>

<div class="header vert">
  <div class="container">
    
    <h1><?php echo $locale['home']['title'] ?></h1>
      <p class="lead">Administration</p>
      <div>&nbsp;</div>
  </div>
</div>


<div class="featurette" id="sec2">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 text-center">
        <h1>Internal Tools</h1>
        <br>
      </div>
  </div>
  
  <div class="container well well-lg">
    
    <div class="row">
        
        <div class="col-sm-3">
          <div class="list-group">
            <a href="./card-maker/" class="list-group-item">Card Maker</a>
          </div>
        </div>  
    </div>
  </div>
  </div>
</div>

<footer>
  <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>