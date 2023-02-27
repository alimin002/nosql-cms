<?php

$captcha_word = captchaCode(4);
//unset($_SESSION['captcha']);
$this->session->set_userdata('captcha', $captcha_word);
//echo $this->session->userdata('captcha');
$font = FCPATH.'assets/captcha/SourceCodePro-Medium.ttf'; 
$font_size = 20;
// $x = 10;
// $y = 10;
// $angle = rand(-20,20);

$im = imagecreatetruecolor(100, 35);

$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);

//set background to transparent
$textcolor = imagecolorallocate($im, 155, 155, 155);
$textshadow = imagecolorallocate($im, 250, 250, 250);
imagealphablending($im, true);
imagesavealpha($im, true);
$bgcolor = imagecolorallocatealpha($im, 0, 0, 0, 127);
imagefill($im, 0, 0, $bgcolor);

// background red gradien
for ($i=0; $i < 100; $i++) { 
	$color = imagecolorallocate($im, 80+$i,0,0);
	// imageline($im, $i,35,$i,0,$color);
}

for($i=0;$i<100;$i++) {
    imagesetpixel($im,rand()%200,rand()%50,$grey);
}  

$array = str_split($captcha_word);
//generate captcha text
for ($i=0; $i < sizeof($array) ; $i++) { 
	$angle = rand(-20,20);
	$x = 5 + ($i*25);
	$y = rand(22,28);
	imagettftext($im, $font_size, $angle, $x - 1, $y, $textshadow, $font, $array[$i]);
	imagettftext($im, $font_size, $angle, $x, $y, $textcolor, $font, $array[$i]);
}

header("Content-type: image/png"); 
imagepng($im); 
imagedestroy($im);
?>
