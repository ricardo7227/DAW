<?php
print "<B><U>Pr�cticas con funciones para recortar cadenas  (ejemplo file066.php)</U></B><BR>";

$var1 = "  \r\t\n   Resumen de compras   \r\t\n   "; 
print "<BR>Recortes chop(), rtrim(),ltrim() y ltrim()- cadena:<B> $var1</B><BR>";
print "Cadena en hexadecimal  (Nota: car�cter 20 es espacio, 09 es \\t, 0a es \\n, 0d es \\r) <BR>"; 
print bin2hex ($var1) . "<BR>";
print "Longitud de la cadena original:" . strlen($var1) . " caracteres<BR>";

// la funci�n chop(pcadena)
// recorta los espacios finales incluyendo los caracteres 
// de fin de l�nea 
Print "<BR><B>Funci�n chop(): recorta cadenas por el final</B><BR>";
// �sta es una l�nea con espacios al inicio y al final, tambi�n con 
// caracteres de fin de l�nea, control de carro, tabulaci�n
// en la configuraci�n en hexadecimal se puede observar que
// estos caracteres del final desaparecen
$var2 = chop($var1);
print "Cadena recortada con chop():<B>" . $var2 . "</B><BR>";
print "Configuraci�n en hexadecimal de la cadena recortada con chop()<BR>"; 
print bin2hex($var2) ."<BR>";
print "Longitud de la cadena despu�s del recorte:" . strlen($var2). " caracteres<BR>"; 

Print "<BR><B>Funci�n rtrim(): recorta cadenas igual que chop()</B><BR>";
// la funci�n rtrim(pcadena) es un alias de chop()
// recorta los espacios finales incluyendo los caracteres 
// de fin de l�nea 
$var2 = rtrim($var1);
print "Cadena recortada con rtrim():<B>" . $var2 . "</B><BR>";
print "Configuraci�n en hexadecimal de la cadena recortada con rtrim()<BR>"; 
print bin2hex($var2) ."<BR>";
print "Longitud de la cadena despu�s del recorte:" . strlen($var2). " caracteres<BR>"; 

Print "<BR><B>Funci�n ltrim(): recorta cadenas por el inicio</B><BR>";
// la funci�n ltrim(pcadena)  
// recorta los espacios iniciales incluyendo los caracteres 
// de fin de l�nea 
$var2 = ltrim($var1);
print "Cadena recortada con ltrim():<B>" . $var2 . "</B><BR>";
print "Configuraci�n en hexadecimal de la cadena recortada con ltrim()<BR>"; 
print bin2hex($var2) ."<BR>";
print "Longitud de la cadena despu�s del recorte:" . strlen($var2). " caracteres<BR>"; 

Print "<BR><B>Funci�n trim(): recorta cadenas por el inicio y por el final</B><BR>";
// la funci�n trim(pcadena)  
// recorta los espacios iniciales y finales incluyendo los 
// caracteres de fin de l�nea 

$var2 = trim($var1);
print "Cadena recortada con trim():<B>" . $var2 . "</B><BR>";
print "Configuraci�n en hexadecimal de la cadena recortada con trim()<BR>"; 
print bin2hex($var2) ."<BR>";
print "Longitud de la cadena despu�s del recorte:" . strlen($var2). " caracteres<BR>";  
?>
