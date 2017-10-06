<?php
print "<B><U>Sentencia foreach (ejemplo file024.php)</U></B><BR>";

print "<BR>Primer ejemplo de foreach<BR>";
$matriz1 = array("PHP 3", "PHP 4", "PHP 5", "PHP 6");
foreach ($matriz1 as $var1) {
    print "Elemento de matriz 1: $var1<br>";
}

print "<BR>Segundo ejemplo de foreach<BR>";
$matriz2["PHP 3"] = 1998;
$matriz2["PHP 4"] = 2000;
$matriz2["PHP 5"] = 2004;
$matriz2["PHP 6"] = 2010;
foreach ($matriz2 as $clave => $var1) {
    print "Elemento de matriz 2: clave  $clave año  $var1<br>";
}
 
?> 