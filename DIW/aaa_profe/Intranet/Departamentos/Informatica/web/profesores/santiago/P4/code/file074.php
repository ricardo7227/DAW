<?php
print "<B><U>Lista variable de parámetros (ejemplo file074.php)</U></B><BR><BR>";

// llamada a la función con 6 parámetros
echo "<B>Ejemplo 1 </B><BR>";
prueba( 777, 2, 3, 5, 8, 9 );

// llamada a la función con 2 parámetros 
echo "<BR><B>Ejemplo 2 </B><BR>";
prueba( 100, 20 );

// llamada a la función sin parámetros 
echo "<BR><B>Ejemplo 3 </B><BR>";
prueba();
 
echo "<BR>Fin";

// función con lista variable de parámetros
function prueba() {

	// func_num_args() devuelve la cantidad de parámetros
   $params = func_num_args();
   echo "Cantidad de parámetros recibidos: $params<br>\n";
   
   for ($i = 0; $i <$params; $i++) {
   // func_get_arg() devuelve los parámetros de a uno 
   	echo func_get_arg($i) . "<BR>";
   }
   
   // func_get_args() devuelve una matriz con la lista de elementos
   $mat = func_get_args();
   echo "La suma es " . array_sum($mat) . "<BR>";
   
   } 
  
?>
