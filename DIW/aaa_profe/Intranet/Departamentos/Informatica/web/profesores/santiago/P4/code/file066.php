<?php
print "<B><U>Prácticas con funciones para recortar cadenas  (ejemplo file066.php)</U></B><BR>";

$var1 = "  \r\t\n   Resumen de compras   \r\t\n   "; 
print "<BR>Recortes chop(), rtrim(),ltrim() y ltrim()- cadena:<B> $var1</B><BR>";
print "Cadena en hexadecimal  (Nota: carácter 20 es espacio, 09 es \\t, 0a es \\n, 0d es \\r) <BR>"; 
print bin2hex ($var1) . "<BR>";
print "Longitud de la cadena original:" . strlen($var1) . " caracteres<BR>";

// la función chop(pcadena)
// recorta los espacios finales incluyendo los caracteres 
// de fin de línea 
Print "<BR><B>Función chop(): recorta cadenas por el final</B><BR>";
// ésta es una línea con espacios al inicio y al final, también con 
// caracteres de fin de línea, control de carro, tabulación
// en la configuración en hexadecimal se puede observar que
// estos caracteres del final desaparecen
$var2 = chop($var1);
print "Cadena recortada con chop():<B>" . $var2 . "</B><BR>";
print "Configuración en hexadecimal de la cadena recortada con chop()<BR>"; 
print bin2hex($var2) ."<BR>";
print "Longitud de la cadena después del recorte:" . strlen($var2). " caracteres<BR>"; 

Print "<BR><B>Función rtrim(): recorta cadenas igual que chop()</B><BR>";
// la función rtrim(pcadena) es un alias de chop()
// recorta los espacios finales incluyendo los caracteres 
// de fin de línea 
$var2 = rtrim($var1);
print "Cadena recortada con rtrim():<B>" . $var2 . "</B><BR>";
print "Configuración en hexadecimal de la cadena recortada con rtrim()<BR>"; 
print bin2hex($var2) ."<BR>";
print "Longitud de la cadena después del recorte:" . strlen($var2). " caracteres<BR>"; 

Print "<BR><B>Función ltrim(): recorta cadenas por el inicio</B><BR>";
// la función ltrim(pcadena)  
// recorta los espacios iniciales incluyendo los caracteres 
// de fin de línea 
$var2 = ltrim($var1);
print "Cadena recortada con ltrim():<B>" . $var2 . "</B><BR>";
print "Configuración en hexadecimal de la cadena recortada con ltrim()<BR>"; 
print bin2hex($var2) ."<BR>";
print "Longitud de la cadena después del recorte:" . strlen($var2). " caracteres<BR>"; 

Print "<BR><B>Función trim(): recorta cadenas por el inicio y por el final</B><BR>";
// la función trim(pcadena)  
// recorta los espacios iniciales y finales incluyendo los 
// caracteres de fin de línea 

$var2 = trim($var1);
print "Cadena recortada con trim():<B>" . $var2 . "</B><BR>";
print "Configuración en hexadecimal de la cadena recortada con trim()<BR>"; 
print bin2hex($var2) ."<BR>";
print "Longitud de la cadena después del recorte:" . strlen($var2). " caracteres<BR>";  
?>
