<?php
print "<B><U>Unión de matrices (ejemplo file046.php)</U></B><BR><BR>";

// unión de dos matrices
$mat1 = array("uno" =>"Alemania");
$mat2 = array("dos"=>"Francia", "uno"=>"Italia"); 
$mat3 = array("dos"=>"Francia", "tres"=>"España");
$mat4 = array("UK", "Brasil");
$mat5 = array("Canadá", "Portugal", "Argentina");

// las claves repetidas no se toman en cuenta   
$mat6 = $mat1 + $mat2 + $mat3 + $mat4 + $mat5;

print "Obsérvese que no se incluyen los siguientes elementos: <BR>";
print "<BR> [dos]   Francia";
print "<BR> [uno]   Italia";
print "<BR> [0]     Canadá";
print "<BR> [1]     Portugal";

print "<BR><BR>Contenido actual de la matriz: cantidad de elementos :" . count($mat6) . "<BR><BR>";
print_r ($mat6); 

?>