<!DOCTYPE html>
<html>
	<head>
	<meta charset ="UTF-8" />
	<title>Prohlížení adresářů</title>
	</head>
	<body>	
		    <h1>Prohlížení adresářů - seřazení souborů - použíti funkce scandir</h1>

		    <?php  		
			  $current_dir = $_SERVER['DOCUMENT_ROOT'].'/mis/17-prace-se-soubory/uploads/';
			  
			  echo "Funkce <strong>dirname(cesta)</strong> ".dirname($current_dir)."</br>";			  
			  echo "Funkce <strong>basename(cesta) - vrací název souboru ze zadané cesty</strong> ".basename($current_dir.'mujskript.php')."</br>";
			  echo "Funkce <strong>disk_free_space(cesta)</strong>: ".(disk_free_space($current_dir)/1024/1024/1024)." GB </br>";			  
			  echo "Funkce <strong>disk_total_space(cesta)</strong>: ".(disk_total_space($current_dir)/1024/1024/1024)." GB</br>";			  
			  
			  $files1 = scandir($current_dir);
			  $files2 = scandir($current_dir,1); // druhým parametrem nastavíme směr řazení
			  			  
			  echo '<p>Adresářem pro upload je '.$current_dir.'</p>';
			  echo '<p>Výpis adresáře seřeazný abecedně, a to vzestupně:</p><ul>';
			  
			  foreach($files1 as $file){			  			  
				  // vynecháme položky . a ..
				  if($file != '.' && $file != ".."){
					  echo '<li><a href="filedetails.php?file='.$file.'">'.$file.'</a></li>';
				  }
			  }			  
			  echo '</ul>';
			  
			  echo '<p>Výpis adresáře seřeazný abecedně, a to sestupně:</p><ul>';
			  
			  foreach($files2 as $file){			  			  
				  // vynecháme položky . a ..
				  if($file != '.' && $file != ".."){
					  echo '<li>'.$file.'</li>';
				  }
			  }			  
			  echo '</ul>';
			  			  
			?>
	</body>
</html>