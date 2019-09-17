<?php
	
	/* Operator reference */
	
	$a = 7;
	$b = &$a; // alias - operator reference - promnne a a b ukazuji na stejne misto pameti
	
	echo $a."<br />";
	echo $b."<br />";
	
	unset($a); // zruseni promenne
	echo $b."<br />";
	
	/* operator identity */
	$a = 0;
	echo ($a=='0')."<br />"; // true - staci pokud se rovnaji hodnoty		
	
	if ($a==='0') // false - musi se rovnat hodnoty i typ
	  echo "Jsou identicke <br />";
	else
	  echo "Nejsou identicke <br />";
	  
   /* Ternarni operator */
   $znamka = 60;   
   echo ($znamka>=50 ? 'Prospěl' : 'Neprospěl').'<br />';
	
	/* Operator potlaceni chyby */
	
	$a = @(57/0);
	echo $a;
	
	/* Operator spusteni */
	// $vystup = `ls -la'; // na unixovem systemu
	$vystup = `dir c:`; // uvozovky na klavese kde je tilda(~)
	echo '<pre>'.$vystup."</pre>";

	/* Typovy operator */
	class UkazkovaTrida{};
	$mujObjekt = new UkazkovaTrida();
	if($mujObjekt instanceof UkazkovaTrida)
		echo "mujObjekt je instancí UkazkovaTrida <br />";
	
	/* Testovani a nastaveni typu promennych */
	
	$a = 56;
	echo gettype($a).'<br />';
	settype($a, 'float');
	echo gettype($a).'<br />';
	
	// is_array()
	// is_double(), is_float(), is_real() // ekvivalentni funkce
	// is_long(), is_int(), is_integer() // ekvivalentni funkce
	// is_string()
	// is_bool()
	// is_object()
	// is_resource()
	// is_null()
	// is_scalar()
	// is_numeric()
	// is_callable() // overuje zda je promenna nazvem platne funkce
	
	
	/* Testovani stavu promenne */
	$tireqty = 10;
	echo 'isset($tireqty):'.isset($tireqty).'<br />';
	echo 'isset($neexistujici):'.isset($neexistujici).'<br />';
	echo 'empty($tireqty):'.empty($tireqty).'<br />';
	echo 'empty($neexistujici):'.empty($neexistujici).'<br />';
	
	/* Reinterpretace promennych */
	// pretypovani promenne zavolanim funkce
	$a = intval(15.5);
	$b = floatval(10);
	$c = strval(7.56);
	echo gettype($a). " " . gettype($b)." ". gettype($c)."<br />";
	
	
?>

