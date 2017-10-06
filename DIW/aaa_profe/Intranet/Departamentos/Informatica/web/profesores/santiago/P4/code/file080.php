<?php
print "<B><U>Diferencia entre p�blico y privado (ejemplo file080.php)</U></B><BR><BR>";

// Definici�n de la clase
class MiClase {
	// Una propiedad privada y otra p�blica 
	public $publ;
	private $priva;

	// Un m�todo de cada tipo de �mbito
	function metPublic($texto) {
		// Este m�todo lo puedo utilizar
		// desde cualquier parte

		$this->publ = $texto;
		$this->priva = $texto;
	}
	private function metPrivate($texto) {
		// este m�todo s�lo puedo usar dentro de la clase 
 
		$this->publ = $texto;
		$this->priva = $texto;
	}

	function metPublic2($texto) {
	// este m�todo lo puedo llamar desde una clase derivada 
   // de   MiClase 
		$this->metPrivate($texto);
		print "Estoy dentro del m�todo metPublic2<BR><BR>";
		print "Desde dentro de la clase puedo visualizar " . 
         " la variable priva: " .$this->priva . "<BR><BR>";
	}
}	
 
// se genera un ejemplar del objeto
$obj = new MiClase();

// se modifica el valor de una propiedad
// desde fuera de la clase (se puede hacer porque
// la propiedad es p�blica)

$obj->publ = "Modificaci�n 1";
print "1. �Qu� hay en la propiedad publ? " . $obj->publ . "<BR><BR>";

// modificamos una variable p�blica con un m�todo p�blico
$obj->metPublic("Modificaci�n 2");
print "2. �Qu� hay en la propiedad publ? " . $obj->publ . "<BR><BR>";


// Todas estas sentencias producen errores
// por eso se han puesto como comentarios

// pero desde aqu� no podemos visualizar las propiedades
// privadas ni protegidas del objetos 

//print "3. �Qu� hay en la propiedad priva? " . $obj->priva . "<BR>"; // propiedad private
 
// Desde aqu� tampoco puedo usar el m�todo  metPrivate. 
// modificamos una variable p�blica con un m�todo privado
//$obj->metPrivate("Modificaci�n 4");  // m�todo private
// Desde aqu� tampoco puedo modificar las variables
// privadas ni protegidas  
//$obj->priva("Modificaci�n 5");  // propiedad private

// �sta no produce error
// pero s� puedo usar un m�todo p�blico que 
// llama a m�todos protected o private desde dentro de la clase
$obj->metPublic2("Modificaci�n 6");

print "�ltima sentencia del script. <BR>";

?>