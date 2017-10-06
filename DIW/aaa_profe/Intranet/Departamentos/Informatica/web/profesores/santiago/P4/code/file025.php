<?php
print "<B><U>Estructuras de control anidadas (ejemplo file025.php)</U></B><BR>";

// Matriz tridimensional
$mat[0][0][0] = "1";
$mat[0][0][1] = "2";
$mat[0][1][0] = "3";
$mat[0][1][1] = "4";
$mat[1][0][0] = "5";
$mat[1][0][1] = "6";
$mat[1][1][0] = "7";
$mat[1][1][1] = "8";

// estructura de control de nivel 1
foreach($mat as $var1) {
    print "foreach 1 : $var1<BR>";
	// estructura de control de nivel 2
    foreach ($var1 as $var2) {
        print "foreach 2: $var2<BR>";
        			// estructura de control de nivel 3
		    foreach ($var2 as $var3) {
       			 print "foreach 3: $var3<BR>";
    	}
    }
}
?> 