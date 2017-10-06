<?php
print "<B><U>Clases abstractas  (ejemplo file085.php)</U></B><BR><BR>";

// Clase abstracta 
// sirve para ser derivada pero no se pueden
// crear ejemplares de esta clase

abstract class MiClase {
	public $saludo;
	function __construct(){
		print "Se está ejecutando el constructor en la " .
          "clase MiClase<BR>";		
	} 
	function __destruct(){
		print "Se está destruyendo un objeto de la clase " .
         " MiClase<BR>";
	}
 
	function Saludar() {
		print $this->saludo;
	}

}	
// Subclase o clase derivada
class MiSubClase extends MiClase {
	public $despedida;
        	function __construct(){
		print "Se está ejecutando el constructor de un objeto " .
          " de la subclase MiSubClase<BR>";
	} 

	function __destruct(){
		print "Se está destruyendo un objeto de la clase " .
          " MiSubClase<BR>";
	} 

	function Despedirse() {
		print $this->despedida ."<BR>";
	}
}

// se crea un objeto de clase MiSubClase
// al ser una clase derivada de la clase abstracta MiClase    
$obj = new MiSubClase();

$obj->saludo = "Hola, ¿cómo estamos?<BR><BR>";
$obj->Saludar();
 
// Pero, ¿Qué pasa si intento generar un objeto de la clase
// MiClase que es abstracta? 

print "<B>Intento de generar un ejemplar de una clase abstracta...</B><BR>";
$obj2 = new MiClase(); 
 
?>
