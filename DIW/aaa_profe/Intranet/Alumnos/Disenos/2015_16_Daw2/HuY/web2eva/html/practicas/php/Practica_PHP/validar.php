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
	<form name="miForm" method="POST" action="enviar.html">
		<p>Nombre: <input type="text" name="nombre" value='<?php echo $_POST["nombre"];?>' disabled="disabled"/></p>
		<p>Edad: <input type="text" name="edad" value='<?php echo $_POST["edad"];?>' disabled="disabled"/></p>
			
		<?php
			if ($_POST["edad"]<18 || $_POST["edad"]>65){
				echo "DATOS INCORRECTOS...<br/><br/><input type='button' value='volver' onclick='history.back()'/>";
			} else {
				echo "Poblacion:<input type='text' name='poblacion' value=''/>
					<br/><br/><input type='submit' value='enviar'/>";
			}
		?>
	</form>
</body>
</html>

