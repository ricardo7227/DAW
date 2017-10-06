<?php
print "<B><U>Navegaci�n por las matrices (ejemplo file054.php)</U></B><BR>";
print "<B>funci�n array_walk()</B><BR><BR>";

// matriz asociativa
$mat0 = array("Color"=>"Rojo", "Altura"=>1.80, "Ancho"=>2.50,"Peso"=>127);
 
// funci�n para tratar a todos los elementos
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