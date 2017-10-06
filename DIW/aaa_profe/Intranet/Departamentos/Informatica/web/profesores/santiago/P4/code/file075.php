<?php
print "<B><U>Retorno de valores (ejemplo file075.php)</U></B><BR><BR>";

// llamada a la funci�n con 6 par�metros
echo "<B>Ejemplo 1 </B><BR>";
echo "La suma es " . prueba( 777, 2, 3, 5, 8, 9 ) . "<BR>";

// llamada a la funci�n con 2 par�metros 
echo "<BR><B>Ejemplo 2 </B><BR>";
$var = prueba( 100, 20 ); 
echo "La suma es " . $var . "<BR>";

// llamada a la funci�n sin par�metros 
echo "<BR><B>Ejemplo 3 prueba sin par�metros</B><BR>";
prueba();

// llamada a una funci�n que devuelve una matriz
echo "<BR><B>Ejemplo 4 (retorno de una matriz) </B><BR>";
$mat = pruebamat("ABCDEFGH"); 
print_r ($mat);
echo "<BR><BR>Fin";

// funci�n con lista variable de par�metros
function prueba() {

   // func_get_args() devuelve una matriz con la lista de elementos
   $mat = func_get_args();
   return array_sum($mat);
   } 
// funci�n que devuelve una matriz
function pruebamat($var) {

   // str_split divide una cadena en una matriz
   return str_split($var);
   }   
?>