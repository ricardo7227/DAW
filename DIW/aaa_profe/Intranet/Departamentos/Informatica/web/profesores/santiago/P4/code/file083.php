<?php
print "<B><U>Constructor en la clase derivada  (ejemplo file083.php)</U></B><BR><BR>";

// Clase
class MiClase {
	public $saludo;
	function __construct(){
		print "Se est� ejecutando el constructor en la clase " .
         " MiClase<BR>";		
	}
 
	function __destruct(){
		print "Se est� destruyendo un objeto de la clase " .
                
         " MiClase<BR>";
	} 

	function Saludar() {
		print $this->saludo;
	}

}	
// Subclase o clase derivada
class MiSubClase extends MiClase {
	public $despedida;
	function __construct(){
		print "Se est� ejecutando el constructor de un objeto " .
                       "de la subclase MiSubClase<BR>";
	} 

	function __destruct(){
		print "Se est� destruyendo un objeto de la clase " .
         " MiSubClase<BR>";
	} 

	function Despedirse() {
		print $this->despedida ."<BR>";
	}
}
print "Primer ejemplo<BR><BR>";

// se crea un objeto de clase MiSubClase
// al ser una clase derivada de MiClase, la clase MiSubClase
// posee todos los m�todos y las propiedades de su clase base 
// MiClase y adem�s los m�todos y propiedades propios

$obj = new MiSubClase();

// Podemos comprobar que no se produce una llamada autom�tica 
// al constructor de la clase base

// El objeto $obj es de clase MiSubClase pero igualmente
// puedo utilizarlo para hacer referencia a la propiedad
// saludo y al m�todo saludar que son de su clase base

$obj->saludo = "Hola, �c�mo estamos?<BR>";
$obj->Saludar();

// El objeto $obj es de clase MiSubClase por lo que
// puedo utilizar sus propiedades y m�todos (despedida y despedir)

$obj->despedida = "Adi�s<BR>";
$obj->Despedirse(); 
 
print "Segundo ejemplo<BR><BR>";

// se crea un objeto de clase MiClase
$obj2 = new MiClase();

// El objeto $obj2 no posee los m�todos y propiedades
// de su clase hija (Esta es la comprobaci�n))
// esto produce un error  fatal 

$obj2->despedida = "Adi�s<BR>";
$obj2->Despedirse(); 
?>
 