<?php
Print "<B>Funciones de navegaci�n de archivos (ejemplo file124.php) </B><BR><BR>";

// si no existe el archivo emite una advertencia
// con @ evito el mensaje de advertencia
$arch = "archivo01.txt";
print "<BR><BR><B>1. Lectura de todo el contenido con fgets()</B><BR> ";

// Veamos todo el contenido 
$da = fopen ($arch, "r");
while (!feof($da)) {
    $bufer = fgets($da, 4096);
	print $bufer . "<BR>";
}

// Ahora retrocedemos el posicionamiento del archivo
print "<B>2. Rebobinar con rewind() y se lee una l�nea </B><BR> ";
// rebobina y lee una l�nea
rewind($da);
$var = fgets($da, 4096); 
print "L�nea le�da: <BR> $var <BR>";

print "<BR><B>3. Reposicionar con fseek() y leer un car�cter</B><BR> ";
// ahora se busca la posici�n del car�cter 21 contados a
// a partir de la posici�n vigente (SEEK_CUR)y lee ese car�cter
// las otras opciones son SEEK_END y SEEK_SET
fseek($da,21,SEEK_CUR);
print "El car�cter le�do es la letra l de la palabra lectores: " . fgetc($da) . "<BR>";


print "<BR><B>4. Averiguar la posici�n del puntero con ftell() </B><BR> "; 
// indica la posici�n vigente 

print "La posici�n actual del puntero es:" . ftell($da) . "<BR>";
 
fclose ($da); 
?>