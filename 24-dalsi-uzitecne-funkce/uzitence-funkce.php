<?php

  echo "<h1>Vyhodnocování textových řetězců - eval()</h1>";
  
  //vyhodnotí řetězec jako kód PHP
  //lze uložit části kódu do databáze a vyhodnocovat je nebo lze generovat kód v cyklu a spouštět
  //nejčastější použití je jako součást šablonovacího systému
  eval("echo 'Ahoj Světe';"); 
  
  echo "<h1>Ukončení běhu skriptu - die() a exit()</h1>";
  //exit;
  //die(); //alias exit
  
  /*  obvyklé použití v kombinasi s operátorem or a příkazem
      
	  mysql_query($query) or die('Nepodařilo se provést dotaz.');
	  
	  lze zavolat i funkci p5ed ukončením skriptu - vypíše chybu, zaloguje chybu do souboru, pošle email atd.
	  function err_msg(){
		  return 'Došlo k chybě MySQL: '.mysql_error();
	  }
	  
	  mysql_query($query) or die(err_msg());
	  
  */
  
  echo "<h1>Serializování proměnných a objektů</h1>";
  //serializace je proces převodu všeho, co lze ukládat do proměnné (včetně objektu), do textového řetezce, který můžete ukládat do databáze nebo ho předávat v adrese URL z jedné stránky do druhé
  /*
     $serializovany_objekt = serialize($muj_objekt);	 \  
  */
  class Employee {
	  var $name;
	  var $employee_id;
  }
  
  $emp = new Employee();
  $emp->name = 'Karel';
  $emp->employee_id = 5324;
  
  $serializovany_emp = serialize($emp);
  echo ($serializovany_emp);  
  //před uložením do databáze je potřeba zavolat na serializovaný objekt funkci mysqli_real_escape_string(), abyste escapovali speciální znaky
  
  echo "<h3>Deserializace</h3>";
  $novy_objekt = unserialize($serializovany_emp);
  echo $novy_objekt->name. ", ". $novy_objekt->employee_id;
  //poznámka - před serializací musí interpret PHP znát strukturu třídy, proto je potřeba vložit definici třídy předem
  
  echo "<h1>Načítání informací o prostředí PHP</h1>";
  
  echo "<h3>Přehled dostupných skupin funkcí</h3>";
  $extensions = get_loaded_extensions();
  
  foreach ($extensions as $each_ext){
	  echo $each_ext.'<br />';
	  echo '<ul>';
	  $ext_funcs = get_extension_funcs($each_ext);
	  
	  foreach($ext_funcs as $func){
		  echo '<li>'.$func.'</li>';
	  }
	  echo '</ul>';	  
  }
  
  echo "<h1>Identifikujeme vlastníka skriptu</h1>";
  //funkce umožní vyřešit problém s oprávněním
  echo get_current_user();
  
  echo "<h1>Zjištění času poslední úpravy skriptu</h1>";
  echo date('j. n. Y H:i', getlastmod());
  
  echo "<h1>Dočasná změna běhového prostředí</h1>";
  //dočasně změníme nastavení v php.ini za běhu skriptu
  //ini_set() přebírá dva parametry, prvním je název kofigurační direktivy ze souboru php.ini, jejíž hodnotu bychom chtěli změnit. Druhým je nová hodnota.
  //ne všechny direktivy jdou změnit - záleží na nastavení úrovní PHP_INI_USER, PHP_INI_PERDIR, PHP_INI_SYSTEM, PHP_INI_ALL (můžete měnit hodnoty ve všech souborech php.ini, .htaccess a httpd.conf)
  
  $old_max_execution_time = ini_set('max_execution_time', 120);
  echo 'původní časový limit: '.$old_max_execution_time.'</br>';
  
  $max_execution_time = ini_get('max_execution_time');
  echo 'nový časový limit: '.$max_execution_time.'</br>';
  
  echo "<h3>Zvýrazňování zdrojového kódu</h3>";
  
  show_source('uzitence-funkce.php'); //parametr je název souboru, barvy syntaxe lze nastavit v php.ini (Colors for Syntax Highlighting mode)
  echo "<br />";
  highlight_string('<?php echo "ahoj"; ?>'); //parametr je řetězec kódu
  
  echo "<h1>Ovládání interpretu PHP z příkazového řádku</h1>";
  /* - lze spustit skript z řádku
     php mujskript.php
	 
	 - pomocí roury - echo je programem pro příkazový řádek
	 echo "<?php for ($i = 1; $i<10; $i++) echo $i; ?>" | php
	 
	 - spuštění řádku kódu z příkazového řádku
	 php -r "for ($i = 1; $i<10; $i++) echo $i;"
	 
  
  
  
?>