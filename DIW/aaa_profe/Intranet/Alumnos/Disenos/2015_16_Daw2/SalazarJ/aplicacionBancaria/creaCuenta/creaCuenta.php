<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script src="js/creaCuenta.js" type="text/javascript"></script>
	</head>
	<body>
		<!-- Input oculto para controlar la respuesta del servidor -->
		<input type="hidden" value="0" id="estado"/> 
		<h2>Creación de cuentas</h2>
		<table>
			<tr>
				<td>Introduce numero cuenta:</td><td> <input type="text" id="numCu"/></td>
			</tr>
			<tr>
				<td><div class="error" id="error_numCu"></div></td>
			</tr>
		</table>
	</body>
</html>