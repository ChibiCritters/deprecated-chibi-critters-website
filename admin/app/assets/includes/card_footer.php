<?php
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
 
  $webRoot = WEB_ROOT;
?>
</div>
  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="<?php echo $webRoot; ?>/assets/javascript/bootstrap.min.js"></script>
  <script src="<?php echo $webRoot; ?>/assets/javascript/knockout-3.1.0.js"></script>
  <script src="<?php echo $webRoot; ?>/assets/javascript/plugins.js"></script>
  <script src="<?php echo $webRoot; ?>/assets/javascript/main.js"></script>
  <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

  <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src=&#39;//www.google-analytics.com/analytics.js&#39;;
            r.parentNode.insertBefore(e,r)}(window,document,&#39;script&#39;,&#39;ga&#39;));
            ga(&#39;create&#39;,&#39;UA-XXXXX-X&#39;);ga(&#39;send&#39;,&#39;pageview&#39;);

</script></body>
</html>
