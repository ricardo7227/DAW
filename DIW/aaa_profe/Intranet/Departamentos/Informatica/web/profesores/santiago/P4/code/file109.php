<?php
print "<B><U>Funciones para leer cabeceras HTTP (ejemplo file109.php)</U></B><BR><BR>";

print "<B>1. Matriz devuelta por la función apache_request_headers() o getallheaders()</B><BR>"; 
$cabeceras = apache_request_headers();
// $cabeceras = getallheaders(); // alias de apache_request_headers()

foreach ($cabeceras as $header => $value) {
    echo "$header: $value <br>";
}
print "<BR><B>2. Matriz devuelta por la función apache_response_headers()</B><BR>"; 
$cabeceras = apache_response_headers();

foreach ($cabeceras as $header => $value) {
    echo "$header: $value <br>";
} 

?>