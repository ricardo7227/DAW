<?php
print "<B><U>Simulación de sobrecarga de acceso a propiedades (ejemplo file096.php)</U></B><BR><BR>";

// Definición de la clase Prueba
class Prueba {
 	private $matriz;

	// en el constructor se crea la matriz con un único elemento
	function __construct() {
		$this->matriz = array("Italia"=>100);
	}

	// cuando se accede a una propiedad que no existe, actúa
	// el método __get(), en el argumento se recibe el nombre de la
	// supuesta propiedad
	
	// aquí implementamos la función para que reciba los valores de
	// claves de una matriz asociativa
	// éste es sólo un ejemplo para la aplicación de métodos __get()
	// y __set()

		function __get($nv){
		print "<BR>función get:" . $nv ."<BR>";

		// la función isset() verifica si la variable está asignada
		if (isset($this->matriz[$nv]) ) {
			return $this->matriz[$nv];
		}
		else{
			return False;
		} 
	}

	// cuando se asigna un valor a una propiedad que no existe,
   // actúa el método __set(), en el argumento se recibe el 
   // nombre de la supuesta propiedad y el valor que se quiere 
   // asignar

	function __set($nv,$val){
		print "<BR>función set:" . $nv . ", " . $val ."<BR>";
		$this->matriz[$nv] = $val;
	}
        
        // ejemplo de _isset()
	function __isset($nv){
		print "<BR>función _isset:" . $nv . "<BR>";
		return isset($this->matriz[$nv]);

	}

	// ejemplo de _unset()
	function __unset($nv){
		print "<BR>función _unset:" . $nv . "<BR>";
		unset($this->matriz[$nv]);

	}
}	

// al generar el ejemplar de la clase Prueba
// se ejecuta automáticamente el constructor de la clase
// __construct() 

$objPrueba = new Prueba;

// la matriz sólo tiene el elemento de clave Italia, por lo que
// España no existe
if (!$objPrueba->España) {
	print "el elemento no existe en la matriz.<BR> ";
}

// si intentamos obtener el valor de la pseudopropiedad España
// obtenemos False, porque aún no le asignamos valor

$b = $objPrueba->España;
print "Retorno es :" . $b . "<BR>";

// Ahora se asigna el valor a la pseudo propiedad España,
// gracias a la implementación del método __set(), el valor
// se almacena en la propiedad matriz, en la clave España

$objPrueba->España = 150; 

// Al acceder ahora a la pseudo propiedad, obtenemos el valor
// desde el método __get()

$b = $objPrueba->España;
print "Retorno es :" . $b . "<BR>";

if ($objPrueba->España) {
	print "El elemento existe en la matriz.<BR> ";
}

// creamos otro elemento
$objPrueba->Argentina = 200;

// se usa la función isset() con una propiedad no existente
// esperando que la función _isset() haga su trabajo
if (isset($objPrueba->Argentina)) {
	print "El elemento está en la matriz.<BR> ";
}

unset($objPrueba->Argentina);
 
 
?>