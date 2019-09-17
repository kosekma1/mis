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
		<style type="text/css">
		  table, th, td {
			  border-collapse: collapse;
			  border: 1px solid black;
			  padding: 6px;
		  }
		  
		  th {
			  background: #ccccff;
		  }

		  .right {
			  text-align: right;
		  }
		</style>		
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
			echo "<table>\n";
			echo "<tr>
				<th>Datum objednání</th>
				<th>Pneumatik</th>
				<th>Lahví oleje</th>
				<th>Zapalovacích svíček</th>
				<th>Celková cena</th>
				<th>adresa</th>
				</tr>";									
			for($i=0; $i<$number_of_orders; $i++){
				$line = explode("\t", $orders[$i]);
				// zachovame jen pocet objednanych polozek - odstrani se text za cislem a prevede se na cislo
				$line[1] = intval($line[1]);
				$line[2] = intval($line[2]);
				$line[3] = intval($line[3]);
				
				echo "<tr>
					  <td>".$line[0]."</td>
					  <td class=\"right\">".$line[1]."</td>
					  <td class=\"right\">".$line[2]."</td>
					  <td class=\"right\">".$line[3]."</td>
					  <td class=\"right\">".$line[4]."</td>
					  <td>".$line[5]."</td></tr>";					  
			}
			echo "</table>";
		?>
	</body>
</html>
	
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   

