<?php
print "<B><U>Uso de la función array_shift() (ejemplo file043.php)</U></B><BR>";

// reducción del tamaño de una matriz
// la matriz se crea con 5 elementos
$mat1 = array("Alemania", "Austria", "Bélgica", "Dinamarca", "España");
// ¿Cuántos elementos hay en la matriz?
print "Contenido inicial de la matriz: cantidad de elementos :" . count($mat1). "<BR>";

// Contenido de la matriz 
print_r ($mat1); 

$var2 = array_shift ($mat1);      // elimina el primer elemento

// en $var2 queda almacenado ese elemento	
print "<BR><BR>Se elimina el elemento: " .$var2 . " usando la función array_shift()<BR>";

// ¿Cuántos elementos hay en la matriz?
print "<BR>Contenido actual de la matriz: cantidad de elementos :" . count($mat1). "<BR>";

// Contenido de la matriz 
print_r ($mat1); 

?>