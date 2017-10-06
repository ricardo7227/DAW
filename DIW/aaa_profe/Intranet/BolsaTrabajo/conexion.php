<?php
	$cn = mysql_connect("localhost", "phpuser", "phpp@asswd1011") or die("Error en Conexion");
$db=mysql_select_db("basedatos", $cn) or die ("Error en la base de datos");
?>