<?php
print "<B><U>Pr�cticas con funci�n strncmp() para comparar cadenas (ejemplo file063.php)</U></B><BR>";

function imprimir ($var1,$var2,$var3){
	$var = strncmp($var1,$var2,$var3);
	$l1 = strlen($var1);
	$l2 = strlen($var2);
	if ($var  < 0) 
		print "par�metro 1<B> $var1 </B> de $l1 caracteres es < al par�metro 2 <B> $var2 </B>de $l2 caracteres<BR>";
	if ($var  == 0) 
		print "par�metro 1<B> $var1 </B> de $l1 caracteres es = al par�metro 2 <B> $var2 </B>de $l2 caracteres<BR>";	
	if ($var  > 0) 
		print "par�metro 1<B> $var1 </B> de $l1 caracteres es > al par�metro 2 <B> $var2 </B>de $l2 caracteres<BR>";	


}
// la funci�n strncmp()
Print "<BR><B>Funci�n strncmp(): comparaci�n de dos cadenas de los primeros n caracteres</B><BR>";

// el tercer par�metro es la cantidad de caracteres 
// que se comparar�n
// Esto dar� igual porque compara los 3 primeros
imprimir('abc','abcdef',3); 
imprimir('abc',' abc ',5); // diferentes  
imprimir('ABC','abc',2); // diferencia de may�sculas y min�sculas

?>
