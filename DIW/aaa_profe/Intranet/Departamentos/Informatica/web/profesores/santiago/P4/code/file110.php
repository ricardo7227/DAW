<?php
// archivo file110.php
// uso de la funci�n header

// Enviaremos un documento Word que est�
// en la misma carpeta que el script file110.php
header('Content-type: application/word');

// Aparecer� un cuadro de di�logo que permite
// abrir el archivo con la aplicai�n indicada
// abrir el archivo con otra aplicaci�n a elegir
// guardar el archivo en disco local
header('Content-Disposition: attachment; filename="test.rtf"');

// Se lee el archivo
readfile('test.rtf');
?>