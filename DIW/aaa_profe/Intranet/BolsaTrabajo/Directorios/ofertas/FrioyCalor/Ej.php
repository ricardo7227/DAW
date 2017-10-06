
<h1>Listado de archivo</h1>
 
<ul>
<?php
//ruta a la carpeta, '.' es carpeta actual
$path=".";
$no_mostrar=Array("","php");
$dir_handle = @opendir($path) or die("No se pudo abrir $path");
while ($file = readdir($dir_handle)) {
 $pos=strrpos($file,".");
 $extension=substr($file,$pos);
 if (!in_array($extension, $no_mostrar)) {
 echo "<li><a href=\"$file\" id=\"enlace_$file\" title=\"$file\">$file</a></li>";
 }
 if (is_dir($ruta . $file) && $file!="." && $file!=".."){ 
               //solo si el archivo es un directorio, distinto que "." y ".." 
               echo "<br>Directorio: $ruta$file"; 
               listar_directorios_ruta($ruta . $file . "/"); 
            } 
 
}
closedir($dir_handle);
?>
</ul>