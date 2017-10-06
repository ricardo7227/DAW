<!DOCTYPE html>
<html lang="es">
<head>
	<title>JS + PHP</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Ejemplo de PHP">
	<meta name="keywords" content="HTML5, CSS3, JavaScript, PHP">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>
<body>
	<form name="miForm" method="POST" action="validar.php">
		<p>Nombre: <input type="text" name="nombre" value=""/></p>
		<p>Edad: <input type="text" name="edad" value=""/> (18-65)</p>
		<p><button onclick="javascript:validarEdad()">Enviar</button></p>
	</form>
</body>
</html>

