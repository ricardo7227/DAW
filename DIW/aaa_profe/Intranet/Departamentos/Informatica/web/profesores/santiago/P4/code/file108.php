<?php
print "<B><U>Varias funciones para tratar con clases y objetos (ejemplo file108.php)</U></B><BR><BR>";

// Definición de la clase Persona
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

// Definición de la clase Empleado que se deriva de la clase Persona
Class Empleado extends Persona {
	public $sección;

	function __construct($id, $name, $sección){
		$this->identificador = $id;
		$this->nombre = $name;	
		$this->sección = $sección;
		print "* Uso de la constante __METHOD__ :" . __METHOD__;
	}

 	function Listar(){
		print "Empleado es " . $this->nombre . "<BR>";
	}
}


// Se genera un objeto de la clase Empleado
$emp = new Empleado(99,"José González","Contabilidad");


// Función get_declared_classes()
print  "<BR><B>1. Función get_declared_classes(). </B>Éstas son las clases definidas : ";
print_r  (get_declared_classes()) ;


// Función is_a()
// función declarada obsoleta en PHP 6
if (is_a($emp,"Empleado")){
	print "<BR><B>2. Función is_a(). </B>El objeto \$emp pertenece a la clase Empleado.";
}


?>
