<?php
print "<B><U>Par�metros predeterminados (ejemplo file073.php)</U></B><BR><BR>";

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

// 4. en este caso no se pasa ning�n valor
// con @ evitamos el mensaje de error
print "Caso 4 : ";
@PRUEBA(); 

// 5. en este caso no se pasa ning�n valor
// saldr� un mensaje de Advertencia porque no hay par�metro 1
print "Caso 5 : ";
prueba();

echo "Fin";

// La funci�n tiene un par�metro normal y dos con valores predeterminados
function prueba($a,$b =6, $c=3) {
    print " La suma es " . ($a + $b + $c) .  "<BR><BR>";
}	  
?>