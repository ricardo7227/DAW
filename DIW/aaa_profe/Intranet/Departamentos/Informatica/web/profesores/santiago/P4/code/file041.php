<?php
print "<B><U>Uso de la funci�n count() (ejemplo file041.php)</U></B><BR>";

// Cantidad de elementos de una matriz 
$mat1 = array("Alemania","Austria","B�lgica","Dinamarca","Espa�a");

// sintaxis
// count (matriz) o sizeof(matriz))
echo "Caso 1: matriz de �ndice secuencial autom�tico<BR>"; 
echo "count :" . count($mat1). "<BR>";
echo "sizeof :" . count($mat1). "<BR>";

echo "�Elemento 4? :" . $mat1[4]. "<BR><BR>";

$mat2 = array("3"=>"Alemania", "Austria","B�lgica","Dinamarca","Espa�a"); 
echo "Caso 2: matriz de �ndice de asignaci�n manual<BR>"; 
echo "count :" . count($mat2). "<BR>";
echo "sizeof :" . count($mat2). "<BR>";
echo "�Elemento 4? :" . $mat2[4]. "<BR>";
echo "�Elemento 7? :" . $mat2[7]. "<BR>"; 

?>