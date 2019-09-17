<!DOCTYPE html>
<html>
	<head>
	<meta charset ="UTF-8" />
	<title>Prohlížení adresářů</title>
	</head>
	<body>	
		    <h1>Prohlížení adresářů - použití třídy dir</h1>

		    <?php  		
			  $current_dir = $_SERVER['DOCUMENT_ROOT'].'/mis/17-prace-se-soubory/uploads';
			  $dir = dir($current_dir);
			  
			  echo '<p>Ukazatelem je '.$dir->handle.'</p>';
			  echo '<p>Adresářem pro upload je '.$dir->path.'</p>';
			  echo '<p>Výpis adresáře:</p><ul>';
			  
			  while(false != ($file = $dir->read())){
				  // vynecháme položky . a ..
				  if($file != '.' && $file != ".."){
					  echo '<li>'.$file.'</li>';
				  }
			  }
			  
			  echo '</ul>';
			  $dir->close();
			?>
	</body>
</html>