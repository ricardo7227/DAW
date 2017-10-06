<?php
// Operadores bit a bit (ejemplo file015.php)

$var1 = 8;  // en binario es 100
$var2 = 12; // en binario es 110

// Operador Y
$var3 = $var1 & $var2;
echo "$var3 <BR>"; // el resultado es 8 (100)

// Operador O
$var3 = $var1 | $var2;
echo "$var3 <BR>"; // el resultado es 12 (110))

// Operador xOR
$var3 = $var1 ^ $var2;
echo "$var3 <BR>"; // el resultado es 4 (010))

// Operador negación
$var3 = ~$var1;
echo "$var3 <BR>"; // el resultado es -9 (111...011))

// Operador desplazamiento a la izquierda
$var3 = $var1 << 2; // 2 posiciones es como multiplicar por 4
echo "$var3 <BR>"; // el resultado es 32 (10000)

// Operador desplazamiento a la derecha
$var3 = $var1 >> 2; // 2 posiciones es como dividir por 4
echo "$var3 <BR>"; // el resultado es 2 (001)

?>