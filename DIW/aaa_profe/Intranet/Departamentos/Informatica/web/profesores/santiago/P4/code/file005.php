<?php
// Variable de variable $$ (archivo file005.php)

$var = "uno";  // asigna "uno" a la variable de nombre $var 
$$var = "dos"; // asigna "dos" a la variable de nombre $uno

// $$var significa (en este caso) $uno
print ($var); // produce el texto: "uno" 
print ($uno); // produce el texto: "dos"

?>
 
