<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Aplicación Bancaria</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
		<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script>
		<script src="js/index.js" type="text/javascript"></script>
		<script src="js/checks.js" type="text/javascript"></script>
	</head>
	<body>
		<h1 id="titulo"><img id="ImagenBanco" src="imagenes/bank.png"/><span>Aplicación Bancaria</span></h1>
		<div id="opciones">
			<table style="width: 100%;">
				<tr>
					<td><a  href="" id="creabd" class="boton">Crear base de datos</a></td>
					<td><a href="" id="borrabd" class="boton">Borrar base de datos</a></td>
				</tr>
				<tr>
					<td><a href="" id="creaCuenta" class="boton">Crear cuenta</a></td>
					<td><a href="" id="cambioSaldo" class="boton">Ingresos/Reintegros</a></td>
				</tr>
				<tr>
					<td><a href="" id="verMovimientos" class="boton">Ver movimientos</a></td>
					<td><a href="" id="borraCuenta" class="boton ">Borrar cuenta</a></td>
				</tr>
				<tr>
					<td colspan="2"><a href="/phpmyadmin" target="_blank" id="phpmyadmin" class="boton"> PhpMyAdmin</a></td>
				</tr>
			</table>
		</div>
		<div id="contenido"></div>
	</body>
</html>