<?php
print "<B><U>Sentencia while (ejemplo file021.php)</U></B><BR>";

// sintaxis while 
$var1 = 1;
while ($var1 <= 3) {
 	// si no se modificase el valor de $var1 el bucle ser�a infinito
	// tambi�n podr�a ser infinito si la modificaci�n de $var1 
	// tendiese a alejarse de la condici�n falsa, 
   // por ejemplo, si en lugar
	// de sumar 1 se restase 1. $var1 ser�a 1, 0, -1, -2, etc. nunca
	// llegar�a a 3.
     print "1er.while " . $var1++ . "<BR>";  //post incremento
	 
}
// observar en la salida impresa que $var1 sale de la sentencia
// while
// el valor 4, pero el print es hasta el valor 3.
// al tomar el valor 4, no cumple la condici�n y abandona el bucle 

// sintaxis while/endwhile 
while ($var1 > 0):
   	// si no se modificase el valor de $var1 el bucle ser�a infinito
     print "2do. while " . $var1-- . "<BR>";  //post decremento
endwhile;
?>