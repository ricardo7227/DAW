<?php
print "<B><U>Pr�cticas con funciones para buscar en cadenas (ejemplo file059.php)</U></B><BR>";
$var1 = "Hoy estamos aqu� para estudiar el lenguaje PHP";
print "<BR>Cadena utilizada en los ejemplos:<B> $var1</B><BR>";

// la funci�n strstr
Print "<BR><B>Funci�n strstr(): b�squeda de la primera aparici�n de una subcadena</B><BR>";
$buscar = "estudiar";
$var2 = strstr($var1,$buscar);
print "<B>1.:</B> busca la cadena <B> $buscar </B> <BR> (encuentra:  $var2 )<BR>";
$buscar = "EsTuDiar";
$var2 = strstr($var1,$buscar);
print "<B>2.:</B> busca la cadena <B> $buscar </B><BR>  $var2 (no encuentra lo buscado strstr() porque hace diferencias entre may�sculas y min�sculas)<BR>";

// la funci�n stristr() 
Print "<BR><B>Funci�n stristr(): b�squeda de la primera aparici�n de una subcadena</B><BR>";
$buscar = "estudiar";
$var2 = stristr($var1,$buscar);
print "<B>3.:</B> busca la cadena <B> $buscar </B> <BR> (encuentra:  $var2 )<BR>";
$buscar = "EsTuDiar";
$var2 = stristr($var1,$buscar);
print "<B>4.:</B> busca la cadena <B> $buscar </B> <BR>  (encuentra:  $var2 ) porque stristr() no hace diferencias entre may�sculas y min�sculas.<BR>";

// la funci�n strrchr() 
Print "<BR><B>Funci�n strrchr(): b�squeda la �ltima aparici�n del primer car�cter de una cadena</B><BR>";
$buscar = "hoy";
$var2 = strrchr($var1,$buscar);

// no encontrar� nada porque no la funci�n strrchr() 
// hace diferencia entre may�sculas y min�sculas
print "<B>5.:</B> busca la cadena <B> $buscar </B><BR> (no la encuentra  porque strrchr() hace diferencias entre may�sculas y min�sculas:  $var2 )<BR>";
$buscar = strtoupper($buscar); // HOY en may�sculas
$var2 = strrchr($var1,$buscar);
// observar que no encuentra hoy sino la �ltima H de la cadena
// strrchr() busca la �ltima aparici�n del primer car�cter 
// de la cadena de b�squeda
// el resto de la cadena no se toma en cuenta, 
// es decir 'HOY' es lo mismo que poner 'H' 
print "<B>6.:</B> busca la cadena <B> $buscar </B><BR>  (encuentra:  $var2 )<BR>"; 


// la funci�n strpos()
Print "<BR><B>Funci�n strpos(): averigua la posici�n de la primera posici�n de una cadena</B><BR>";
$buscar = "php";
$var2 = strpos($var1,$buscar);

// no encontrar� nada porque no la funci�n strpos() 
// hace diferencia entre may�sculas y min�sculas
print "<B>7.:</B> busca la cadena <B> $buscar </B><BR> $var2 (no la encuentra porque strpos() hace diferencia entre may�sculas y min�sculas)<BR>";
// en este caso la encontrar� en la posici�n 43
$buscar = strtoupper($buscar);
$var2 = strpos($var1,$buscar);
print "<B>8.:</B> busca la cadena <B> $buscar </B> <BR>  (la encuentra en la posici�n:  $var2 )<BR>"; 
// se puede utilizar un par�metro de desplazamiento para comenzar la
// b�squeda desde una posici�n determinada de la cadena
$var2 = strpos($var1,$buscar,44);
print "<B>9.:</B> busca la cadena <B> $buscar </B> a partir de la posici�n 44<BR>  (no la encuentra porque PHP est� antes de la posici�n 44:  $var2 )<BR>"; 
?> 