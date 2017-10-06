<?php

?>
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Prueba</title>
		<link rel="stylesheet" href="style/w3.css">
		<link rel="stylesheet" type="text/css" href="style/estilo.css">
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	</head>
	<body>	
		<header class="cabecera w3-container w3-teal">
  			<h1><i class="fa fa-bank w3-xxxlarge"></i>Aplicación Bancaria</h1>
  			
		</header>
		<div class="contenedor w3-container w3-animate-opacity">
  			<h3>    Bienvenido a la aplicación bancaria.</h3>
  			<p>Desde esta aplicación podrás controlar todas las gestiones sobre tu cuenta de ahorros,</p>
  			<p> desde ver sus movimientos o hacer ingresos, hasta cerrar la cuenta.</p>
  			
  			
  			<form action="CrearBD/crearbd1.php" method="post" name="formulario">

  					<button type="submit" name="crearbd" class="icono w3-opacity w3-half notas w3-button w3-btn w3-card-8 w3-teal">
		  					<h3>  Crear base de datos</h3><br>
		  					<i class="w3-button fa fa-hdd-o w3-xxxlarge"></i>
		  			</button>
		  	</form>
		  	
		  	<form action="CrearCuenta/cuentas0.php" method="post" name="formulario">				
  					<button type="submit" name="crearCuenta" class="icono w3-opacity notas w3-half w3-button w3-card-8 w3-btn w3-teal">
		  					<h3>  Abrir cuenta bancaria </h3><br>
		  					<i class="w3-button fa fa-credit-card w3-xxxlarge"></i>
		  			</button>
		  	</form>
		  	
		  	<form action="Ingresos/ingresos.php" method="post" name="formulario">	
		  			<button type="submit" name="" class="icono w3-opacity notas w3-half w3-button w3-card-8 w3-btn  w3-teal">
		  					<h3>  Ingresos </h3><br>
		  					<i class="w3-button fa fa-bar-chart w3-xxxlarge"></i>
		  			</button>
		  	</form>
		  	
		  	<form action="Reintegros/reintegros.php" method="post" name="formulario">	
		  			<button type="submit" name="" class="icono w3-opacity notas w3-half w3-button w3-card-8 w3-btn  w3-teal">
		  					<h3>  Reintegros </h3><br>
		  					<i class="w3-button fa fa-bar-chart w3-xxxlarge"></i>
		  			</button>
		  	</form>
		  	
		  	<form action="Movimientos/movimientos1.php" method="post" name="formulario">	
		  			<button type="submit" name="" class="icono w3-opacity notas w3-half w3-button w3-card-8 w3-btn  w3-teal">
		  					<h3>  Listado de movimientos </h3><br>
		  					<i class="w3-button fa fa-money w3-xxxlarge"></i>
		  			</button>
		  	</form>
		  	
		  	<form action="CierreCuenta/cierre1.php" method="post" name="formulario">	
		  			<button type="submit" name="" class="icono w3-opacity notas w3-half w3-button w3-card-8 w3-btn  w3-teal">
		  					<h3>  Cierre de cuenta </h3><br>
		  					<i class="w3-button fa fa-ban text-danger w3-xxxlarge" style="color:red;"></i>
		  			</button>
  			</form>
		</div>

		<div class="w3-container w3-teal">
		  <p>Alejandro Rubio</p>
		</div>
	</body>
</html>