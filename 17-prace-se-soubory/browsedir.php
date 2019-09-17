<!DOCTYPE html>
<html>
	<head>
	<meta charset ="UTF-8" />
	<title>Prohlížení adresářů</title>
	</head>
	<body>	
		    <h1>Prohlížení adresářů</h1>

		    <?php  		
			  $current_dir = $_SERVER['DOCUMENT_ROOT'].'/mis/17-prace-se-soubory/uploads';
			  $dir = opendir($current_dir);
			  
			  echo '<p>Adresářem pro upload je '.$current_dir.'</p>';
			  echo '<p>Výpis adresáře:</p><ul>';
			  
			  while(false != ($file = readdir($dir))){
				  // vynecháme položky . a ..
				  if($file != '.' && $file != ".."){
					  echo '<li>'.$file.'</li>';
				  }
			  }
			  
			  echo '</ul>';
			  closedir($dir);
			?>
	</body>
</html>