<?php
// Referencias (ejemplo file004.php)

$Cadena = "Ejemplo";
$Ref = &$Cadena;  // en $Ref se guarda la direcci�n de $Cadena
$Ref2 = &$Ref;    // Referencia de referencia
echo $Ref2;       //  podremos ver "Ejemplo"
 
?>