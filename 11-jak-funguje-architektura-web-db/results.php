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
		
		@$db = new mysqli('localhost','bookorama', 'bookorama123', 'books');
		//databázi lze změnit $db->select_db(nazev) nebo procedurálně mysqli_select_db(prostredek, nazev)
		
		if(mysqli_connect_errno()){
			echo '<p>Chyba: Nepodařilo se připojit k databázi. <br />
					Zkuste to prosím později.</p>';
			exit;
		}

		/* change character set to utf8 */
		if (!$db->set_charset("utf8")) {
			printf("Error loading character set utf8: %s\n", $db->error);
			exit();
		} else {
			printf("Current character set: %s\n", $db->character_set_name());
		}
		
		$query = "SELECT isbn, author, title, price FROM books WHERE $searchtype LIKE ?";
		$stmt = $db->prepare($query); // připravený příkaz - mohu bindovat parametry kolikrát chci => vhodné pro načítání velkého množství dat
		$searchterm = '%'.$searchterm.'%';
		$stmt->bind_param('s', $searchterm); // s=textový řetězec, i=celé číslo, b=...
		$stmt->execute();
		$stmt->store_result(); //načtení všech řádků a uložení do mezipaměti
		
		$stmt->bind_result($isbn, $author, $title, $price); //bindování výsledků do vázaných proměnných
		
		echo "<p>Počet nalezených knih: ".$stmt->num_rows."</p>";
		
		while($stmt->fetch()){ //každé volání načte výsledek do čtyř vázaných proměnných, alternativy mysqli_fetch_object - vrátí výsledek jako objekt, v němž jsou hodnoty uložené ve vlastnostech, jejižch názvy se shodují s názvy sloupců
			echo "<p><strong>Název: ".$title."</strong>";
			echo "<br/>Autor: ".$author;
			echo "<br/>ISBN: ".$isbn;
			echo "<br/>Cena: ".number_format($price,2)." Kč</p>";
		}
		
		$stmt->free_result(); //uvolnění výsledné sady z paměti
		$db->close(); //volání není povinné, každý skript se na své konci automticky odpojuje od databáze
		
    ?>
	</body>
</html>