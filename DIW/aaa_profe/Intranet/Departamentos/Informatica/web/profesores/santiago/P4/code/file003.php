<?php
// Referencias (ejemplo file003.php)

$Cadena = "Tipo de dato de cadena";
$Ref = &$Cadena; // en $Ref se guarda la dirección de $Cadena
$Cadena = "--Aquí la cambio-- ";
echo $Ref;      // veremos "--Aquí la cambio-- "
 
?>
 
