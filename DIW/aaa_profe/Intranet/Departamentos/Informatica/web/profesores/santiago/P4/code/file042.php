<?php
print "<B><U>Uso de la función array_slice() (ejemplo file042.php)</U></B><BR>";

// reducción del tamaño de una matriz
$mat1 = array("Alemania", "Austria","Bélgica","Dinamarca","España");
// sintaxis
// array_slice (matriz, desde, tamaño)
// Parámetros
// desde: si +, elemento 'desde' donde se procesa la matriz 
// (contado desde el inicio)
// desde: si -, elemento 'desde' donde se procesa la matriz 
// (contado desde el final)
// tamaño: si +, cantidad de elementos
// tamaño: si -, la secuencia se detendrá a tantos elementos 
// del final de la matriz 
// tamaño: si se omite, procesa hasta el final de la matriz

// si se omite el tercer parámetro, se
// asume hasta el final
$mat2 = array_slice ($mat1, 3);      
// devuelve "Dinamarca" "España"
//

// el tercer parámetro es -1, la copia de
// elementos de la matriz se detendrá a 1 elemento
// del final
$mat2 = array_slice ($mat1, 2, -1);  
// devuelve "Bélgica" "Dinamarca"
//

// el segundo parámetro es negativo, esto quiere decir
// que la cuenta se hace desde el final
// el tercer parámetros es positivo, por que indica
// la cantidad de elementos a copiar
$mat2 = array_slice ($mat1, -1, 1);  // devuelve "España"
//

$mat2 = array_slice ($mat1, 0, -1);   
// devuelve todos menos "España" 
//

$mat2 = array_slice ($mat1, 1, -1);   
// devuelve todos menos "Alemania" y "España" 
//
$mat2 = array_slice ($mat1, 1, 3);   
// devuelve todos menos "Alemania" y "España" 
?>