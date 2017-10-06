<?php
print "<B><U>Añadir elementos con array_intersect_assoc() (ejemplo file051.php)</U></B><BR><BR>";

// intersección entre dos matrices
$mat1 = array("Bélgica", 1 , "Escocia","España");
$mat2 = array("España", "Alemania", "Escocia", "001"); 
// la representación como cadena de 1 y 001 son diferentes

// por eso el elemento con valor 1 no está en la matriz intersección
// el valor España está en ambas matrices, pero con distinto 
// orden (clave) 
$mat3 = array_intersect_assoc($mat1,$mat2);
 
print "Contenido actual de la matriz: cantidad de elementos :" . count($mat3) . "<BR><BR>";
// observar qué valores de clave se mantienen
// 2 para Escocia 
print_r ($mat3); 

?>