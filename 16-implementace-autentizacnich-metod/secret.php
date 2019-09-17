<!DOCTYPE html>
<html>
	<head>
	<meta charset ="UTF-8" />
	<title>Tajná stránka</title>
	</head>
	<body>
	<?php
	  if ((!isset($_POST['name'])) || (!isset($_POST['password']))){
	?>
		    <h1>Přihlaste se, prosím</h1>

			<form action="secret.php" method="post">
				<p>
				<label for="name">Uživatelské jméno:</label>
				<input type ="text" name="name" size="15" /></p>
				
				<p>
				<label for="password">Heslo:</label>
				<input type ="password" name="password" size="15" /></p>				

				<button type="submit" name="submit">Přihlásit</button>
			</form>		  
	<?php
	  } else if(($_POST['name'] == 'uživatel') && ($_POST['password'] == 'heslo')) {
		  //kombinace uživatelského jména a hesla je správná
		  echo '<h1>A je to!</h1>
				<p>Určitě jste rád/a, že vidíte tuto tajnou stránku.</p>';				
	  } else {
		  //kombinace uživatelského jména a hesla není platná
		  echo '<h1>Jděte pryč!</h1>
				<p>Nejste oprávněni používat tuto stránku.</p>';				
	  }	
	?>	
	</body>
</html>