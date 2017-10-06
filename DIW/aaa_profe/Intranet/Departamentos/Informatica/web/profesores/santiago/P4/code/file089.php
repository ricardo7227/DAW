<?php
print "<B><U>Interfaces (ejemplo file089.php)</U></B><BR><BR>";

// Definici�n de la clase Persona
class Persona {
	// Identificaci�n de la persona
	public $dni;
	public $nombre;
	function __construct($var_dni, $var_nombre) {
	    $this->dni = $var_dni;
		$this->nombre = $var_nombre;
	}
}
	
// la clase empleado extiende la clase persona e implementa 
// la interfaz Imprimir

class Empleado extends Persona implements Imprimir  {
	//   
	public $departamento;

	function __construct($var_departamento, $var_dni, $var_nombre) {
	    $this->departamento = $var_departamento;
		parent::__construct($var_dni, $var_nombre);
	}

	// esta funci�n se debe implementar obligatoriamente
	// porque la clase Empleado implementa la interfaz Imprimir

	function imprimir(){
		print "Empleado " . ($this->nombre) . "<BR><BR>";
	}
}	
// La clase que implemente la interfaz Imprimir deber� forzosamente
// implementar la funci�n imprimir

Interface Imprimir {
	function imprimir();
}
 
// Se crea un objeto Empleado
$emp = new Empleado("Contabilidad","44423899","Jos� P�rez");

// se usa el m�todo de la clase Empleado
$emp->imprimir();

// el objeto $emp es de tipo Empleado, Persona e Imprimir

if ($emp instanceof Empleado) {
	print "El objeto \$emp es de tipo Empleado.<BR>";}

if ($emp instanceof Persona) {
	print "pero tambi�n es de tipo Persona (por derivar de " .
     "esta clase).<BR>";}

if ($emp instanceof Imprimir) {
	print "Y tambi�n es de tipo Imprimir (por implementar " . 
     "esta interfaz).<BR>";}
 
?>