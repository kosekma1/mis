<!DOCTYPE html>
  <html>
	<head>
	<meta charset="UTF-8">	
	<title>Cena akcií RM Systému</title>
	</head>
	<body>

	<?php
	  // Vybereme akcii
	  echo '<h1>Přehle cen akcí v RM Systému</h1>';
	  	  	  
	  $url = 'https://akcie-cz.kurzy.cz/rm-system/kurzy/rm-system.csv?day=';
	  
	  if(!($contents = file_get_contents($url))){
		  die('Nepodařilo se otevřít '.$url);
	  }
	  	  	  
	  $contents = mb_convert_encoding( $contents, "UTF-8", "Windows-1252");
	  
	  // Extrahujeme data.	  	  
	  $lines = explode("\n", $contents);
	  echo '<table border=1>';
	  foreach($lines as $line){
		  if (trim($line)!=""){ // pokud není řádka prázdná
			  $items = explode(';', $line);
			  echo '<tr>';
			  foreach($items as $label){
				  echo '<td>'.$label.'</td>';		  
			  }
			  echo '</tr>';
	      }
	  }
	  echo '</table>';

	  
	  // Přiznáme zdroj
	  echo '<p>Tato informace pochází z <br /><a href="'.$url.'">'.$url.'</a>.</p>';
	  	
	?>
	
	</body>
 </html>