<?php
print "<B><U>Par�metros pasados por valor (ejemplo file071.php)</U></B><BR><BR>";

$var1 = 12;
echo "1. (antes de llamada a la funci�n) valor de \$var1 en c�digo principal: $var1 <BR><BR>";

prueba($var1);

echo "2. (despu�s de llamada a la funci�n) valor de \$var1 en c�digo principal: $var1 <BR><BR>"; 

echo "Fin";

// Se modifica el valor del par�metro
function prueba($var1) {
    echo "*. Valor del par�metro recibido en funci�n prueba: $var1 <BR><BR>";
    $var1 = 100;
    echo "*. Valor de \$var1 modificado en funci�n prueba: $var1 <BR><BR>"; 
}	  
?>