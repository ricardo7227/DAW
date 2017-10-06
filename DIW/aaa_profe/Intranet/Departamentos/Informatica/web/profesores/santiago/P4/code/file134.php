<?php
print "Navegaci�n por directorios con funci�n recursiva (ejemplo file134.php)<BR><BR>";

// Atenci�n: si utilizamos un directorio con muchos archivos y carpetas
// el tiempo de proceso puede exceder el tiempo m�ximo de proceso
// permitido para resolver la p�gina

$dir    = 'C:\\ATI';
navegarDir($dir);
 

// funci�n que se usa de modo recursivo
// cada vez que se encuentra un subdirectorio
// se realiza una nueva llamada a la funcion
// navegaDir()
function navegarDir($dir) {
    static $mat = array();
    $files = scandir($dir);
    $sumafil = $sumadir = 0;file: 
    foreach($files as $value){
        if ($value == "." | $value == "..")
            continue;
        
        // rearmamos la ruta de acceso completa
        $path = $dir . "\\" . $value;
        
        // si es un directorio, lo
        // analizamos
        if (is_dir($path)) 
            $sumadir += navegarDir($path);
            
        // si es un archivo se suma su espacio
        // (es el espacio realmente ocupado en disco
        // puede estar comprimido)
        if (is_file($path)) 
            $sumafil += filesize($path);
    }
    
    print "<B>$dir </B><BR>";
    $format = "archivos: %d KB  (acumulado en  subdirectorios: %d KB)<BR>";    
    printf($format, $sumafil/1024 , $sumadir/1024);
           
    // este valor acumula todo el espacio ocupado
    // por los archivos del directorio m�s
    // todos los archivos de todos sus subdirectorios
    // total acumulado del directorio 
    $totdir =  $sumadir + $sumafil;
    return $totdir;
}
?> 
