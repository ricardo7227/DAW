<?php
print "<B><U>Parámetros predeterminados (ejemplo file073.php)</U></B><BR><BR>";

$var1 = 12;

// 1. en este caso se pasa un valor
print "Caso 1 : ";
prueba($var1);

// 2. en este caso se pasan dos valores
print "Caso 2 : ";
prueba($var1, 100);

// 3. en este caso se pasan tres valores
print "Caso 3 : ";
prueba($var1, 100, 200); 

// 4. en este caso no se pasa ningún valor
// con @ evitamos el mensaje de error
print "Caso 4 : ";
@PRUEBA(); 

// 5. en este caso no se pasa ningún valor
// saldrá un mensaje de Advertencia porque no hay parámetro 1
print "Caso 5 : ";
prueba();

echo "Fin";

// La función tiene un parámetro normal y dos con valores predeterminados
function prueba($a,$b =6, $c=3) {
    print " La suma es " . ($a + $b + $c) .  "<BR><BR>";
}	  
?>