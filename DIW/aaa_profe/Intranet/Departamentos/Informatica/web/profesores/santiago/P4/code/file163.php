<?php
// Subdivisión de cadenas con strtok (archivo file163.php)

$cadena = "Esta es-una cadena-de texto- con 4 tokens";

// definimos que el separador es el guión
$token =strtok($cadena,"-");

// ya tenemos el primer elemento en $token
$i = 1;

// el bucle se ejecuta mientras
// haya datos
while ($token) {
    print ("Elemento nro. $i <B> $token </B><BR>");
    $i++;
    // se llama nuevamente a la función strtok()
    // pero sin la cadena que se analiza,
    // sólo con el separador
    $token =strtok("na");
}

?>