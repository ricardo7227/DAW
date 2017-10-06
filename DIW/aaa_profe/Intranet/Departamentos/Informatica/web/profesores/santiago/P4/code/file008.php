<?php
// Ámbito local (ejemplo file008.php)

function PruebaLocal()
{
    // se define la variable como estática para
    // que la variable mantenga su valor entre
    // las diferentes llamadas a la función
    static $var; 
	echo "Prueba local. \$var  :". ++$var . "<BR>"; /* ¿qué valor muestra $var? */
 
} 
 
PruebaLocal(); // debe imprimir 1
PruebaLocal(); // deberá imprimir 2
PruebaLocal(); // deberá imprimir 3

?>