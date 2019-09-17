<!DOCTYPE html>
<html>
	<head>
	  <meta charset="UTF-8" />
	  <title>Výsledky hledání Book-O-Rama</title>
	</head>

	<body>
	<h1>Výsledky hledání Book-O-Rama</h1>
	<?php
		//vytváříme zkrácené názvy proměnných
		$searchtype = $_POST['searchtype'];
		$searchterm = trim($_POST['searchterm']);
		
		if (!$searchtype || !$searchterm){
			echo '<p>Nezadali jste některý z údajů pro vyhledávání. <br />
			Vraťte se prosím zpět a zkuste to znovu</p>';
			exit;			
		}
	
		//ověřujeme typ hledání
		switch($searchtype){
			case 'Title':
			case 'Author':
			case 'ISBN':
			  break;
			default:
			  echo '<p>Nezadali jste platný typ hledání. <br />
					Vraťte se prosím zpět a zkuste to znovu';
			  exit;
		}
		
		//nastavení pro PDO - obecné databázové rozhraní PDO
		$user = 'bookorama';
		$pass = 'bookorama123';
		$host = 'localhost';
		$db_name = 'books';
		
		//nastavení názvu DNS
		$dns = "mysql:host=$host;dbname=$db_name";
		
		//připojení k databázi
		try {
			//připojení včetně nastavení kódování
			$db = new PDO($dns, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));						
			
			//provedení dotazu
			$query = "SELECT isbn, author, title, price FROM books WHERE $searchtype LIKE :searchterm";
			$stmt = $db->prepare($query); // připravený příkaz - mohu bindovat parametry kolikrát chci => vhodné pro načítání velkého množství dat
			$searchterm = '%'.$searchterm.'%';
			$stmt->bindParam(':searchterm', $searchterm); // s=textový řetězec, i=celé číslo, b=...
			$stmt->execute();
			
			//zobrazuje počet nalezených řádků
			echo "<p>Počet nalezených knih: ".$stmt->rowCount()."</p>";
			
			//zobrazujeme jednotlivé řádky
			while($result = $stmt->fetch(PDO::FETCH_OBJ)){
				echo "<p><strong>Název: ".$result->title."</strong>";
				echo "<br/>Autor: ".$result->author;
				echo "<br/>ISBN: ".$result->isbn;
				echo "<br/>Cena: ".number_format($result->price,2)." Kč</p>";
			}
			
			//odpojení od databáze
			$db = NULL;
		} catch (PDOException $e){
			echo "Chyba: ".$e->getMessage();
			exit;
		}			
		
    ?>
	</body>
</html>