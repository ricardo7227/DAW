<?php
// Análisis de un documento con funciones regex  (archivo file166.php)

$cadena = "<HTML>hola<p>soy párrafo</p>aca no lo soy<P>otro párrafo</P></HTML>";
$patrón = "/<P>[^<]*<\/P>/i";

preg_match_all($patrón, $cadena, $matches, PREG_SET_ORDER);

// matriz con las coincidencias
print_r($matches);

?> 
