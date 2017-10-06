<?php
// Uso de operandos aritméticos (ejemplo file009.php)

$var1 = 4.5;
$var2= 5; 
// Suma
$resultado = $var1 + $var2; // resultado es 9.5
echo $resultado . "<BR>";
// Resta
$resultado = $var1 - $var2; // resultado es -0.5
echo $resultado . "<BR>";
// Multiplicación
$resultado = $var1 * $var2; // resultado es 22.5
echo $resultado . "<BR>";
// División
$resultado = $var1 / $var2; // resultado es 0.9
echo $resultado . "<BR>";
// Módulo
// considera sólo la parte entera de las variables
$resultado = $var1 % $var2; // resultado es 4
echo $resultado . "<BR>";
$var1 = 10;
$var2 = 3.98;
$resultado = $var1 % $var2; // resultado es 1
echo $resultado . "<BR>";

?>