<?php
// Subdivisi�n de cadenas con strtok (archivo file163.php)

$cadena = "Esta es-una cadena-de texto- con 4 tokens";

// definimos que el separador es el gui�n
$token =strtok($cadena,"-");

// ya tenemos el primer elemento en $token
$i = 1;

// el bucle se ejecuta mientras
// haya datos
while ($token) {
    print ("Elemento nro. $i <B> $token </B><BR>");
    $i++;
    // se llama nuevamente a la funci�n strtok()
    // pero sin la cadena que se analiza,
    // s�lo con el separador
    $token =strtok("na");
}

?>