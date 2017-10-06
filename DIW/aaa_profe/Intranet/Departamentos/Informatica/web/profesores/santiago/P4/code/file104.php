<?php
print "<B><U>Foreach con objetos (ejemplo file104.php)</U></B><BR><BR>";

class Prueba{
	public $prop1 = "valor de propiedad 1";
	public $prop2 = "valor de propiedad 2";
	public $prop3 = "valor de propiedad 3";
}

$obj = new Prueba;

foreach ($obj as $nombre_prop => $valor_prop){
 	print "<B>Propiedad:</B>  " . $nombre_prop . 
      "<B>    Valor:  </B>" . $valor_prop . "<BR>";
}	

?>