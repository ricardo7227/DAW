<?php
Print "<B>Funciones de escritura de archivos (ejemplo file125.php) </B><BR><BR>";

print "<BR><BR><B>1. Contenido original del archivo</B><BR> ";

$arch = "archivo01.txt";
$da = fopen ($arch, "r");
while (!feof($da)) {
    $bufer = fgets($da, 4096);
	print $bufer . "<BR>";
}
fclose($da);

print "<BR><BR><B>2. Apertura del archivo con modo para a�adir por el final</B><BR> ";
// Se abre el archivo con modo "a"
$da = fopen ($arch, "a");
$var = fwrite($da, "A�adamos esta l�nea por el final..."); 
print "Se a�adieron $var caracteres por el final. <BR>";
fclose($da);

print "<BR><BR><B>3. Contenido final del archivo</B><BR> ";
$da = fopen ($arch, "r");
while (!feof($da)) {
    $bufer = fgets($da, 4096);
	print $bufer . "<BR>";
}
fclose($da);
 
?>