<?php
  echo '<h1>Funkce date()</h1>';
  //aktuální datum ve formátu 17. 2. 2017
  echo date('j. n. Y')."<br />"; /* date má spoustu formátovacích kódů https://www.php.net/manual/en/function.date.php */
  echo date('U'); //vrátí časovou známku Unixu
  
  /* druhým parametrem funkce date() je časová známka Unixu - číslo reprezentující počet sekund od půlnoci 1. 1. 1970 v Greenwichském čase jako 32 bitové číslo a obsáhne roky 1902-2038 */
  
  echo '<h1>Převod data na časovou  známku Unixu - mktime()</h1>';
  echo "Časová známka pro dnešní den: ".mktime()."<br />";
  echo "Převod časové známky na formát data: ".date('j. n. Y', mktime())."<br />";
  $mes = 9;
  $den = 18;
  $rok = 2019;
  echo 'Jednoduchá aritmetika time(12,0,0,$mes,$den+30,$rok): ', $k = mktime(12,0,0,$mes,$den+30,$rok)," = ", date('j. n. Y', $k);
  
  echo '<h1>Funkce time()</h1>';
  /* time() vrací vždy časovou známku Unixu pro aktuální datum a čas, funkce nemá žádné parametry */
  echo 'Časová známka získaná funkcí time(): '.time()."<br />";
  
  echo '<h1>Funkce getdate(casova znamka)</h1>';
  /* getdate() vrací pole s jednotlivými komponentami data a času */
  echo 'Pole s jednotlivými komponentami data získaná funkcí getdate(): ';
  echo '<pre>';
  print_r(getdate());
  echo '</pre>';
  
  echo '<h1>Validace data funkcí checkdate(int mesic, int den, int rok)</h1>';
  /* funkce checkdate počítá i s přestupnými roky */
  echo 'Kontrola data 29.2.2008: '.checkdate(2,29,2008)."<br />";
  echo 'Kontrola data 29.2.2007: '.checkdate(2,29,2007);
  
  echo '<h1>Formátování časových známek - funkce strftime(format, casovaznamka)</h1>';
  /* https://www.php.net/manual/en/function.strftime.php */
  echo strftime("%A<br />");
  echo strftime("%x<br />");
  echo strftime("%c<br />");
  echo strftime("%Y<br />");
  
  echo '<h1>Převádění formátů data mezi PHP a MySQL</h1>';
  /* časy v MySQL se řídí standardem ISO 8601 tedy formátem 2019-09-18 */
  /* formátování v MySQL do českého formátu data DD.MM.RRRR
     
	 SELECT DATE_FORMAT(sloupec_s_datem, '%d. %m. %Y')
	 FROM nazevtabulky;
	 
	 formátovací kódy lze dohledat v dokumentaci
	 
	 funkce UNIX_TIMESTAMP() převádí datum na časovou známku
	 SELECT UNIX_TIMESTAMP(sloupec_s_datem)
	 FROM nazevtabulky;
  */
  
  /* Výpočty s daty v jazyce PHP */
  
  echo '<h1>Časový rozdíl v datech - pomocí rozdílu časových známek</h1>';
  
  $day = 18;
  $month = 9;
  $year = 1972;
  
  //určíme časovou známku pro datum narození
  $bdayunix = mktime(0,0,0,$month, $day, $year);
  //určíme časovou známku pro dnešek
  $nowunix = time();
  //spočítcáme rozdíl
  $ageunix = $nowunix-$bdayunix;
  //převedeme rozdíl ze sekund na roky
  $age = floor($ageunix/(365*24*60*60)); //nepočítá se s přestupnými roky
  echo 'Současný věk je '.$age;
  
  /* lepší je použít již vestavěné funkce pro manipulaci s daty - date_add(), date_sub() a date_diff(), které již s přestupnými roky a zimním a letním časem počítají */
  
  /* Výpočty s daty v MySQL 
  
  //přičteme jeden den k datu 25. 2. 1700
  SELECT adddate('1700-02-25', interval 1 day)
  
  */
  
  echo '<h1>Mikrosekundy - funkce microtime()</h1>';
  //volání s arguementem true vrací desetinné číslo, bez argumentu vrací textový řetězec
  echo number_format(microtime(true),5,'.','');
  
  
  
  
  
?>