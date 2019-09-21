<?php
session_start();

echo '<h1>Page 2 - relace</h1>';

echo 'Proměnná $_SESSION[\'session_var\'] obsahuje '. $_SESSION['session_var'].'<br />';

unset($_SESSION['session_var']);
?>

<p><a href="page3.php">Další stránka</p>
