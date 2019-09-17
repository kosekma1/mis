<?php

/* Definice třídy */
class nazevtridy{
	
  public $vlastnost1; // viditelnost/typ pristupu public, private a protected
  private $vlastnost2;   // modifikator přístupu private říká, že k vlastnosti je přístup pouze uvnitř třídy a nedědí se, protected - přístup pouze uvnitř třídy a dědí se, public - přístup uvnitř i vně a dědí se
  
  // konstruktor - slouží k inicializaci třídy
  function __construct($param){
	  echo "Konstruktor byl zavolán s argumentem ".$param."<br />";	  
  }
  
  // metoda - PHP podporuje přetěžování metod jen ve třídách - normálně ne
  function metoda1(){
	  
  }
    
  
  function metoda2($parametr1, $parametr2){
	  $this->vlastnost1 = $parametr1; // použití ukazatele $this pro přístup k třídním proměnným/vlstnostem
	  $this->vlastnost2 = $parametr2;
	  
	  echo $this->vlastnost1."<br />";
	  echo $this->vlastnost2."<br />";    
  }   
  
  function metoda3($param){
	  return 10*$param;
  }
  
  // destruktor - slouží k uvolnění zdrojů nebo provedení akcí před zničením objektu
  function __destructor(){
	  
  }
  
}

echo "<h1>Definice třídy</h1>";
echo <<< TEST
<pre>
<code>
class nazevtridy{
	
  public \$vlastnost1; // viditelnost/typ pristupu public, private a protected
  public \$vlastnost2;
  
  // konstruktor - slouží k inicializaci třídy
  function __construct(\$param){
	  echo "Konstruktor byl zavolán s argumentem ".\$param."<br />";
  }
  
  // metoda - PHP podporuje přetěžování metod jen ve třídách - normálně ne
  function metoda1(){
	  
  }
  
  function metoda2(\$parametr1, \$parametr2){
	   \$this->vlastnost1 = \$parametr1; // použití this pro přístup k třídním proměnným/vlstnostem
	   \$this->vlastnost2 = \$parametr2;
	  
	   echo \$this->vlastnost1."<br />";
	   echo \$this->vlastnost2."<br />";
  }

  function metoda3(\$param){
	  return 10*\$param;
  }  
  
  // destruktor - slouží k uvolnění zdrojů nebo provedení akcí před zničením objektu
  function __destructor(){
	  
  }
  
}
</code>
</pre>
TEST;



/* vytváření instací tříd */
echo "<h1>Vytváření instací tříd</h1>";
$a = new nazevtridy("První");
$a = new nazevtridy("Druhý");

/* přístup k třídním proměnným */
echo "<h1>Přístup k třídním proměnným</h1>";
$a = new nazevtridy("Třetí");
$a->vlastnost1 = "hodnota"; // vlastnost/proměnná má typ přístupu public proto k ní lze přistupovat mimo třídu
echo $a->vlastnost1;

echo "<h1>Volání metod třídy</h1>";
$a = new nazevtridy("Čtvrtá");
$a->metoda1();
$a->metoda2("hodnota1","hodnota2");
$vysledek = $a->metoda3(10); // metoda vrací hodnotu
echo $vysledek."<br />";

/* Magické metody _get() a __set() */
// definované magické metody se vždy zavolají při přístupu k proměnným třídy a lze tak ošetřit předávané hodnoty apod. na jednom místě
class MojeTrida {
	private $vlastnost;
	
	function __get($nazev){
		return $this->$nazev;
	}
	
	function __set($nazev, $hodnota){
		if ( ($nazev == 'vlastnost') && ($hodnota>=0) && ($hodnota<=100) ){
			$this->vlastnost = $hodnota;
		} else {
			echo $nazev." může obsahovat pouze hodnoty mezi 0 a 100";
		}
		//$this->nazev = $hodnota;
	}
}
echo "<h1>Magické metody _get() a __set()</h1>";
$a = new MojeTrida();
$a->vlastnost = 5;
echo $a->vlastnost."<br />";
$a->vlastnost = 250;


/* Dědičnost v PHP */

class A {
	public $vlastnost1;
	function metoda1(){
	  echo "Volání metoda1()<br />";
	}
}

class B extends A {
	public $vlastnost2;
	function metoda2(){
		echo "Volání metoda2()<br />";
	}
}

echo "<h1>Dědičnost</h1>";
// platné operace
$b = new B();
$b->metoda1();
$b->vlastnost1 = 10;
$b->metoda2();
$b->vlastnost2 = 10;

//řízení viditelnost private, protected
class C {
	// metoda se nedědí a není přístupná vně třídy - pouze uvnitř třídy
	private function metoda1(){
		echo "Volání metoda1()<br />";
	}
	
	//metoda s modifikátorem protected se dědí a není přístupná vně třídy - pouze uvnitř třídy
	protected function metoda2(){
		echo "Volání metoda2()<br />";
	}
	
	public function metoda3(){
		echo "Volání metoda3()<br />";
	}
}

class D extends C {
	function __construct() {
		//$this->metoda1(); // vyhodí chybu - nemá k metodě přístup protože je v mateřské třídě private
		$this->metoda2();
		$this->metoda3();
	}
}

echo "<h2>Dědičnost - modifikátory přístupu</h2>";
$d = new D();
//$d->metoda2(); // vyhodí chybu - nelze volat vně třídy, protože je přístup protected
$d->metoda3(); // ok - je public

//přepisování proměnných a metod - překrytí
class E {
	public $vlastnost = 'výchozí hodnota';
	function metoda(){
		echo 'Něco<br />';
		echo 'Vlastnost $vlastnost má hodnotu '.$this->vlastnost.'<br />';
		
	}
	
	final function neprepisovatelna_metoda(){ //klíčové slovo final zabraňuje překrytí metody/proměnné/třídy
		echo 'Mě nelze přepsat/překrýt<br />';
	}
}

class F extends E{
	public $vlastnost = 'jiná hodnota';
	function metoda(){
		echo 'Něco jiného<br />';
		echo 'Vlastnost $vlastnost má hodnotu '.$this->vlastnost.'<br />';
		
	}
	
	function metoda_volani_predka(){
		parent::metoda(); //lze volat metody předka, ale použijí se přepsané/překryté proměnné definované v potomkovi
	}
	
	/* metodu nelze přepsat/překrýt protože v předkovi je definovaný modifikátor final, který tomu zabraňuje
	function neprepisovatelna_metoda(){ 
		echo 'Mě nelze přepsat/překrýt<br />';
	} 
	*/
}
echo "<h2>Přepisování / překrytí vlastností a metod</h2>";
$e = new E();
$e->metoda();
$f = new F();
$f->metoda();
$f->metoda_volani_predka(); //lze volat metody předka, ale použijí se proměnné definované v potomokovi

/* php nepodporuje vícenásobnou dědičnost, ale pro simulaci lze využít rozhraní a traity */
interface Zobrazitelne {
	function zobraz();
}

class webovaStranka implements Zobrazitelne {
	//třída se přihlásila k implementaci rozhraní Zobrazitelne a tak musí implementovat dané metody v rozhraní, pokud neimplementuje, tak to skončí fatální chybou
	function zobraz(){
		echo "Konkrétní implementace metody zobraz.<br />";
	}
}
echo "<h2>Použití interface</h2>";
$webovaStranka = new webovaStranka();
$webovaStranka->zobraz();

/* traity - do traitů lze shromáždit funkčnost, kterou lze používat opakovaně ve více třídách. Třída může kombinovat více tratiů, přičemž jednotlivé traity můžou od 
   sebe dědit. Jedná se tedy o skvělé stavební kameny pro budování opětovné použitelnosti zdrojového kódu. Trait se liší od rozhraní v tom, žemůže obsahovat celé definice
   funkcí, včetně jejich implementace. Rozhraní pouze specifikuje, které funkce musí třída implementovat. 
	
   Metody traitu přepisují zděděné metody a metody aktuální třídy přepisují metody traitu.
   
 */

echo "<h2>Použití traitů</h2>";

//vytvoření traitu
trait logovac {
	public function zaznamenejZpravu($zprava, $uroven='LADENI'){
		//kod pro zaznamenani zpravy zprava
		echo "Loguju $zprava v urovni $uroven<br />";
	}
}

//použití traitu
class souboroveUloziste {
	use logovac;
	
	function uloz($data){
		$this->zaznamenejZpravu("ukladam do ulozistec");
		echo "ukladám $data";
	}
}

$souboroveUloziste = new souboroveUloziste();
$souboroveUloziste->uloz("data");

//spojovaní více traitů
trait souborovyLogovac {
	public function zaznamenejZpravu($zprava, $uroven='LADENI'){
		//kod pro zaznamenani zpravy $zprava do souboru
	}
}

trait systemovyLogovac {
	public function zaznamenejZpravu($zprava, $uroven='LADENI'){
		//kod pro zaznamenani zpravy $zprava do systémového žurnálu
	}
}

class souboroveUloziste1 {
    use souborovyLogovac, systemovyLogovac {
		souborovyLogovac::zaznamenejZpravu insteadof systemovyLogovac; // nastaveni použití metody z traitu souborovyLogovac místo systemovyLogovac
		systemovyLogovac::zaznamenejZpravu as private zaznamenejsysZpravu; // přejmenování metody v traitu a navíc se změnou přístupu
	}
}

/* Pokročilé objektově orientované koncepce */

//konstanty tříd

echo "<h1>Pokročilé objektově orientované koncepce</h1>";
echo "<h2>Konstaty třídy</h2>";
class Math {
	const pi = 3.14159;
}
echo "Math:pi = ".Math::pi; // ke konstantě třídy přistupujeme operátoerm ::

//statické metody
echo "<h2>Statické metody</h2>";
class NovaMath {
	static function umocni($vstup){
		return $vstup * $vstup;
	}
}
echo "NovaMath::umoctni(8) = ".NovaMath::umocni(8); // lze volat bez vytvoření třídy, uvnitř metody nelze použít klíčové slovo $this

/* Ověřování typu objektu */
echo "<h2>Ověřování typu objektu</h2>";

class Trida {
	
}
$trida = new Trida();
echo ($trida instanceof Trida) ?  "Je instací třídy Trida" : "Není instancí třídy Trida"; // vrátí 1

/* Typování proměnných */
echo "<h2>Typování proměnných</h2>";

class TestovaciTrida {
	function test(){
		echo "Testovací třída - výpis.";
	}
}

function over(TestovaciTrida $objekt){ // deklarování typu předávaného objektu - lze pouze pro objekty - typovat lze tridy, rozhrani, pole nebo funkce zpětného volání. Traity typovat nelze.
	$objekt->test();
}

$testovaciTrida = new TestovaciTrida();
over($testovaciTrida);

/* Pozdní statické vazby
   V dědické hierarchii s více implementacemi stejné metody můžete rozhodovat, z které třídy metodu vyberete pomocí pozdních statických vazeb.
 */
echo "<h2>Pozdní statické vazby</h2>";

class X {
	public static function jakatrida(){
		echo __CLASS__;
	}
	
	public static function test(){
		//self::jakatrida(); // vypsalo by X X v prikladu nize - static zajisti pozdní vazbu
		static::jakatrida(); // modifikátorem static donutíme interpret PHP, aby vybral třídu, kterou jste skutečně volali - tzn. "pozdní" část řetězce
	}
}

class Y extends X {
	public static function jakatrida(){
		echo __CLASS__;
	}
}

X::test();
echo "<br />";
Y::test();

/* Konujeme objekty */

$a = new TestovaciTrida();
$b = clone $a; // vytvorime kopii objektu $a stejne třídy se stejnými hodnotami a vlastnostmi

class UpravaKlonovani {
	
	// metoda se volá automaticky až po tom co vznikne přesná kopie standardním kopírováním, takže postačí, když změníte jen ty věci, které chcete.
	//  obvykle se zajišťuje aby se správně kopírovaly ty vlastnosti, které slouří jako reference na objekt - tzn. zkopiruje se i odkazovaný objekt (mělká vs hluboká kopie)
	function __clone() { 
       echo "Něco jsem zklonoval vlastními silami";		
	}
}

echo "<h2>Klonování objektů</h2>";
$c = new UpravaKlonovani();
$d = clone $c;


/* Abstraktní třídy - nelze z nich vytvářet instance a slouží jako otisky metod, ale neimplementují je */
abstract class Abstraktni {
	abstract function metodaX($param1, $param2);
}

// $test = new Abstraktni(); // nelze vytvořit instanci
class VyuzitiAbstraktniTridy extends Abstraktni {
   function metodaX($param1, $param2){
	   echo $param1." : ".$param2;
	   
   }	
}
echo "<h2>Abstraktní třídy</h2>";
$a = new VyuzitiAbstraktniTridy(); // je nutné metody definovat
$a->metodaX("ahoj","jsem deklarovana abstraktni metoda");


/* Přetězování metod metodou __call() */

class Pretizeni {
	
	/* magická metoda, která se volá na pozadí */
	public function __call($metoda, $p) {
		if($metoda == 'zobraz'){ // metodu zobraz nesmíme implementovat jinak to nebude fungovat
			if(is_object($p[0])) {
			  $this->zobrazObjekt($p[0]);
			} else if (is_array($p[0])) {
			  $this->zobrazPole($p[0]);
			} else {
				$this->zobrazSkalarniHodnotu($p[0]);
			}
			
		}
	}
	
	/* funguje jako předchozí metoda ale jen pro nedostupnou metodu, které voláme staticky */
	public static function __callStatic($metoda, $p) { 
		if($metod='test'){
			echo "Staticky volaná metoda přes callStatic";
		}
	}
	
	public function zobrazObjekt($p){
		echo $p;
	}
	
	public function zobrazPole($p){		
		$limit = count($p);		
		for($i=0;$i<$limit;$i++){			
			echo $p[$i]."<br />";
		}
	}
	
	public function zobrazSkalarniHodnotu($p){
		echo $p;
	}
}

echo "<h2>Přetěžování funkcí</h2>";
$p = new Pretizeni();
$pole = array(1,2,3);
$p->zobraz($pole);
$p::test("ahoj"); // nedostupná metoda volaná staticky

/* Funkce __autoload() - nejedná se o metodu třídy, ale o samostatnou funkci - definuje se vně třídy. Bude se volat automaticky, kdykoliv se někdo pokusí vytvořit instatni nedefinované třídy */

// funce se snaží načítat soubor se stejným názvem jako třída a příponou .php
function __autoload($nazevTridy){
	include_once $nazevTridy.".php";
}

echo "<h2>Speciální funkce __autoload()</h2>";
$auto = new NeexistujiciTrida();
$auto->test();

/* Implementace iterátorů a iterací */

// PHP přináší možnost procházet vlastnosti objektu pomocí cyklu foreach, jako by se jednalo o pole
class MaTrida {
	public $a = "5";
	public $b = "6";
	public $c = "7";
}

echo "<h2>Implementace iterátorů a iterací</h2>";
echo "<h3>Seznam vlastností třídy</h3>";
$x = new MaTrida();
foreach ($x as $vlastnost){
	echo $vlastnost."<br />";
}

// implementace iteratoru - k tomuto účelu musí třída, kterou chcete procházet, implementovat rozhraní IteratorAggregate a mít metodu getIterator()
class  MyObject implements IteratorAggregate {
	public $data = array();
	
	function __construct($in){
		$this->data = $in;
	}
	
	function getIterator(){
		return new ObjectIterator($this);
	}
		
}

/* rozhraní je nezávislé na datové struktuře - když použijeme spojový seznam, tak je potřeba upravit implementaci, ale rozhraní zůstane stejné */
class ObjectIterator implements Iterator {
	
	private $obj;
	private $count;
	private $currentIndex;
	
	// nepovinný konstruktor - je vhodné místo kde můžeme nastavit počet položek, které chceme procházet a také odkaz na samotná data
	function __construct($obj){
		$this->obj = $obj;
		$this->count = count($this->obj->data);
	}
	
	// nastaví interní datový ukazatel na začátek dat
	function rewind(){
		$this->currentIndex = 0;
	}
	
	// sděluje, jestli se nachází nějaká datová položka na aktuální pozici datového ukazatel
	function valid(){
		return $this->currentIndex < $this->count;
	}
	
	// měla by vracet datový ukazatel
	function key(){
		return $this->currentIndex;
	}
	
	// vrací hodnotu na aktuální pozici datového ukazatele
	function current(){
		return $this->obj->data[$this->currentIndex];
	}
	
	// posune datový ukazatel na další pozici
	function next(){
		$this->currentIndex++;
	}
}

echo "<h3>Implementace iteratoru</h3>";
$myObject = new MyObject(array(2,4,6,8,10));

$myIterator = $myObject->getIterator();
for($myIterator->rewind(); $myIterator->valid(); $myIterator->next()){
	$key = $myIterator->key();
	$value = $myIterator->current();
	echo $key." => ".$value."<br />";
}

/* Generátory */

// generátor uchovává stav - v dalším cyklu bude pokračovat tam, kde skončil
// liší se od funkce, že místo return používá yield
/* Generátor můžeme považovat z pole možných hodnot. Hlavním rozdílem mezi generátorem a funkcí, která plní pole možnými hodnotami, je ten že se provádí postupně.
   Vždy vznikne jen jedna hodnota, kterou je nutné držet v paměti. Pomocí generátoru lze tedy zpracovávat velké množství dat, které by jinak zaplnila celou paměť, nebo se do ní nevešla.
*/

echo "<h2>Generátory</h2>";

function fizzbuzz($start, $end){
	$current = $start;
	while($current <= $end){
		if($current%3 == 0 && $current%5==0){
			yield "fizzbuzz";			
		} else if ($current%3==0){
			yield "fizz";
		} else if ($current%5==0){
			yield "buzz";
		} else {
			yield $current;
		}
		$current++;
	}
}

foreach (fizzbuzz(1,20) as $number){
	echo $number."<br />";
}


/* Převod tříd na řetezce */
// stačí ve tříde definovat metodu __toStrgin(), která se zavolá, když se pokusíte vypsat tuto třídu echo, print
echo "<h2>Převod tříd na textové řetězce</h2>";

class Printable {
	public $testone;
	public $testtwo;
	public $testthree;
	public function __toString(){
		return(var_export($this, TRUE)); //prostřdnictvím funkce var_export() vypisujeme všechny vlastnosti této třídy s jejich hodnotami
	}
}

$p = new Printable();
echo "<pre>".$p."</pre>";
echo $p;

/* Rozhraní Reflection API */
// Umožňuje dotazovat se tříd a objektů na jejich strukturu a obsah. To může být užitečné, když pracujeme s neznámými nebo nezdokumentovanými třídami (například v zakódovaných skriptech PHP)
echo "<h3>Rozhraní Reflection API</h3>";

require_once("./navrh-trid/page.php");

$class = new ReflectionClass("Page");
echo "<pre>".$class."</pre>";

/* Jmenné prostory */
/* Jmenné prostory představují řešení, jak seskupovat řídy a funkce. Pomocí nich je možné skládat související komponenty do knihovny */
// výhody - všechny třídy a funkce jsou zabaledé do samostatného prostoru, takže se vyhneme kolizím názvů
// příkaz namespace musí být deklarován na úplném začátku souboru
echo "<h2>Jmenné prostory</h2>";

 /*	definovano v souboru orders.php
     namespace orders;
	class Order {	
	}
	class OrderItem {	
	}
*/
include 'orders.php';
$myOrder = new orders\Order();
echo $myOrder;

/* alternativní volání - kdy nemusí dávat jménný prostor před volání třídy */
/* namespace orders;
include 'orders.php';
$myOrder1 = new Order();
echo $myOrder1; */


/* Dceřinné jmenné prostory */
echo "<h2>Dceřinné jmenné prostory</h2>";

/* namespace bob\html\page
   class Page {	   
   }
*/
/* pak bude volání vypadat takto:
  $services = new bob\html\page\Page()
*/


/* Globální jmenný prostor */
echo "<h2>Globální jmenný prostor</h2>";
// zapisuje se zpětné lomítko - pokud tedy existuje ještě globální třída Page
/* $services = new \Page();


/* Globální jmenný prostor */
echo "<h2>Globální jmenný prostor</h2>";
// zapisuje se zpětné lomítko - pokud tedy existuje ještě globální třída Page
// $services = new \Page();

/* Import a tvorba aliasů jmenných prostorů */
echo "<h2>Import a tvorba aliasů jmenných prostorů</h2>";

// vytvoření zkráceného aliasu page pro jmenný prostor bob\html\page
// use bob\html\page;
// $services = new page\Page()

// vytvoření zkráceného jiného aliasu pro jmenný prostor bob\html\page
// use bob\html\page as www;
// $services = new www\Page()


?>

