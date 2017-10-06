<?php
print "<B><U>Uso de la función array_push() (ejemplo file045.php)</U></B><BR><BR>";

// incremento del tamaño de una matriz
$mat1 = array("Alemania", "Austria","Bélgica","Dinamarca","España");
print "<BR>Contenido inicial de la matriz: cantidad de elementos :" . $var1 . "<BR><BR>";
print_r ($mat1);

// se añadieron dos elementos
$var1 = array_push ($mat1,"Francia","Grecia");
print "<BR>La función array_push() añade elementos por el final de la matriz y <BR> devuelve la nueva cantidad de elementos ($var1)<BR>";

 
print "<BR>Contenido actual de la matriz: cantidad de elementos :" . $var1 . "<BR><BR>";
print_r ($mat1); 

?>