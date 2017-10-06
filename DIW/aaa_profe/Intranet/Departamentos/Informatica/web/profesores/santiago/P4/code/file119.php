<?php
// archivo file119.php

session_start();
$fechahora = "�ste es el primer acceso";
$contador = 1;
if (isset($_SESSION['fechahora'])){
	// fecha hora del �ltimo acceso
	$fechahora = $_SESSION['fechahora'];
	$contador = $_SESSION['contador'];
}

// si la variable est� asignada quiere decir que 
// existe la variable de sesi�n

// actualizaci�n de la variable de sesi�n
// esta operaci�n se debe hacer antes de
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
	echo "Identificador de la sesi�n: " . session_id() . "<BR>";
	echo "Nombre de la sesi�n: " . session_name() . "<BR>";
	echo "Elemento fechahora: " . $_SESSION['fechahora'] . "<BR>" ;
        echo "Elemento contador: " . $_SESSION['contador'] . "<BR><BR>" ;
	echo "<BR>La �ltima vez que accedi� a esta p�gina fue : $fechahora <BR>"; 
        echo "<BR>Cantidad de accesos a esta p�gina  : $contador <BR>"; 
    ?> 
    </BODY>
</HTML>
