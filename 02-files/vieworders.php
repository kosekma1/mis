<?php

	$documentroot = $_SERVER['DOCUMENT_ROOT'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Bobovy autodíly - Výsledek objednávky</title>		
	</head>
	
	<body>
	<h1>Bobovy autodíly</h1>
	<h2>Objednávky zákazníků</h2>
	
	<?php
	
		@$fp = fopen('$documentroot/../orders/orders.txt','rb');
		flock($fp, LOCK_SH); //uzamkneme soubor pro cteni
		
		if(!$fp){
			echo "<p><strong>Žádné nevyřízené objednávky<br />Zkuste to prosím později</strong></p>";			
			exit;
		} 
		
		while (!feof($fp)){
			$order = fgets($fp);
			echo htmlspecialchars($order)."<br />";
		}
		
		flock($fp, LOCK_UN); //uvolnime zamek pro cteni
		fclose($fp);
		
		echo "<h2>Alternativní čtení ze souboru</h2>";
		
		if (file_exists('$documentroot/../orders/orders.txt')){
	       $fp = fopen('$documentroot/../orders/orders.txt','rb');
		   flock($fp, LOCK_SH); //uzamkneme soubor pro cteni
		   echo nl2br(fread($fp, filesize('$documentroot/../orders/orders.txt'))); // funkce nl2br prevede /n na <br> a nacte cely soubor del filesize
		   flock($fp, LOCK_UN); //uvolnime zamek pro cteni
		   echo '<br />Přechozí pozice v souboru byla '.(ftell($fp)).'<br />';
		   rewind($fp);
		   echo 'Po přetočení je pozice v souboru '.(ftell($fp));
		   fclose($fp);		   
		} else {
			echo 'Žádné nové objednávky';
		}
		
		//unlink('$documentroot/../orders/orders.txt'); // smazani souboru
							
		
	?>
	
	</body>
</html>
