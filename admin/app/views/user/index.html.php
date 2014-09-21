<html>

<body>
<?php echo $_GET['password']; ?><br/>
<?php 
  require_once(MODEL_ROOT . '/user.php');
  $user = new User();
  $user->setPassword($_GET['password']);
  echo $user->password . "<br>";
  echo $user->salt;
?>
</body>
</html>