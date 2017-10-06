<?php
print "<B><U>Combinaci�n de matrices con array_merge() (ejemplo file047.php)</U></B><BR><BR>";

// combinaci�n de 5 matrices
$mat1 = array("uno" =>"Alemania");
$mat2 = array("dos"=>"Francia", "uno"=>"Italia"); 
$mat3 = array("dos"=>"Francia", "tres"=>"Espa�a");
$mat4 = array("UK", "Brasil");
$mat5 = array("Canad�", "Portugal", "Argentina");

// las claves repetidas no se toman en cuenta
// OJO: s�lo en matrices asociativas
$mat6 = array_merge($mat1, $mat2, $mat3, $mat4, $mat5);

print "Obs�rvese que no se incluyen los siguientes elementos: <BR>";
print "<BR> [dos]   Francia";
print "<BR> [uno]   Alemania"; // selecciona Italia

print "<BR>Contenido actual de la matriz: cantidad de elementos :" . count($mat6) . "<BR><BR>";
print_r ($mat6); 

?>