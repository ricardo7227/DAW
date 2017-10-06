<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="js/borraCuenta.js"></script>
	</head>
	<body>
	<!-- Se utiliza un input oculto para controlar al respuesta del servidor -->
	<input type="hidden" value="0" id="estado"/> 
	<h2>Borrado de cuentas</h2>
	<table>
	<tr>
	<td>Introduce numero de cuenta:</td><td> <input type="text" name="numCu" id="numCu"/></td>
	</tr>
	<tr>
	<td><div class="error" id="error_numCu"></div></td>
	</tr>
	</table>
	</body>
</html>
