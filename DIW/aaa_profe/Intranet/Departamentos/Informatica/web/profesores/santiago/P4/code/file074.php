<?php
print "<B><U>Lista variable de par�metros (ejemplo file074.php)</U></B><BR><BR>";

// llamada a la funci�n con 6 par�metros
echo "<B>Ejemplo 1 </B><BR>";
prueba( 777, 2, 3, 5, 8, 9 );

// llamada a la funci�n con 2 par�metros 
echo "<BR><B>Ejemplo 2 </B><BR>";
prueba( 100, 20 );

// llamada a la funci�n sin par�metros 
echo "<BR><B>Ejemplo 3 </B><BR>";
prueba();
 
echo "<BR>Fin";

// funci�n con lista variable de par�metros
function prueba() {

	// func_num_args() devuelve la cantidad de par�metros
   $params = func_num_args();
   echo "Cantidad de par�metros recibidos: $params<br>\n";
   
   for ($i = 0; $i <$params; $i++) {
   // func_get_arg() devuelve los par�metros de a uno 
   	echo func_get_arg($i) . "<BR>";
   }
   
   // func_get_args() devuelve una matriz con la lista de elementos
   $mat = func_get_args();
   echo "La suma es " . array_sum($mat) . "<BR>";
   
   } 
  
?>
