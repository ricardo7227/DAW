<?php
Print "<B>Funciones para tratamiento de archivos (ejemplo file126.php) </B><BR>";

print "<BR><B>1. Copia de un archivo funci�n copy()</B><BR>";
$arch = "archivo01.txt";
if (!copy($arch, $arch . ".bak")) {
    print("error en la copia del archivo $arch...<br>");
} 

print "<BR><B>2. Fecha y hora de �ltima modificaci�n: funci�n filemtime()</B><BR>";
print "�ltima modificaci�n: " . filemtime($arch) . "<BR>";   

print "<BR><B>3. Existe el directorio funci�n: is_dir()</B><BR>";
$dir = "c:\Mis Documentos";
if (is_dir($dir)) {
    print("Existe el directorio $dir...<br>");
}

print "<BR><B>4. Verifica si es un ejecutable funci�n: is_executable()</B><BR>";
if (!is_executable($arch)) {
    print("$arch... no es un ejecutable <br>");
}

print "<BR><B>5. Verifica si es un archivo normal: funci�n is_file()</B><BR>";
if (is_file($arch)) {
    print("$arch... es un archivo normal<br>");
}

print "<BR><B>6. Verifica si es un archivo con permiso de lectura: funci�n is_readable()</B><BR>";
if (is_readable($arch)) {
    print("$arch... es un archivo con permiso de lectura<br>");
} 

print "<BR><B>7. Verifica si es un archivo con permiso de escritura: funci�n is_writeable()</B><BR>";
if (is_writeable($arch)) {
    print("$arch... es un archivo con permiso de escritura<br>");
} 


print "<BR><B>8. Cambio de nombre de un archivo: funci�n rename()</B><BR>";
rename($arch . ".bak", "copias2.txt");
 
print "<BR><B>9. Crea un temporal: funci�n tempnam()</B><BR>";
$var = tempnam("c:\Mis Documentos", "tes");
print "Archivo creado:  $var <BR>";

print "<BR><B>10. Actualiza fecha y hora de modificaci�n: funci�n touch()</B><BR>";
$var = touch($arch);
 
print "<BR><B>11. Borrado de archivo: funci�n unlink()</B><BR>";
$var = unlink("copias2.txt");
  
?>