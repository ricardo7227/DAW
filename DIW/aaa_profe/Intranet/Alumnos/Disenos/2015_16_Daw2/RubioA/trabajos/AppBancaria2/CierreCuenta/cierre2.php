<?php 

?>

<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Cierre de Cuenta</title>
		<link rel="stylesheet" href="../style/w3.css">
		<link rel="stylesheet" type="text/css" href="../style/estilo.css">
		<script src="../js/jquery-1.12.0.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	</head>
	<body>	
		<header class="cabecera w3-container w3-teal">
  			<a href="../index.php"><h1><i class="fa fa-bank w3-xxxlarge"></i>Aplicación Bancaria</h1></a>
		</header>
		<div class="cabecera w3-container w3-teal">
			  <h2>Cierre de Cuenta</h2>
		</div>
		
		<div class="w3-animate-opacity w3-teal cabecera formulario w3-card-16">
			<?php 
			
			//Recogemos el numero de cuenta
			$numcuenta=$_POST['cajanumcu'];
			
			//Conectamos con la BD
			$conexion = mysqli_connect("localhost", "root","nohay2sin3","Banco");
			
			$select1="SELECT cu_sal FROM cuentas WHERE cu_ncu='". $numcuenta ."';";
			$resultado=mysqli_query($conexion, $select1);
			$numfilas=mysqli_num_rows($resultado);
			if($numfilas==1)
			{
				while ($celda = mysqli_fetch_row($resultado))
				{
					$saldocuenta=$celda[0];
				}
				if ($saldocuenta==0)
				{
					$select2="DELETE * FROM cuentas WHERE cu_ncu='". $numcuenta ."';";
					mysqli_query($conexion,$select2);
					mysqli_close($conexion);
					echo "<h2>La cuenta ha sido borrada con éxito.</h2>";
				}
				else 
				{
					echo "La cuenta aún dispone de saldo, por lo que no se puede borrar.";
				}
			}
			else
			{
				echo "ERROR: La cuenta no ha sido borrada.";
			}

			?>
			
			
			
			
			
			
		</div>
		
		<div class="w3-container w3-teal">
			  <p>Alejandro Rubio</p>
		</div>
	</body>
</html>