<?php
print "<B><U>Sentencia do (ejemplo file022.php)</U></B><BR>";

// sintaxis do 
$var1 = 1;
do   
{
 	// si no se modificase el valor de $var1 el bucle sería infinito
	// también podría ser infinito si la modificación de $var1 
	// tendiese a alejarse de la condición falsa, 
   //  por ejemplo, si en lugar
	// de sumar 1 se restase 1. $var1 sería 1, 0, -1, -2, etc. nunca
	// llegaría a 3.
     print "1er.do " . $var1++ . "<BR>";  //post incremento
	 
} while ($var1 < 4);

print "<BR>2do. do Ahora  la condición no se cumple nunca<BR>";
do   
{
 	// En este caso, la condición no se cumple nunca
	// la iteración se hace una vez.  
     print "2do.do (se ejecuta una vez): " . $var1++ . "<BR>";  
   //post incremento
	 
} while ($var1 < 2); 

?>