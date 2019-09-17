<?php
	switch($_POST['gender']){
		case "muž";
		case "žena";
		case "jiné";
		  echo "<h1>Gratuluji!<br />
		        Jste: ".$_POST['gender'].".</h1>";
		  break;
		default:
		  echo "<h1><span color=\"color: read; \">VAROVÁNÍ:</span><br />
		       Neplatná vstupní hodnota!";
		  break;		
	}

?>

