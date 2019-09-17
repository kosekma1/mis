<?php
  
  // vytvarime zkracena nazvy promennych
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $feedback = trim($_POST['feedback']);  
 
  if ( isset($name, $email, $feedback) && (!empty($name) && !empty($email) && !empty($feedback)) ){			
			$process = True;
		} else {
			$process = False;
		}
  
  if ($process) {
	  
	  // pripravujeme staticke informace
	  $toaddress = "feedback@priklad.cz";
	  
	  $subject = "Zpětná vazba";
	  
	  $mailcontent = "Jméno zákazníka: ".str_replace("\r\n","", $name)."\n". // odstraneni \r\n je dulezite hlavne pri vkladani textu do emailu aby nedoslo k tzv. injekci hlavicek
					 "E-mail zákazníka: ".str_replace("\r\n","", $email)."\n".
					 "Komentář zákazníka:\n".str_replace("\r\n","", $feedback);
					 
	  $dodatecne_hlavicky = "From: webserver@priklad.cz\r\n
					  Reply-to: bob@priklad.cz";
	  
	  // odesilame e-mail funkci mail() - paty parametr se predava programu nakonfigurovanem pro odesilani emailu
	  @mail($toaddress,$subject,$mailcontent,$dodatecne_hlavicky); // znak @ potlacuje vypis chyb - chybove odesilani zpomaluje skript
  }
  
?>

<!DOCTYPE html>

<html>
	<head>
		<title>Bobovy autodíly - <?php $process ? "Zpětná vabza odeslána" : "Chyba ve formuláři" ?></title>
	</head>
	<body>
		<h1><?php echo $process ? "Zpětná vazba odeslána" : "Chyba ve formuláři" ?></h1>
		<?php 
			if ($process) {
			 echo "<p>Vaše zpětná vazba byla úspěšně odeslána</p>";
			 echo "<p>".nl2br(htmlspecialchars($mailcontent))."</p>";
			} else {
				echo "<p>Ve formuláři byly chyby a nešel proto odeslat.</p>";
			}		
		 ?>
	<body>
</html>

