<?php
Print "<B>Funci�n de empaquetado pack() y desempaquetado unpack() (ejemplo file117.php) </B><BR>";

print "<BR><B>Empaquetado con pack()</B><BR>";
$formato = "A25A35A30";
$datos = pack($formato, "Jos� Garc�a", "Ave.301, n�m.99", "Castelldefels"); 
echo $datos;

// Desempaqueta en una matriz asociativa
// los nombres de los elementos se incluyen en el formato
print "<BR><B>Desempaquetado con unpack()</B><BR>";
$formato = "A25nombre/A35direcci�n/A30ciudad";
$datos2 = unpack($formato,$datos);
print_r ($datos2); 

?>