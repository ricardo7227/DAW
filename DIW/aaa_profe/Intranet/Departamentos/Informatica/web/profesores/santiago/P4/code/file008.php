<?php
// �mbito local (ejemplo file008.php)

function PruebaLocal()
{
    // se define la variable como est�tica para
    // que la variable mantenga su valor entre
    // las diferentes llamadas a la funci�n
    static $var; 
	echo "Prueba local. \$var  :". ++$var . "<BR>"; /* �qu� valor muestra $var? */
 
} 
 
PruebaLocal(); // debe imprimir 1
PruebaLocal(); // deber� imprimir 2
PruebaLocal(); // deber� imprimir 3

?>