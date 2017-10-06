<?php
// función compact() (archivo file160.php)

$var1 = "Hola";
$var2 = 1200;
$var3 = "test";
$esta_si = "XXX";

// cuando la variable no existe la función no genera
// el elemento en la matriz resultante

$nuevo_array = compact("var1", "var2", "var", "esta_no_existe", "esta_si");

var_dump($nuevo_array);

?>