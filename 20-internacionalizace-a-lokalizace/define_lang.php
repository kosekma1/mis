<?php
  /* soubor zodpovědný za odesílání místních hlaviček */
  if((!isset($_SESSION['lang'])) || (!isset($_GET['lang']))) {
	  $_SESSION['lang'] = "cs";
	  $currLang = "cs";
  } else {
	  $currLang = $_GET['lang'];
	  $_SESSION['lang'] = $currLang;	  
  }
  
  switch($currLang){
	  case "cs":
		  define("CHARSET","UTF-8");
		  define("LANGCODE","cs");
		  break;
	  case "en":
		  define("CHARSET","ISO-8859-1");
		  define("LANGCODE","em");
		  break;
	  default:
	      define("CHARSET","UTF-8");
		  define("LANGCODE","cs");
		  break;
  }
  
  header("Content-Type: text/html; charset=".CHARSET);
  header("Content-Language: ".LANGCODE);
 ?>