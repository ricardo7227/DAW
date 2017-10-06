<?php
print "<B><U>Sentencia switch (ejemplo file020.php)</U></B><BR>";

print "<BR>Ejemplo 1er.switch<BR>";
$i = 2;
switch ($i) {
     case 0:
         print "i es igual a 0<BR>";
     case 1:
         print "i es igual a 0 o 1<BR>";
     case 2:
         print "i es igual 0, 1 o 2<BR>";
     default:
	 	 print "Sólo un break impediría que se imprima esta línea<BR>"; 	 
}

print "<BR>Ejemplo 2do.switch<BR>";
// Este switch es similar a un if/elseif
$i = 2;
switch ($i) {  
     case 0:
         print "i es igual a 0<BR>";
		 break;
     case 1:
         print "i es igual a 0 o 1<BR>";
		 break;
	 default:
	 	 print "Sólo un break impediría que se imprima esta 

línea<BR>";
} 	 

print "<BR>Ejemplo if idéntico a sentencia switch<BR>";
// este if/elseif es idéntico funcionalmente 
// al switch anterior porque aquél tiene break en todos 
// los casos. Pero si se omitiese algún break el comportamiento
// no sería lógicamente idéntico
if ($i == 0) 
  {
    print "i es igual a 0<BR>";
  }
  elseif ($i == 1)
  {
     print "i es igual a 1<BR>";
  } 	
  else
  {
   	 print "Ambas expresiones fueron falsas<BR>"; 	 
  }
print "fin del ejemplo<BR>"; 

?> 