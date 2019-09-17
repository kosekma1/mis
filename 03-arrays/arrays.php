<?php
	$produkty = array('Pneumatiky', 'Lahve oleje', 'Zapalovací svíčky');
	$produkty_arr = ['Pneumatiky', 'Lahve oleje', 'Zapalovací svíčky'];
	
	$cisla = range(1,10); // do pole se ulozi cisla 1-10
	
	$lichaCisla = range(1,10,2); // treti parametr je krok
	$pismena = range('a','z');
	
	echo "$produkty[0] $produkty[1] $produkty[2]<br />";
	
	$produkty[3] = 'Brzdové destičky';
	
	for ($i=0; $i<4; $i++){
		echo $produkty[$i]."\t";
	}
	
	echo "<br />";
	
	foreach($produkty as $produkt){
		echo $produkt."\t";
	}
	
	echo "<br />";
	
	foreach($cisla as $cislo){
			echo $cislo."<br />";
	}
	
	// pole s jinými klíči
	$prices = array('Pneumatiky' => 2500, 'Lahve oleje' => 250, 'Zapalovací svíčky' => 100);
	
	
	$prices['Brzdové destičky'] = 55;
	
	echo "Cena brzdových destiček:".$prices['Brzdové destičky']."<br />";
	
	foreach ($prices as $klic=>$hodnota){
		echo $klic." - ".$hodnota."<br />";		
	}
	
	echo "<br />";
	
	while ($element = each($prices)){
		echo $element['key']." - ".$element['value']."<br />";
	}
	
	echo "<br />";
	reset($prices); //vraceni aktualniho prvku zpet na zacatek pole pro opetovne prochazeni
	while(list($product, $price) = each($prices)){
		echo $product." - ".$price."<br />";
		
	}
	
	// Dvojrozměrné pole
	
	$produkty = array ( array('PNE', 'Pneumatiky', 2500), array('OLE', 'Lahve oleje', 2500), array('ZAP', 'Zapalovací svíčky', 2500) );
	echo '<br />';
	
	for($radek=0; $radek<3; $radek++){		
		for($sloupec=0; $sloupec<3; $sloupec++){
			echo '|'.$produkty[$radek][$sloupec];			
		}		
		echo '|<br />';		
	}
	
	// Dvojrozměrné pole is pojmenovanými klíči
	$produkty2 = array ( array('Kod' => 'PNE', 
							   'Popis' => 'Pneumatiky', 
							   'Cena'=> 2500), 
						 array('Kod' =>'OLE', 
							   'Popis' =>'Lahve oleje', 
							   'Cena'=>2500), 
						 array('Kod' =>'ZAP', 
							   'Popis' =>'Zapalovací svíčky', 
							   'Cena'=>2500) 
					   );
	
	echo '<br />';
	for ($radek =0; $radek<3; $radek++){
		echo '|'.$produkty2[$radek]['Kod'].'|'.$produkty2[$radek]['Popis'].'|'.$produkty2[$radek]['Cena'];				
		echo '<br />';
	}
	
	echo '<br />';
	for ($radek =0; $radek<3; $radek++){
		while(list($klic,$hodnota) = each($produkty2[$radek])) {
			echo '|'.$hodnota;		
		}
		echo '<br />';
	}
	
	// Trojrozměrné pole
	
	$produkty3 = array ( array (array('OSO_PNE', 'Pneumatiky', 2500), 
								array('OSO_OLE', 'Lahve oleje', 250), 
								array('OSO_ZAP', 'Zapalovací svíčky', 100)
							   ),									 
						array (array('DOD_PNE', 'Pneumatiky', 300), 
							   array('DOD_OLE', 'Lahve oleje', 300), 
							   array('DOD_ZAP', 'Zapalovací svíčky', 125)
							  ),									 
					    array (array('KAM_PNE', 'Pneumatiky', 3750), 
							   array('KAM_OLE', 'Lahve oleje', 375), 
							   array('KAM_ZAP', 'Zapalovací svíčky', 150)
							  )
					    );
   echo '<br />';
   for($vrstva=0; $vrstva<3;$vrstva++){
	   for($radek=0; $radek<3; $radek++){
		   for($sloupec=0; $sloupec <3; $sloupec++){
			   echo '|'.$produkty3[$vrstva][$radek][$sloupec];
		   }
		   echo '<br />';
	   }
	   echo '<br />';
   }		
   
   // Řazení polí
   
   function print_array($array){
	  $size = count($array);
	  for($i=0;$i<$size;$i++){
	   echo($array[$i]);
	   if($i<$size-1){
		   echo(', ');
	   } else{
		   echo('<br />');
	   }
     }   
   }
   
   $products = array('Pneumatiky', 'Lahve oleje', 'Zapalovaci svicky');
   echo('<h2>Unsorted array</h2>');
   foreach($products as $item){ // prochazeni pole pomoci foreach
	   echo($item.',');
   }   
        
   sort($products, SORT_LOCALE_STRING); // funkce sort radi velka pismena pred mala
   echo('<h2>Sorted array</h2>');
   print_array($products);
   
   $numbers = array(600,52,2);
   sort($numbers,SORT_NUMERIC);
   echo('<h2>Sorted numeric array</h2>');
   print_array($numbers);
   
   sort($products, SORT_STRING & SORT_FLAG_CASE); // radi retezec a ignoruje velikost pismen
   
   // Funkce asort a ksort - razeni podle klice nebo hodnoty v asociativnim poli
   $ceny = array('Pneumatiky' => 2500, 'Lahve oleje' => 250, 'Zapalovaci svicky' => 100);
   echo('<h2>Unsorted array</h2>');
   print_r($ceny);
   
   asort($ceny); // radi podle hodnota
   echo('<h2>Sorted array according values - function asort()</h2>');
   print_r($ceny);
   echo('<h2>Sorted array according keys - function ksort()</h2>');
   ksort($ceny); // radi podle hodnota
   print_r($ceny);
   
   // funkce radici pole sestupne
   rsort($products);
   arsort($ceny);
   krsort($ceny);
   
   // Razeni vicerozmernych poli
   
   $produkty = array ( array('OSO_PNE', 'Pneumatiky', 2500), 
					   array('OSO_OLE', 'Lahve oleje', 250), 
					   array('OSO_ZAP', 'Zapalovací svíčky', 100));
	   
   array_multisort($produkty); // serazeni prvku vzestupne podle prvniho prvku
   echo('<br /><br />');
   echo('<h2>Multisort - vicerozmernoho pole - vychozi razeni vzestupne</h2>');
   print_r($produkty);
   
   echo('<h2>Multisort - vicerozmernoho pole - sestupne</h2>');
   array_multisort($produkty, SORT_DESC); // serazeni prvku vzestupne podle prvniho prvku
   print_r($produkty);

   // Uzivatelsky definovane razeni pro vicerozmerne pole - razeni podle druheho sloupce   
   function porovnej($x, $y){
	   if($x[2] == $y[2]){
		   return 0;
	   } else if ($x[2]<$y[2]){
		   return -1;
	   } else {
		   return 1;
	   }
   }
   
   echo('<br /><br />');
   echo('<h2>Razeni vicerozmernoho pole s definovanym razenim</h2>');
   usort($produkty, 'porovnej');
   print_r($produkty);
   
   // Obracene uzivatelske razeni - lisi se v navratove hodnote pro dane porovnani
   function porovnej_obracene($x, $y){
	   if($x[2] == $y[2]){
		   return 0;
	   } else if ($x[2]<$y[2]){
		   return 1;
	   } else {
		   return -1;
	   }
   }
   
   // Preusporadani poli
   $pictures = array('mlok','slunce','ahoj','zima');
   echo('<h2>Vychozi poradi prvku</h2>');
   print_r($pictures);
   
   echo('<h2>Preusporadani pole pomoci shuffle</h2>');
   shuffle($pictures);
   print_r($pictures);
   
   // Pravraceni pole
   
   $cisla = range(1,10); // vygeneruj pole o deseti prvcich - cislech
   echo('<h2>Vygenerovane pole prvku</h2>');
   print_r($cisla);
        
   $cisla = array_reverse($cisla);
   echo('<h2>Prevracene pole prvku</h2>');
   print_r($cisla);
   
   $cisla = array();
   for($i=20; $i>0;$i--){
	   array_push($cisla, $i);
   }
   echo('<h2>Vygenerovane pole pres array_push</h2>');
   print_r($cisla);
   
   // Dalsi manipulace s poli
   // each(), current(), reset(), end(), next(), pos(), prev()
   
   echo "<h1>Další manipulace s poli current(), reset(), end(), next(), pos(), prev()</h1>";
   
   $pole = array(1,2,3);
   
   //prochazeni od zacatku do konce
   echo('<h2>Prochazeni od zacatku do konce</h2>');
   $hodnota = current($pole);   // vrati aktulni prvek   
   while($hodnota){
	   echo "$hodnota.<br />";
	   $hodnota = next($pole); // posune se o jeden a vrati prvek
   }
   
   //vraceni na prvni prvek
   reset($pole);
   
   $hodnota = end($pole); // presun na posledni prvek
   //prochazeni pozpatku
   echo('<h2>Prochazeni od konce do zacatku (pozpátku)</h2>');
   while($hodnota){
	   echo "$hodnota.<br />";
	   $hodnota = prev($pole);
   }
   
   // Aplikovani funkce na jednotlive prvky pole - array_walk()
   
   function muj_vypis($hodnota){
	   echo "$hodnota<br />";
   }
   echo "<h1>Aplikovani funkce na jednotlive prvky pole - jen jeden parametr</h1>";
   $pole = array('Emil','Karel','Pepa');
   array_walk($pole, 'muj_vypis');
   
   // do funkce predavame hodnotu odkazem pres & tim muzeme zmenit jeji obsah
   function me_nasobeni(&$hodnota, $klic, $nasobitel){ //klice jsme museli uvest i kdyz ho vubec nepouzijeme a to kvuli tomu aby sel zadat $nasobitel
		$hodnota *= $nasobitel;
   }
   $pole = array(1,2,3);   
   array_walk($pole, 'me_nasobeni', 3);
   
   echo "<h1>Aplikovani funkce na jednotlive prvky pole - vsechny tri parametry</h1>";
   
   $hodnota = current($pole);
   while($hodnota){
	   echo $hodnota."<br />";
	   $hodnota = next($pole);
   }
   
   // Pocitani prvku v poli - count(), sizeof() a array_count_values()
   
   $pole = array(4,5,1,2,3,1,2,1);
   $pocet_prvku_1 = count($pole);
   $pocet_prvku_2 = sizeof($pole);
   echo "<h1>Unikatni pocet vyskytu</h1>";
   $pocet_jedinecnych_vyskytu = array_count_values($pole); // vraci asociativni pole s poctem vyskytu unikatnich prvku   
   print_r($pocet_jedinecnych_vyskytu);
   
   // Prevod poli na skalarni promenne - vhodne na pouziti treba pro extrahovani promennych z $_REQUEST, $_POST apod.
   echo "<h1>Prevod poli na skalarni promenne - extract()</h1>";
   $pole = array('klic1'=> 'hodnota1','klic2'=> 'hodnota2','klic3'=> 'hodnota3');
   
   extract($pole); // nazvy promennychbudou klice a ty budou mit prirazeny hodnoty
   echo "$klic1 $klic2 $klic3 <br />";
   
   extract($pole,EXTR_PREFIX_ALL, 'ma_predpona'); // vsem exrahovanym nazvum promennym pripoji definovanou predponu
   echo "$ma_predpona_klic1 $ma_predpona_klic2 $ma_predpona_klic3";
   
   
   
   
   
   
   
   
   
   
   
   
   
?>
