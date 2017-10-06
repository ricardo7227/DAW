<?php
print "<B><U>Prácticas con función strncmp() para comparar cadenas (ejemplo file063.php)</U></B><BR>";

function imprimir ($var1,$var2,$var3){
	$var = strncmp($var1,$var2,$var3);
	$l1 = strlen($var1);
	$l2 = strlen($var2);
	if ($var  < 0) 
		print "parámetro 1<B> $var1 </B> de $l1 caracteres es < al parámetro 2 <B> $var2 </B>de $l2 caracteres<BR>";
	if ($var  == 0) 
		print "parámetro 1<B> $var1 </B> de $l1 caracteres es = al parámetro 2 <B> $var2 </B>de $l2 caracteres<BR>";	
	if ($var  > 0) 
		print "parámetro 1<B> $var1 </B> de $l1 caracteres es > al parámetro 2 <B> $var2 </B>de $l2 caracteres<BR>";	


}
// la función strncmp()
Print "<BR><B>Función strncmp(): comparación de dos cadenas de los primeros n caracteres</B><BR>";

// el tercer parámetro es la cantidad de caracteres 
// que se compararán
// Esto dará igual porque compara los 3 primeros
imprimir('abc','abcdef',3); 
imprimir('abc',' abc ',5); // diferentes  
imprimir('ABC','abc',2); // diferencia de mayúsculas y minúsculas

?>
