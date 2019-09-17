<?php
  
  echo "<h1>Ořezávání textových řetězců</h1>";
  $jmeno = " Martin ";

  echo $jmeno." : ".strlen($jmeno)."<br/>";
  
  $name = trim($jmeno); // orizne prazdne znaky na zacatku a konci retezce
  echo $name." : ".strlen($name)."<br/>";
  $name = rtrim($jmeno); // orizne prazdne znaky vpravo
  echo $name." : ".strlen($name)."<br/>";
  $name = ltrim($jmeno); // orizne prazdne znaky vlevo
  echo $name." : ".strlen($name)."<br/>";
    
  echo "<h1>Formátování textových řetězců po výstup</h1>";
  
  echo "<h2>Filtrování textových řetězců - htmlspecialchars</h2>";
  // funkce htmlspecialchars prevadi znaky na jim ekvivalentni entity HTML
  
  $text = "<script type='text/javascript'>alert('ahoj');</script>";
  echo $text; // tisk bez prevodu na specialni znaky vyvola spusteni skriptu
  echo htmlspecialchars($text); // s prevodem nedojde ke spusteni a text se vypise tak, jak je
 
  echo "<h2>Nahrazení znaků - str_replace</h2>";
  $name = "Martin\r\n";
  echo $name;
  $name = str_replace("\r\n","",$name); // odstraneni \r\n je dulezite hlavne pri vkladani textu do emailu aby nedoslo k tzv. injekci hlavicek
  echo $name;
  
  echo "<h2>Funkce nl2br</h2>";
  // funkce nl2br prevadi znak noveho radku na <br />
  $text = "Výlet do\nTiský stěn se vydařil.\nVšichni dorazili v pořádku.";    
  echo nl2br(htmlspecialchars($text));
  
  echo "<h2>Formátování textového řetězce pro tisk - print, printf, sprintf</h2>";
  $cena = 1024.2;
  $cena_s_dopravou = 1500.2;
  printf("Celková cena je %s <br />", $cena); // dosazeni jako retezce, printf vraci 1 
  printf("Celková cena je %.2f (s dopravou %.2f) <br />", $cena, $cena_s_dopravou); // dosazeni cisla do retezce jako cislo se dvema desetinnymi cisly
  printf("Celková cena je %2\$.2f (s dopravou %1\$.2f) <br />", $cena_s_dopravou, $cena); // poradi argumentu lze urcit %1\$ a dalsi %2\$
  $vystup = sprintf("Celková cena je %.2f (s dopravou %.2f) <br />", $cena, $cena_s_dopravou); // dosazeni cisla do retezce jako cislo se dvema desetinnymi cisly
  echo $vystup;
  
  echo "<h2>Změna velikosti písmen</h2>";
  $text = "Dlouhá věta pro testovací účely.";
  
  echo strtoupper($text)."<br />";
  echo mb_strtoupper($text)."<br />"; // prevadi spravne vsechnz znaky UTF-8
  
  echo "strtolower: ".strtolower($text)."<br />";
  $text_upper = mb_strtoupper($text);
  echo $text_upper."<br />";
  echo "mb_strtolower: ".mb_strtolower($text_upper)."<br />";
  
  echo ucfirst($text)."<br />";
  echo ucwords($text)."<br />";
  
  echo "<h2>Spojování a rozdělování textových řetězců</h2>";
  
  $email = "kosek.martin@gmail.com";
  echo $email."<br />";
  $email_array = explode('@',$email);
  print_r($email_array);
  
  $novy_email = implode('@', $email_array);
  echo "<br />";
  echo $novy_email."<br />";
  
  $text = "Karel nese čaj a k tomu kafe.";
  $token = strtok($text," "); // rozdeluje text na token postupne
  echo "<br /> Funkce strtok() <br />";
  echo $text."<br />";
  while($token!=""){
	  echo $token."<br />";
	  $token = strtok(" ");
  }
            
  echo "<br /> Funkce substr() a mb_substr() <br />";			
  $test = "Vaše služby pro zákazníky jsou super";
  echo substr($test,0,6)."<br />"; //vraci 6 znaků od indexu 0 - nefunguje dobře s češtinou
  echo mb_substr($test,0,6)."<br />"; // vraci 6 znaků od indexu 0 - používat pro češtinu - kódování UTF-8
  
  echo "<h2>Porovnávání textových řetězců</h2>";
  
  echo "<h3>strcmp(), strcasecmp(), strnatcmp()</h3>";
  $a = 'Martin';
  $b = 'Martin';
  $c= 'Verča';
  echo "Řetězce $a a $b se rovnají = ".strcmp($a, $b)."<br />";
  echo "Řetězce $a a $c se nerovnají. $a je abecedně před $c proto vrací = ".strcmp($a, $c)."<br />";
  echo "Přirozené uspořádání '2' a '12'".strnatcasecmp('2','12')."<br />";
  
  echo "<h3>Délka textového řetězce</h3>";
  $d = "Karel jede na kole.";
  printf("Délka řetězce %s je %d znaků.<br />", $d, strlen($d));
  
  echo "<h2>Vyhledávání textových řetězců v textových řetězcích</h2>";
  $text = "Dlouhý text obsahující řetězec obchod uprostřed věty.";
  if(strstr($text,'obchod')){
	  printf("Řetězec %s obsahuje slovo obchod = %s<br />", $text, strstr($text,'obchod'));
  } else {	   
	  printf("Řetězec %s neobsahuje slovo obchod = %d<br />", $text, strstr($text,'obchod'));	  
  }
  
  echo "<h2>Vyhledávání pozice podřetězce - strpos() a strrpos()</h2>";
  $text = "Dlouhý text obsahující řetězec obchod uprostřed věty.";
  printf("Slovo obchod je na pozici(pozice posledniho pismena ve vete) %d<br />", strpos($text, 'obchod'));  
  printf("Slovo obchod hledame od pozice 6 a je na pozici %d<br />", strpos($text, 'obchod', 6));  
  
  $vysledek = mb_strpos($text,'x'); //kvůli češtině použijeme mb_strpos
  if($vysledek === false){ // nutno porovnavat operatorem === jelikož pokud bude hledaný řetězec na pozici 0, tak 0 znamená true
	  echo "Nenalezeno";
  } else {
	  echo "Nalezeno na pozici ".$vysledek;
  }
  
  echo "<h2>Nahrazování podřetězců</h2>";
  $text = "Dlouhý text obsahující řetězec obchod uprostřed věty.";
  $text = str_replace('obchod','KAREL', $text);
  echo "Řetězec 'obchod' byl narazen řetězcem 'KAREL': $text <br/>";
  
  $text = "Dlouhý text obsahující řetězec obchod uprostřed věty.";
  $skupina_slov = array('text', 'obchod');
  $text = str_replace($skupina_slov,'KAREL', $text);
  echo "Skupina slov array('text', 'obchod') byla nahrazena slovem KAREL $text";
  
  /* Regulární výrazy */
  echo "<h1>Regulární výrazy</h1>";
  $email = 'kosek.martin@gmail.com';
  
  if(preg_match('/^[a-zA-z0-9_\-\.]+@[a-zA-z0-9\-]+\.[a-zA-z0-9\-\.]+$/', $email) === 0 ) {
	  echo "<p>Emailova adresa je neplatna</p>";
	  exit;
  } 
  
  $feedback = 'Hlavně mě zajímá obchod';
  $toaddress ='feedback@priklad.cz';
  $email = 'karel@velkyzakaznik.cz';
  if(preg_match('/obchod|zákaznická podpora|prodej/', $feedback)){
	  $toaddress = 'prodej@priklad.cz';
  } else if(preg_match('/faktura|účet/', $feedback)){
	  $toaddress = 'ucetni@priklad.cz';	  
  }
  
  if(preg_match('/velkyzakaznik\.cz/', $email)){
	  $toaddress = 'bob@priklad.cz';
  }
  
  echo $toaddress;
  
  echo "<h2>Rozdělování textových řetězců regulárním i výrazy</h2>";
  $adresa = 'uzivatelskejmeno@priklad.cz';
  echo $adresa."<br />";
  $pole = preg_split('/\.|@/',$adresa);
  while(list($klic, $hodnota) = each($pole)){
	  echo '<br />'.$hodnota;
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
			
?>