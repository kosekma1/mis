<?php
//vytváříme obrazové plátno - využíváme grafickou knihovnu GD2
$width=200;
$height=200;
$im = imagecreatetruecolor($width, $height);
$white = imagecolorallocate($im,255,255,255); //přidám barvu do palety obrázku
$blue = imagecolorallocate($im,0,0,255); //přidám barvu do palety obrázku

//kreslíme obrázek
imagefill($im,0,0,$blue); 
imageline($im,0,0,$width,$height,$white);  //parametry platno, souradnice vychoziho bodu, souradnice ciloveho bodu, barva
imagestring($im,4,50,150,'Prodej', $white); // parametry platno,pismo, pozice, text, barva

//výstup obrázku
header('Content-type: image/png');
imagepng($im);

//header('Content-type: image/jpg');
//imagejpeg($im);

//úklid
imagedestroy($im);
?>