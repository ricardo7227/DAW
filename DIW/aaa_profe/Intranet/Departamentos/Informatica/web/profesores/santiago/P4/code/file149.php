<?php
print "<BR><B><U> Gestión de excepciones (Derivación de clase Exception) (ejemplo file149.php) <BR></B></U>";

// Se extiende la clase Exception
Class MiExcepción  extends Exception{
    // El método MostrarError no existe en la clase base Exception
    // la clase derivada no puede modificar los métodos de la clase
    // Exception porque son todos 'final'. Pero sí es posible 
    // añadir propiedades y métodos
    function MostrarError(){
	echo "*****************************<BR>";
	echo "Se produjo este error: " . $this->getMessage() ."<BR>";
	echo "Código: " .$this->getCode() . "<BR>";
	echo "Archivo del error: " .$this->getFile() . "<BR>";
	echo "Línea del error: " .$this->getLine() . "<BR>";
	$var = $this->getTrace();
	echo "En la función: " . $var[0] ['function'] . "<BR>";
	echo "Función llamada desde la línea: " . $var[0] ['line'] . "<BR>";	
	echo "*****************************<BR>";
        
	// durante el tratamiento de una excepción 
	// podemos generar una nueva excepción
	try{	
            // se crea un objeto de clase Exception
            throw new Exception("otro error (generado dentro de la primera excepción)",8);
	} catch (Exception $er){
            // aquí podemos acceder a los métodos de la clase
            // Exception (pero no a los de su clase hija)
            echo $er->getMessage();
	}
    }
} 
function dividir($y,$x) {
    // el objeto se crea con un mensaje y un código de error, ambos
    // son definidos por el desarrollador 
    if ($x == 0) throw new MiExcepción("división por cero", 12);
    return $y/$x;
} 
 
try{
    $r = dividir(23,0);
} catch (MiExcepción $e) {	
    // aquí podemos hacer referencia a los métodos de la clase base y 
    // de la clase hija
    echo $e->MostrarError();
    exit;
} 
print $r;
?> 