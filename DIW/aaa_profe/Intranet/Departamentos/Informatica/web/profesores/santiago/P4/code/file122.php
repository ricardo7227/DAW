<?php
// Apertura de archivos (ejemplo file122.php) 

// si no existe el archivo emite una advertencia
// con @ evito el mensaje de advertencia
$fp = @fopen("archivo01.txt", "r") 
    or die ("No existe el archivo");

// en $fp queda cargado el descriptor del recurso
print $fp; 
// por ejemplo:
// Resource id #3

?>