<?php
print "<B><U>Parámetros pasados por valor (ejemplo file071.php)</U></B><BR><BR>";

$var1 = 12;
echo "1. (antes de llamada a la función) valor de \$var1 en código principal: $var1 <BR><BR>";

prueba($var1);

echo "2. (después de llamada a la función) valor de \$var1 en código principal: $var1 <BR><BR>"; 

echo "Fin";

// Se modifica el valor del parámetro
function prueba($var1) {
    echo "*. Valor del parámetro recibido en función prueba: $var1 <BR><BR>";
    $var1 = 100;
    echo "*. Valor de \$var1 modificado en función prueba: $var1 <BR><BR>"; 
}	  
?>