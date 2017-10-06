<?php
// Función include(ejemplo file030.php) 
function xx()
{
if (empty($var1)):
	print "file030.php->  \$var1 no es visible dentro de la función xx<BR>";
endif;	 
 
$var2 = "Esta variable se definió en la función";

}
xx();
if (empty($var2)):
	// no se espera otra cosa, pero para comprobar que se mantienen
	// todas las reglas de ámbito hacemos esta comprobación
        	print "file030.php->  \$var2 no es visible dentro del código principal<BR>";
endif;	
if (!empty($var1)):
	// no se espera otra cosa, pero para comprobar que se mantienen
	// todas las reglas de ámbito hacemos esta comprobación
	// $var1 fue definida en el archivo llamante 
        // pero sigue siendo visible
	// sin necesidad de indicar globals
	print "file030.php->  \$var1 es visible dentro del código principal<BR>";
endif;
print "<BR>file030.php-> En el archivo file030.php (include) se sumará 1 a \$var1<BR>"; 
$var1++;
$var3 = 99;

?> 