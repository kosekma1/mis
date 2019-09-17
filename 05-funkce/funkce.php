<?php
 
 function ma_funkce(){
	 echo 'Zavolali jste mou funkci';
 }
 
 echo "<h1>Funkce bez parametrů</h1>";
 ma_funkce();
 
 function create_table($data, $header=NULL, $caption=NULL){
	 echo '<table border="1">';
	 if($caption){
		 echo "<caption>$caption</caption>";
	 }
	 if($header){
		 echo "<tr><th>$header</th></tr>";		 
	 }
	 reset($data);
	 $value = current($data);
	 while($value){
		 echo "<tr><td>$value</td></tr>\n";
		 $value = next($data);
	 }
	 echo '</table>';
 }
 
 $my_data = array('Prvni kus dat', 'Druhy kus dat', 'Treti kus dat');
 //$my_data = ['Prvni kus dat', 'Druhy kus dat', 'Treti kus dat'];
 $my_header = 'Několik druhů dat';
 $my_caption = 'Toto je muj caption';
 echo "<h1>Funkce s parametry</h1>";
 create_table($my_data);
 create_table($my_data,$my_header,$my_caption); 
 create_table($my_data,'Záhlaví');
 create_table($my_data,NULL, 'Popisek');
 
 /* promenlivy pocet parametru */
 function var_args(){
	 echo 'Počet parametrů: ';
	 echo func_num_args();
	 
	 echo '<br />';
	 $args = func_get_args();
	 foreach ($args as $arg){
		 echo $arg.'<br />';
	 }
 }
 echo "<h1>Proměnlivý pocet parametrů</h1>";
 var_args('jedna','dva','tri','ctyri',5);
 
 /* oblast plastnosti */
 
  echo "<h1>Oblast platnosti proměnných a funkcí</h1>";
 function fn(){
	 $var = 'obsah';
 }
 
 fn();
 echo $var;
 
 function fn1(){
	 echo 'Uvnitř funkce nejprve platí, že $var = '.$var.'<br />';
	 $var = 2;
	 echo 'a později uvnitř platí, že $var = '.$var.'<br />';
 }
$var = 1;
fn1();
echo 'Vně funkce latí, že $var = '.$var.'<br />';
 
/* globalni promenna */
function fn2(){
	global $var;
	$var = 'obsah';
	echo 'Uvnitř funkce platí, že $var = '.$var.'<br />';
} 
echo "<h1>Globální platnost</h1>";
fn2();
echo 'Vně funkce platí, že $var = '.$var.'<br />';


/* predavani parametru odkazem */
echo "<h1>Předávání parametrů odkazem</h1>";
function zvys(&$hodnota, $mnozstvi = 1){
	$hodnota = $hodnota + $mnozstvi;
}

$a = 10;
zvys($a);
echo $a.'<br />';

/* klicove slovo return */

function larger($x, $y){
	if( (!isset($x)) || (!isset($y))){
		echo 'Tato funkce vyžaduje dvě čísla';
		return; //předčasné přerušní funkce
	}
	if($x>$y){
		echo $x."<br />";
	} else {
		echo $y."<br />";
	}
}

$a = 1;
$b = 2.5;
$c = 1.9;
echo "<h1>Použití klíčového slova Return</h1>";
larger($a,$b);
larger($c,$a);
larger($d,$a);

function larger2($x, $y){
	if( (!isset($x)) || (!isset($y))){
		echo 'Tato funkce vyžaduje dvě čísla';
		return false; //předčasné přerušní funkce
	}
	if($x>=$y){
		return $x;
	} else {
		return $y;
	}
}

echo "<h1>Vrácení hodnot z funkce</h1>";
echo larger($a,$b);
echo larger($c,$a);
echo larger($d,$a);

/* rekurze */
echo "<h1>Rekurze</h1>";

function reverse_r($str){
	if(strlen($str)>1){
		reverse_r(substr($str,1));
	}
	echo substr($str, 0, 1);
}

function reverse_i($str){
	for($i=1;$i<=strlen($str);$i++){
		echo substr($str, -$i, 1);
	}
}

reverse_r('Ahoj');
echo '<br />';
reverse_i('Ahoj');

/* anonymní funkce (uzávěry) - funkce bez názvu, často slouží jako funkce zpětného volání - to jsou funkce, které předáváme jako argumenty jiným funkcím*/
echo "<h1>Anonymní funkce (uzávěry)</h1>";

$pole = array(1,2,3);
array_walk($pole, function($hodnota) {echo "$hodnota<br />";});

// funkce se přiřadí proměnné
$vypis = function($hodnota) {echo "$hodnota<br />";};
// funkce se zavolá jako proměnná
$vypis('Ahoj');

array_walk($pole, $vypis); // zredukovani volani diky funkci přiřazené v proměnné

echo "<h1>Použití globální proměnné v uzávěru</h1>";

$printer = function($value) { echo "$value <br />";};

$products = ['Pneumatiky' => 2500,
			  'Lahve oleje' => 250,
			  'Zapalovací svíčky' => 100];

//$products = [100,200,300];
			  
$markup = 0.21;

$apply = function(&$val) use ($markup) { // use = global, tedy použij globální proměnnou $markup uvnitř této anonymní funkce
	$val = $val * (1 + $markup);
};

echo "<br />";
array_walk($products, $apply);
array_walk($products, $printer);




















?>