<?php
// Impresión de matrices (archivo file162.php)

$miarray = array("Yes" => "Sí",
                 "News"  => "Noticias",
                 "Paper" => "Papel");

print "<B>Impresión con print_r()</B><BR><BR>";
print_r($miarray);

print "<BR><BR><B>Impresión con var_dump()</B><BR><BR>";
var_dump($miarray);
?>