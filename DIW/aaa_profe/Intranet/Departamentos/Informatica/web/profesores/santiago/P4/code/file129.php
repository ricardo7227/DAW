<?php
Print "<B>Tratamiento de archivos subidos al servidor (ejemplo file129.php) </B><BR><BR>";

print "<BR><B>1. Verifica si se permiten uploads.<BR></B>";

if (!get_cfg_var('file_uploads'))
{
    die ("Para resolver este problema, asignar On a directiva file_uploads de php.ini");
} 
else 
{
    print "TRUE<BR>";
}

print "<BR><B>2. Aquí se cargará el archivo (directiva upload_tmp_dir en php.ini) <BR></B>";
print get_cfg_var('upload_tmp_dir') . "<BR>";
print "(si se quiere modificar cambiar la directiva upload_tmp_dir en php.ini)<BR> "; 

print "<BR><B>3. Límite máximo del tamaño que se puede transferir al servidor<BR></B>";
print get_cfg_var('upload_max_filesize') . "<BR>"; 
print "(si se quiere modificar cambiar la directiva upload_max_filesize)<BR>";

print "<BR><B>4. Verifica si hubo algún error en la subida del archivo >> ".  $_FILES['arch']['error'] . "</B><BR>";

print "<BR><B>5. Éste es el contenido de la superglobal $_FILES <BR></B>"; 
print_r ($_FILES);
print "<BR>";

print "<BR><B>6. Otra verificación de la subida<BR></B>";

if (is_uploaded_file($_FILES['arch']['tmp_name']))
{
    print "OK<BR>";

    // movemos el archivo a otra ubicación
    $destino = "upload.txt";
    if (move_uploaded_file ($_FILES['arch']['tmp_name'],$destino))
   {
	print "Archivo copiado en $destino<BR>";
    } 
} 
else 
{
    echo "carga incorrecta";
}

?>	