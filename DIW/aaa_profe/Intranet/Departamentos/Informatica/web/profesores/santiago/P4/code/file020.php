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
	 	 print "S�lo un break impedir�a que se imprima esta l�nea<BR>"; 	 
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
	 	 print "S�lo un break impedir�a que se imprima esta 

l�nea<BR>";
} 	 

print "<BR>Ejemplo if id�ntico a sentencia switch<BR>";
// este if/elseif es id�ntico funcionalmente 
// al switch anterior porque aqu�l tiene break en todos 
// los casos. Pero si se omitiese alg�n break el comportamiento
// no ser�a l�gicamente id�ntico
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