<?php
// ejemplo del uso de la funci�n preg_match() (archivo file165.php)

$cadena = "*** hoja 001    d�a 14/10/2009";
$patr�n = '/hoja\s?\d\d\d/'; 

preg_match($patr�n, $cadena, $matches, PREG_OFFSET_CAPTURE);

// matriz con las coincidencias
print_r($matches);

?> 
