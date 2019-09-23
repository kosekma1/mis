<?php
session_start();
 //Ukládáme si hodnotu relační proměnné, abychom mohli ověřit, zda byl uživatel přihlášený
 $old_user = $_SESSION['valid_user'];
 unset($_SESSION['valid_user']);
 session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Odhlášení</title>
</head>
<body>
<h1>Odhlášení</h1>
<?php
  if(!empty($old_user)){
	  echo '<p>Byl/a jste odhlášen/a.</p>';
  } else {
	  //Uživatel nebyl přihlášen, ale nějak se dostal na tuto stránku.
	  echo '<p>Nebyl/a jste přihlášen/a, proto odhlášení nebylo nutné.</p>';
  }   
?>

<p><a href="authmain.php">Zpět na domovskou stránku.</a></p>
</body>
</html>

