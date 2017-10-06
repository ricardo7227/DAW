<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Prueba</title>
		<link rel="stylesheet" href="../style/w3.css">
		<link rel="stylesheet" type="text/css" href="../style/estilo.css">
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
		<script src="../js/jquery-1.12.0.min.js" type="text/javascript"></script>
		<script>	
			window.onload= function () 
			{
				$("#destino").load("cuentas1.php");
			}
			</script>

	</head>
	<body>	
		<header class="cabecera w3-container w3-teal">
  			<a href="../index.php"><h1><i class="fa fa-bank w3-xxxlarge"></i>Aplicación Bancaria</h1></a>
		</header>
		<div class="cabecera w3-container w3-teal">
			  <h3>Nueva Cuenta</h3>
		</div>
		<div class="w3-animate-opacity formulario w3-card-16">
			<form class="w3-container">					
					<div id="destino">
					
							
					</div>
			</form>
		</div>	
		
</body>
</html>





<?php
?>