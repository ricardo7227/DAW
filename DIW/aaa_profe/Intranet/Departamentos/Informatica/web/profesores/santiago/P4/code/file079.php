<?php
print "<B><U>Pase de objetos a funciones (ejemplo file079.php)</U></B><BR><BR>";

// Clase
class MiClase {
	public $saludo;

	function __construct(){
	// 
		// la referencia $this se puede utilizar
		// dentro de la clase 
		$this->saludo = "�C�mo est�?";
	} 
}
	
function Test($obj)
{
	// esta funci�n recibe como par�metro al objeto de 
	// clase MiClase
	$obj->saludo = "Buenos tardes.";
}

// Se crea el objeto $obj
$obj = new MiClase();

// �qu� hay en la propiedad saludo? 
print $obj->saludo . "<BR>"; // el constructor puso �C�mo est�?

// pasamos el objeto a una funci�n 
// dentro de la funci�n se modifica al objeto
Test($obj);

//�Se modific� el objeto?
print $obj->saludo . "<BR>"; // S�, en PHP 5/6 se ver� 'Buenas tardes'

?>