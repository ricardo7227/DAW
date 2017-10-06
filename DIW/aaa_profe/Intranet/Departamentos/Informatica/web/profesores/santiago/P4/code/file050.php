<?php
print "<B><U>A�adir elementos con array_intersect() (ejemplo file050.php)</U></B><BR><BR>";

// intersecci�n entre dos matrices
$mat1 = array("B�lgica", 1 , "Escocia", "Espa�a");
$mat2 = array("Espa�a", "Alemania", "Escocia", "001");

// la representaci�n como cadena de 1 y 001 son diferentes
// por eso el elemento con valor 1 no est� en la matriz intersecci�n
$mat3 = array_intersect($mat1,$mat2);
 
print "Contenido actual de la matriz: cantidad de elementos :" . count($mat3) . "<BR><BR>";
// observar qu� valores de clave se mantienen
// 2 para Escocia, 3 para Espa�a
print_r ($mat3); 

?>
