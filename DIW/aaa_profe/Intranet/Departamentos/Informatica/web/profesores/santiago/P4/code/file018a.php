<?php
print "<B><U>Sentencia if (ejemplo file018a.php)</U></B><BR>";
$var1 = 3;
$var2 = 4.5;


// En este caso la evaluaci�n es True
if ($var1 == 3)
{
	echo "1. La evaluaci�n fue verdadera<BR>";
}

// En este caso la evaluaci�n es True
// se utiliza una expresi�n compuesta
if (($var1 == 3) and ($var1 >= $var2 or $var2 > 4.4))
{
	echo "2. La evaluaci�n fue verdadera<BR>";
}

// En este caso la evaluaci�n es False
// pero como se usa el operador ! False se
// transforma en True y por lo tanto
// se ejecuta la sentencia interna al if
if (!(($var2 > 10) or ($var1 == 3 and $var1 >= $var2)))
{
	echo "3. La evaluaci�n fue verdadera<BR>";
}
?>