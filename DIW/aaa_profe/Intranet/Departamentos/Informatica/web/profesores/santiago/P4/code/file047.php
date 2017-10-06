<?php
print "<B><U>Combinación de matrices con array_merge() (ejemplo file047.php)</U></B><BR><BR>";

// combinación de 5 matrices
$mat1 = array("uno" =>"Alemania");
$mat2 = array("dos"=>"Francia", "uno"=>"Italia"); 
$mat3 = array("dos"=>"Francia", "tres"=>"España");
$mat4 = array("UK", "Brasil");
$mat5 = array("Canadá", "Portugal", "Argentina");

// las claves repetidas no se toman en cuenta
// OJO: sólo en matrices asociativas
$mat6 = array_merge($mat1, $mat2, $mat3, $mat4, $mat5);

print "Obsérvese que no se incluyen los siguientes elementos: <BR>";
print "<BR> [dos]   Francia";
print "<BR> [uno]   Alemania"; // selecciona Italia

print "<BR>Contenido actual de la matriz: cantidad de elementos :" . count($mat6) . "<BR><BR>";
print_r ($mat6); 

?>