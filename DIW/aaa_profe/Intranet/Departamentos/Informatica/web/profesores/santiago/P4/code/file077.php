<?php
print "<B><U>Recursividad (ejemplo file077.php)</U></B><BR><BR>";

// cálculo del factorial de 5
$var1 = 5;

echo "El factorial de " . $var1 . " es " . (factorial($var1)); 
 
function factorial($var) {
	// irá llamando recursivamente a factorial()
	// $var es una variable local de cada función factorial
	if ($var == 0) return 1;
	echo "calculará multiplicación por " . $var ."<BR>";
	return $var * factorial ($var -1);
}
 
?> 