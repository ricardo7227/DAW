<?php
print "<B><U>Comprobación de tipos (ejemplo file093.php)</U></B><BR><BR>";

// Definición de la clase Factura
class Factura {
	// Número de la factura
	public $número;
	public $fecha;

	// matriz de objetos líneas de detalle (Línea_Detalle)
	public $líneas;

	function __construct($var_número, $var_fecha) {
	    $this->número = $var_número;
		$this->fecha = $var_fecha;
	}

	function agregar_línea(Línea_Detalle $línea_detalle) {
		$this->líneas[] = $línea_detalle;
	}

	function obtener_líneas() {
		return ($this->líneas);
	}
}
	
// Definición de la clase Línea_Detalle
class Línea_Detalle {
	// Una propiedad publica
	public $cantidad;
	public $producto;

	function __construct($var_cantidad, $var_producto) {
		// constructor de la clase Línea_Detalle
	    $this->cantidad = $var_cantidad;
		$this->producto = $var_producto;
	}
}
	
// Se crea un objeto Factura
$fac = new Factura("21001","20/04/2004");

// se crea un objeto línea de detalle
$lin = new Línea_Detalle(6,"peras");

// se agrega la línea a la factura
$fac->agregar_línea($lin); //se envía un objeto Línea_Detalle

// se crea otra línea de detalle
$fac->agregar_línea(12, "manzanas"); // ¡PERO NO SE ENVÏA UN 
                                 // OBJETO LÍNEA_DETALLE! 

// obtención de todas las líneas de factura
print "<U><B>contenido de las líneas de detalle </U></B><BR>";
foreach (($fac->obtener_líneas()) as $value){ 
	print  ("cantidad: " . $value->cantidad . " unidades -  " .  
      " producto: " .$value->producto . "<BR>");
}	
 
?>