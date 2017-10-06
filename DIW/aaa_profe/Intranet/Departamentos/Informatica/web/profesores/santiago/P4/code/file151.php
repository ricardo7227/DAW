<?php
print "Genera un archivo XML con funciones DOM (file151.php)";

// se crea un objeto DOMDocument
$doc = new DOMDocument("1.0");

$root = $doc->createElement("HTML");
$root= $doc->appendChild($root);

// se crea un elemento hijo de HTML
$ele1 = $doc->createElement("BODY");
$ele1 = $root->appendChild($ele1);

// se crea un elemento hijo de BODY
$ele2 = $doc->createElement("P");
$ele2 = $ele1->appendChild($ele2);

// se informa el texto del elemento <P> </P>
$texto = $doc->createTextNode("Texto de prueba para el párrafo");
$texto = $ele2->appendChild($texto);

// se guarda el archivo XML
$doc->save("file151.xml");

?> 
