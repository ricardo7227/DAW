<?php
// Operadores de comparación (ejemplo file011.php)

$var1 = 12; 
$var2 = "12 gatos";
// Aquí PHP considera una comparación numérica
echo $var1 ==  $var2; // resultado Verdadero
echo $var1 !=  $var2; // resultado Falso
echo $var1 === $var2; // resultado Falso

$var1 = "12";  
$var2 = "12 gatos";
// Aquí PHP considera una comparación de cadenas
echo $var1 ==  $var2; // resultado Falso
echo $var1 !=  $var2; // resultado Verdadero
echo $var1 === $var2; // resultado Falso

// Ternario (esta evaluación da TRUE)
($var1 != $var2) ? ($var1 = "ES CIERTO") : ($var1 = "ES FALSO");
echo $var1;           // resultado ES CIERTO

?>