<?php
Print "<B>Funciones para tratamiento de directorios (ejemplo file127.php) </B><BR>";

print "<BR><B>1. Extrae el nombre de archivo a partir de una ruta de acceso: función basename()</B><BR>";
$arch = "C:\AppServ\www\PHP6\archivo01.txt";
print "Ruta de acceso: " . $arch . "<BR>";
print "Nombre de archivo: " . basename($arch) . "<BR>";

print "<BR><B>2. Extrae los directorios de una ruta de acceso completa: función dirname()</B><BR>";
print "Ruta de acceso: " . $arch . "<BR>";
print "Nombre de archivo: " . dirname($arch) . "<BR>"; 


print "<BR><B>3. Obtener, crear y cambiar el directorio de trabajo : funciones getcwd(), mkdir() y chdir()</B><BR>";
// directorio actual
print "Directorio vigente: " . getcwd() . "<BR>";
mkdir('nuevodir1',0700); // crea un nuevo directorio nuevodir1
chdir('nuevodir1'); // cambia el director de trabajo vigente
// nuevo directorio actual
print "Nuevo directorio vigente: " . getcwd() . "<BR>";

print "<BR><B>4. Espacio libre en disco: función disk_free_space()</B><BR>";
print "Espacio libre: " . disk_free_space(dirname($arch)) .  " bytes<BR>";


print "<BR><B>5. Espacio total en disco: función disk_total_space()</B><BR>";
print "Espacio libre: " . disk_total_space(dirname($arch)) .  " bytes<BR>"; 

print "<BR><B>6. Obtener el descriptor de un directorio: función opendir()</B><BR>";
print "Descriptor del directorio: " . opendir(dirname($arch)) .  " <BR>";


print "<BR><B>7. Obtener el contenido de un directorio: función readdir() y rewinddir()</B><BR>";
$var = opendir("C:\AppServ\www");
while ($file = readdir($var)) {
       echo "$file <BR>";
}

// rebobina el puntero del directorio y lo pone al principio
rewinddir($var);
// si ahora leemos el directorio
$file = readdir($var); // se lee nuevamente la primera entrada  

?>