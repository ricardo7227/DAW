<?php
print "<B><U>Pr�cticas con funciones para cadenas (ejemplo file058.php)</U></B><BR>";

// ejemplo de sentencia echo
print "<BR><B>Sentencia echo</B><BR>";  
echo "Ya hemos utilizado la sentencia echo varias veces<BR>";

print "<BR><B>Funci�n print</B><BR>";  
print "Tambi�n ya hemos utilizado la funci�n print varias veces<BR>";

print "<BR><B>Funci�n printf</B><BR>";
// cada formato % se corresponde con una cadena
$temp = 15.25;
$hora = 9;
$min = 45;

printf ("%s %.2d %s %02dh %02dm<BR>","temperatura ",$temp, "grados a las ", $hora, $min);  
$c = 120;
print ("<BR>El n�mero 120 visto en diferentes formatos<BR>");
printf ("Dec:%d <BR>Bin:%b <BR>Oct:%o <BR>Hex:%x <BR>Car:%c<BR>", $c, $c, $c, $c, $c, $c);

printf ("-Atenci�n redondeos: La deuda es de %3.1f euros<BR>", 219.97);
printf ("-No hay truncamientos: La deuda es de %0.1f euros<BR>", -777219.97);

print "<BR><B>Funci�n sprintf</B><BR>";
// cada formato % se corresponde con una cadena
$d�a = 15;
$mes = 11;
$a�o = 2009;  
$var1 = sprintf ("%s %02d/%02d/%04d<BR>","fecha ",$d�a, $mes, $a�o);  
echo $var1;

print "<BR><B>Funci�n vprintf</B><BR>";
$mat1 = array("fecha",15, 11, 2009);
vprintf ("%s %02d/%02d/%04d<BR>",$mat1);  
?>  