<?php
print "<B><U>M�todo final  (ejemplo file088.php)</U></B><BR><BR>";

// Clase con un m�todo final 
// sirve para indicar que no puede ser reemplazado 
  
class MiClase {
	public $saludo;
	final function Saludar() {
		print $this->saludo ."<BR>";
	} 
}	
// Subclase o clase derivada

//Pero no se puede implementar un m�todo definido como final

class MiSubClase extends MiClase {
	public $despedida;
	// la definici�n de este m�todo produce un error fatal
	function Saludar() {
		print $this->saludo ."<BR>";
	} 
	function Despedirse() {
		print $this->despedida ."<BR>";
	}
}

// se crea un objeto de clase MiSubClase
// una clase derivada de la clase MiClase
// la que tiene un m�todo final  
 
$obj = new MiSubClase();

$obj->saludo = "Hola, �c�mo estamos?<BR><BR>";
 
$obj->Saludar();

?>
