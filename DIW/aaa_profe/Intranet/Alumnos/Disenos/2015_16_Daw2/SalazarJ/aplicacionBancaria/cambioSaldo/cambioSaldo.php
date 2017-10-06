<?php 
	//Al comenzar se destruye la sesión por si existe, y se vuelve a crear
	session_start();
	session_destroy();
	session_start();
	//Se controla el estado mediante Sesiones
	$_SESSION['estado']=0;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="js/cambioSaldo.js"></script>
	</head>
	<body>
		<h2>Ingresos y Reintegros</h2>
		<table>
		<tr>
			<td>Introduce numero de cuenta:</td><td> <input type="text" name="numCu" id="numCu"/></td>
		</tr>
		<tr>
			<td colspan="2"><div class="error" id="error_numCu"></div></td>
		</tr>
		</table>
	</body>
</html>