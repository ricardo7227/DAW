<?php
print "<B><U>Pr�cticas con funci�n strcmp() para comparar cadenas  (ejemplo file061.php)</U></B><BR>";

function imprimir ($var1,$var2){
	$var3= strcmp($var1,$var2);
	$l1 = strlen($var1);
	$l2 = strlen($var2);
	if ($var3 < 0)
        	print "par�metro 1<B> $var1 </B> de $l1 caracteres es < al 	par�metro 2 <B> $var2 </B>de $l2 caracteres<BR>";
	if ($var3 == 0) 
		print "par�metro 1<B> $var1 </B> de $l1 caracteres es = al par�metro 2 <B> $var2 </B>de $l2 caracteres<BR>";	
	if ($var3 > 0) 
		print "par�metro 1<B> $var1 </B> de $l1 caracteres es > al par�metro 2 <B> $var2 </B>de $l2 caracteres<BR>";	
}

// la funci�n strcmp()
Print "<BR><B>Funci�n strcmp(): diversos casos de comparaci�n de dos cadenas</B><BR>";
imprimir('abc','abc'); // igual
imprimir('abc','abc    '); // es segundo es mayor
imprimir('ABC','abc'); // diferencia de may�sculas y min�sculas
imprimir('1a','1A'); // diferentes

imprimir('  ','    ');// diferentes en la longitud
imprimir('-','!'); // s�mbolos especiales

?>