<?php
print "Uso de SimpleXML (file152.php)";

$persona = simplexml_load_file("file145.xml");

$nombres = $persona->nombres;
$apellidos = $persona->apellidos;

foreach($nombres  as $n) {
    print "<BR>nombre; $n";
}

?>