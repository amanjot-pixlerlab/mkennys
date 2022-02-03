<?php
session_start(); 
//Sessions in PHP are started by using the 
//session_start() function.  
//Like the setcookie( ) function, 
//the session_start function must come before any HTML, 
//including blank lines, on the page.session_start(); 
//Check if the security code and 
//the session value are not blank 
//and if the input text matches the stored text
if(($_POST['check']) == $_SESSION['check']) { 
echo 'Input OK';
}else{ 
echo 'Input Wrong';        
}