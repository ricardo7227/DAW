<?php
print "<B><U>Ordenamiento de matrices (ejemplo file056.php)</U></B><BR>";
 
$mat0 = array(4=>"Austria", 8=>"Bélgica", 2=>"Dinamarca", 7=>"Alemania", 9=>"Andorra", 3=>"España");
print "<BR><BR><B>matriz original</B><BR>";
print_r ($mat0);

print "<BR><BR><B>por valores de menor a mayor sin mantener claves (sort)</B><BR>";
sort($mat0); 
print_r ($mat0);


print "<BR><BR><B>por valores de mayor a menor sin mantener claves (rsort)</B><BR>";
rsort($mat0); 
print_r ($mat0);

// redefinimos la matriz para ver cómo se respetan las claves
$mat0 = array(4=>"Austria", 8=>"Bélgica", 2=>"Dinamarca", 7=>"Alemania", 9=>"Andorra", 3=>"España");
print "<BR><BR><B>por valores de menor a mayor preservando claves (asort)</B><BR>";
asort($mat0); 
print_r ($mat0);

print "<BR><BR><B>por valores de mayor a menor preservando claves (arsort)</B><BR>";
arsort($mat0); 
print_r ($mat0);

// redefinimos la matriz para ver cómo se respetan las claves
$mat0 = array(4=>"Austria", 8=>"Bélgica", 2=>"Dinamarca", 7=>"Alemania", 9=>"Andorra", 3=>"España");
print "<BR><BR><B>por claves de menor a mayor (ksort)</B><BR>";
ksort($mat0); 
print_r ($mat0);

print "<BR><BR><B>por claves de mayor a menor (krsort)</B><BR>";
krsort($mat0); 
print_r ($mat0);

print "<BR><BR><B>uso de una función de usuario (usort)</B><BR>";
// ejemplo de una función de usuario
$mat0 = array(4=>"Austria", 8=>"Bélgica", 2=>"Dinamarca", 7=>"Alemania", 9=>"Andorra", 3=>"España");
function sortusuario ($ele1, $ele2) {
	// retorno -1: $ele1 es menor que $ele2
	// retorno 0: ambos elementos son iguales
	// retorno 1: $ele1 es mayor que $ele2
	// la función fuerza que el elemento España sea 
   // siempre el primero de la matriz   
    if ($ele1 == "España") return -1;
	if ($ele1 == $ele2) return 0;
            return ($ele1 > $ele2) ? -1 : 1;
}
usort ($mat0, sortusuario);
print_r ($mat0);
 

?> 