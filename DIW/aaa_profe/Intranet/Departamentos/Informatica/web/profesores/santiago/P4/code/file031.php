<?php
// Funci�n include(ejemplo file031.php)
 
$var1 = 2; 
// opci�n m�s segura
if ($var1 == 2)
    { 
 	include 'file030.php';
    }
// esta sintaxis podr�a dar problemas
// cuando hay una include
if ($var1 == 3):
 	include 'file030.php';
endif;

?> 