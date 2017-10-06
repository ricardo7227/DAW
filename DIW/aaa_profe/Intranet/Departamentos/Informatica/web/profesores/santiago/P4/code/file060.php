<?php
print "<B><U>Prácticas con funciones para buscar en cadenas (ejemplo file060.php)</U></B><BR>";

$var1 = "Hoy estamos aquí para estudiar el lenguaje PHP 6";
print "<BR>Cadena utilizada en los ejemplos:<B> $var1</B><BR>";

// la función strspn()
Print "<BR><B>Función strspn(): búsqueda de la longitud del segmento inicial más largo formado por caracteres del literal buscado</B><BR>";
$buscar = "aeiouH";
$var2 = strspn($var1,$buscar);
print "<B>1.:</B> busca los caracteres <B> $buscar </B> <BR> (hasta el carácter:  $var2 están todos, corta en la letra " . substr($var1,$var2,1). "<BR>";

$buscar = "aeiouh";
$var2 = strspn($var1,$buscar);
print "<B>2.:</B> busca los caracteres <B> $buscar </B> <BR> (la función diferencia entre mayúsculas y minúsculas, corta en la letra " . substr($var1,$var2,1). "<BR>"; 

// la función strcspn()
Print "<BR><B>Función strcspn(): búsqueda de la longitud del segmento inicial más largo formado por caracteres no contenidos en el literal buscado</B><BR>";
$buscar = "123456789";
$var2 = strcspn($var1,$buscar);
print "<B>3.:</B> busca los caracteres <B> $buscar </B> <BR> (hasta el carácter:  $var2 están todos, corta en la posición $var2 (final de cadena)<BR>";

$buscar = "PhP";
$var2 = strcspn($var1,$buscar);
print "<B>4.:</B> busca los caracteres <B> $buscar </B> <BR> (hasta el carácter:  $var2 están todos, la función diferencia entre mayúsculas y minúsculas -la primera p minúscula no produce el corte-, corta en la posición $var2 <BR>"; 
?>  