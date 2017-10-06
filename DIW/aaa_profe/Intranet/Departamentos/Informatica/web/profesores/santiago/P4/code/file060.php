<?php
print "<B><U>Pr�cticas con funciones para buscar en cadenas (ejemplo file060.php)</U></B><BR>";

$var1 = "Hoy estamos aqu� para estudiar el lenguaje PHP 6";
print "<BR>Cadena utilizada en los ejemplos:<B> $var1</B><BR>";

// la funci�n strspn()
Print "<BR><B>Funci�n strspn(): b�squeda de la longitud del segmento inicial m�s largo formado por caracteres del literal buscado</B><BR>";
$buscar = "aeiouH";
$var2 = strspn($var1,$buscar);
print "<B>1.:</B> busca los caracteres <B> $buscar </B> <BR> (hasta el car�cter:  $var2 est�n todos, corta en la letra " . substr($var1,$var2,1). "<BR>";

$buscar = "aeiouh";
$var2 = strspn($var1,$buscar);
print "<B>2.:</B> busca los caracteres <B> $buscar </B> <BR> (la funci�n diferencia entre may�sculas y min�sculas, corta en la letra " . substr($var1,$var2,1). "<BR>"; 

// la funci�n strcspn()
Print "<BR><B>Funci�n strcspn(): b�squeda de la longitud del segmento inicial m�s largo formado por caracteres no contenidos en el literal buscado</B><BR>";
$buscar = "123456789";
$var2 = strcspn($var1,$buscar);
print "<B>3.:</B> busca los caracteres <B> $buscar </B> <BR> (hasta el car�cter:  $var2 est�n todos, corta en la posici�n $var2 (final de cadena)<BR>";

$buscar = "PhP";
$var2 = strcspn($var1,$buscar);
print "<B>4.:</B> busca los caracteres <B> $buscar </B> <BR> (hasta el car�cter:  $var2 est�n todos, la funci�n diferencia entre may�sculas y min�sculas -la primera p min�scula no produce el corte-, corta en la posici�n $var2 <BR>"; 
?>  