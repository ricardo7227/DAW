<?php
print "<B><U>Uso de la funci�n array_pop() (ejemplo file044.php)</U></B><BR>";

// reducci�n del tama�o de una matriz
$mat1 = array("Alemania", "Austria","B�lgica","Dinamarca","Espa�a");
print "Contenido inicial de la matriz: cantidad de elementos :" . count($mat1). "<BR>";
print_r ($mat1);

// array_shift() elimina el primer elemento de la matriz, mientras
// que array_pop() elimina el �ltimo

$var = array_pop ($mat1);      // elimina el �ltimo elemento "Espa�a"

print "<BR><BR>Se utiliza la funci�n array_pop() para eliminar el �ltimo elemento de la matriz";
print "<BR>Elemento eliminado $var <BR>";
 
print "<BR>Contenido final de la matriz: cantidad de elementos :" . count($mat1). "<BR>";
print_r ($mat1); 

?>