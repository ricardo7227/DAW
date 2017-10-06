<?php
// Subdivisión de cadenas con explode (archivo file164.php)

$cadena = "Esta esXYZuna cadenaXYZde textoXYZ con 4 tokens";

// definimos que el separador es la cadena XYZ
$miarray =explode("XYZ", $cadena);

$i = 1;
foreach($miarray as $a) {
    print ("Elemento nro. $i <B> $a </B><BR>");
    $i++;
}
?>