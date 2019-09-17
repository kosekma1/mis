<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Informace o souboru</title>
</head>
<body>
<?php
  
  if (!isset($_GET['file'])) {
    echo "Neuvedli jste název souboru.";
  } else {
    $uploads_dir = $_SERVER['DOCUMENT_ROOT'].'/mis/17-prace-se-soubory/uploads/';
    // Ořežeme adresáře kvůli bezpečnosti.
    $the_file = basename($_GET['file']);

    $safe_file = $uploads_dir.$the_file;

    echo '<h1>Informace o souboru: '.$the_file.'</h1>';

    echo '<h2>Údaje o souboru</h2>';
    echo 'Poslední přístup k souboru: '.
      date('j. n. Y H:i', fileatime($safe_file)).'<br/>';
    echo 'Poslední úprava souboru: '.
      date('j. n. Y H:i', filemtime($safe_file)).'<br/>';

    //$user = posix_getpwuid(fileowner($safe_file));
    //echo 'Vlastník souboru: '.$user['name'].'<br/>';	
    echo 'Vlastník souboru: '.fileowner($safe_file).'<br/>';

    //$group = posix_getgrgid(filegroup($safe_file));
    //echo 'Skupina souboru: '.$group['name'].'<br/>';
	echo 'Skupina souboru: '.filegroup($safe_file).'<br/>';

    echo 'Oprávnění souboru: '.decoct(fileperms($safe_file)).'<br/>';
    echo 'Typ souboru: '.filetype($safe_file).'<br/>';
    echo 'Velikost souboru: '.filesize($safe_file).' bytes<br>';

    echo '<h2>Testy souboru</h2>';
    echo 'is_dir: '.(is_dir($safe_file)? 'true' : 'false').'<br/>';
    echo 'is_executable: '.(is_executable($safe_file)? 'true' : 'false').'<br/>';
    echo 'is_file: '.(is_file($safe_file)? 'true' : 'false').'<br/>';
    echo 'is_link: '.(is_link($safe_file)? 'true' : 'false').'<br/>';
    echo 'is_readable: '.(is_readable($safe_file)? 'true' : 'false').'<br/>';
    echo 'is_writable: '.(is_writable($safe_file)? 'true' : 'false').'<br/>';
  }
?>
</body>
</html>
