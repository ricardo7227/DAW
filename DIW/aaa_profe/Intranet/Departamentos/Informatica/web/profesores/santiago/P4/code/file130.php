<?php
// Esta descarga se realiza automáticamente
$arch = "upload.txt";
header("Content-Disposition: attachment; filename='$arch'");
header("Content-Length: ", filesize($arch));
header("Content-Type: application/octet-stream; name='$arch'");
?>
