<?php
print "<B><U>Definici�n de una clase (ejemplo file078a.php)</U></B><BR><BR>";

// Definici�n de la clase
class MiClase {
// Estilo PHP 4 (que es compatible con PHP 5 y PHP 6)
	// Una propiedad publica
	var $pub;

	// Un m�todo p�blico
	function Saludar() {
		// dentro de la clase nos referimos a sus
		// propiedades con la palabra $this
		print $this->pub;
	}

	function MiClase() {
		// este m�todo opcional se ejecuta autom�ticamente 
		// al crear un objeto de esta clase
		print "constructor MiClase: �Me est�n creando ahora!<BR>";
	}

	
	function __destruct() {
		// este m�todo opcional se ejecuta autom�ticamente 
		// al eliminarse el objeto
		print "__Destruct: �Estoy a punto de desaparecer!<BR>";
	}
}
	
print "Primera sentencia del script. <BR>";
// se genera un ejemplar del objeto
$obj = new MiClase();

// se modifica el valor de una propiedad
// desde fuera de la clase (se puede hacer porque
// la propiedad es p�blica)

$obj->pub = "Hola, �c�mo estamos?<BR>";

// se llama a un m�todo de la clase
$obj->Saludar();

// al terminar la secuencia de comandos se destruye el objeto 
print "�ltima sentencia del script. <BR>";

?>
