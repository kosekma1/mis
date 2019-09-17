<!DOCTYPE html>
<html>
 <head>
	  <meta charset="UTF-8" />
	  <title>Výsledek vložení knihy do databáze Book-O-Rama</title>
  </head>
  <body>  
  <h1>Výsledek vložení knihy do databáze Book-O-Rama</h1>
  
  <?php    
	if(empty($_POST['ISBN']) || empty($_POST['Author']) || empty($_POST['Title']) || empty($_POST['Price'])) {
		echo "<p>Nezadali jste všechny povinné údaje.<br /> Vraťte se prosím zpět a zkuste to znovu</p>";
		exit;		
	}
	
	//vytváříme zkrácené názvy proměnných
	$isbn = $_POST['ISBN'];
	$author =  $_POST['Author'];
	$title =  $_POST['Title'];
	$price =  $_POST['Price'];
	
	@$db = new mysqli('localhost','bookorama','bookorama123','books');
	
	if(mysqli_connect_errno()){
		echo "<p>Chyba. Nepodařilo se připojit k databázi.<br /> Zkuste to prosím později</p>";
		exit;
	}
	
	$query = "INSERT INTO books VALUES (?, ?, ?, ?)";
	$stmt = $db->prepare($query);
	
	$stmt->bind_param("sssd",$isbn, $author, $title, $price);
	$stmt->execute();
	
	if($stmt->affected_rows > 0) {
		echo "<p>Kniha byla úspěšně vložena do databáze.</p>";
	} else {
		echo "<p>Nastala chyba.<br />Položku se nepodařilo přidat</p>";
	}
	
  ?>
  </body>
  
</html>
