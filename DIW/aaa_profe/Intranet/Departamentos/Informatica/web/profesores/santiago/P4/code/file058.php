<?php
print "<B><U>Prácticas con funciones para cadenas (ejemplo file058.php)</U></B><BR>";

// ejemplo de sentencia echo
print "<BR><B>Sentencia echo</B><BR>";  
echo "Ya hemos utilizado la sentencia echo varias veces<BR>";

print "<BR><B>Función print</B><BR>";  
print "También ya hemos utilizado la función print varias veces<BR>";

print "<BR><B>Función printf</B><BR>";
// cada formato % se corresponde con una cadena
$temp = 15.25;
$hora = 9;
$min = 45;

printf ("%s %.2d %s %02dh %02dm<BR>","temperatura ",$temp, "grados a las ", $hora, $min);  
$c = 120;
print ("<BR>El número 120 visto en diferentes formatos<BR>");
printf ("Dec:%d <BR>Bin:%b <BR>Oct:%o <BR>Hex:%x <BR>Car:%c<BR>", $c, $c, $c, $c, $c, $c);

printf ("-Atención redondeos: La deuda es de %3.1f euros<BR>", 219.97);
printf ("-No hay truncamientos: La deuda es de %0.1f euros<BR>", -777219.97);

print "<BR><B>Función sprintf</B><BR>";
// cada formato % se corresponde con una cadena
$día = 15;
$mes = 11;
$año = 2009;  
$var1 = sprintf ("%s %02d/%02d/%04d<BR>","fecha ",$día, $mes, $año);  
echo $var1;

print "<BR><B>Función vprintf</B><BR>";
$mat1 = array("fecha",15, 11, 2009);
vprintf ("%s %02d/%02d/%04d<BR>",$mat1);  
?>  