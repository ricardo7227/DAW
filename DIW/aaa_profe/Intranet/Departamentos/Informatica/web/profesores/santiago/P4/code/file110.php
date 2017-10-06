<?php
// archivo file110.php
// uso de la función header

// Enviaremos un documento Word que está
// en la misma carpeta que el script file110.php
header('Content-type: application/word');

// Aparecerá un cuadro de diálogo que permite
// abrir el archivo con la aplicaión indicada
// abrir el archivo con otra aplicación a elegir
// guardar el archivo en disco local
header('Content-Disposition: attachment; filename="test.rtf"');

// Se lee el archivo
readfile('test.rtf');
?>