<?php
// �mbito local (ejemplo file007.php)

function PruebaLocal()
{ 
    $var; 
	echo "Prueba local. \$var  :". ++$var . "<BR>"; /* �qu� valor muestra $var? */
 
} 
 
PruebaLocal(); // debe imprimir 1
// la suma ++$var se pierde porque es una variable local
// que se reinicializa en cada llamada a la funci�n
PruebaLocal(); // debe imprimir 1
// siempre imprimir� 1
PruebaLocal(); // debe imprimir 1

?>