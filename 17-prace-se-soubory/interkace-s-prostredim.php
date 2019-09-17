<?php

echo '<h1>Zobrazení a nastavení proměnných prostředí</h1>';
echo '<p>funkce getenv() vrátí hodnotu proměnné<p>';
echo '<p>funkce putenv() naství hodnotu proměnné<p>';
echo '<p>getenv("HTTP_REFERER"): '.getenv("HTTP_REFERER").'</p>';
echo '<p>putenv( "HOME=\'home/nikod\'" ): '.putenv("HOME='home/nikdo'").'</p>';
echo '<p>getenv("HOME"): '.getenv("HOME").'</p>';

echo '<h1>Funkce phpinfo() vrátí seznam proměnných prostředí</h1>';
phpinfo();

?>