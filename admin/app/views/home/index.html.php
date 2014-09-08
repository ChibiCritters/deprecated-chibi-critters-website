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

<div class="navbar navbar-fixed-top navbar-bold" data-spy="affix" data-offset-top="1000">
  <div class="container">
    <div class="navbar-header">
      <a href="#" class="navbar-brand">Home</a>
      <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    </div>
    <div class="navbar-collapse collapse" id="navbar">
      <ul class="nav navbar-nav">
        <li><a href="#sec1">Video</a></li>
        <li><a href="#sec2">How to Play</a></li>
        <li><a href="#sec3">Archetypes</a></li>
        <li><a href="#sec4">Coming Soon</a></li>
      </ul>
    </div>
   </div>
</div>

<div class="header vert">
  <div class="container">
    
    <h1><?php echo $locale['home']['title'] ?></h1>
      <p class="lead"><?php echo $locale['home']['description'] ?></p>
      <div>&nbsp;</div>
      <a href="#sec2" class="btn btn-default btn-lg"><i class="fa fa-play-circle-o"></i> How To Play</a>
    <a href="#sec4" class="btn btn-default btn-lg"><i class="fa fa-shopping-cart"></i> Buy It Now</a>
  </div>
</div>

<div id="sec1" class="blurb">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1>The Simplicity of Bootstrap</h1>
        <p class="lead">The Most Popular Responsive Framework</p>
      </div>
    </div>
  </div>
</div>

<div class="featurette" id="sec2">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1>Flow of A Turn</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2 col-md-offset-2 text-center">
        <div class="featurette-item">
          <i class="icon-rocket"></i>
          <h4>Draw</h4>
          <p>Replenish your hand by drawing a card.</p>
        </div>
      </div>
      <div class="col-md-2 text-center">
        <div class="featurette-item">
          <i class="icon-magnet"></i>
          <h4>Summon</h4>
          <p>Summon up to one Critter per turn.</p>
        </div>
      </div>
      <div class="col-md-2 text-center">
        <div class="featurette-item">
          <i class="icon-shield"></i>
          <h4>Love</h4>
          <p>Equip one Love to a Critter you control.</p>
        </div>
      </div>
      <div class="col-md-2 text-center">
        <div class="featurette-item">
          <i class="icon-pencil"></i>
          <h4>Quest</h4>
          <p>Attempt a Quest. Complete 5 and you win!</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="callout" id="sec3">
  <div class="vert">
    <div class="col-md-12 text-center"><h2>Unlock The Power Of Drizzle Dynastys and Painter Dragons</h2></div>
    <div class="col-md-12 text-center">&nbsp;</div>
    <div class="col-md-8 col-md-offset-2 text-center">
      <div class="row hidden-xs">
       <div class="col-sm-2"><img class="img-circle grayscale" src="http://www.gravatar.com/avatar/5c708a2c9d25d1f2e4195ece1f1c684d?s=80"></div>
       <div class="col-sm-2"><img class="img-circle grayscale" src="http://www.gravatar.com/avatar/3bb38f66f79ca138f318af89fe6b02ec?s=80"></div>
       <div class="col-sm-2"><img class="img-circle grayscale" src="http://www.gravatar.com/avatar/3423a3e32fda92a5aaed72c7cde3849c?s=80"></div>
       <div class="col-sm-2"><img class="img-circle grayscale" src="http://www.gravatar.com/avatar/325b6c3c0a75bfdb72822035bb556826?s=80"></div>
       <div class="col-sm-2"><img class="img-circle grayscale" src="http://www.gravatar.com/avatar/cdd69340b0cfac4c7acb892e3ea7556e?s=80"></div>  
       <div class="col-sm-2"><img class="img-circle grayscale" src="http://www.gravatar.com/avatar/889778901fb1522dac2846ffe62bd960?s=80"></div>
     </div>
    </div>
  </div>
</div>

<div class="blurb" id="sec4">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1>Chibi Critters Is Coming Soon</h1>
        <p>Want to sign up for email alerts and news updates? Sign up here!</p>
      </div>
    </div>
  </div>
</div>

<hr>

<div class="gallery">
  
  <div class="row">
      <div class="col-md-6 col-md-offset-3 text-center">
        <h5>This Template is Responsive</h5>
        <h2>Features Galore</h2>
        <br>
      </div>
  </div>
  
  <div class="container well well-lg">
    
    <div class="row">
        
        <div class="col-sm-3">
          <div class="list-group">
            <a href="#" class="list-group-item">
              <span class="text-success"><i class="icon-film"></i></span> Carousel</a>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="list-group">
            <a href="#" class="list-group-item">
              <span class="text-success"><i class="icon-folder-close-alt"></i></span> Tabs</a>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="list-group">
            <a href="#" class="list-group-item">
              <span class="text-success"><i class="icon-credit-card"></i></span> Modal</a>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="list-group">
            <a href="#" class="list-group-item">
              <span class="text-success"><i class="icon-reorder"></i></span> Navigation</a>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="list-group">
            <a href="#" class="list-group-item">
              <span class="text-success"><i class="icon-mobile-phone"></i></span> Mobile-first</a>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="list-group">
            <a href="#" class="list-group-item">
              <span class="text-success"><i class="icon-align-justify"></i></span> Accordion</a>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="list-group">
            <a href="#" class="list-group-item">
              <span class="text-success"><i class="icon-list-alt"></i></span> Panel</a>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="list-group">
            <a href="#" class="list-group-item">
              <span class="text-success"><i class="icon-check"></i></span> Form</a>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="list-group">
            <a href="#" class="list-group-item">
              <span class="text-success"><i class="icon-table"></i></span> Table</a>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="list-group">
            <a href="#" class="list-group-item">
              <span class="text-success"><i class="icon-eye-open"></i></span> Icons</a>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="list-group">
            <a href="#" class="list-group-item">
              <span class="text-success"><i class="icon-th"></i></span> Responsive Grid</a>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="list-group">
            <a href="#" class="list-group-item">
              <span class="text-success"><i class="icon-font"></i></span> Typography</a>
          </div>
        </div>      
    </div>
  </div>
</div>

<div class="blurb">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1>Kickstart Your Web Design</h1>
        <p class="lead">With this Responsive Bootstrap Template</p>
      </div>
    </div>
  </div>
</div>

<div class="blurb bright">
  
  <div class="row">
      <div class="col-md-6 col-md-offset-3 text-center">
        <h3>Smashing Heading</h3>
        <br>
      </div>
  </div>
  
  <div class="row">
    <div class="col-sm-4 col-sm-offset-2">
         <div class="panel panel-default">
         <div class="panel-heading text-center"><h2>Drizzle Dynastys</h2></div>
         <div class="panel-body text-center">Conquer the mind and unleash the 
     awesome powers of the elements with these fierce warriors. Dizzle Dynastys
     are centred around sending cards directly from the deck to the Graveyard,
     allowing them to create powerful combinations with the many different weapons 
     hidden in the deck. Use their effects to overwhelm your opponent and win!<hr>
          <button class="btn btn-lg btn-primary btn-block">Login</button> 
          </div>
         </div>
  </div>
    <div class="col-sm-4">
         <div class="panel panel-default">
         <div class="panel-heading text-center"><h2>Painter Dragons</h2></div>
         <div class="panel-body text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
          Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis 
          dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
          Aliquam in felis sit amet augue.<hr>
          <button class="btn btn-lg btn-primary btn-block">Sign Up</button> 
           
          </div>
         </div>
  </div>
  </div>
</div>


<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 text-center">
        <ul class="list-inline">
          <li><a href='https://www.facebook.com/ChibiCritters'><i class="icon-facebook icon-2x"></i></li></a>
          <li><a href='https://twitter.com/ChibiCritters'><i class="icon-twitter icon-2x"></i></li></a>
          <li><a href='http://chibicritters.tumblr.com/'><i class="icon-tumblr icon-2x"></i></li></a>
        </ul>
        <a href="./card-maker">Internal Tools</a>

  <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>