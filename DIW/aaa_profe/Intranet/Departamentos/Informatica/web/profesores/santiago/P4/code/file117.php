<?php
Print "<B>Función de empaquetado pack() y desempaquetado unpack() (ejemplo file117.php) </B><BR>";

print "<BR><B>Empaquetado con pack()</B><BR>";
$formato = "A25A35A30";
$datos = pack($formato, "José García", "Ave.301, núm.99", "Castelldefels"); 
echo $datos;

// Desempaqueta en una matriz asociativa
// los nombres de los elementos se incluyen en el formato
print "<BR><B>Desempaquetado con unpack()</B><BR>";
$formato = "A25nombre/A35dirección/A30ciudad";
$datos2 = unpack($formato,$datos);
print_r ($datos2); 

?>