<?php
print "<B><U>Parámetros pasados por referencia (ejemplo file072b.php)</U></B><BR><BR>";

$var1 = 12;
echo "1. (antes de llamada a la función) valor de \$var1 en código principal: $var1 <BR><BR>";

prueba($var1);

echo "2. (después de llamada a la función) valor de \$var1 en código principal: $var1 <BR><BR>"; 

echo "Fin";

// Se modifica el valor del parámetro
// el parámetro aquí se llama $var2, pero ocupa la misma 
// dirección que $var1 (se considera como una alias dentro de la función)
function prueba(&$var2) {
    echo "*. Valor del parámetro recibido en función prueba: $var2 <BR><BR>";
    $var2 = 100;
    echo "*. Valor del parámetro modificado en función prueba: $var2 <BR><BR>"; 
}	  
?>
