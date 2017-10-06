<?php
// Operadores de comparaci�n (ejemplo file011.php)

$var1 = 12; 
$var2 = "12 gatos";
// Aqu� PHP considera una comparaci�n num�rica
echo $var1 ==  $var2; // resultado Verdadero
echo $var1 !=  $var2; // resultado Falso
echo $var1 === $var2; // resultado Falso

$var1 = "12";  
$var2 = "12 gatos";
// Aqu� PHP considera una comparaci�n de cadenas
echo $var1 ==  $var2; // resultado Falso
echo $var1 !=  $var2; // resultado Verdadero
echo $var1 === $var2; // resultado Falso

// Ternario (esta evaluaci�n da TRUE)
($var1 != $var2) ? ($var1 = "ES CIERTO") : ($var1 = "ES FALSO");
echo $var1;           // resultado ES CIERTO

?>