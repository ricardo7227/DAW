<?php
// archivo file120.php

// se indica el inicio de la sesión
// o continúa utilizando una sesión ya iniciada
session_start();
date_default_timezone_set('Europe/Paris');
$fechahora = "éste es el primer acceso";
$contador = 1;
if (isset($_SESSION['fechahora'])){
	// fecha hora del último acceso
	$fechahora = $_SESSION['fechahora'];
	$contador = $_SESSION['contador'];
    }

// si la variable ($_SESSION['fechahora']) está asignada    
// quiere decir que existe la sesión

// actualización de la variable de sesión
$_SESSION["fechahora"] = date('d/m/Y h:i:s'); // actualiza la variable
$contador++;	
$_SESSION["contador"] = $contador; // actualiza la variable

// eliminación de un elemento de la matriz de $_SERVER
unset($_SESSION["contador"]);
?>
<HTML>
    <HEAD>
	<TITLE>Uso de sesiones en PHP (ejemplo file120.php)</TITLE>
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