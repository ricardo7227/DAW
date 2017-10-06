<?php
Print "<B>Funciones para tratamiento de archivos (ejemplo file126.php) </B><BR>";

print "<BR><B>1. Copia de un archivo función copy()</B><BR>";
$arch = "archivo01.txt";
if (!copy($arch, $arch . ".bak")) {
    print("error en la copia del archivo $arch...<br>");
} 

print "<BR><B>2. Fecha y hora de última modificación: función filemtime()</B><BR>";
print "Última modificación: " . filemtime($arch) . "<BR>";   

print "<BR><B>3. Existe el directorio función: is_dir()</B><BR>";
$dir = "c:\Mis Documentos";
if (is_dir($dir)) {
    print("Existe el directorio $dir...<br>");
}

print "<BR><B>4. Verifica si es un ejecutable función: is_executable()</B><BR>";
if (!is_executable($arch)) {
    print("$arch... no es un ejecutable <br>");
}

print "<BR><B>5. Verifica si es un archivo normal: función is_file()</B><BR>";
if (is_file($arch)) {
    print("$arch... es un archivo normal<br>");
}

print "<BR><B>6. Verifica si es un archivo con permiso de lectura: función is_readable()</B><BR>";
if (is_readable($arch)) {
    print("$arch... es un archivo con permiso de lectura<br>");
} 

print "<BR><B>7. Verifica si es un archivo con permiso de escritura: función is_writeable()</B><BR>";
if (is_writeable($arch)) {
    print("$arch... es un archivo con permiso de escritura<br>");
} 


print "<BR><B>8. Cambio de nombre de un archivo: función rename()</B><BR>";
rename($arch . ".bak", "copias2.txt");
 
print "<BR><B>9. Crea un temporal: función tempnam()</B><BR>";
$var = tempnam("c:\Mis Documentos", "tes");
print "Archivo creado:  $var <BR>";

print "<BR><B>10. Actualiza fecha y hora de modificación: función touch()</B><BR>";
$var = touch($arch);
 
print "<BR><B>11. Borrado de archivo: función unlink()</B><BR>";
$var = unlink("copias2.txt");
  
?>