<?php
print "<B><U>Varias funciones para tratar con clases y objetos (ejemplo file107.php)</U></B><BR><BR>";

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

// Se genera un objeto de la clase Persona
$per = new Persona(1222,"José Pérez");

// Se genera un objeto de la clase Empleado
$emp = new Empleado(99,"José González","Contabilidad");

// Función class_exists() 
if (class_exists('Persona')) {
	print "<BR><B>1. Función class_exists(). </B>La clase Persona ya existe.";
}

// Función get_class() 
print "<BR><B>2. Función get_class(). </B>La clase del objeto \$per es :" . get_class($per) ;
// Función get_class_methods()
print  "<BR><B>3. Función get_class_methods(). </B>Éstos son los métodos de la clase Persona : ";
print_r (get_class_methods("Persona")) ;

// Función get_class_vars()
print  "<BR><B>4. Función get_class_vars(). </B>Éstas son las propiedades de la clase Persona : ";
print_r (get_class_vars("Persona")) ;

// Función get_object_vars()
print  "<BR><B>5. Función get_object_vars(). </B>Éstas son las propiedades del objeto \$emp : ";
print_r (get_object_vars($emp)) ;
 
// Función get_parent_class() 
print  "<BR><B>6. Función get_parent_class(). </B>Ésta es la clase base del objeto \$emp : " . get_parent_class($emp);

// Función getType()
print  "<BR><B>7. Función getType(). </B>Éste es el tipo de la variable \$emp: " . gettype($emp);


// Función is_subclass_of()
if (is_subclass_of($emp,"Persona")){
	print "<BR><B>8. Función is_subclass_of(). </B>El objeto \$emp es subclase de la clase Persona.";
}

// Función method_exists()
if (method_exists($emp,"Listar")){
	print "<BR><B>9. Función method_exists(). </B>El objeto \$emp contiene el método Listar.";
}

// Función setType()
$vardbl = 23;
settype($vardbl,"double");
print  "<BR><B>10. Función setType(). </B>Éste es el tipo de la variable \$vardbl: " . gettype($vardbl);
?>
