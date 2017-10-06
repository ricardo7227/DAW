<?php
print "<B><U>Distintas funciones para buscar elementos en matrices (ejemplo file055.php)</U></B><BR>";
 
$mat0 = array("Alemania","Andorra","Austria","8"=>"B�lgica","Dinamarca","Espa�a");
print_r ($mat0);

print "<BR><B>B�squeda de elementos con array_search()</B><BR><BR>";
$clave = array_search("B�lgica", $mat0); // respuesta = 3
print "La clave de B�lgica es: $clave <BR>"; 
$clave = array_search("Espa�a", $mat0); // respuesta = 10
print "La clave de Espa�a es: $clave <BR>"; 
$clave = array_search("Irlanda", $mat0); // respuesta vac�a
print "La clave de Irlanda es: $clave <BR>"; 

print "<BR><B>B�squeda de todos los elementos que empiecen por A con preg_grep()</B><BR><BR>";
// la funci�n utiliza una expresi�n patr�n de b�squeda y el
// nombre de la matriz
// el resultado es una matriz con todos los elementos
// que cumplen la condici�n definida
$mat1 =preg_grep("/^A/",$mat0);
print_r ($mat1);

print "<BR><BR><B>B�squeda de elementos mediante la funci�n in_array()</B><BR><BR>";
if (in_array ("Dinamarca", $mat0))
    print "B�squeda con in_array(): Dinamarca est�"; 
?> 
 