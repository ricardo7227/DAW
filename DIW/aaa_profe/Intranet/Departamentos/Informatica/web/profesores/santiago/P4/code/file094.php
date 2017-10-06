<?php
print "<B><U>Constantes de clases (ejemplo file094.php)</U></B><BR><BR>";

// Definición de la clase MisConstantes
class MisConstantes {
	const pi = 3.14156;
	const cero_absoluto = -273;
	
}	
$diámetro = 12;

// Para usar la constante no hace falta crear un ejemplar 
$perímetro = $diámetro * MisConstantes::pi;

print "El perímetro es  $perímetro ";
  
?>