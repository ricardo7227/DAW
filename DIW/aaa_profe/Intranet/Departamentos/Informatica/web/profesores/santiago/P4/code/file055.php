<?php
print "<B><U>Distintas funciones para buscar elementos en matrices (ejemplo file055.php)</U></B><BR>";
 
$mat0 = array("Alemania","Andorra","Austria","8"=>"Bélgica","Dinamarca","España");
print_r ($mat0);

print "<BR><B>Búsqueda de elementos con array_search()</B><BR><BR>";
$clave = array_search("Bélgica", $mat0); // respuesta = 3
print "La clave de Bélgica es: $clave <BR>"; 
$clave = array_search("España", $mat0); // respuesta = 10
print "La clave de España es: $clave <BR>"; 
$clave = array_search("Irlanda", $mat0); // respuesta vacía
print "La clave de Irlanda es: $clave <BR>"; 

print "<BR><B>Búsqueda de todos los elementos que empiecen por A con preg_grep()</B><BR><BR>";
// la función utiliza una expresión patrón de búsqueda y el
// nombre de la matriz
// el resultado es una matriz con todos los elementos
// que cumplen la condición definida
$mat1 =preg_grep("/^A/",$mat0);
print_r ($mat1);

print "<BR><BR><B>Búsqueda de elementos mediante la función in_array()</B><BR><BR>";
if (in_array ("Dinamarca", $mat0))
    print "Búsqueda con in_array(): Dinamarca está"; 
?> 
 