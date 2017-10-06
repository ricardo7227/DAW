<?php
print "<B><U>Pase de objetos a funciones (ejemplo file079.php)</U></B><BR><BR>";

// Clase
class MiClase {
	public $saludo;

	function __construct(){
	// 
		// la referencia $this se puede utilizar
		// dentro de la clase 
		$this->saludo = "¿Cómo está?";
	} 
}
	
function Test($obj)
{
	// esta función recibe como parámetro al objeto de 
	// clase MiClase
	$obj->saludo = "Buenos tardes.";
}

// Se crea el objeto $obj
$obj = new MiClase();

// ¿qué hay en la propiedad saludo? 
print $obj->saludo . "<BR>"; // el constructor puso ¿Cómo está?

// pasamos el objeto a una función 
// dentro de la función se modifica al objeto
Test($obj);

//¿Se modificó el objeto?
print $obj->saludo . "<BR>"; // Sí, en PHP 5/6 se verá 'Buenas tardes'

?>