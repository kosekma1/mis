<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">	
</head>
<body>

<?php
  $dir = $_SERVER['DOCUMENT_ROOT'].'/mis/17-prace-se-soubory/uploads/';
  chdir($dir);
  
  //verze s funkcí exec()
  echo '<h1>Funkce exec()</h1>';
  echo '<pre>';
  
  // Unix
  // exec('ls -la', $result)
  
  // Windows
  exec('dir', $result);
  
  foreach($result as $line){
	  echo $line.PHP_EOL;
  }
  
  echo '</pre>';
  echo '<hr>';
  
  // Verze s funkcí passthru()
  echo '<h1>Funkce passthru()</h1>';
  echo '<pre>';
  
   // Unix
  // passthru('ls -la')
  
  // Windows
  passthru('dir');    
  
  echo '</pre>';
  echo '<hr>';
  
  // Verze s funkcí system()
  echo '<h1>Funkce system()</h1>';
  echo '<pre>';
  
   // Unix
  // $result = system('ls -la')
  
  // Windows
  $result = system('dir');    
  $result = system(escapeshellcmd('dir'));     // escapování příkazů, které by předával uživatel
  
  echo '</pre>';
  echo '<hr>';
  
  // Verze se zpětnými apostrofy
  echo '<h1>Zpětné apostrofy</h1>';
  echo '<pre>';
  
   // Unix
  // $result = `ls -la`;
  
  // Windows
  $result = `dir`;    
  echo $result;

  echo '</pre>';
  echo '<hr>';

?>

</body>
</html>