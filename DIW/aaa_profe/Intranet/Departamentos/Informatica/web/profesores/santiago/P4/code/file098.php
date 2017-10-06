<?php
print "<B><U>Clonación de objetos (ejemplo file098.php)</U></B><BR><BR>";

// Definición de la clase Prueba
class Prueba {
 	static $contador = 0;
	
	function __construct() {
	        print "<BR>entra a construct: " . self::$contador . "<BR>";
                self::$contador++;
	}
		  
}

 
$objPrueba = new Prueba;

$objPrueba->cliente = "cliente original";
$objPrueba->dirección = "dirección original";
print "Objeto original<BR>";

// el objeto original
print "Contador " . Prueba::$contador . "<BR>";
print $objPrueba->cliente . "<BR>"; 
print $objPrueba->dirección . "<BR>"; 

$CloPrueba = clone $objPrueba;
print "<BR>Objeto clonado<BR>";

// el objeto clonado
print "Contador " . Prueba::$contador . "<BR>";
print $CloPrueba->cliente . "<BR>"; 
print $CloPrueba->dirección . "<BR>"; 

?>  