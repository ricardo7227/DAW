<?php
print "<B><U>Uso de la funci�n array_push() (ejemplo file045.php)</U></B><BR><BR>";

// incremento del tama�o de una matriz
$mat1 = array("Alemania", "Austria","B�lgica","Dinamarca","Espa�a");
print "<BR>Contenido inicial de la matriz: cantidad de elementos :" . $var1 . "<BR><BR>";
print_r ($mat1);

// se a�adieron dos elementos
$var1 = array_push ($mat1,"Francia","Grecia");
print "<BR>La funci�n array_push() a�ade elementos por el final de la matriz y <BR> devuelve la nueva cantidad de elementos ($var1)<BR>";

 
print "<BR>Contenido actual de la matriz: cantidad de elementos :" . $var1 . "<BR><BR>";
print_r ($mat1); 

?>