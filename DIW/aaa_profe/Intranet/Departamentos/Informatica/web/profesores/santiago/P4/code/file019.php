<?php
print "<B><U>Sentencia elseif (ejemplo file019.php)</U></B><BR>";
$var1 = 8;

// En este caso la evaluaci�n es Falsa
if ($var1 < 7)
   {
	echo "1. La evaluaci�n fue verdadera<BR>";
   }
elseif ($var1 < 8)
   {
        echo "2. La evaluaci�n es verdadera en el 1er. elseif<BR>";
   }
elseif ($var1 < 9)
   {
        // esta sentencia elseif se eval�a como True
        echo "3. La evaluaci�n es verdadera en el 2do. elseif<BR>";
   } 
   // esta sentencia else if ya no se evaluar�
elseif ($var1 < 10)
   {
    echo "4. La evaluaci�n es verdadera en el 3er. elseif<BR>";
   }     
else
   {
    echo "5. La evaluaci�n fue siempre falsa<BR>";
   }
// esta sentencia echo se ejecutar� siempre, ya que 
// est� fuera del bloque if/elseif/else   
echo "Sali� del if";	 
?>