<?php
print "<B><U>Añadir elementos con array_unshift() y con array_pad() (ejemplo file049.php)</U></B><BR><BR>";
$mat1 = array("Bélgica", "Escocia", "España");

print "<BR>Contenido original de la matriz: cantidad de elementos :" . count($mat1) . "<BR>";
print_r ($mat1);

// array_unshift(matriz existente, elementos nuevos,...)
//
// añadir dos elementos por adelante con array_unshift

$var1 = array_unshift($mat1,"Alemania","Andorra");
print "<BR><BR><B>Uso función array_unshift()</B><BR>";
print "<BR>Resultado: cantidad de elementos :" . $var1 . "<BR>";
print_r ($mat1); 

// array_pad( matriz existente, cantidad, relleno)
// cantidad: entero (rellena hasta esta cantidad de elementos)
//	Si este valor es menor que el tamaño de la matriz, la función
//	devuelve una matriz igual que la de entrada (sin cambios ni 
// eliminaciones) 
//	Si es un valor positivo, rellena por la cola de la matriz. 
//	Si es un valor negativo, rellena por el inicio de la matriz. 

// relleno: valor de los elementos que se rellenan
//
// añadir por la cola elementos de relleno constantes 
// hasta llegar a 7 elementos
$mat2 = array_pad ($mat1,7,"A definir");
print "<BR><BR><B>Uso función array_pad() (relleno por la cola) </B><BR>";
print "<BR>Resultado: cantidad de elementos :" . count($mat2) . "<BR>";
print_r ($mat2);

// añadir por adelante elementos de relleno constantes 
// hasta llegar a 9 elementos
$mat3 = array_pad ($mat2,-9,"A definir");
print "<BR><BR><B>Uso función array_pad()(relleno por el inicio)</B><BR>";
print "<BR>Resultado: cantidad de elementos :" . count($mat3) . "<BR>";
print_r ($mat3);  

?>
