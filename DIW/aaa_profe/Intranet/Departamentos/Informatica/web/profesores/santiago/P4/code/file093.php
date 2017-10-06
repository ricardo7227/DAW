<?php
print "<B><U>Comprobaci�n de tipos (ejemplo file093.php)</U></B><BR><BR>";

// Definici�n de la clase Factura
class Factura {
	// N�mero de la factura
	public $n�mero;
	public $fecha;

	// matriz de objetos l�neas de detalle (L�nea_Detalle)
	public $l�neas;

	function __construct($var_n�mero, $var_fecha) {
	    $this->n�mero = $var_n�mero;
		$this->fecha = $var_fecha;
	}

	function agregar_l�nea(L�nea_Detalle $l�nea_detalle) {
		$this->l�neas[] = $l�nea_detalle;
	}

	function obtener_l�neas() {
		return ($this->l�neas);
	}
}
	
// Definici�n de la clase L�nea_Detalle
class L�nea_Detalle {
	// Una propiedad publica
	public $cantidad;
	public $producto;

	function __construct($var_cantidad, $var_producto) {
		// constructor de la clase L�nea_Detalle
	    $this->cantidad = $var_cantidad;
		$this->producto = $var_producto;
	}
}
	
// Se crea un objeto Factura
$fac = new Factura("21001","20/04/2004");

// se crea un objeto l�nea de detalle
$lin = new L�nea_Detalle(6,"peras");

// se agrega la l�nea a la factura
$fac->agregar_l�nea($lin); //se env�a un objeto L�nea_Detalle

// se crea otra l�nea de detalle
$fac->agregar_l�nea(12, "manzanas"); // �PERO NO SE ENV�A UN 
                                 // OBJETO L�NEA_DETALLE! 

// obtenci�n de todas las l�neas de factura
print "<U><B>contenido de las l�neas de detalle </U></B><BR>";
foreach (($fac->obtener_l�neas()) as $value){ 
	print  ("cantidad: " . $value->cantidad . " unidades -  " .  
      " producto: " .$value->producto . "<BR>");
}	
 
?>