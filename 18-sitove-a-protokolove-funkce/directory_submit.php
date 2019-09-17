<!DOCTYPE html>
  <html>
	<head>
	<meta charset="UTF-8">	
	<title>Výsledek odeslání stránek</title>
	</head>
	<body>

	
	<body>
	<h1>Výsledek odeslání stránek</h1>
	  <?php
	    $url = $_POST['url'];
		$email = $_POST['email'];
		
		// overujeme platnost url adresy
		$url = parse_url($url);
		$host = $url['host'];		
		
		if(($ip=gethostbyname($host)) == $host) {			
			echo 'K zadanému hostiteli neexistuje platná adresa IP.';
			exit;
		}
		
		// z ip adresy lze získat název hostitele pomocí funkce gethostbyaddr(); problém může nastat s virtuálním hostingem, kdy pod jednou IP adresou funguje více serverů, takže host name se nebudou rovnat
		
		echo 'Hostitel ('.$host.') se nachází na adrese IP '.$ip.' <br />';
		
		//Ověřujeme platnost emailové adresy
		$email = explode('@',$email);
		$emailhost = $email[1];
		
		if(!getmxrr($emailhost, $mxhostsarr)){
			echo 'Emailová adresa nemá platný název hostitele.';			
		}
		
		echo 'Emaily prochází skrz: <br />';
		
		echo '<ul>';
		foreach($mxhostsarr as $mx){
			echo '<li>'.$mx.'</li>';			
		}
		echo '</ul>';
		
		//Pokud jsme se dostali až sem, je vše v pořádku.
		echo '<p>Všechny zadané údaje jsou v pořádku</p>';
		echo '<p>Děkujeme za odeslání vašich webových stránek. Brzy je navštíví naši zaměstnanci.</p>';
		// Ve skutečné aplikaci bychom dále uložili webové stránky do databáze.				
		
	  ?>
		
	
	</body>
 </html>