<?php
print "<B><U>Destructores (ejemplo file100.php)</U></B><BR><BR>";

// Definición de la clase ClaseBase
class ClaseBase {
	//  destructor de la clase ClaseBase 
	// Este destructor se ejecuta sólo en dos casos:
	// cuando se libera un objeto de la clase ClaseBase
	// o cuando se llama explícitamente desde una clase hija
	// con la sintaxis parent::__desstruct()

	function __destruct() {
	    print "Éste es el destructor de la clase base " .
        " ClaseBase<BR>";
	}
}	

// Definición de la clase ClaseHija1
class ClaseHija1 extends ClaseBase {
 	
	// destructor de la clase ClaseHija1
	// Este destructor se ejecuta cuando se libera 
	// un objeto de la clase ClaseHija1

	function __destruct() {
	    print "Llamada automática al destructor de la clase " .
          "hija ClaseHija1<BR>";

		// aquí se podría llamar explícitamente al 
        // destructor de la clase base
	}
}	

// Definición de la clase ClaseHija2
class ClaseHija2 extends ClaseBase {
 	
	// destructor de la clase ClaseHija2 
	function __destruct() {
	    print "Llamada automática al destructor de la clase " .
         " hija ClaseHija2<BR>";
		// aquí se llama explìcitamente al destructor de 
        // la clase base 
		print "<B>Atención:</B>Llamada explícita desde la clase " .
         " hija ClaseHija2<BR>";
		parent::__destruct();
	}
}
	
// observar ahora los mensajes de los constructores
print "<BR>Se crea un ejemplar de la clase base ClaseBase<BR>";
$base = new ClaseBase;
 
// aquí se libera el objeto $base, por lo que
// se activa el destructor (pero si el objeto mantiene 
// referencias activas la función unset() no activará
// el destructor, simplemente liberará el objeto pero
// el método destruct() no se ejecutará

unset($base);

print "<BR>Se crea un ejemplar de la clase hija ClaseHija1<BR>";
$hija1 = new ClaseHija1;

print "<BR>Se crea un ejemplar de la clase hija ClaseHija2<BR>";
$hija2 = new ClaseHija2;

// al finalizar las secuencias de comandos se liberan 
// todos los objetos aquí se activan los destructores de los objetos
Print "<BR><B>Fin de la secuencia de comandos.</B><BR><BR>" 

?>