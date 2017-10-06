<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="js/movimientos.js"></script>
		<style>
			#mesIni,#mesFin {
				width: 3em;
				text-align: center;
			}
			#anioIni, #anioFin{
				width: 4em;
				text-align: center;
				margin-left: 2px;
			}
		</style>
	</head>
	<body>
		<h2>Buscar Movimientos</h2>
		<table>
		<tr>
			<td>Introduce numero de cuenta:</td><td> <input type="text" name="numCu" id="numCu"/></td>
		</tr>
		<tr>
			<td colspan="2"><div class="error" id="error_numCu"></div></td>
		</tr>
		<tr>
			<td style="width: 13em;">Fecha inicial: <input type="text" placeholder="Mes" id="mesIni" /><input type="text" placeholder="Año" id="anioIni" /></td>
			<td style="width: 13em;">Fecha final:  <input type="text" placeholder="Mes" id="mesFin" /><input type="text" placeholder="Año" id="anioFin" /></td>
		</tr>
		<tr><td colspan="2"><div class="error" id="error_mesIni"></div></td></tr>
		<tr><td colspan="2"><div class="error" id="error_anioIni"></div></td></tr>
		<tr><td colspan="2"><div class="error" id="error_mesFin"></div></td></tr>
		<tr><td colspan="2"><div class="error" id="error_anioFin"></div></td></tr>
		<tr><td colspan="2"><div class="error" id="error_fechasVal"></div></td></tr>
		<tr>
			<td colspan="2"><a style="margin-left:4em;" href="" id="buscarMov" class="boton">Buscar movimientos</a></td>
		</tr>
		</table>
	</body>
</html>