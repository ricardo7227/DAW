<?php
// función extract() (archivo file161.php)

// Esta variable ya existe
// por lo que debe actuar la opción de añadir
// un prefijo (en este caso, bis)
$Car = "Coche";

$miarray = array("Yes" => "Sí",
                 "News"  => "Noticias",
                 "Read"  => "Leer",
                 "Car"   => "Automóvil", 
                 "Paper" => "Papel");

// se utiliza la opción EXTR_PREFIX_SAME
// que añade un prefijo cuando ya existe una
// variable con el mismo nombre que una clave
// de la matriz (en este caso, la variable $Car)

extract($miarray, EXTR_PREFIX_SAME, "bis");

// imprimimos todas las variables
echo "$Yes, $News, $Read, $Car, $Paper, $bis_Car\n";

?> 

