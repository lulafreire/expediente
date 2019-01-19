<?php
$url = $_GET['url'];
$link = "anexos/".$url;
header ("Content-Disposition: attachment; filename=".$url."");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($link));
readfile($link);
?>