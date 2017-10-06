<?php
print "<B><U>Pr�cticas con funciones para convertir cadenas  (ejemplo file065.php)</U></B><BR>";

// la funci�n bin2hex(pcadena)
// convierte byte a byte una cadena a su representaci�n hexadecimal 
Print "<BR><B>Funci�n bin2hex(): convertir cadenas</B><BR>";
$var1 = bin2hex("1234"); //  debe ser hexadecimal 31 32 33 34
print "cadena:$var1 <BR>";

// la funci�n str_split(pcadena, plong)
// convierte una cadena en una matriz
// corta cada plong caracteres, que por omisi�n es 1
Print "<BR><B>Funci�n str_split(): convertir cadenas a matriz</B><BR>";
$var1 = str_split("abcdefghijk"); 
// asume que cada elemento tiene longitud 1  
print_r ($var1); 

Print "<BR><BR><B>Funci�n str_split(): con par�metro de longitud</B><BR>";
$var1 = str_split("PHP es un lenguaje f�cil",3); 
// cada elemento tiene longitud 3 
print_r ($var1);   

// la funci�n strtolower(pcadena)
// convierte una cadena a todo min�sculas
Print "<BR><BR><B>Funci�n strtolower(): convertir cadenas a min�sculas</B><BR>";
// no afecta n�meros y s�mbolos especiales
$var1 = strtolower("JuanNU�EZ2@COMPUTER.ORG");   
print $var1 ."<BR>";   

// la funci�n strtoupper(pcadena)
// convierte una cadena a todo may�sculas
Print "<BR><B>Funci�n strtolower(): convertir cadenas a may�sculas</B><BR>";
// no afecta n�meros y s�mbolos especiales
$var1 = strtoupper("juannu�ez2@computer.org");     
print $var1 ."<BR>";  

// la funci�n ucfirst(pcadena)
// convierte el primer car�cter de una cadena a 
// may�sculas (si es alfab�tico))
Print "<BR><B>Funci�n ucfirst(): convertir el primer car�cter a may�sculas</B><BR>";
// no afecta n�meros y s�mbolos especiales
$var1 = ucfirst("juan p�rez"); //   
print $var1 ."<BR>";  
$var1 = ucfirst("-juan p�rez"); // - no es alfab�tico 
print $var1 ."<BR>";  

// la funci�n ucwords(pcadena)

// convierte el primer car�cter de cada palabra de una cadena 
// a may�sculas (si es alfab�tico))
Print "<BR><B>Funci�n ucwords(): convertir el primer car�cter de cada palabra a may�sculas</B><BR>";
// no afecta n�meros y s�mbolos especiales
$var1 = ucwords("juan p�rez"); //   
print $var1 ."<BR>";  
$var1 = ucwords("-juan p�rez"); // - no es alfab�tico    
print $var1 ."<BR>";

?>

