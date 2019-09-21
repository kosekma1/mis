<?php
// Ověříme, jestli máme vhodná data v proměnných
// (proměnnými jsou button-text a button-color).

$button_text = $_POST['button_text'];
$button_color = $_POST['button_color'];

if (empty($button_text) || empty($button_color)) {
  echo '<p>Nelze vytvořit obrázek: nevyplnili jste formulář správně.</p>';
  exit;
}

// Vytvoříme obrázek s použitím základního tlačítka správné barvy
// a zjistíme jeho rozměry.
$im = imagecreatefrompng($button_color.'-button.png');

$width_image = imagesx($im);
$height_image = imagesy($im);

// Náš obrázek musí mít 18pixelové okraje.
$width_image_wo_margins = $width_image - (2 * 18);
$height_image_wo_margins = $height_image - (2 * 18);

// Řekneme knihovně GD2, kde se nachází písmo, které chceme použít.

// V systému Windows použijeme:
//putenv('GDFONTPATH=C:/WINDOWS/Fonts');

//putenv('GDFONTPATH=' . realpath('.'));

// V systému UNIX použijeme úplnou cestu k adresáři písma.
// V tomto příkladu používáme rodinu písem DejaVu:
//putenv('GDFONTPATH=/usr/share/fonts/truetype/dejavu');

$font_name = 'C:/WINDOWS/Fonts/arial.ttf';  //absolute path needed
//$font_name = 'arial.ttf';  //absolute path needed

// Zjistíme, jestli se písmo o dané velikosti vleze do tlačítka, přičemž
// ho postupně zmenšujeme, dokud se nevleze.
$font_size = 33;

do {
  $font_size--;

  // Určujeme velikost textu s danou velikostí písma.
  $bbox = imagettfbbox($font_size, 0, $font_name, $button_text);

  $right_text = $bbox[2]; // souřadnice pravého okraje
  $left_text = $bbox[0];  // souřadnice levého okraje
  $width_text = $right_text - $left_text;   // jak je text široký?
  $height_text = abs($bbox[7] - $bbox[1]);  // jak je text vysoký?
   
} while ($font_size > 8 &&
  ($height_text > $height_image_wo_margins ||
  $width_text > $width_image_wo_margins)
);

if ($height_text > $height_image_wo_margins ||
    $width_text > $width_image_wo_margins) {
  // Zadaný text se nevleze na tlačítko tak, aby byl čitelný.
  echo '<p>Zadaný text se nevleze na tlačítko.</p>';
} else {	
  // Našli jsme vhodnou velikost písma.
  // Nyní zjistíme, kam bychom měli text umístit.

  $text_x = $width_image / 2.0 - $width_text / 2.0;
  $text_y = $height_image / 2.0 - $height_text / 2.0;

  if ($left_text < 0) {
    $text_x += abs($left_text);     // připočítáme levý přesah
  }

  $above_line_text = abs($bbox[7]); // jak daleko nad základní dotažnicí?
  $text_y += $above_line_text; // přičteme vzdálenost od základní dotažnice
  
  $text_y -= 2;  // upravíme výšku pro tvar naší šablony

  $white = imagecolorallocate($im, 255, 255, 255);

  imagettftext($im, $font_size, 0, $text_x, $text_y, $white,
               $font_name, $button_text);

  header('Content-type: image/png');
  imagepng($im);
}

// Uklidíme prostředky.
imagedestroy ($im);
?>
