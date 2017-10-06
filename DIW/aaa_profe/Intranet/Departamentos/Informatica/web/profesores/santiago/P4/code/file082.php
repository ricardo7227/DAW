<?php
print "<B><U>Acceso a una función miembro estático  (ejemplo file082.php)</U></B><BR><BR>";

// Clase
class MiClase {
	static $pi = 3.14156;
	static function longitud_circunferencia ($diámetro)
	{
		return MiClase::$pi * $diámetro;
	}
}

// El método estático se usa sin crear la instancia de la clase
// sintaxis clase::método()

Print "Longitud de la circunferencia (sin instancia): " . MiClase::longitud_circunferencia(8.5) . "<BR>";

$obj = new MiClase;
// En este caso utilizamos la función estática pero
// creando un objeto de la clase
// atención: cambia la sintaxis obj->método()
Print "Longitud de la circunferencia (con instancia) : " . 
  $obj->longitud_circunferencia(44.5);  
?>