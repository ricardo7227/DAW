<?php
print "<B><U>Prácticas con funciones para convertir cadenas  (ejemplo file065.php)</U></B><BR>";

// la función bin2hex(pcadena)
// convierte byte a byte una cadena a su representación hexadecimal 
Print "<BR><B>Función bin2hex(): convertir cadenas</B><BR>";
$var1 = bin2hex("1234"); //  debe ser hexadecimal 31 32 33 34
print "cadena:$var1 <BR>";

// la función str_split(pcadena, plong)
// convierte una cadena en una matriz
// corta cada plong caracteres, que por omisión es 1
Print "<BR><B>Función str_split(): convertir cadenas a matriz</B><BR>";
$var1 = str_split("abcdefghijk"); 
// asume que cada elemento tiene longitud 1  
print_r ($var1); 

Print "<BR><BR><B>Función str_split(): con parámetro de longitud</B><BR>";
$var1 = str_split("PHP es un lenguaje fácil",3); 
// cada elemento tiene longitud 3 
print_r ($var1);   

// la función strtolower(pcadena)
// convierte una cadena a todo minúsculas
Print "<BR><BR><B>Función strtolower(): convertir cadenas a minúsculas</B><BR>";
// no afecta números y símbolos especiales
$var1 = strtolower("JuanNUÑEZ2@COMPUTER.ORG");   
print $var1 ."<BR>";   

// la función strtoupper(pcadena)
// convierte una cadena a todo mayúsculas
Print "<BR><B>Función strtolower(): convertir cadenas a mayúsculas</B><BR>";
// no afecta números y símbolos especiales
$var1 = strtoupper("juannuñez2@computer.org");     
print $var1 ."<BR>";  

// la función ucfirst(pcadena)
// convierte el primer carácter de una cadena a 
// mayúsculas (si es alfabético))
Print "<BR><B>Función ucfirst(): convertir el primer carácter a mayúsculas</B><BR>";
// no afecta números y símbolos especiales
$var1 = ucfirst("juan pérez"); //   
print $var1 ."<BR>";  
$var1 = ucfirst("-juan pérez"); // - no es alfabético 
print $var1 ."<BR>";  

// la función ucwords(pcadena)

// convierte el primer carácter de cada palabra de una cadena 
// a mayúsculas (si es alfabético))
Print "<BR><B>Función ucwords(): convertir el primer carácter de cada palabra a mayúsculas</B><BR>";
// no afecta números y símbolos especiales
$var1 = ucwords("juan pérez"); //   
print $var1 ."<BR>";  
$var1 = ucwords("-juan pérez"); // - no es alfabético    
print $var1 ."<BR>";

?>

