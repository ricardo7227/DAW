<?php
print "<B><U>Par�metros pasados por referencia (ejemplo file072b.php)</U></B><BR><BR>";

$var1 = 12;
echo "1. (antes de llamada a la funci�n) valor de \$var1 en c�digo principal: $var1 <BR><BR>";

prueba($var1);

echo "2. (despu�s de llamada a la funci�n) valor de \$var1 en c�digo principal: $var1 <BR><BR>"; 

echo "Fin";

// Se modifica el valor del par�metro
// el par�metro aqu� se llama $var2, pero ocupa la misma 
// direcci�n que $var1 (se considera como una alias dentro de la funci�n)
function prueba(&$var2) {
    echo "*. Valor del par�metro recibido en funci�n prueba: $var2 <BR><BR>";
    $var2 = 100;
    echo "*. Valor del par�metro modificado en funci�n prueba: $var2 <BR><BR>"; 
}	  
?>
