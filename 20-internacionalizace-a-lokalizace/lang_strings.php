<?php

function defineStrings(){	
	switch($_SESSION['lang']){
		case "cs":
		  define ("WELCOME_TXT","Vítejte");
		  define ("CHOOSE_TXT","Zvolte jazyk");
		break;
		case "en":
		  define ("WELCOME_TXT","Welcome");
		  define ("CHOOSE_TXT","Choose language");
		break;
		default:
          define ("WELCOME_TXT","Vítejte");
		  define ("CHOOSE_TXT","Zvolte jazyk");
		break;		
	}
}

?>