<?php

// Ověřujeme, jestli máme data.
$vote = $_POST['vote'];

if (empty($vote)) {
  echo '<p>Nehlasovali jste pro žádného politika.</p>';
  exit;
}

/*******************************************
  Dotazování databáze na výsledky
*******************************************/

// Přihlašujeme se do databáze.
$db = new mysqli('localhost', 'poll', 'poll', 'poll');
//nastavení kódování pro připojení do databáze
$db->query("SET CHARACTER SET 'utf8'");
$db->query("SET SESSION collation_connection ='utf8_unicode_ci'");

if (mysqli_connect_errno()) {
  echo '<p>Chyba: Nepodařilo se připojit k databázi.<br/>
        Zkuste to prosím později.</p>';
  exit;
}
// Přidáváme uživatelův hlas
// Nejdříve ale zjistíme id záznamu kandidáta - MySQL má nastaven safe update, který je vázaný na ID záznamu - v nastavení se dá zrušit
$v_query = "SELECT id FROM poll_results WHERE candidate = ?";
$v_stmt = $db->prepare($v_query);
$v_stmt->bind_param('s', $vote);
$v_stmt->execute();
$v_stmt->store_result();

/* 
$num_of_rows = $v_stmt->num_rows;
echo "Počet výsledků = ". $num_of_rows."<br />";
*/

$v_stmt->bind_result($id); //namapování výsledku do proměnné $id
$v_stmt->fetch();
$v_stmt->free_result();

$v_query = "UPDATE poll_results 
              SET num_votes = num_votes + 1
              WHERE id = ?";
			  	  
$v_stmt = $db->prepare($v_query);
$v_stmt->bind_param('d', $id);
$v_stmt->execute();
$v_stmt->free_result();

// Načítáme aktuální výsledky ankety.
$r_query = "SELECT candidate, num_votes FROM poll_results";
$r_stmt = $db->prepare($r_query);
$r_stmt->execute();
$r_stmt->store_result();
$r_stmt->bind_result($candidate, $num_votes);
$num_candidates = $r_stmt->num_rows;

// Určujeme celkový počet hlasů.
$total_votes = 0;

while ($r_stmt->fetch()) {
  $total_votes +=  $num_votes;
}

$r_stmt->data_seek(0);

/*******************************************
  Úvodní výpočty pro graf
*******************************************/

// Vytvoříme konstanty.
//putenv('GDFONTPATH=/usr/share/fonts/truetype/dejavu');

$width = 500;         // šířka obrázku v pixelech
$left_margin = 50;    // levý okraj grafu
$right_margin = 50;   // pravý okraj grafu
$bar_height = 40;
$bar_spacing = $bar_height / 2;
$font_name = 'C:\Windows\Fonts\DejaVuSans.ttf';
$title_size = 16;     // v bodech
$main_size = 12;      // v bodech
$small_size = 12;     // v bodech
$text_indent = 10;    // odsazení textových popisků od okraje obrázku

// Nastavujeme počáteční bod, že kterého budeme kreslit.
$x = $left_margin + 60;  // x-ová souřadnice počátku
$y = 50;                 // y-ová souřadnice počátku
$bar_unit = ($width - ($x + $right_margin)) / 100;   // jeden "bod" grafu

// Vypočítáme výšku grafu – sloupce s mezerami a nějaké místo navíc.
$height = $num_candidates * ($bar_height + $bar_spacing) + 50;

/*******************************************
  Kreslíme základní obrázek
*******************************************/

// Vytváříme prázdné plátno.
$im = imagecreatetruecolor($width, $height);

// Nastavujeme barvy.
$white = imagecolorallocate($im, 255, 255, 255);
$blue = imagecolorallocate($im, 0, 64, 128);
$black = imagecolorallocate($im, 0, 0, 0);
$pink = imagecolorallocate($im, 255, 78, 243);

$text_color = $black;
$percent_color = $black;
$bg_color = $white;
$line_color = $black;
$bar_color = $blue;
$number_color = $pink;

// Vyplňujeme plátno barvou pozadí.
imagefilledrectangle($im, 0, 0, $width, $height, $bg_color);

// Kreslíme rámeček okolo plátna.
imagerectangle($im, 0, 0, $width - 1, $height - 1, $line_color);

// Přidáváme nadpis.
$title = 'Výsledky ankety';
$title_dimensions = imagettfbbox($title_size, 0, $font_name, $title);
$title_length = $title_dimensions[2] - $title_dimensions[0];
$title_height = abs($title_dimensions[7] - $title_dimensions[1]);
$title_above_line = abs($title_dimensions[7]);
$title_x = ($width - $title_length) / 2;  // centrujeme vodorovně
$title_y = ($y - $title_height) / 2 + $title_above_line; // centrujeme svisle

imagettftext($im, $title_size, 0, $title_x, $title_y,
             $text_color, $font_name, $title);

// Kreslíme základní čáru, přičemž začínáme mírně nad prvním sloupcem
// a končíme mírně pod posledním sloupcem.
imageline($im, $x, $y - 5, $x, $height - 15, $line_color);

/*******************************************
  Kreslíme data do grafu
*******************************************/

// Načítáme postupně jednotlivé záznamy z databáze a kreslíme odpovídající
// sloupce.

while ($r_stmt->fetch()) {

  if ($total_votes > 0) {
    $percent = intval(($num_votes / $total_votes) * 100);
  } else {
    $percent = 0;
  }

  // Zobrazujeme popisek s procentuální hodnotou.
  $percent_dimensions = imagettfbbox($main_size, 0, $font_name, $percent.'%');

  $percent_length = $percent_dimensions[2] - $percent_dimensions[0];

  imagettftext($im, $main_size, 0, $width - $percent_length - $text_indent,
               $y + ($bar_height / 2), $percent_color, $font_name,
               $percent.'%');

  // Délka sloupce pro tuto hodnotu.
  $bar_length = $x + ($percent * $bar_unit);

  // Kreslíme sloupec pro tuto hodnotu.
  imagefilledrectangle($im, $x, $y - 2, $bar_length, $y + $bar_height,
                       $bar_color);

  // Kreslíme popisek pro tuto hodnotu.
  imagettftext($im, $main_size, 0, $text_indent, $y + ($bar_height / 2),
               $text_color, $font_name, $candidate);

  // Kreslíme rámeček, aby bylo jasné, kde je 100 %.
  imagerectangle($im, $bar_length + 1, $y - 2,
                 ($x + (100 * $bar_unit)), $y + $bar_height, $line_color);

  // Zobrazujeme čísla.
  imagettftext($im, $small_size, 0, $x + (100 * $bar_unit) - 50, $y +
               ($bar_height / 2), $number_color, $font_name,
               $num_votes.'/'.$total_votes);

  // Přesouváme se dolů k dalšímu sloupci.
  $y = $y + ($bar_height + $bar_spacing);

}

/*******************************************
  Zobrazení obrázku
*******************************************/
header('Content-type:  image/png');
imagepng($im);

/*******************************************
  Úklid
*******************************************/
$r_stmt->free_result();
$db->close();
imagedestroy($im);
?>
