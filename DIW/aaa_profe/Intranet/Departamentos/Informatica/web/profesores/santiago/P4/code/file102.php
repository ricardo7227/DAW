<?php
print "<B><U>Referencia indirecta a objetos retornados por funciones (ejemplo file102.php)</U></B><BR><BR>";

abstract class Persona {
	public $nombre;
	//  constructor de la clase Persona 
	function __construct($var) {
	    $this->nombre = $var;
	}
}	

// Definición de la clase Empleado
class Empleado extends Persona implements Imprimir {
	public $sección;
	//  constructor de la clase Empleado 
	function imprimir() {
	    print "Empleado " . $this->nombre . "<BR>";
	}
	function __destruct(){
		print "Se destruye el objeto Empleado<BR>";
	}
}	

// Definición de la clase Cliente
class Cliente extends Persona implements Imprimir {
	public $dirección;
	//  constructor de la clase Cliente 
	function imprimir() {
	    print "Cliente " . $this->nombre . "<BR>";
	}
	function __destruct(){
		print "Se destruye el objeto Cliente<BR>";
	}
}
	
// Definición de la clase Proveedor
class Proveedor extends Persona implements Imprimir {
	public $dirección;
	//  constructor de la clase Proveedor 
	function imprimir() {
	    print "Proveedor " . $this->nombre . "<BR>";
	}
        function __destruct(){
		print "Se destruye el objeto Proveedor<BR>";
	}
}	

// Definición de la interfaz Imprimir
interface Imprimir{
	function imprimir();
} 

function generaObjetos($obj,$var){
	switch($obj){
		case "Empleado";
			return new Empleado($var);
		case "Cliente";
			return new Cliente($var);
		case "Proveedor";
			return new Proveedor($var);	
	}
} 

// este objeto se destruye al terminar el script
// porque su ámbito es local al programa
$obj = new Proveedor("Pepe Sánchez");
$obj->imprimir();

// estos objetos se destruyen inmediatamente porque
// su ámbito es local a la función en donde se crea el objeto

generaObjetos("Cliente", "José Perez")->imprimir(); 
generaObjetos("Proveedor", "Juan Rodríguez")->imprimir(); 
generaObjetos("Empleado", "Francisco Font Nicolau")->imprimir(); 

// esto provoca un error por que no existe la clase Distribuidor
//generaObjetos("Distribuidor", "Miguel Lombardo")->imprimir(); 
?>