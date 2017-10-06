<?php
print "<B><U>Constructores (ejemplo file099.php)</U></B><BR><BR>";

// Definición de la clase ClaseBase
class ClaseBase {
	// constructor de la clase ClaseBase 
	// Este constructor se ejecuta sólo en dos casos:
	// cuando se crea un objeto de la clase ClaseBase
	// o cuando se llama explícitamente desde una clase hija
	// con la sintaxis parent::__construct()

	function __construct() {
	    print "Éste es el constructor de la clase " .
        " base ClaseBase<BR>";
	}
}	

// Definición de la clase ClaseHija1
class ClaseHija1 extends ClaseBase {
 	
	// constructor de la clase ClaseHija1
	// Este constructor se ejecuta cuando se crea 
	// un objeto de la clase ClaseHija1

	function __construct() {
	    print "Éste es el constructor de la clase hija " . 
         " ClaseHija1<BR>";
		// aquí se podría llamar explícitamente 
        // al constructor de la clase base
	}
}	

// Definición de la clase ClaseHija2
class ClaseHija2 extends ClaseBase {
 	
	// constructor de la clase ClaseHija2 
	// observar que se utiliza la vieja sintaxis para hacer 
   // referencia al constructor, es decir, se usa el nombre de 
   // la propia clase esto es igual a haber codificado lo siguiente:
	// function __construct(){ 
	// se recomienda utilizar el nombre de método __construct()
 
	function ClaseHija2() {
	    print "Éste es el constructor de la clase hija " . 
         " ClaseHija2<BR>";

		// aquí se llama explìcitamente al constructor 
        // de la clase base 
		parent::__construct();
	}
}	

// observar ahora los mensajes de los constructores
print "<BR>Se crea un ejemplar de la clase base ClaseBase<BR>";
$obj = new ClaseBase; 

print "<BR>Se crea un ejemplar de la clase hija ClaseHija1<BR>";
$obj = new ClaseHija1;

print "<BR>Se crea un ejemplar de la clase hija ClaseHija2<BR>";
$obj = new ClaseHija2;
 
?>