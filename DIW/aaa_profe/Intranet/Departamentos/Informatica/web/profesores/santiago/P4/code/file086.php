 <?php
print "<B><U>M�todos abstractos  (ejemplo file086.php)</U></B><BR><BR>";

// Clase abstracta 
// sirve para ser derivada pero no se pueden
// crear ejemplares de esta clase
abstract class MiClase {
	public $saludo;
	
	// Un m�todo abstracto no puede tener instrucciones
	// producir�a un error fatal
	// Esto obliga a las clases derivadas a suministrar
	// una implementaci�n del m�todo abstracto
	abstract function Saludar() ;
	
}	
// Subclase o clase derivada
class MiSubClase extends MiClase {
	public $despedida;
	function __construct(){
		print "Se est� ejecutando el constructor de un objeto " .
         " de la subclase MiSubClase<BR>";
	} 
	function __destruct(){
		print "Se est� destruyendo un objeto de la clase " .
         " MiSubClase<BR>";
	}
	// Este m�todo debe incluirse, sino se produce un error fatal
	function Saludar() {
		// se usa $this para direccionar a una propiedad 
        // de la clase base
		print $this->saludo ."<BR>";
	} 
	function Despedirse() {
		print $this->despedida ."<BR>";
	}
}

// se crea un objeto de clase MiSubClase
// una clase derivada de la clase abstracta MiClase
   
$obj = new MiSubClase();

$obj->saludo = "Hola, �c�mo estamos?<BR><BR>";

// se utiliza el m�todo en la clase derivada que provee
// la implementaci�n de un m�todo abstracto de la clase base

$obj->Saludar();
 
 
?>