<?php
session_start();

$_SESSION['session_var'] = "Ahoj Světe";

echo '<h1>Page 1 - relace</h1>';

echo 'Proměnná $_SESSION[\'session_var\'] obsahuje '. $_SESSION['session_var'].'<br />';
?>

<p><a href="page2.php">Další stránka</p>

