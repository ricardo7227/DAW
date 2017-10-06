<?php
print "<B><U>Prácticas con función strcasecmp() para comparar cadenas  (ejemplo file062.php)</U></B><BR>";

function imprimir ($var1,$var2){
	$var3= strcasecmp($var1,$var2);
	$l1 = strlen($var1);
	$l2 = strlen($var2);
	if ($var3 < 0) 
		print "parámetro 1<B> $var1 </B> de $l1 caracteres es < al parámetro 2 <B> $var2 </B>de $l2 caracteres<BR>";
	if ($var3 == 0) 
		print "parámetro 1<B> $var1 </B> de $l1 caracteres es = al 	parámetro 2 <B> $var2 </B>de $l2 caracteres<BR>";	
	if ($var3 > 0) 
		print "parámetro 1<B> $var1 </B> de $l1 caracteres es > al parámetro 2 <B> $var2 </B>de $l2 caracteres<BR>";	
}

// la función strcasecmp()

Print "<BR><B>Función strcasecmp(): no diferencia entre mayúsculas y minúsculas</B><BR>";
Print "comparar con resultados obtenidos antes con strcmp()<BR><BR>";
imprimir('abc','abc'); // son iguales
imprimir('abc','abc    '); // es segundo es más largo

// no hace diferencia de mayúsculas y minúsculas
imprimir('ABC','abc'); 
imprimir('1a','1A'); // son iguales
imprimir('  ','    ');// son diferentes 
imprimir('-','!'); // símbolos especiales

?>