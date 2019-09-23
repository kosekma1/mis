<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Členská sekce</title>
</head>
<body>
<h1>Členská sekce</h1>

<?php
  //Ověříme relační proměnnou
  if(isset($_SESSION['valid_user'])){
	  echo '<p>Přihlásil/a jste se jako '.$_SESSION['valid_user'].'</p>';
	  echo '<p><em>Zde se nachází obsah pouze pro členy.</em></p>';
  } else {
	  echo '<p>Nejste přihlášen/a</p>';
	  echo '<p>Tuto stránku můžou vidět pouze členové</p>';
  }
?>

<p><a href="authmain.php">Zpět na domovskou stránku.</a></p>

</body>
</html>