<?php
/*** Zabezpečení zdrojového kódu ***/

/* Filtrování vstupu uživatele 
   - datům od uživatelů  nesmíme nikdy věřit
   
 */
 
 /* Filtrujte i základní hodnoty */
 
 // čísla
 echo "<h2>Filtrování čísel</h2>";
 $_POST['num_nights'] = 0;
 $number_of_nights = (int)$_POST['num_nights'];
 if($number_of_nights == 0) {
	 echo "CHYBA: Neplatný počet nocí.";
	 //exit;
 }
 
 
 //datumy 10/30/2019
 echo "<h2>Filtrování datumů 1</h2>";
 $_POST['departure_date'] = "10/30/2019";
 $mmddyy = explode('/', $_POST['departure_date']);
 if(count($mmddyy) != 3) {
	 echo "CHYBA: Zadali jste neplatné datum";
	 //exit;
 }
 
 //zpracujeme roky jako 02 nebo 95
 echo "<h2>Filtrování datumů 2</h2>";
 if( (int)$mmddyy[2]<100) {
	 if ((int)$mmddyy[2]>50){
		 $mmddyy[2] = (int)$mmddyy[2] + 1900;		 
	 } else if ((int)$mmddyy[2] >=0) {
         $mmddyy[2] = (int)$mmddyy[2] + 2000;
	 }
	 // v opačném případě je rok < 0 a funkce checkdate() ho zachytí	 	
 }
 
 if(!checkdate($mmddyy[0],$mmddyy[1],$mmddyy[2])) {
	 echo "CHYBA: Zadali jste neplatné datum!";
	 //exit;
 } else {
	 echo "Datum: ". $mmddyy[0].$mmddyy[1].$mmddyy[2];
 }
 
 
?>

<?
/* Zabezpečení textových řetězců pro dotazy SQL 
   - ochrana před injekcí SQL
   
   Doporučení:
   - používejte parametrizované dotazy, kde je to jen možné. Tyto dotazy oddělují kód SQL od dat. Nepomůžou vám však v případě názvů sloupců a tabulek, ale jelikož
     schéma databáze znáte, můžete definovat seznam platných hodnot
   - ujistěte se, že vstupní data splňují všechny vaše požadavky např. obsahují jen číslice a písmena a ne "; DELTE FROM users;"
   
   Rozšíření mysqli obsahuje rovněž bezpečnostní pojistku, která spočívá v tom, že metody mysqli_query() a mysqli::query() můžeou spouštět najednou pouze jediný dotaz. Pro spouštění více dotazů
   slouží mysqli_multi_query() nebo mysqli::multi_query().
      
*/

/* Escapování výstupu
   - zajistíme, že výstup obvykle od uživatele bude jen text a nebudou vedlejší účinky (spuštění skriptu apod.)
   
   Můžeme využít funkce htmlspecialchars() a htmlentities(). Ty převádí určité znaky ve vstupním textovém řetězci na entity HTML. Webový prohlížeč převádí entity na výstupní znaky, a tudíž
   je nepovažuje za součást výstupu.
   
*/

<?php
 echo "<br /><h1>Escapování výstupu</h1>";
 $input_str = "<p> align=\"center\">Uživatel zadal \"15000?\".</p>
               <script type=\"text/javascript\">
			   // zde by mohl být zákeřný kód JavaScriptu
			   </script>";
 echo "<h2>htmlspecialchars()</h2>";
 $str = htmlspecialchars($input_str, ENT_NOQUOTES, "UTF-8");
 echo nl2br($str);
 
 echo "<h2>htmlentities()</h2>";
 $str = htmlentities($input_str, ENT_QUOTES, "UTF-8");
 echo nl2br($str);
 
 
 /* Uspořádání zdrojového kódu
    - soubory ke kterým nebudou uživatelé přistupovat přímo z internetu mají být mimo strom dokumentů vašich webových stránek. Tedy ne v /home/httpd/formu/www, ale např.
	  v /home/httpd/forum/lib a vašem zdrjovém kódu byste je vkládali následujícím způsobem require_once('../lib/user_object.php');
*/

/* Co patří do zdrojového kódu

   do zdrojového kódu nepatří:
   $conn = new mysqli('localhost', 'bob', 'tajne', 'nejakadb');
   - pokud by se k němu dostal hacker, tak získá okamžitě přístup do databáze jako bob
   - lepší je vkládat soubory s konfigurac9, které jsou mimo strom dokumentů vaši webové aplikace
   
   <?php
      //toto je soubor dbconncet.php
	  $db_server = "localhost";
	  $db_user_name = 'bob';
	  $db_password = 'tajne';
	  $db_name = 'nejakadb';	  
   ?>
   
   výše uvedený soubor potom můžete vložit do svého skriptu:
   
   <?php
     include ("../code/dbconnect.php");
	 $conn = new mysqli($db_server, $db_user_name,  $db_password,  $db_name);
   ?>
   
   podobně byste měli nakládat i s jinými citlivými daty, pro která chcete zavést dodatečnou vrstvu ochrany

?>