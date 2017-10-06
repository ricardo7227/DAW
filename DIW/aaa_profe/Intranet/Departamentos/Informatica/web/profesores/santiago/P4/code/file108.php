<?php
print "<B><U>Varias funciones para tratar con clases y objetos (ejemplo file108.php)</U></B><BR><BR>";

// Definici�n de la clase Persona
Class Persona {
	public $identificador;
	public $nombre;
	function __construct($id, $name){
		$this->identificador = $id;
		$this->nombre = $name;	
	}

 	function Imprimir(){
		print $this->identificador;
	}

}

// Definici�n de la clase Empleado que se deriva de la clase Persona
Class Empleado extends Persona {
	public $secci�n;

	function __construct($id, $name, $secci�n){
		$this->identificador = $id;
		$this->nombre = $name;	
		$this->secci�n = $secci�n;
		print "* Uso de la constante __METHOD__ :" . __METHOD__;
	}

 	function Listar(){
		print "Empleado es " . $this->nombre . "<BR>";
	}
}


// Se genera un objeto de la clase Empleado
$emp = new Empleado(99,"Jos� Gonz�lez","Contabilidad");


// Funci�n get_declared_classes()
print  "<BR><B>1. Funci�n get_declared_classes(). </B>�stas son las clases definidas : ";
print_r  (get_declared_classes()) ;


// Funci�n is_a()
// funci�n declarada obsoleta en PHP 6
if (is_a($emp,"Empleado")){
	print "<BR><B>2. Funci�n is_a(). </B>El objeto \$emp pertenece a la clase Empleado.";
}


?>
