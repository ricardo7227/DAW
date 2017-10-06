<?php
print "<B><U>__autoload() (ejemplo file106.php)</U></B><BR><BR>";

// Éste es un modo de hacerlo sin __autoload()
//include_once "Personas.php";

function __autoload($varClase) {
	// con este print veremos cuántas veces se invoca a la 
   // función autoload()
	// Será sólo una vez, porque el archivo Personas.php contiene la
	// declaración de las dos clases del programa

	print "<BR>** Entró a la función __autoload()**<BR><BR>";

	// la lógica dentro de la función __autoload() es libre
	// lo habitual es incluir la definición de la clase faltante

	if ($varClase == "Empleado" or $varClase == "Persona") {
		include_once "Personas.php";
	}	
	else {
		include_once $varClase . ".php";
	}	 
}

// la clase Persona no está declarada dentro de la 
// secuencia de comandos vigente en lugar de producirse un error, 
// la unción __autoload lo intercepta
// y se ejecuta. El parámetro que recibe la función es el nombre 
// de la clase que no está definida en el script

$obj = new Persona(122,"José Pérez");
$obj->listar();

// como la clase Empleado está definida dentro del archivo 
// Personas.php cuando se hace referencia a la clase Empleado, 
// PHP detecta que la clase ya 
// está definida, ya que se cargó junto con la clase Persona

$obj = new Empleado(99123,"Juan Fernández","Recursos humanos");
$obj->listar();

?>