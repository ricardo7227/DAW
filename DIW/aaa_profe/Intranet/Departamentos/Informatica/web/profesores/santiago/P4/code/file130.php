<?php
// Esta descarga se realiza autom�ticamente
$arch = "upload.txt";
header("Content-Disposition: attachment; filename='$arch'");
header("Content-Length: ", filesize($arch));
header("Content-Type: application/octet-stream; name='$arch'");
?>
