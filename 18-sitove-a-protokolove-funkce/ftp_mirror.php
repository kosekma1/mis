<!DOCTYPE html>
  <html>
	<head>
	<meta charset="UTF-8">	
	<title>Zrcadlení</title>
	</head>
	<body>

	
	<body>
	<h1>Zrcadlení</h1>
	
	<?php
	
		$host = 'apache.cs.utah.edu';
		$user = 'anonymous';
		$password = 'ja@priklad.cz';
		$remotefile = '/apache.org/httpd/httpd-2.4.41.tar.gz';
		$localfile = 'c:\\xampp\\htdocs\\mis\\18-sitove-a-protokolove-funkce\\httpd-2.4.41.tar.gz';		
		//$localfile = '/../httpd-2.4.41.tar.gz';		
				
		//Připojení k serveru
		$conn = ftp_connect($host);
		
		if(!$conn){
			echo 'Chyba: nelze se připojit k '.$host;
			exit;
		}
		
		echo 'Připojeno k '.$host.'<br />';
		
		// Přihlášení k serveru
		$result = @ftp_login($conn, $user, $password);
		if(!$result){
			echo 'Chyba: nelze se připojit jako '.$user;
			exit;
		}
	
		echo 'Přihlášen jako '.$user.'<br />';
		
		//Povolujeme pasivní režim
		ftp_pasv($conn, true);
		
		/* Podle času poslední úpravy zjistíme, jestli je nutná aktualizace. */
		echo 'Kontrola času poslední úpravy souboru ... <br />';
		if(file_exists($localfile)){
			$localtime = filemtime($localfile);
			echo 'Lokální soubor byl naposledy upraven ';
			echo date('j. n. Y H:i', $localtime);
			echo '<br />';
		} else {
			$localtime = 0;
		}
		
		$remotetime = ftp_mdtm($conn, $remotefile);
		if(!($remotetime>0)){
			/* To nemusí znamenat, že soubor neexistuje, ale server nemusí podporovat čas poslední úpravy. */
			echo 'Nelze načíst čas vzdáleného souboru.';
			$remotetime = $localtime + 1; //zajistíme aktualizaci
		} else {
			echo 'Poslední úprava vzdáleného souboru ';
			echo date('j. n. Y H:i', $remotetime);
			echo '<br />';
		}
		
		if(!($remotetime>$localtime)){
			echo 'Lokální kopie je aktuální. <br />';
			exit;
		}
		
		// Stažení souboru
		echo 'Stahování souboru ze serveru... <br />';
		$fp = fopen($localfile, 'wb');
		
		if(!$success = ftp_fget($conn, $fp, $remotefile, FTP_BINARY)){
			echo 'Chyba: Nelze stáhnout soubor.';
			fclose($fp);
			ftp_quit($conn);
			exit;
		} 
			
		fclose($fp);
		echo 'Soubor se podařilo stáhnout úspěšné.';
		
		//zavřeme spojení se serverem
		ftp_close($conn);							
	
	?>
	
	</body>
</html>