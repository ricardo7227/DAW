<?php
	if(isset($_POST['validar']))
	{
		$edad=(int)$_POST['edad'];
		if($edad<18 || $edad>40)
		{?>
			<html>
				<head>
					<title>Formulario</title>
				</head>
				<body>
					<h2>Ejercicio Formulario</h2>
					<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="formu1">
						<table>
							<tr>
								<td>Introduce nombre:</td><td><input type="text" name="nombre"/></td>
							</tr>
							<tr>
								<td>Introduce edad:</td><td><input type="text" name="edad"/></td>
							</tr>
							<tr>
								<td colspan="2"><div style="color:red">La edad debe estar entre 18 y 40 años</td>
							</tr>
							<tr>
								<td colspan="2"><input type="submit" value="validar" name="validar"/></td>
							</tr>
						</table>					
					</form>					
				</body>
			</html>
			<?php
		}
		
		else
			
		{?>
			<html>
				<head>
					<title>Formulario</title>
				</head>
				<body>
					<h2>Ejercicio Formulario</h2>
					<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="formu1">
						<table>
							<tr>
								<td>Introduce nombre:</td><td><input type="text" name="nombre" value="<?php echo $_POST['nombre']?>" disabled /></td>
							</tr>
							<tr>
								<td>Introduce edad:</td><td><input type="text" name="edad" value="<?php echo $_POST['edad']?>" disabled /></td>
							</tr>
							<tr>
								<td>Introduce tu color favorito:</td><td><input type="text" name="color"/></td>
							</tr>
							<tr>
								<td colspan="2"><input type="submit" value="confirmar" name="confirmar"/></td>
							</tr>
						</table>					
					</form>					
				</body>
			</html>
		
		<?php	
		}
	}
	if(isset($_POST['confirmar']))
	{
		echo '<h1>FORMULARIO CORRECTO!</h1>';
	}
		
?>
