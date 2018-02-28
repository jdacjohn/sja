<?php
// ----------------------------------------- 
//  The Web Help .com
// ----------------------------------------- 

header('Content-type: image/jpeg');

$width = 50;
$height = 18;

$my_image = imagecreatetruecolor($width, $height);

imagefill($my_image, 0, 0, 0x173f72);

// add noise
for ($c = 0; $c < 40; $c++){
	$x = rand(0,$width-1);
	$y = rand(0,$height-1);
	imagesetpixel($my_image, $x, $y, 0x173f72);
	}

$x = rand(1,10);
$y = 1;

$rand_string = rand(1000,9999);
imagestring($my_image, 5, $x, $y, $rand_string, 0xffffff);

setcookie('tntcon',(md5($rand_string).'a4xn'));

imagejpeg($my_image);
imagedestroy($my_image);
?>