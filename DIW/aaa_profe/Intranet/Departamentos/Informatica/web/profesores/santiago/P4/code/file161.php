<?php
// funci�n extract() (archivo file161.php)

// Esta variable ya existe
// por lo que debe actuar la opci�n de a�adir
// un prefijo (en este caso, bis)
$Car = "Coche";

$miarray = array("Yes" => "S�",
                 "News"  => "Noticias",
                 "Read"  => "Leer",
                 "Car"   => "Autom�vil", 
                 "Paper" => "Papel");

// se utiliza la opci�n EXTR_PREFIX_SAME
// que a�ade un prefijo cuando ya existe una
// variable con el mismo nombre que una clave
// de la matriz (en este caso, la variable $Car)

extract($miarray, EXTR_PREFIX_SAME, "bis");

// imprimimos todas las variables
echo "$Yes, $News, $Read, $Car, $Paper, $bis_Car\n";

?> 

