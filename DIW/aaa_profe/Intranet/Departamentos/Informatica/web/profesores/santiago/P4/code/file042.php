<?php
print "<B><U>Uso de la funci�n array_slice() (ejemplo file042.php)</U></B><BR>";

// reducci�n del tama�o de una matriz
$mat1 = array("Alemania", "Austria","B�lgica","Dinamarca","Espa�a");
// sintaxis
// array_slice (matriz, desde, tama�o)
// Par�metros
// desde: si +, elemento 'desde' donde se procesa la matriz 
// (contado desde el inicio)
// desde: si -, elemento 'desde' donde se procesa la matriz 
// (contado desde el final)
// tama�o: si +, cantidad de elementos
// tama�o: si -, la secuencia se detendr� a tantos elementos 
// del final de la matriz 
// tama�o: si se omite, procesa hasta el final de la matriz

// si se omite el tercer par�metro, se
// asume hasta el final
$mat2 = array_slice ($mat1, 3);      
// devuelve "Dinamarca" "Espa�a"
//

// el tercer par�metro es -1, la copia de
// elementos de la matriz se detendr� a 1 elemento
// del final
$mat2 = array_slice ($mat1, 2, -1);  
// devuelve "B�lgica" "Dinamarca"
//

// el segundo par�metro es negativo, esto quiere decir
// que la cuenta se hace desde el final
// el tercer par�metros es positivo, por que indica
// la cantidad de elementos a copiar
$mat2 = array_slice ($mat1, -1, 1);  // devuelve "Espa�a"
//

$mat2 = array_slice ($mat1, 0, -1);   
// devuelve todos menos "Espa�a" 
//

$mat2 = array_slice ($mat1, 1, -1);   
// devuelve todos menos "Alemania" y "Espa�a" 
//
$mat2 = array_slice ($mat1, 1, 3);   
// devuelve todos menos "Alemania" y "Espa�a" 
?>