<?php
print "<B><U>Método final  (ejemplo file088.php)</U></B><BR><BR>";

// Clase con un método final 
// sirve para indicar que no puede ser reemplazado 
  
class MiClase {
	public $saludo;
	final function Saludar() {
		print $this->saludo ."<BR>";
	} 
}	
// Subclase o clase derivada

//Pero no se puede implementar un método definido como final

class MiSubClase extends MiClase {
	public $despedida;
	// la definición de este método produce un error fatal
	function Saludar() {
		print $this->saludo ."<BR>";
	} 
	function Despedirse() {
		print $this->despedida ."<BR>";
	}
}

// se crea un objeto de clase MiSubClase
// una clase derivada de la clase MiClase
// la que tiene un método final  
 
$obj = new MiSubClase();

$obj->saludo = "Hola, ¿cómo estamos?<BR><BR>";
 
$obj->Saludar();

?>
