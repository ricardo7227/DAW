<?php
// An�lisis de un documento con funciones regex  (archivo file166.php)

$cadena = "<HTML>hola<p>soy p�rrafo</p>aca no lo soy<P>otro p�rrafo</P></HTML>";
$patr�n = "/<P>[^<]*<\/P>/i";

preg_match_all($patr�n, $cadena, $matches, PREG_SET_ORDER);

// matriz con las coincidencias
print_r($matches);

?> 
