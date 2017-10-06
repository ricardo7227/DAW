<?php
// archivo file118.php
$fechahora = "�ste es el primer acceso";
$contador = 1;
date_default_timezone_set('Europe/Paris');
// si la variable est� asignada quiere decir que 
// existe la cookie
if (isset($_COOKIE['fechahora'])){
	// fecha hora del �ltimo acceso
	$fechahora = $_COOKIE['fechahora'];
	$contador = $_COOKIE['contador'];
}
// actualizaci�n de la cookie
// esta operaci�n se debe hacer antes de
// mandar cualquier cabecera a la salida
setcookie("fechahora",date('d/m/Y h:i:s')); // actualiza la cookie	
setcookie("contador",$contador + 1); // actualiza la cookie	
?>
<HTML>
	<HEAD>
		<TITLE>Uso de cookies en PHP (ejemplo file118.php)</TITLE>
	</HEAD>
	<BODY>
            <H3>Fecha y hora actual:
            <?php
                echo date('d/m/Y h:i:s') ?>
            </H3><BR><B>
	 Contenido de la superglobal $_COOKIE</B><BR>
	<?php 
	  echo "Elemento fechahora: " . $_COOKIE['fechahora'] . "<BR>" ;
	  echo "Elemento contador: " . $_COOKIE['contador'] . "<BR><BR>" ;
	  echo "<BR>La �ltima vez que accedi� a esta p�gina fue : $fechahora <BR>"; 
     echo "<BR>Cantidad de accesos a esta p�gina  : $contador <BR>"; 
		?> 
	</BODY>
</HTML>