<?php
print "<B><U>Uso de la función array_pop() (ejemplo file044.php)</U></B><BR>";

// reducción del tamaño de una matriz
$mat1 = array("Alemania", "Austria","Bélgica","Dinamarca","España");
print "Contenido inicial de la matriz: cantidad de elementos :" . count($mat1). "<BR>";
print_r ($mat1);

// array_shift() elimina el primer elemento de la matriz, mientras
// que array_pop() elimina el último

$var = array_pop ($mat1);      // elimina el último elemento "España"

print "<BR><BR>Se utiliza la función array_pop() para eliminar el último elemento de la matriz";
print "<BR>Elemento eliminado $var <BR>";
 
print "<BR>Contenido final de la matriz: cantidad de elementos :" . count($mat1). "<BR>";
print_r ($mat1); 

?>