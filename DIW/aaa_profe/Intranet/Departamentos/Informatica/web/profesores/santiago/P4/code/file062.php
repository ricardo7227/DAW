<?php
print "<B><U>Pr�cticas con funci�n strcasecmp() para comparar cadenas  (ejemplo file062.php)</U></B><BR>";

function imprimir ($var1,$var2){
	$var3= strcasecmp($var1,$var2);
	$l1 = strlen($var1);
	$l2 = strlen($var2);
	if ($var3 < 0) 
		print "par�metro 1<B> $var1 </B> de $l1 caracteres es < al par�metro 2 <B> $var2 </B>de $l2 caracteres<BR>";
	if ($var3 == 0) 
		print "par�metro 1<B> $var1 </B> de $l1 caracteres es = al 	par�metro 2 <B> $var2 </B>de $l2 caracteres<BR>";	
	if ($var3 > 0) 
		print "par�metro 1<B> $var1 </B> de $l1 caracteres es > al par�metro 2 <B> $var2 </B>de $l2 caracteres<BR>";	
}

// la funci�n strcasecmp()

Print "<BR><B>Funci�n strcasecmp(): no diferencia entre may�sculas y min�sculas</B><BR>";
Print "comparar con resultados obtenidos antes con strcmp()<BR><BR>";
imprimir('abc','abc'); // son iguales
imprimir('abc','abc    '); // es segundo es m�s largo

// no hace diferencia de may�sculas y min�sculas
imprimir('ABC','abc'); 
imprimir('1a','1A'); // son iguales
imprimir('  ','    ');// son diferentes 
imprimir('-','!'); // s�mbolos especiales

?>