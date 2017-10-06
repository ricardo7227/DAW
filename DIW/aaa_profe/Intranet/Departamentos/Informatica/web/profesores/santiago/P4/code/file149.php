<?php
print "<BR><B><U> Gesti�n de excepciones (Derivaci�n de clase Exception) (ejemplo file149.php) <BR></B></U>";

// Se extiende la clase Exception
Class MiExcepci�n  extends Exception{
    // El m�todo MostrarError no existe en la clase base Exception
    // la clase derivada no puede modificar los m�todos de la clase
    // Exception porque son todos 'final'. Pero s� es posible 
    // a�adir propiedades y m�todos
    function MostrarError(){
	echo "*****************************<BR>";
	echo "Se produjo este error: " . $this->getMessage() ."<BR>";
	echo "C�digo: " .$this->getCode() . "<BR>";
	echo "Archivo del error: " .$this->getFile() . "<BR>";
	echo "L�nea del error: " .$this->getLine() . "<BR>";
	$var = $this->getTrace();
	echo "En la funci�n: " . $var[0] ['function'] . "<BR>";
	echo "Funci�n llamada desde la l�nea: " . $var[0] ['line'] . "<BR>";	
	echo "*****************************<BR>";
        
	// durante el tratamiento de una excepci�n 
	// podemos generar una nueva excepci�n
	try{	
            // se crea un objeto de clase Exception
            throw new Exception("otro error (generado dentro de la primera excepci�n)",8);
	} catch (Exception $er){
            // aqu� podemos acceder a los m�todos de la clase
            // Exception (pero no a los de su clase hija)
            echo $er->getMessage();
	}
    }
} 
function dividir($y,$x) {
    // el objeto se crea con un mensaje y un c�digo de error, ambos
    // son definidos por el desarrollador 
    if ($x == 0) throw new MiExcepci�n("divisi�n por cero", 12);
    return $y/$x;
} 
 
try{
    $r = dividir(23,0);
} catch (MiExcepci�n $e) {	
    // aqu� podemos hacer referencia a los m�todos de la clase base y 
    // de la clase hija
    echo $e->MostrarError();
    exit;
} 
print $r;
?> 