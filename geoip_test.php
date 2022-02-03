<?php 
$pageContent = file_get_contents('http://freegeoip.net/json/' . $_SERVER['REMOTE_ADDR']);
$parsedJson  = json_decode($pageContent);
print_r($parsedJson);
?>
