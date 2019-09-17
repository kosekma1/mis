<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Uploadování...</title>
</head>
<body>
<h1>Uploadování souboru...</h1>
<?php

  echo "<h3>Informace o souboru:</h3>";
  echo $_FILES['the_file']['tmp_name']."<br />"; // dočasně uložený soubor na serveru
  echo $_FILES['the_file']['name']."<br />"; // jméno uploadovaného souboru
  echo $_FILES['the_file']['size']."<br />"; // velikost uploadovaného souboru
  echo $_FILES['the_file']['type']."<br />"; // typ uploadovaného souboru
  echo $_FILES['the_file']['error']."<br />"; // chyba při uploadu

  /* v případě uploadu více souborů využíváme pole a přísup bude následující:
     $name1 = $_FILES['the_file']['name'][0];
	 $name2 = $_FILES['the_file']['name'][1];
  */
  
  if($_FILES['the_file']['error']>0){  // UPLOAD_ERROR_OK = 0
	  echo 'Chyba:';
	  switch($_FILES['the_file']['error']){
		  case 1: // UPLOAD_ERR_INI_SIZE
			echo 'Soubor je větší než upload_max_filesize.';
			break;
		  case 2: // UPLOAD_ERR_FORM_SIZE
			echo 'Soubor je větší než max_file_size';
			break;
		  case 3: // UPLOAD_ERR_NO_FILE
			echo 'Soubor se podařilo uploadovat jen částečně.';
			break;
		  case 4: // UPLOAD_ERR_NO_TMP_DIR
			echo 'Žádný soubor nebyl uploadován.';
			break;
		  case 6: // UPLOAD_ERR_CANT_WRITE
			echo 'Nelze uploadovat soubor: není definován dočasný adresář.';
			break;
		  case 7: // UPLOAD_ERR_EXTENSION
			echo 'Upload selhal: nelze zapisovat na disk.';
			break;		  		  
	  }
	  exit;
  }   
  
  // Má tento soubor správný typ MIME?
  if($_FILES['the_file']['type'] != 'image/png'){
	  echo 'Chyba: soubor není obrázkem PNG.';
	  exit;
  }
  
  // Uložíme soubor tam, kde bychom ho chtěli mít.
  $uploaded_file = 'C:\\xampp\\htdocs\\mis\\17-prace-se-soubory\\uploads\\'.$_FILES['the_file']['name'];
    
  if(is_uploaded_file($_FILES['the_file']['tmp_name'])){
	  if(!move_uploaded_file($_FILES['the_file']['tmp_name'], $uploaded_file)){
		  echo 'Chyba: nelze přesunout soubor do cílového adresáře.';
		  exit;
	  }
  } else {
	  echo 'Chyba: možný útok uploadem souboru. Název souboru: ';
	  echo $_FILES['the_file']['name'];
	  exit;
  }
  
  echo 'Soubor byl úspěšně uploadován.';
      
  //Zobrazíme, co bylo uploadováno.
  echo '<p>Uploadovali jste následující obrázek:<br/>';  
  echo '<img src="http://localhost/mis/17-prace-se-soubory/uploads/'.$_FILES['the_file']['name'].'" />';
  
  echo '<h3>Ochrana při uploadu souboru funkce basename</h3>';
  //funkce ořezává všechny případné adresáře v cestě z bezpečnostních důvodů, kdyby je předal útočník
  $path = "/home/http/html/index.php";
  $file1 = basename($path);
  $file2 = basename($path,".php");
  print $file1."<br />"; //$file1 má hodnotu index.php
  print $file2."<br />"; //$file2 má hodnotu index

?>

</body>
</html>