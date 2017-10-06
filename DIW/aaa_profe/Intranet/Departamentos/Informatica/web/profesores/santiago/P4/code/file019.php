<?php
print "<B><U>Sentencia elseif (ejemplo file019.php)</U></B><BR>";
$var1 = 8;

// En este caso la evaluación es Falsa
if ($var1 < 7)
   {
	echo "1. La evaluación fue verdadera<BR>";
   }
elseif ($var1 < 8)
   {
        echo "2. La evaluación es verdadera en el 1er. elseif<BR>";
   }
elseif ($var1 < 9)
   {
        // esta sentencia elseif se evalúa como True
        echo "3. La evaluación es verdadera en el 2do. elseif<BR>";
   } 
   // esta sentencia else if ya no se evaluará
elseif ($var1 < 10)
   {
    echo "4. La evaluación es verdadera en el 3er. elseif<BR>";
   }     
else
   {
    echo "5. La evaluación fue siempre falsa<BR>";
   }
// esta sentencia echo se ejecutará siempre, ya que 
// está fuera del bloque if/elseif/else   
echo "Salió del if";	 
?>