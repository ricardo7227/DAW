<?php
print "<B><U>Diferencia entre público y privado (ejemplo file080.php)</U></B><BR><BR>";

// Definición de la clase
class MiClase {
	// Una propiedad privada y otra pública 
	public $publ;
	private $priva;

	// Un método de cada tipo de ámbito
	function metPublic($texto) {
		// Este método lo puedo utilizar
		// desde cualquier parte

		$this->publ = $texto;
		$this->priva = $texto;
	}
	private function metPrivate($texto) {
		// este método sólo puedo usar dentro de la clase 
 
		$this->publ = $texto;
		$this->priva = $texto;
	}

	function metPublic2($texto) {
	// este método lo puedo llamar desde una clase derivada 
   // de   MiClase 
		$this->metPrivate($texto);
		print "Estoy dentro del método metPublic2<BR><BR>";
		print "Desde dentro de la clase puedo visualizar " . 
         " la variable priva: " .$this->priva . "<BR><BR>";
	}
}	
 
// se genera un ejemplar del objeto
$obj = new MiClase();

// se modifica el valor de una propiedad
// desde fuera de la clase (se puede hacer porque
// la propiedad es pública)

$obj->publ = "Modificación 1";
print "1. ¿Qué hay en la propiedad publ? " . $obj->publ . "<BR><BR>";

// modificamos una variable pública con un método público
$obj->metPublic("Modificación 2");
print "2. ¿Qué hay en la propiedad publ? " . $obj->publ . "<BR><BR>";


// Todas estas sentencias producen errores
// por eso se han puesto como comentarios

// pero desde aquí no podemos visualizar las propiedades
// privadas ni protegidas del objetos 

//print "3. ¿Qué hay en la propiedad priva? " . $obj->priva . "<BR>"; // propiedad private
 
// Desde aquí tampoco puedo usar el método  metPrivate. 
// modificamos una variable pública con un método privado
//$obj->metPrivate("Modificación 4");  // método private
// Desde aquí tampoco puedo modificar las variables
// privadas ni protegidas  
//$obj->priva("Modificación 5");  // propiedad private

// Ésta no produce error
// pero sí puedo usar un método público que 
// llama a métodos protected o private desde dentro de la clase
$obj->metPublic2("Modificación 6");

print "Última sentencia del script. <BR>";

?>