<?php
// Referencias (ejemplo file003.php)

$Cadena = "Tipo de dato de cadena";
$Ref = &$Cadena; // en $Ref se guarda la direcci�n de $Cadena
$Cadena = "--Aqu� la cambio-- ";
echo $Ref;      // veremos "--Aqu� la cambio-- "
 
?>
 
