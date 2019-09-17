<?php

    require_once("file_exception.php");

	$tireqty = (int)$_POST['tireqty'];
	$oilqty = (int)$_POST['oilqty'];
	$sparkqty = (int)$_POST['sparkqty'];			
	$address = preg_replace('/\t|\R/',' ',$_POST['address']);	
	$document_root = $_SERVER['DOCUMENT_ROOT'];
	$date = date('j. n. Y H:i');
	
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
		
		define('TIREPRICE', 2500);
		define('OILPRICE', 250);
		define('SPARKPRICE', 100);
		
		
		if ($totalqty==0){
			
			echo '<p style="color:red">Nic jste si neobjednal/a na předchozí stránce</p';
			
		} else {
				
			echo '<p>Objednávka byla zpracována</p>'.$date.'</p>';	
			echo '<p>Vaše objednávka:</p>';	
			
			$totalamount = 0.00;								
			$totalamount = $tireqty*TIREPRICE + $oilqty*OILPRICE + $sparkqty*SPARKPRICE;
			
			echo "<p>Objednáno položek ".$totalqty."</p>";
			
			if ($tireqty > 0){
					echo 'pneumatik: '.htmlspecialchars($tireqty).'<br />';
			}
			if ($oilqty > 0) {
					echo 'lahví oleje: '.htmlspecialchars($oilqty).'<br />';
			}
			if ($sparkqty > 0) {
					echo 'zapalovacích svíček: '.htmlspecialchars($sparkqty).'<br />';
			}
														
			
			echo"<p>Objednáno ".$totalqty."<br/>";
			
			
			echo "Cena: ".number_format($totalamount, 2)." Kč<br />";
			
			$taxrate = 0.20;
			$totalamount = $totalamount * (1+$taxrate);
			echo "Celková cena s DPH ".number_format($totalamount, 2)." Kč </p>";
						
			echo '<p>Doručovací adresa: '.htmlspecialchars($address).'</p>';
			
			$outputstring = $date."\t".$tireqty." pneumatik\t".$oilqty." lahví oleje\t".$sparkqty." zapalovacích svíček\t".$totalamount."\t".$address."\n";
						
			// otevreme soubor pro doplneni
			try {
				if( !($fp = @fopen('$document_root/../orders/orders.txt','ab'))) {
				  throw new FileOpenException();
				}					
				
				if (!flock($fp, LOCK_EX)) {	// zamek souboru - ochrana proti soubeznemu zapisu jinymi uzivateli					
				  throw new FileLockException();
				}							
				
				if(!fwrite($fp, $outputstring, strlen($outputstring))) {
				  throw new FileWriteException();
				}
				
				flock($fp, LOCK_UN);			
				fclose($fp);				
				echo "<p>Objednávka byla uložena.</p>";
			} catch (FileOpenException $foe){
				echo "<p><strong>Soubor s objednávkami se nepodařilo otevřít.<br />Prosím, kontaktujte našeho webmastera, který vám rád pomůže</strong></p>";
			} catch (Exception $e){
				echo "<p><strong>Vaše objednávka nemohla být zpracována. Zkuste to prosím později</strong></p>";
				echo $e;
			}
			
		}
								
	?>
				
	
</body>

</html>