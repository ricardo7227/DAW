<?php
print "<B><U>Prácticas con relleno de cadenas: str_pad() (ejemplo file067.php)</U></B><BR>";

// str_pad ( pcadena, plongitud [, prelleno [, ptipo_relleno]])
// prelleno es opcional (asume espacio)
// ptipo_relleno: asume relleno por el final STR_PAD_RIGHT
// se coloca la visualización en hexadecimal para ver los 
// caracteres espacio (hex 20)
$var1 = "Lenguaje PHP";
print "<BR>Cadena: <B> $var1 </B><BR>";
print "<BR>en hexadecimal:" . bin2hex ($var1) . "<BR>";
print "Longitud de la cadena original:" . strlen($var1) . " caracteres<BR>";

$var2 = str_pad($var1, 15); 
// añade espacios a la derecha 
print "<BR>1. Añade espacios a la derecha hasta llegar a longitud 15<BR>"; 
print "$var2<BR>"; 
print "en hexadecimal:" . bin2hex ($var2) . "<BR>";
print "Longitud es ". strlen($var2) . "<BR>";
   
$var2 = str_pad($var1, 20, "* *", STR_PAD_RIGHT); 
// añade relleno a la derecha
print "<BR>2. Añade relleno a la derecha hasta llegar a longitud 20<BR>"; 
print "$var2<BR>"; 
print "en hexadecimal:" .  bin2hex ($var2) . "<BR>";
print "Longitud es ". strlen($var2) . "<BR>";

$var2 = str_pad($var1, 20, "* *", STR_PAD_LEFT); 
// añade relleno a la izquierda
print "<BR>3. Añade relleno a la izquierda hasta llegar a longitud 20<BR>";
print "$var2<BR>"; 
print "en hexadecimal:" . bin2hex ($var2) . "<BR>";
print "Longitud es ". strlen($var2) . "<BR>";
   
$var2 = str_pad($var1, 20, "* *", STR_PAD_BOTH); 
// añade relleno a ambos lados
print "<BR>4. Añade relleno a ambos lados hasta llegar a longitud 20<BR>";
print "$var2<BR>"; 
print "en hexadecimal:" . bin2hex ($var2) . "<BR>";
print "Longitud es ". strlen($var2) . "<BR>";
?>