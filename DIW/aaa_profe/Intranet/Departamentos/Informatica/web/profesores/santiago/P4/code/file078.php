<?php
print "<B><U>Definición de una clase (ejemplo file078.php)</U></B><BR><BR>";

// Definición de la clase
class MiClase {

	// Una propiedad publica
	public $pub;

	// Un método público
	function Saludar() {
		// dentro de la clase nos referimos a sus
		// propiedades con la palabra $this
		print $this->pub;
	}

	function __construct() {
		// este método opcional se ejecuta automáticamente 
		// al crear un objeto de esta clase
		print "__Construct: ¡Me están creando ahora!<BR>";
	}

	
	function __destruct() {
		// este método opcional se ejecuta automáticamente 
		// al eliminarse el objeto
		print "__Destruct: ¡Estoy a punto de desaparecer!<BR>";
	}
}
	
print "Primera sentencia del script. <BR>";
// se genera un ejemplar del objeto
$obj = new MiClase();

// se modifica el valor de una propiedad
// desde fuera de la clase (se puede hacer porque
// la propiedad es pública)

$obj->pub = "Hola, ¿cómo estamos?<BR>";

// se llama a un método de la clase
$obj->Saludar();

// al terminar la secuencia de comandos se destruye el objeto 
print "Última sentencia del script. <BR>";

?>
