<?php

  if((!isset($_SERVER['PHP_AUTH_USER'])) && (!isset($_SERVER['PHP_AUTH_PW'])) && (substr($_SERVER['HTTP_AUTHORIZATION'],0,6) == 'Basic')){
	  list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
  }
  
  if(($_SERVER['PHP_AUTH_USER'] != 'uzivatel') || ($_SERVER['PHP_AUTH_PW'] != 'heslo')) {
	  //návštěvník zatím nezadal přihlašovací údaje nebo je jeho/její kombinace hesla neplatná	  
	  header('WWW-Authenticate: Basic realm="Nazev-oblasti"');
	  header('HTTP/1.0 401 Unauthorized');
  } else {	  
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="UTF-8" />
	<title>Tajná stránka</title>
  </head>
  <body>
  <?php
    echo '<h1>A je to!</h1><p>Určitě jste rád/a, že vidíte tuto tajnou stránku.</p>';
    }
  ?>
  </body>
 </html> 
