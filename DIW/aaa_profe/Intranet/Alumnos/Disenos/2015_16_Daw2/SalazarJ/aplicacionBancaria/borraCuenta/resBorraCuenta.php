<?php
//Funciones para comprobar el numero de cuenta en el servidor
function error_numCu()
{
	echo "<h2>La cuenta introducida no es valida.</h2><br>";
}
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


//Si el input oculto vale 0
function respuestaEstado0(){
	if(comprobarnumCu())
	{
		//Se conecta a la base de datos
		$conexion= new mysqli("localhost","root","nohay2sin3","Banco");
		if(mysqli_connect_errno())
		{
			echo "ERROR!--".mysqli_connect_error($conexion);
			mysqli_close($conexion);
			exit();
		}
		
		//Comprueba si existe la cuenta
		$comprobacionCuenta= "SELECT * FROM cuentas WHERE cu_ncu=".$_POST['numCu'];		
		if(mysqli_num_rows(mysqli_query($conexion,$comprobacionCuenta))<=0)
		{
			echo '<h2>La cuenta no existe</h2>';
			mysqli_close($conexion);
			exit();
		}
	
		//Se escribe con formulario de respuesta con el input oculto con valor 1
		echo '<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<script src="js/borraCuenta.js"></script>
			</head>
			<body>
				<input type="hidden" value="1" id="estado"/>
				<h2>Borrado de cuentas</h2>
				<table>
					<tr>
						<td>Numero de cuenta:</td><td> <input type="text" name="numCu" id="numCu" value="'.$_POST['numCu'].'" disabled/></td>
					</tr>';
	
		//Se obtienen los titulares de la cuenta
		$sentenciaTitulares="SELECT cu_dn1, cu_dn2 FROM cuentas WHERE cu_ncu=".$_POST['numCu'];
		$resultadoTitulares=mysqli_query($conexion,$sentenciaTitulares);
		$titular1="";
		$titular2="";
		if($resultadoTitulares)
		{
			while ($fila = mysqli_fetch_row($resultadoTitulares)) {
				$titular1=$fila[0];
				$titular2=$fila[1];
			}
		}
		echo "		<tr>
						<td>Titular:</td><td><input type='text' id='tit1' disabled value='".$titular1."'/></td>
					</tr>";
	
		if($titular2!='')
		{
			echo" 	<tr>
						<td>Segundo Titular:</td><td><input type='text' id='tit2' disabled value='".$titular2."'/></td>
					</tr>";
		}
		else
		{
			echo" 	<tr>
						<td><input type='hidden' id='tit2' disabled value='".$titular2."'/></td>
					</tr>";			
		}
	
		//Se obtine el saldo de la cuenta
		$comprobarSaldo="SELECT cu_sal FROM cuentas WHERE cu_ncu=".$_POST['numCu'];
		$resultadoSaldo=mysqli_query($conexion, $comprobarSaldo);
		if($resultadoSaldo)
		{
			while ($fila = mysqli_fetch_row($resultadoSaldo)) {
				$saldo=(int)$fila[0];
			}
		}
		echo "			<tr>
						<td>Saldo:</td><td><input type='text' id='saldo' disabled value='".$saldo."'/></td>
					</tr>";
		echo '		</table>';
		//Si el saldo de la cuenta no es 0, se muestra mensaje de error
		if($saldo!=0)
		{
			echo "<div class='error'>Para poder borrar la cuenta su saldo debe ser 0</div>";
		}
		//Si vale 0, se muestran los botones de confirmación y de cancelar.
		else
		{
			echo "<table>
			<tr>
				<td><a  href='' id='confOperacion' class='boton'>Confirmar operación</a></td>
				<td><a  href='' id='cancOperacion' class='boton'>Cancelar operación</a></td>
			</tr>
		 </table>";
		}
		echo '</body>
	</html>';
		mysqli_close($conexion);
	}
}

//Si el input oculto vale 1
function respuestaEstado1(){
	
	//Se establece la conexion a la base de datos
	$conexion= new mysqli("localhost","root","nohay2sin3","Banco");
	if(mysqli_connect_errno())
	{
		echo "ERROR!--".mysqli_connect_error($conexion);
		mysqli_close($conexion);
		exit();
	}
	
	
	//resultado 1 : update o borrado del titular	
	
	//Se seleciona el numero de cuentas del titular de la cuenta a borrar
	$sentencia= "SELECT cl_ncu FROM clientes WHERE cl_dni='".$_POST['titular1']."'";
	$resultadoCuentas=mysqli_query($conexion, $sentencia);
	if($resultadoCuentas)
	{
		while ($fila = mysqli_fetch_row($resultadoCuentas)) {
			$cuentasTit1=$fila[0];
		}
	}
	
	//Si tiene más de una cuenta, se actualiza quitandole una
	if($cuentasTit1>1)
	{
		$sentencia="UPDATE clientes SET cl_ncu=cl_ncu-1 WHERE cl_dni='".$_POST['titular1']."'";
		$resultado1= mysqli_query($conexion, $sentencia);
	}
	//Si solo tiene una, se le da de baja
	else
	{
		$sentencia="DELETE FROM clientes WHERE cl_dni='".$_POST['titular1']."'";
		$resultado1=mysqli_query($conexion, $sentencia);
	}
	
	
	//resultado 2:  updateo o borrado del segundo titular
	
	//Se comprueba que exista segundo titular de la cuenta a borrar
	if($_POST['titular2']!='')
	{
		
		//Se procede igual que con el titular
		$sentencia= "SELECT cl_ncu FROM clientes WHERE cl_dni='".$_POST['titular2']."'";
		$resultadoCuentas=mysqli_query($conexion, $sentencia);
		if($resultadoCuentas)
		{
			while ($fila = mysqli_fetch_row($resultadoCuentas)) {
				$cuentasTit2=$fila[0];
			}
		}
		if($cuentasTit2>1)
		{
			$sentencia="UPDATE clientes SET cl_ncu=cl_ncu-1 WHERE cl_dni='".$_POST['titular2']."'";
			$resultado2= mysqli_query($conexion, $sentencia);
		}
		else
		{
			$sentencia="DELETE FROM clientes WHERE cl_dni='".$_POST['titular2']."'";
			$resultado2=mysqli_query($conexion, $sentencia);
		}
	}
	//Si no existe segundo titular, se establece true al resultado
	else
	{
		$resultado2=true;
	}
	
	//resultado 3: Borrado de movimientos
	$sentencia= "DELETE FROM movimientos WHERE mo_ncu='".$_POST['numCu']."'";
	$resultado3=mysqli_query($conexion, $sentencia);
	//resultado 4: Borrado de cuenta
	$sentencia="DELETE FROM cuentas WHERE cu_ncu='".$_POST['numCu']."'";
	$resultado4=mysqli_query($conexion, $sentencia);
	
	//Si alguna de las operaciones no se ha realizado correctamente hace Rollback
	if(!$resultado1 || !$resultado2 || !$resultado3 || !$resultado4)
	{
		echo '<h2>Ha ocurrido un error durante la operación</h2>';
		mysqli_rollback($conexion);
		mysqli_close($conexion);
		exit();
	}
	
	echo "<h2>Operación realizada correctamente</h2>";
	mysqli_close($conexion);
}


if($_POST['estado']==0)
{
	respuestaEstado0();
}
if($_POST['estado']==1)
{
	respuestaEstado1();
}



?>