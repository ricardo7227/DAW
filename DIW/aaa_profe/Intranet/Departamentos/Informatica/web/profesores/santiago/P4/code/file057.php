<?php
print "<B><U>Inversi�n de matrices array_reverse (ejemplo file057.php)</U></B><BR>";
 
$mat0 = array(4=>"Austria", 8=>"B�lgica", 2=>"Dinamarca", 7=>"Alemania", 9=>"Andorra", 3=>"Espa�a");
print "<BR><BR><B>matriz original</B><BR>";
print_r ($mat0);

print "<BR><BR><B>matriz invertida</B><BR>";
$mat1 = array_reverse($mat0);
print_r ($mat1);

?> 