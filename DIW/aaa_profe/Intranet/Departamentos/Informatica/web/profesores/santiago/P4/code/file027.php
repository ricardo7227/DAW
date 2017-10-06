<?php
print "<B><U>Sentencia break (ejemplo file027.php)</U></B><BR>";

// Matriz bidimensional
$mat[0][0] = "1";
$mat[0][1] = "2";
$mat[1][0] = "3";
$mat[1][1] = "4";

print "<BR>ejemplo con break 3<BR>";
// estructura de control de nivel 1
foreach($mat as $var1) {

    print "foreach 1 : $var1<BR>";
	// estructura de control de nivel 2
    foreach ($var1 as $var2) {
		if ($var2 == "2"):
			// se provoca un error porque no hay 3 niveles
			// sólo 2
                        			break 3;
		endif; 
       	print "foreach 2: $var2<BR>";
     }
}
?> 