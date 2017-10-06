<?php
print "<B><U>Combinación de matrices con array_merge_recursive() (ejemplo file048.php)</U></B><BR><BR>";

// combinación de 5 matrices
$mat1 = array("uno" =>"Alemania");
$mat2 = array("dos"=>"Francia", "uno"=>"Italia"); 
$mat3 = array("dos"=>"Francia", "tres"=>"España");
$mat4 = array("UK", "Brasil");
$mat5 = array("Canadá", "Portugal", "Argentina");

// las claves repetidas se toman en cuenta 
$mat6 = array_merge_recursive($mat1, $mat2, $mat3, $mat4, $mat5);

// las claves "uno" y "dos" son ahora arrays dentro del array 
print "Contenido actual de la matriz: cantidad de elementos :" . count($mat6) . "<BR><BR>";
print_r ($mat6); 

?>