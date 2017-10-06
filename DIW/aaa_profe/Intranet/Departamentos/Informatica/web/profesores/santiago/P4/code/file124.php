<?php
Print "<B>Funciones de navegación de archivos (ejemplo file124.php) </B><BR><BR>";

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
print "<B>2. Rebobinar con rewind() y se lee una línea </B><BR> ";
// rebobina y lee una línea
rewind($da);
$var = fgets($da, 4096); 
print "Línea leída: <BR> $var <BR>";

print "<BR><B>3. Reposicionar con fseek() y leer un carácter</B><BR> ";
// ahora se busca la posición del carácter 21 contados a
// a partir de la posición vigente (SEEK_CUR)y lee ese carácter
// las otras opciones son SEEK_END y SEEK_SET
fseek($da,21,SEEK_CUR);
print "El carácter leído es la letra l de la palabra lectores: " . fgetc($da) . "<BR>";


print "<BR><B>4. Averiguar la posición del puntero con ftell() </B><BR> "; 
// indica la posición vigente 

print "La posición actual del puntero es:" . ftell($da) . "<BR>";
 
fclose ($da); 
?>