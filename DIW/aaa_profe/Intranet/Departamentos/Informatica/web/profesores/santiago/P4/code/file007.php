<?php
// Ámbito local (ejemplo file007.php)

function PruebaLocal()
{ 
    $var; 
	echo "Prueba local. \$var  :". ++$var . "<BR>"; /* ¿qué valor muestra $var? */
 
} 
 
PruebaLocal(); // debe imprimir 1
// la suma ++$var se pierde porque es una variable local
// que se reinicializa en cada llamada a la función
PruebaLocal(); // debe imprimir 1
// siempre imprimirá 1
PruebaLocal(); // debe imprimir 1

?>