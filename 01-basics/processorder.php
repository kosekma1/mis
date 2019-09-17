<?php
	$tireqty = $_POST['tireqty'];
	$oilqty = $_POST['oilqty'];
	$sparkqty = $_POST['sparkqty'];			
	$find = $_POST['find'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Bobovy autodíly - výsledek objednávky</title>
</head>

<body>
	<h1>Bobovy autodíly</h1>
		
	<h2>Výsledek objednávky</h2>			
	
	<?php
		
		if ( isset($tireqty, $oilqty, $sparkqty) && (!empty($tireqty) || !empty($oilqty) || !empty($sparkqty)) ){
			$totalqty = $tireqty + $oilqty + $sparkqty;
		} else {
			$totalqty = 0;
		}
		
		print_r($_POST);
		
		if ($totalqty==0){
			
			echo '<p style="color:red">Nic jste si neobjednal/a na předchozí stránce</p';
			
		} else {
	
			echo '<p>Objednávka byla zpracována</p>'.date('j. n. Y H:i').'</p>';	
			
			
			echo '<p>Vaše objednávka</p>';
			echo 'pneumatik: '.htmlspecialchars($tireqty).'<br />';
			echo 'lahví oleje: '.htmlspecialchars($oilqty).'<br />';
			echo 'zapalovacích svíček: '.htmlspecialchars($sparkqty).'<br />';
			
			
			echo"<p>Objednáno ".$totalqty."<br/>";
			$totalamount = 0.00;
		
			define('TIREPRICE', 2500);
			define('OILPRICE', 250);
			define('SPARKPRICE', 100);
			
			$totalamount = $tireqty*TIREPRICE + $oilqty*OILPRICE + $sparkqty*SPARKPRICE;
			
			echo "Cena: ".number_format($totalamount, 2)." Kč<br />";
			
			$taxrate = 0.20;
			$totalamount = $totalamount * (1+$taxrate);
			echo "Celková cena s DPH ".number_format($totalamount, 2)." Kč </p>";
			
			switch($find){
				case "a":
					echo  "<p>Stálý zákazník.</p>";
					break;
				case "b":
					echo  "<p>Zákazník oslovený televizní reklamou.</p>";
					break;
				case "c":
					echo  "<p>Zákazník, který našel odkaz v telefonním seznamu.</p>";
					break;
				case "d":
					echo  "<p>Zákazník, kterého odkázal známý.</p>";
					break;
				default:
					echo "<p>Není jasné, jak nás tento zákazník našel.</p>";
					break;
			}
		}
								
	?>
	
	<h2>Cena dopravy</h2>
	<table style="border: 0px; padding :3px">
			<tr>
			  <td style="background: #cccccc; text-align: center;">Vzdálenost</td>
			  <td style="background: #cccccc; text-align: center;">Cena</td>
			</tr>
			
			<?php
				$distance = 50;
				while($distance <= 250){
					echo "<tr>
					      <td style=\"text-align: right;\">".$distance."</td>
						  <td style=\"text-align: right;\">".($distance*2.5)."</td>
						  </tr>\n";
					$distance += 50;							
				}
			?>
			
	
</body>

</html>