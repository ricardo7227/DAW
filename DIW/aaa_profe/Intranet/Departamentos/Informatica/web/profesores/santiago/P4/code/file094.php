<?php
print "<B><U>Constantes de clases (ejemplo file094.php)</U></B><BR><BR>";

// Definici�n de la clase MisConstantes
class MisConstantes {
	const pi = 3.14156;
	const cero_absoluto = -273;
	
}	
$di�metro = 12;

// Para usar la constante no hace falta crear un ejemplar 
$per�metro = $di�metro * MisConstantes::pi;

print "El per�metro es  $per�metro ";
  
?>