<?php
print "<B><U>Pr�cticas con relleno de cadenas: str_pad() (ejemplo file067.php)</U></B><BR>";

// str_pad ( pcadena, plongitud [, prelleno [, ptipo_relleno]])
// prelleno es opcional (asume espacio)
// ptipo_relleno: asume relleno por el final STR_PAD_RIGHT
// se coloca la visualizaci�n en hexadecimal para ver los 
// caracteres espacio (hex 20)
$var1 = "Lenguaje PHP";
print "<BR>Cadena: <B> $var1 </B><BR>";
print "<BR>en hexadecimal:" . bin2hex ($var1) . "<BR>";
print "Longitud de la cadena original:" . strlen($var1) . " caracteres<BR>";

$var2 = str_pad($var1, 15); 
// a�ade espacios a la derecha 
print "<BR>1. A�ade espacios a la derecha hasta llegar a longitud 15<BR>"; 
print "$var2<BR>"; 
print "en hexadecimal:" . bin2hex ($var2) . "<BR>";
print "Longitud es ". strlen($var2) . "<BR>";
   
$var2 = str_pad($var1, 20, "* *", STR_PAD_RIGHT); 
// a�ade relleno a la derecha
print "<BR>2. A�ade relleno a la derecha hasta llegar a longitud 20<BR>"; 
print "$var2<BR>"; 
print "en hexadecimal:" .  bin2hex ($var2) . "<BR>";
print "Longitud es ". strlen($var2) . "<BR>";

$var2 = str_pad($var1, 20, "* *", STR_PAD_LEFT); 
// a�ade relleno a la izquierda
print "<BR>3. A�ade relleno a la izquierda hasta llegar a longitud 20<BR>";
print "$var2<BR>"; 
print "en hexadecimal:" . bin2hex ($var2) . "<BR>";
print "Longitud es ". strlen($var2) . "<BR>";
   
$var2 = str_pad($var1, 20, "* *", STR_PAD_BOTH); 
// a�ade relleno a ambos lados
print "<BR>4. A�ade relleno a ambos lados hasta llegar a longitud 20<BR>";
print "$var2<BR>"; 
print "en hexadecimal:" . bin2hex ($var2) . "<BR>";
print "Longitud es ". strlen($var2) . "<BR>";
?>