<?php
print "<B><U>Prácticas con funciones para buscar en cadenas (ejemplo file059.php)</U></B><BR>";
$var1 = "Hoy estamos aquí para estudiar el lenguaje PHP";
print "<BR>Cadena utilizada en los ejemplos:<B> $var1</B><BR>";

// la función strstr
Print "<BR><B>Función strstr(): búsqueda de la primera aparición de una subcadena</B><BR>";
$buscar = "estudiar";
$var2 = strstr($var1,$buscar);
print "<B>1.:</B> busca la cadena <B> $buscar </B> <BR> (encuentra:  $var2 )<BR>";
$buscar = "EsTuDiar";
$var2 = strstr($var1,$buscar);
print "<B>2.:</B> busca la cadena <B> $buscar </B><BR>  $var2 (no encuentra lo buscado strstr() porque hace diferencias entre mayúsculas y minúsculas)<BR>";

// la función stristr() 
Print "<BR><B>Función stristr(): búsqueda de la primera aparición de una subcadena</B><BR>";
$buscar = "estudiar";
$var2 = stristr($var1,$buscar);
print "<B>3.:</B> busca la cadena <B> $buscar </B> <BR> (encuentra:  $var2 )<BR>";
$buscar = "EsTuDiar";
$var2 = stristr($var1,$buscar);
print "<B>4.:</B> busca la cadena <B> $buscar </B> <BR>  (encuentra:  $var2 ) porque stristr() no hace diferencias entre mayúsculas y minúsculas.<BR>";

// la función strrchr() 
Print "<BR><B>Función strrchr(): búsqueda la última aparición del primer caràcter de una cadena</B><BR>";
$buscar = "hoy";
$var2 = strrchr($var1,$buscar);

// no encontrará nada porque no la función strrchr() 
// hace diferencia entre mayúsculas y minúsculas
print "<B>5.:</B> busca la cadena <B> $buscar </B><BR> (no la encuentra  porque strrchr() hace diferencias entre mayúsculas y minúsculas:  $var2 )<BR>";
$buscar = strtoupper($buscar); // HOY en mayúsculas
$var2 = strrchr($var1,$buscar);
// observar que no encuentra hoy sino la última H de la cadena
// strrchr() busca la última aparición del primer carácter 
// de la cadena de búsqueda
// el resto de la cadena no se toma en cuenta, 
// es decir 'HOY' es lo mismo que poner 'H' 
print "<B>6.:</B> busca la cadena <B> $buscar </B><BR>  (encuentra:  $var2 )<BR>"; 


// la función strpos()
Print "<BR><B>Función strpos(): averigua la posición de la primera posición de una cadena</B><BR>";
$buscar = "php";
$var2 = strpos($var1,$buscar);

// no encontrará nada porque no la función strpos() 
// hace diferencia entre mayúsculas y minúsculas
print "<B>7.:</B> busca la cadena <B> $buscar </B><BR> $var2 (no la encuentra porque strpos() hace diferencia entre mayúsculas y minúsculas)<BR>";
// en este caso la encontrará en la posición 43
$buscar = strtoupper($buscar);
$var2 = strpos($var1,$buscar);
print "<B>8.:</B> busca la cadena <B> $buscar </B> <BR>  (la encuentra en la posición:  $var2 )<BR>"; 
// se puede utilizar un parámetro de desplazamiento para comenzar la
// búsqueda desde una posición determinada de la cadena
$var2 = strpos($var1,$buscar,44);
print "<B>9.:</B> busca la cadena <B> $buscar </B> a partir de la posición 44<BR>  (no la encuentra porque PHP está antes de la posición 44:  $var2 )<BR>"; 
?> 