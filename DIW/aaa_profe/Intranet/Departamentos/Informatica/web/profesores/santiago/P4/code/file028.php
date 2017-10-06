<?php
print "<B><U>Sentencia continue (ejemplo file028.php)</U></B><BR>";

// Matriz bidimensional
$mat[0][0] = "1";
$mat[0][1] = "2";
$mat[1][0] = "3";
$mat[1][1] = "4";

print "<BR>ejemplo con continue<BR>";
// estructura de control de nivel 1
foreach($mat as $var1) {
    print "foreach 1 : $var1<BR>";
	// estructura de control de nivel 2
    foreach ($var1 as $var2) {
		if ($var2 == "1"):
			print "abandono de la iteración pero continua con el siguiente<BR>";
			continue 2;
                    		endif; 
       	print "foreach 2: $var2<BR>";
     }
}
print "<BR>el mismo ejemplo pero con break<BR>";
// estructura de control de nivel 1
foreach($mat as $var1) {
    print "foreach 1 : $var1<BR>";
	// estructura de control de nivel 2
    foreach ($var1 as $var2) {
		if ($var2 == "1"):
		    print "abandono del bucle<BR>";
			break 2;
		endif;
                       	print "foreach 2: $var2<BR>";
     }
}
?> 