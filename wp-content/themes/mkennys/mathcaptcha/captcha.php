<?php session_start(); 
$img = imagecreatefrompng('black.png'); 
//value 1
$numeroa = rand(1, 9);
//value2
$numerob = rand(1, 9);
$numero = $numeroa + $numerob;
$display = $numeroa . '+' . $numerob;
$_SESSION['check'] = $numero; 
//The function imagecolorallocate creates a 
//color using RGB (red,green,blue) format.
$white = imagecolorallocate($img, 255, 255, 255); 
imagestring($img, 10, 8, 3, $display, $white);
 header ("Content-type: image/png"); imagepng($img); 
?>