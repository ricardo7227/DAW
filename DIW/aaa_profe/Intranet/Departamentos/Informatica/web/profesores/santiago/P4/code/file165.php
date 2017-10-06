<?php
// ejemplo del uso de la función preg_match() (archivo file165.php)

$cadena = "*** hoja 001    día 14/10/2009";
$patrón = '/hoja\s?\d\d\d/'; 

preg_match($patrón, $cadena, $matches, PREG_OFFSET_CAPTURE);

// matriz con las coincidencias
print_r($matches);

?> 
