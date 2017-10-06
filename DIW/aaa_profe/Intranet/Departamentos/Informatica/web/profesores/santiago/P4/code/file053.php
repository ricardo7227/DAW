<?php
print "<B><U>Navegaci�n por las matrices (ejemplo file053.php)</U></B><BR>";
print "<B>funciones reset, next, prev, end, current, key, each</B><BR><BR>";
// matriz asociativa
$mat0 = array("Color"=>"Rojo", "Altura"=>1.80, "Ancho"=>2.50,"Peso"=>127);
// fuerza el posicionamiento al inicio de la matriz
// (en este caso ser�a innecesario)
reset($mat0);
print "<B>Atributos: </B><BR>";
print  key($mat0). "<BR>";
// next() devuelve False al llegar al �ltimo elemento)
while (next($mat0))
	print key($mat0). "<BR>";
	
// posicionarse en el final de la matriz	

end($mat0);	
print "<BR><B>Valores en orden inverso: </B><BR>";
print  current($mat0). "<BR>";
// navegaci�n hacia atr�s
// prev devuelve false al llegar al principio del archivo
while (prev($mat0))
	print current($mat0). "<BR>";

// vuelve a posicionar el punterno interno de la matriz	
reset($mat0);

print "<BR><B>Navegaci�n con each(): </B><BR>";
// each() devuelve una matriz de cuatro elemento por cada
// elemento de la matriz $mat0 
// en el elemento 0 est� la clave
// en el elemento 1 est� el valor
// $temp es una matriz temporal
while ($temp = each($mat0)) 
	print $temp[0]. " : ". $temp[1] . "<BR>";
?>