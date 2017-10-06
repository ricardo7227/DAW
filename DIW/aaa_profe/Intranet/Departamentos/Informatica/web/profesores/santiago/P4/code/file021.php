<?php
print "<B><U>Sentencia while (ejemplo file021.php)</U></B><BR>";

// sintaxis while 
$var1 = 1;
while ($var1 <= 3) {
 	// si no se modificase el valor de $var1 el bucle sería infinito
	// también podría ser infinito si la modificación de $var1 
	// tendiese a alejarse de la condición falsa, 
   // por ejemplo, si en lugar
	// de sumar 1 se restase 1. $var1 sería 1, 0, -1, -2, etc. nunca
	// llegaría a 3.
     print "1er.while " . $var1++ . "<BR>";  //post incremento
	 
}
// observar en la salida impresa que $var1 sale de la sentencia
// while
// el valor 4, pero el print es hasta el valor 3.
// al tomar el valor 4, no cumple la condición y abandona el bucle 

// sintaxis while/endwhile 
while ($var1 > 0):
   	// si no se modificase el valor de $var1 el bucle sería infinito
     print "2do. while " . $var1-- . "<BR>";  //post decremento
endwhile;
?>