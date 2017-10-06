<?php
//Funciones para comprobar el numero de cuenta en el servidor
function error_numCu()
{
	echo "<h2>La cuenta introducida no es valida.</h2><br>";
}
function comprobarnumCu($numCu)
{
	//Comprobacion de que tiene 10 digitos
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

//Funciones para comprobar el importe en el servidor
function error_importe()
{
	echo "<h2>El importe introducido no es válido</h2><br>";
}
function comprobarImporte()
{
	$importe=$_POST['importe'];
	//Se comprueba que el importe sea mayor que 0, y que sea un numero.
	if($importe<='0'|| !is_numeric($importe) || $importe==''|| $importe=='-0' )
	{
		error_importe();
		return null;
	}
	return true;
}

//*********************************************************************
//*********************************************************************
//*********************************************************************

//Respuesta si el estado de la sesión es 0
function respuestaEstado0()
{
	
	//Comprueba que el numero de cuenta tiene un formato correcto
	if(comprobarnumCu($_POST['numCu']))
	{
		//Se conecta a la base de datos
		$conexion= new mysqli("localhost","root","nohay2sin3","Banco");
		if(mysqli_connect_errno())
		{
			echo "ERROR!--".mysqli_connect_error($conexion);
			mysqli_close($conexion);
			session_destroy ();
			exit();
		}
		
		//Comprueba si existe la cuenta
		$comprobacionCuenta= "SELECT * FROM cuentas WHERE cu_ncu=".$_POST['numCu'];		
		if(mysqli_num_rows(mysqli_query($conexion,$comprobacionCuenta))<=0)
		{
			echo '<h2>La cuenta no existe</h2>';
			mysqli_close($conexion);
			session_destroy ();
			exit();
		}
		
		/**************SESIONES***********************************/
		
		//Se accede a los datos de la cuenta y se guardan en la sesión
		$datosCuenta="SELECT cu_dn1, cu_dn2, cu_sal FROM cuentas WHERE cu_ncu=".$_POST['numCu'];	
		$resultadoDatos=mysqli_query($conexion, $datosCuenta);
		$dn1;
		$dn2;
		$saldo;
		if($resultadoDatos)
		{
			while ($fila = mysqli_fetch_row($resultadoDatos)) {
				$dn1=$fila[0];
				$dn2=$fila[1];
				$saldo=(int)$fila[2];
			}
		}
		$_SESSION['estado']=1;//Se cambia el estado de 0 a 1
		$_SESSION['numCu']=$_POST['numCu'];
		$_SESSION['dn1']=$dn1;
		$_SESSION['dn2']=$dn2;
		$_SESSION['sal']=$saldo;
		
		/***********************************************/
		//Se devuelve un formulario de respuesta donde introducir el importe
		echo" 	<head>
					<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
					<script src='js/cambioSaldo.js'></script>
					<style>
						#numCu{
							text-align:center;
						}
					</style>
				</head>
				<body>
					<h2>Ingresos y Reintegros</h2>
						<table>
						<tr>
							<td>Numero de cuenta:</td><td>".$_SESSION['numCu']."</td>
						</tr>
						<tr>
							<td>Saldo Disponible:</td><td><input type='text' disabled id='saldo' value='".$_SESSION['sal']."' /></td>
						</tr>
						<tr>
							<td>Introduce descripción:</td><td><textarea id='desc'></textarea></td>
						</tr>
						<tr>
							<td>Selecciona tipo de operación:</td><td>Ingreso<input checked type='radio' name='tipOp' value='0'/>Reintegro<input type='radio' name='tipOp'  value='1'/></td>
						</tr>
						<tr>
							<td>Introduce importe(€):</td><td><input type='text' id='importe'/></td>
						</tr>
						<tr>
							<td colspan='2'><div class='error' id='error_importe'></div></td>
						</tr>			
						<tr>
							<td colspan='2'><a style='margin-left:4em;'  href='' id='cambiarSaldo' class='boton'>Realizar operación</a></td>
						</tr>

					</table>
				</body>
			";
	}
	mysqli_close($conexion);
}

//Respuesta si el estado de la sesión es 1
function respuestaEstado1()
{

	$_SESSION['estado']=2;//Se cambia el estado de 1 a 2
	
	//Se comprueba el importe
	if(comprobarImporte())
	{
		//Se conecta a la base de datos
		$conexion= new mysqli("localhost","root","nohay2sin3","Banco");
		if(mysqli_connect_errno())
		{
			echo "ERROR!--".mysqli_connect_error($conexion);
			mysqli_close($conexion);
			session_destroy ();
			exit();
		}
		
		//Se guardan el importe y la descripción en la sesión
		$_SESSION['desc']=$_POST['desc'];
		$_SESSION['importe']=$_POST['importe'];
		
		//Si es reintegro, el importe se cambia a negativo multiplicando por -1
		if($_POST['tipOp']==1)
		{
			$_SESSION['importe']=$_SESSION['importe']*-1;
		}
		
		//Se comprueba que haya saldo suficiente
		if($_SESSION['sal']+(int)$_SESSION['importe']<0)
		{
			mysqli_close($conexion);
			echo 'No hay saldo suficiente';
			session_destroy ();
			exit();
		}
		//Si hay saldo, muestra un formulario con botones de confirmacion y cancelar.
		else
		{
			echo" 	<head>
					<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
					<script src='js/cambioSaldo.js'></script>
					<style>
						#numCu, #importe{
							text-align:center;
						}
					</style>
				</head>
				<body>
					<h2>Ingresos y Reintegros</h2>
						<table>
						<tr>
							<td>Numero de cuenta:</td><td>".$_SESSION['numCu']."</td>
						</tr>
						<tr>
							<td>Saldo Disponible:</td><td>".$_SESSION['sal']."</td>
						</tr>
						<tr>
							<td>Descripción:</td><td><textarea id='desc'  disabled>".$_SESSION['desc']."</textarea></td>
						</tr>
						<tr>
							<td>Importe(€):</td><td>".$_SESSION['importe']."</td>
						</tr>
						<tr>
							<td><div class='error' id='error_importe'></div></td>
						</tr>
						<tr>
							<td><a  href='' id='confOperacion' class='boton'>Confirmar operación</a></td>
							<td><a  href='' id='cancOperacion' class='boton'>Cancelar operación</a></td>
						</tr>
			
					</table>
				</body>
			";
			mysqli_close($conexion);
		}
	}
}

//Respuesta si el estado de la sesión es 2
function respuestaEstado2()
{
	//Se establece la conexion a la base de datos
	$conexion= new mysqli("localhost","root","nohay2sin3","Banco");
	if(mysqli_connect_errno())
	{
		echo "ERROR!--".mysqli_connect_error($conexion);
		mysqli_close($conexion);
		session_destroy ();
		exit();
	}
	
	//Se actualiza el saldo de los titulares
	
	//Actualización del saldo del titular
	$sentenciaTitular1="UPDATE clientes SET cl_sal=cl_sal+".(int)$_SESSION['importe']." WHERE cl_dni='".$_SESSION['dn1']."'";
	$resultado1=mysqli_query($conexion, $sentenciaTitular1);
	
	//Si existe segundo titular, se actualiza su saldo
	if($_SESSION['dn2']!='')
	{
		$sentenciaTitular2="UPDATE clientes SET cl_sal=cl_sal+".(int)$_SESSION['importe']." WHERE cl_dni='".$_SESSION['dn2']."'";
		$resultado2=mysqli_query($conexion, $sentenciaTitular2);
	}
	//Si no existe el segundo titular, se establece el resultado a true
	else
	{
		$resultado2=true;
	}
	
	// Se actualiza el saldo de la cuenta
	$sentenciaCuenta="UPDATE cuentas SET cu_sal=cu_sal+".(int)$_SESSION['importe']." WHERE cu_ncu=".$_SESSION['numCu'];
	$resultado3=mysqli_query($conexion, $sentenciaCuenta);
	
	//Se añade un registro a la tabla de movimientos
	$fechaActual= getDate();
	$hora=$fechaActual['hours'].$fechaActual['minutes'].$fechaActual['seconds'];
	$fech=$fechaActual['year']."-".$fechaActual['mon']."-".$fechaActual['mday'];
	$sentenciaMov="INSERT INTO movimientos (mo_ncu, mo_fec, mo_hor, mo_des, mo_imp) VALUES
			   ('".$_SESSION['numCu']."','$fech','$hora ', '".$_SESSION['desc']."','".$_SESSION['importe']."')";
	$resultado4=mysqli_query($conexion, $sentenciaMov);
	
	//Si ha ocurrido algun error hace Rollback
	if(!$resultado1 || !$resultado2 || !$resultado3 || !$resultado4)
	{
		echo '<h2>Ha ocurrido un error durante la operación</h2>';
		mysqli_rollback($conexion);
		mysqli_close($conexion);
		session_destroy ();
		exit();
	}
	
	echo "<h2>Operación realizada correctamente</h2>";
	mysqli_close($conexion);
	session_destroy ();
}

session_start();
if($_SESSION['estado']==0)
{
	respuestaEstado0();
}
else
{
	if($_SESSION['estado']==1)
	{
	 	respuestaEstado1();
	}
	else
	{
		if($_SESSION['estado']==2)
		{
			respuestaEstado2();
		}
	}
}
?>