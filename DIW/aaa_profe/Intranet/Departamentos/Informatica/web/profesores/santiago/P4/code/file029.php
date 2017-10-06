<?php
print "<B><U>Función include(ejemplo file029.php)</U></B><BR>";

  
$var1 = 8;
print "file029.php-> antes de la función include \$var1 es  $var1<BR><BR>";  

include 'file030.php';

print "file029.php-> después de la función include \$var1 es  $var1<BR><BR>";  
print "file029.php-> la variable definida en el cuerpo principal de file030.php \$var3 es  $var3<BR><BR>";  

?> 