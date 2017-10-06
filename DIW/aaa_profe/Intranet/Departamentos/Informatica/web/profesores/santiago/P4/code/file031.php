<?php
// Función include(ejemplo file031.php)
 
$var1 = 2; 
// opción más segura
if ($var1 == 2)
    { 
 	include 'file030.php';
    }
// esta sintaxis podría dar problemas
// cuando hay una include
if ($var1 == 3):
 	include 'file030.php';
endif;

?> 