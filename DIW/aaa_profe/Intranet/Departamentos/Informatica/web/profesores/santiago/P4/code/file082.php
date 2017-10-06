<?php
print "<B><U>Acceso a una funci�n miembro est�tico  (ejemplo file082.php)</U></B><BR><BR>";

// Clase
class MiClase {
	static $pi = 3.14156;
	static function longitud_circunferencia ($di�metro)
	{
		return MiClase::$pi * $di�metro;
	}
}

// El m�todo est�tico se usa sin crear la instancia de la clase
// sintaxis clase::m�todo()

Print "Longitud de la circunferencia (sin instancia): " . MiClase::longitud_circunferencia(8.5) . "<BR>";

$obj = new MiClase;
// En este caso utilizamos la funci�n est�tica pero
// creando un objeto de la clase
// atenci�n: cambia la sintaxis obj->m�todo()
Print "Longitud de la circunferencia (con instancia) : " . 
  $obj->longitud_circunferencia(44.5);  
?>