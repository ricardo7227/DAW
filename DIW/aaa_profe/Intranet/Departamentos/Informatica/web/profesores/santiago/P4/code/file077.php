<?php
print "<B><U>Recursividad (ejemplo file077.php)</U></B><BR><BR>";

// c�lculo del factorial de 5
$var1 = 5;

echo "El factorial de " . $var1 . " es " . (factorial($var1)); 
 
function factorial($var) {
	// ir� llamando recursivamente a factorial()
	// $var es una variable local de cada funci�n factorial
	if ($var == 0) return 1;
	echo "calcular� multiplicaci�n por " . $var ."<BR>";
	return $var * factorial ($var -1);
}
 
?> 