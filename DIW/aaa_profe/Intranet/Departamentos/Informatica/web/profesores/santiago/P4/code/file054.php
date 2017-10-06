<?php
print "<B><U>Navegación por las matrices (ejemplo file054.php)</U></B><BR>";
print "<B>función array_walk()</B><BR><BR>";

// matriz asociativa
$mat0 = array("Color"=>"Rojo", "Altura"=>1.80, "Ancho"=>2.50,"Peso"=>127);
 
// función para tratar a todos los elementos
function tratar ($valor, $clave, $dato) {
   switch ($clave){
   
	case "Color":
		$valor = "color $valor";
		break;
	case "Altura":
		$valor = "alto $valor metros";
		break;
	case "Ancho":
		$valor = "ancho $valor metros";
		break;
	case "Peso":
		$valor = "peso $valor kilos";
		break;
	default:
		$valor = "$valor $dato";
	}	
	print $valor . "<BR>";				
}

@array_walk($mat0,'tratar','clave no esperada');
?>