<?php
session_start();
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@)(!";
function getRandom($chars){
    $res = "";
    $size = strlen($chars);
    $nbchar = rand(3,5);
    for($i = 0; $i < $nbchar; $i++){
        $res .= utf8_encode ($chars[rand(0,$size-1)]);
    }
    return $res;
}
$string = getRandom($chars);
$_SESSION["captcha"] = $string;
$im = imagecreate(120, 40);


$bg = imagecolorallocate($im, 16, 16, 16);
$textcolor[0] = imagecolorallocate($im, 0, 0, 255);

$textcolor[1] = imagecolorallocate($im, 0, 255, 0);
$textcolor[2] = imagecolorallocate($im, 255, 0, 0);
$textcolor[3] = imagecolorallocate($im, 255, 0, 255);
$textcolor[4] = imagecolorallocate($im, 255, 255, 255);
$textcolor[5] = imagecolorallocate($im, 0, 255, 255);
$textcolor[6] = imagecolorallocate($im, 255, 255, 0);

// Ajout de la phrase en haut à gauche
for($i = 0; $i <= strlen($string) -1; $i++){
    //$color = imagecolorallocate ($im, rand(0,240), rand(0,240), rand(0,240));
$color = $textcolor[rand(0,6)];
    imagestring($im, 18, $i*(rand(14,16))+16, rand(0,25), $string[$i], $color);
}

// Affichage de l'image
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);

?>