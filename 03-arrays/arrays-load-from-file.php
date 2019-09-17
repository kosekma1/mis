<?php	
   
   // Preusporadani poli
   $pictures = array('money.jpg','car.png','fio-reklama.png');
   
   // vytvarime zkracene nazvy promennych
   $document_root = $_SERVER['DOCUMENT_ROOT'];
   
   shuffle($pictures);
   

?>   
   
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Bobovy autodíly - Výsledek objednávky</title>
	</head>
	<body>
		<h1>Bobovy autodíly</h1>
		<h1>Objednávka zákazníků</h1>
		<?php
			$orders = file("$document_root/mis/3-arrays/orders/orders.txt");
			$number_of_orders = count($orders);
			
			if($number_of_orders == 0){
				echo "<p><strong>Žádné nevyřízené objednávky<br />Zkuste to prosím později</strong></p>";
			}
			
			for($i=0; $i<$number_of_orders; $i++){
				echo $orders[$i]."<br />";
			}
		?>
	</body>
</html>
	
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   

