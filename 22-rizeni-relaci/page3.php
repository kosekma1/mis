<?php
session_start();

echo '<h1>Page 3 - konec relace</h1>';

echo 'Proměnná $_SESSION[\'session_var\'] obsahuje '. $_SESSION['session_var'].'<br />';

session_destroy();
?>
