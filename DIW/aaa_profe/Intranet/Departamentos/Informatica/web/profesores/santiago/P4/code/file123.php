<?php
Print "<B>Funciones de lectura de archivos (ejemplo file123.php) </B><BR><BR>";

// si no existe el archivo emite una advertencia
// con @ evito el mensaje de advertencia
$arch = "archivo01.txt";
$da = @fopen($arch, "r") 
    or die ("No existe el archivo");
print "<BR><B>1. Ahora se lee todo con fread()</B><BR>";	
// filesize()) entrega la cantidad de caracteres del archivo
// así se lee todo el archivo en una única operación 
 
$lectura = fread ($da, filesize ($arch));

// cierre del archivo
fclose ($da); 

// se imprime todo lo leído
print $lectura . "<BR>";

print "<BR><BR><B>2. Ahora se lee línea por línea con fgets()</B><BR> ";
$da = fopen ($arch, "r");
while (!feof($da)) {
    $bufer = fgets($da, 4096);
    print $bufer . "<BR>";
}
fclose ($da); 

print "<BR><BR><B>3. Ahora se lee carácter a carácter fgetc()</B><BR> ";
$da = fopen ($arch, "r");
while (!feof($da)) {
    $bufer = fgetc($da);
    $var++;

}
print "Contó $var caracteres.";
fclose ($da);

print "<BR><BR><B>4. Ahora se lee todo a una matriz con file()</B><BR> ";
$da = fopen ($arch, "r");
$mat = file($arch);
// cada elemento de la matriz es una línea de texto  
print_r  ($mat);
fclose ($da); 

print "<BR><BR><B>5. Ahora se lee todo y se imprime con readfile()</B><BR>";
$da = fopen ($arch, "r");
readfile($arch);
fclose ($da); 
 
?>