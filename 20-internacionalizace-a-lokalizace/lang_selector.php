<?php
session_start();
include 'define_lang.php';
include 'lang_strings.php';
defineStrings();

?>
<!DOCTYPE html>  	
<html lang="<?php echo LANGCODE; ?>">
	<meta charset="<?php echo CHARSET; ?>">	
	<title><?php echo WELCOME_TXT; ?></title>		
	<body>
	<h1><?php echo WELCOME_TXT; ?></h1>
	<h1><?php echo CHOOSE_TXT; ?></h1>
	<ul>
	  <li><a href="<?php echo $_SERVER['PHP_SELF']."?lang=cs"; ?>">cs</a></li>
	  <li><a href="<?php echo $_SERVER['PHP_SELF']."?lang=en"; ?>">en</a></li>
	</ul>	
	</body>
 </html>
