<?php

	//Funcion para mostrar  un mensaje de error
	function error_numCu()
	{
		echo "<h2>La cuenta introducida no es valida.</h2><br>";
		
	}
	
	//Funcion para comprobar el numero de cuenta en el servidor
	function comprobarnumCu()
	{
		//Comprobacion de que tiene 10 digitos
		$numCu=$_POST['numCu'];
		if(strlen($numCu)!=10)
		{
			error_numCu();
			return null;
		}
		
		//Comprobacion de que son todo numeros
		for($i=0;$i<strlen($numCu);$i++)
		{
			if(!is_numeric($numCu[$i]))
			{
				error_numCu();
				return null;
			}
		}
		//Comprobacion de que el resto de la suma de los 9 primeros digitos entre 9, es igual al ultimo digito 
		$i;
		$sum=0;
		for($i=0;$i<strlen($numCu)-1;$i++)
		{
			$valor=(int)$numCu[$i];
			$sum=$sum+$valor;
		}
		if($numCu[$i]!=(int)($sum%$i))
		{
			error_numCu();
			return null;
		}		
		return true;		
	}

	//Comprueba que las fechas sean correctas
	function comprobarFech()
	{
		//Se comprueba que exista la fecha inicial
		if(!checkdate((int)$_POST['mesIni'], 1, (int)$_POST['anioIni']))
		{
			echo "<h2>Fecha no válida</h2>";
			return null;
		}
		//Se comprueba que exista la fecha final
		if(!checkdate((int)$_POST['mesFin'], 1, (int)$_POST['anioFin']))
		{
			echo "<h2>Fecha no válida</h2>";
			return null;
		}
		$fechaInicial= new DateTime($_POST['anioIni']."-".$_POST['mesIni']."-1");
		$fechaFinal = new DateTime($_POST['anioFin']."-".$_POST['mesFin']."-1");
		//Se comprueba que la fecha final sea posterior a la inicial
		if($fechaInicial>=$fechaFinal)
		{
			echo "<h2>Fecha no válida</h2>";
			return null;
		}
		
		return true;
	}
	
//*********************************************************************
//*********************************************************************
//*********************************************************************
	
	
	//Comprueba el numero de cuenta y las fechas	
	if(comprobarnumCu() && comprobarFech())
	{
		//Se conecta a la base de datos
		$conexion= new mysqli("localhost","root","nohay2sin3","Banco");
		if(mysqli_connect_errno())
		{
			echo "ERROR!--".mysqli_connect_error($conexion);
			mysqli_close($conexion);
			exit();
		}
		
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style type="text/css">
			#tabla_mov{
				border-collapse: collapse;
			}
			#tabla_mov td , #tabla_mov th{
				border: solid 3px rgba(255, 240, 240, 0.38);
				width: 10em;
				text-align: center;
			}
		</style>
	</head>
	<body>
	<?php
		//Se comprueba si existe la cuenta
		$comprobacionCuenta= "SELECT * FROM cuentas WHERE cu_ncu=".$_POST['numCu'];		
		if(mysqli_num_rows(mysqli_query($conexion,$comprobacionCuenta))<=0)
		{
			echo '<h2>La cuenta no existe</h2>';
			mysqli_close($conexion);
			exit();
		}
		
	?>
		<h2>Movimientos de la cuenta <?php echo $_POST['numCu'];?></h2>
		<h3 style="text-align:center;">Desde <?php echo "1-".$_POST['mesIni']."-".$_POST['anioIni'];?> hasta <?php echo "1-".$_POST['mesFin']."-".$_POST['anioFin'];;?></h3>
	<?php 
		//Si existe, se comprueba si hay movimientos con ese numero de cuenta
		$QueryMovimientos="SELECT * FROM movimientos WHERE (mo_ncu=".$_POST['numCu'].") 
															AND (mo_fec>'".$_POST['anioIni']."-".$_POST['mesIni']."-1') 
															AND (mo_fec<'".$_POST['anioFin']."-".$_POST['mesFin']."-1')";
		
		
		//Si no hay movimientos
		if(mysqli_num_rows(mysqli_query($conexion,$QueryMovimientos))<=0)
		{
			mysqli_close($conexion);
			echo '<h3 style="text-align: center;">No hay movimientos.</h3>';
		}
		//Si hay movimientos los muestra en una tabla
		else
		{
			echo "<table id='tabla_mov'>";
			echo "<tr>";
			echo 	"<th>FECHA</th>";
			echo 	"<th>HORA</th>";
			echo	"<th>DESCRIPCION</th>";
			echo 	"<th>IMPORTE</th>";
			echo "</tr>";
			$resultado=mysqli_query($conexion,$QueryMovimientos);
			while ($fila = mysqli_fetch_row($resultado)) {
				echo	"<tr>";
				echo 	"<td>".$fila[1]."</td><td>".$fila[2]."</td><td>".$fila[3]."</td><td>".$fila[4]."</td>";
				echo 	"</tr>";		
			}
			echo "</table>";
			mysqli_close($conexion);
		}		
	?>	
	</body>
</html><?php }?>