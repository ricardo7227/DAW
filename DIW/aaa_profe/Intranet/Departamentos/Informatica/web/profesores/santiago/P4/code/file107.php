<?php
print "<B><U>Varias funciones para tratar con clases y objetos (ejemplo file107.php)</U></B><BR><BR>";

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

// Se genera un objeto de la clase Persona
$per = new Persona(1222,"Jos� P�rez");

// Se genera un objeto de la clase Empleado
$emp = new Empleado(99,"Jos� Gonz�lez","Contabilidad");

// Funci�n class_exists() 
if (class_exists('Persona')) {
	print "<BR><B>1. Funci�n class_exists(). </B>La clase Persona ya existe.";
}

// Funci�n get_class() 
print "<BR><B>2. Funci�n get_class(). </B>La clase del objeto \$per es :" . get_class($per) ;
// Funci�n get_class_methods()
print  "<BR><B>3. Funci�n get_class_methods(). </B>�stos son los m�todos de la clase Persona : ";
print_r (get_class_methods("Persona")) ;

// Funci�n get_class_vars()
print  "<BR><B>4. Funci�n get_class_vars(). </B>�stas son las propiedades de la clase Persona : ";
print_r (get_class_vars("Persona")) ;

// Funci�n get_object_vars()
print  "<BR><B>5. Funci�n get_object_vars(). </B>�stas son las propiedades del objeto \$emp : ";
print_r (get_object_vars($emp)) ;
 
// Funci�n get_parent_class() 
print  "<BR><B>6. Funci�n get_parent_class(). </B>�sta es la clase base del objeto \$emp : " . get_parent_class($emp);

// Funci�n getType()
print  "<BR><B>7. Funci�n getType(). </B>�ste es el tipo de la variable \$emp: " . gettype($emp);


// Funci�n is_subclass_of()
if (is_subclass_of($emp,"Persona")){
	print "<BR><B>8. Funci�n is_subclass_of(). </B>El objeto \$emp es subclase de la clase Persona.";
}

// Funci�n method_exists()
if (method_exists($emp,"Listar")){
	print "<BR><B>9. Funci�n method_exists(). </B>El objeto \$emp contiene el m�todo Listar.";
}

// Funci�n setType()
$vardbl = 23;
settype($vardbl,"double");
print  "<BR><B>10. Funci�n setType(). </B>�ste es el tipo de la variable \$vardbl: " . gettype($vardbl);
?>
