<?php
// archivo file119.php

session_start();
$fechahora = "éste es el primer acceso";
$contador = 1;
if (isset($_SESSION['fechahora'])){
	// fecha hora del último acceso
	$fechahora = $_SESSION['fechahora'];
	$contador = $_SESSION['contador'];
}

// si la variable está asignada quiere decir que 
// existe la variable de sesión

// actualización de la variable de sesión
// esta operación se debe hacer antes de
// mandar cualquier cabecera a la salida
date_default_timezone_set('Europe/Paris');

$_SESSION["fechahora"] = date('d/m/Y h:i:s'); // actualiza la variable
$contador++;

$_SESSION["contador"] = $contador; // actualiza la variable	
?>
<HTML>
    <HEAD>
    	<TITLE>Uso de sesiones en PHP (ejemplo c1002.php)</TITLE>
    </HEAD>
    <BODY>
    <H3>Fecha y hora actual: <?php echo date('d/m/Y h:i:s') ?></H3><BR><B>
 	Contenido de la superglobal $_SESSION</B><BR>
    <?php 
	echo "Identificador de la sesión: " . session_id() . "<BR>";
	echo "Nombre de la sesión: " . session_name() . "<BR>";
	echo "Elemento fechahora: " . $_SESSION['fechahora'] . "<BR>" ;
        echo "Elemento contador: " . $_SESSION['contador'] . "<BR><BR>" ;
	echo "<BR>La última vez que accedió a esta página fue : $fechahora <BR>"; 
        echo "<BR>Cantidad de accesos a esta página  : $contador <BR>"; 
    ?> 
    </BODY>
</HTML>
