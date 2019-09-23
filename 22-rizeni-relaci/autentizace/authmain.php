<?php
session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
	//uživatel se pokusil přihlásit
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$db_conn = new mysqli('localhost','webauth','webauth','auth');
	
	if(mysqli_connect_errno()){ // pokud !=0 to je bez chyby
		echo 'Připojení k databázi selhalo: '.mysqli_connect_errno();
		exit();
	}
	
	$query = "SELECT * FROM authorized_users where name= '".$username."' AND
	          password = sha1('".$password."')";
	$result = $db_conn->query($query);
	if($result->num_rows) { //pokd něco našel tzn. počet řádek je nenulový
		//Našli jsme uživatele v databázi, takže si uložíme jeho uživatelské jméno
		$_SESSION['valid_user'] = $username;
	}
	
	$db_conn->close();
	
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Domovská stránka</title>
  <style type="text/css">
    fieldset {
		width: 50%;
		border: 2px solid #ff0000;
	}
	legend {
		font-weight: bold;
		font-size: 125%;		
	}
	label {
	  width: 125px;
      float: left;
	  text-align: left;	  
	  font-weight: bold;
	}
	input {
		border: 1px solid #000;
		padding: 3px;
	}
	button {
		margin-top: 12px;
	}		
  </style>  
</head>
  <body>
  <h1>Domovská stránka</h1>
  <?php
    if(isset($_SESSION['valid_user'])){
		echo '<p>Přihlásil/a jste se jako: '.$_SESSION['valid_user'].'<br />';
		echo '<a href="logout.php">Odhlásit</a></p>';		
	} else {
	  if (isset($username)){
		  //Uživatel se pokusil přihlásit, ale neúspěšně.
		  echo '<p>Zadal/a jste špatné uživatelské jméno nebo heslo.</p>';
	  } else {
		  //Uživatel se nepokusil přihlásit nebo se odhlásil.
		  echo '<p>Nejste přihlášen/a</p>';
	  }
	
	
	//Zobrazujeme přihlašovací formulář	
      echo '<form action="authmain.php" method="post">';
      echo '<fieldset>';
      echo '<legend>Přihlaste se!</legend>';
      echo '<p><label for="username">Uživatelské jméno:</label>';
      echo '<input type="text" name="username" id="username"
                   size="30"/></p>';
      echo '<p><label for="password">Heslo:</label>';
      echo '<input type="password" name="password" id="password"
                   size="30"/></p>';
      echo '</fieldset>';
      echo '<button type="submit" name="login">Přihlásit</button>';
      echo '</form>';
	}
  ?>
  <p><a href="members_only.php">Navštívit členskou sekci.</a></p>
</body>
</html>