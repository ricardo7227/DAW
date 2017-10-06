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

//Funcion para comprobar el DNI en servidor
function comprobarDNI($dni)
{
	$DNI=$_POST[$dni];
	if(preg_match_all("/^[0-9]{8}[A-Za-z]{1}$/", $DNI))
	{
		return true;
	}
	else
	{
		echo "<h2>DNI no válido</h2>";
		return false;
	}
}

//Funcion para comprobar que la fecha de nacimiento introducida sea válida
function comprobarFechNac($fech)
{
	$patron='/^(1[0-9]{3}|200[0-9]|201[0-5] )-([0]?[1-9]|[1][0-2])-(0?[1-9]|1[0-9]|2[0-9]|3[0-1])$/';
	if(!preg_match($patron, $fech))
	{
		echo '<h2>Formato de fecha de nacimiento no válido</h2>';
		return null;
	}
	$cadena=explode("-",$fech);
	$año=$cadena[0];
	$mes=$cadena[1];
	$dia=$cadena[2];
	if(!checkdate($mes, $dia, $año))
	{
		echo "<h2>Fecha de nacimiento no válida</h2> ";
		return null;
	}
	return true;
}

/********************************************************************************/
/********************************************************************************/

//Respuesta cuando el input oculto vale 0
function respuestaEstado0()
{
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
		//Si la cuenta NO existe, deja introducir el DNI
		if(mysqli_num_rows(mysqli_query($conexion,$comprobacionCuenta))<=0)
		{	
		echo '<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<script src="js/creaCuenta.js" type="text/javascript"></script>
				</head>
				<body>
					<input type="hidden" value="1" id="estado"/>
					<h2>Creación de cuentas</h2>
					<table>
						<tr>
							<td>Numero cuenta:</td><td> <input disabled value="'.$_POST['numCu'].'" type="text" id="numCu"/></td>
						</tr>
						<tr>
							<td>DNI titular:</td><td><input type="text" id="tit1" />
						</td>
						<tr>
							<td><div class="error" id="error_tit1"></div></td>
						</tr>
					</table>
				</body>
			</html>';
		mysqli_close($conexion);
		exit();
		}
		//Si la cuenta ya existe
		else 
		{
			echo '<h2>La cuenta ya existe</h2>';
				
		}
	}
}

//Respuesta cuando el input oculto vale 1
function respuestaEstado1(){
	//Se comprueba que el DNI sea valido
	if(comprobarDNI('tit1'))
	{
		//Se conecta a la base de datos
		$conexion= new mysqli("localhost","root","nohay2sin3","Banco");
		if(mysqli_connect_errno())
		{
			echo "ERROR!--".mysqli_connect_error($conexion);
			mysqli_close($conexion);
			exit();
		}
		
		//Se comprueba si el DNI del titular ya está dado de alta
		$comprobarTit= "SELECT * FROM clientes WHERE cl_dni='".$_POST['tit1']."'";		
		
		//Si no lo está, se muestra un formulario para introducir datos
		if(mysqli_num_rows(mysqli_query($conexion,$comprobarTit))<=0)
		{
			echo '<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<script src="js/creaCuenta.js" type="text/javascript"></script>
				</head>
				<body>
					<input type="hidden" value="2" id="estado"/>
					<h2>Creación de cuentas</h2>
					<table>
						<tr>
							<td>Numero cuenta:</td><td> <input disabled value="'.$_POST['numCu'].'" type="text" id="numCu"/></td>
						</tr>
						<tr>
							<td>DNI titular:</td><td><input type="text" id="tit1" value="'.$_POST['tit1'].'" disabled />
						</td>
						<tr>
							<td>Nombre:</td><td><input type="text" id="nom1"/></td>
						</tr>
						<tr>
							<td>Direccion:</td><td><input type="text" id="dir1"/></td>
						</tr>
						<tr>
							<td>Telefono:</td><td><input type="text" id="tel1"/></td>
						</tr>
						<tr>
							<td>Email:</td><td><input type="text" id="email1"/></td>
						</tr>
						<tr>
							<td>Fecha Nacimiento:</td><td><input placeholder="YYYY-MM-DD" type="text" id="fechNac1"/></td>
						</tr>
						<tr>
						<td colspan="2"><div class="error" id="error_fechNac1"></div></td>
						</tr>';
				$Factual= date('Y-m-d');
				echo	'<tr>
							<td>Fecha de alta:</td><td><input type="text" disabled id="fechAlt1" value="'.$Factual.'"/></td>
						</tr>
						<tr>
							<td>Numero de cuentas:</td><td><input type="text" id="cuentas1" disabled value="0"/></td>
						</tr>
						<tr>
							<td>Saldo:</td><td><input type="tex" id="sald1" disabled value="0"/></td>
						</tr>';
						
			echo '		<tr>
							<td colspan="2">¿Introducir segundo titular?<label> Si<input type="radio" name="segTit" id="segTit" value="1"/></label><label>No<input type="radio" name="segTit" checked id="segTit" value="0"/></label></td>
						</tr>
					</table>
					<div id="segundoTit" style="display:none">
						<table>
							<tr><td>DNI segundo titular:</td><td><input type="text" id="tit2"/></td></tr>
							<tr>
								<td colspan="2"><div class="error" id="error_tit2"></div></td>
							</tr>
						</table>
					</div>
					<table>
						<tr>
							<td colspan="2"><a id="seguir" href="" class="boton">Continuar</a></td>
						</tr>
					</table>
				</body>
			</html>';
			mysqli_close($conexion);
			exit();
		}
		//Si ya existe, se muestran sus datos
		else
		{
			$resultado=mysqli_query($conexion,$comprobarTit);
			echo '<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<script src="js/creaCuenta.js" type="text/javascript"></script>
				</head>
				<body>
					<input type="hidden" value="2" id="estado"/>
					<h2>Creación de cuentas</h2>
					<table>
						<tr>
							<td>Numero cuenta:</td><td> <input disabled value="'.$_POST['numCu'].'" type="text" id="numCu"/></td>
						</tr>
						<tr>
							<td>DNI titular:</td><td><input type="text" id="tit1" value="'.$_POST['tit1'].'" disabled /></td>
						</tr>';
			while ($fila = mysqli_fetch_row($resultado)) {
				echo '
							<tr>
								<td>Nombre:</td><td><input type="text" id="nom1" disabled value="'.$fila[1].'"/></td>
							</tr>
							<tr>
								<td>Direccion:</td><td><input type="text" id="dir1" disabled value="'.$fila[2].'"/></td>
							</tr>
							<tr>
								<td>Telefono:</td><td><input type="text" id="tel1" disabled value="'.$fila[3].'"/></td>
							</tr>
							<tr>
								<td>Email:</td><td><input type="text" id="email1" disabled value="'.$fila[4].'"/></td>
							</tr>
							<tr>
								<td>Fecha Nacimiento:</td><td><input type="text" id="fechNac1" disabled value="'.$fila[5].'"/></td>
							</tr>
							<tr>
								<td>Fecha de alta:</td><td><input type="text" id="fechAlt1" disabled value="'.$fila[6].'"/></td>
							</tr>
							<tr>
								<td>Numero de cuentas:</td><td><input type="text" id="cuentas1" disabled value="'.$fila[7].'"/></td>
							</tr>
							<tr>
								<td>Saldo:</td><td><input type="tex" id="sald1" disabled value="'.$fila[8].'"/></td>
							</tr>';
			}
				
			echo '		<tr>
							<td colspan="2">¿Introducir segundo titular?<label> Si<input type="radio" name="segTit" id="segTit" value="1"/></label><label>No<input type="radio" name="segTit" checked  id="segTit" value="0"/></label></td>
						</tr>
					</table>
					<div id="segundoTit" style="display:none">
						<table>
							<tr><td>DNI segundo titular:</td><td><input type="text" id="tit2"/></td></tr>
							<tr>
								<td colspan="2"><div class="error" id="error_tit2"></div></td>
							</tr>
						</table>
					</div>
					<table>
						<tr>
							<td colspan="2"><a id="seguir" href="" class="boton">Continuar</a></td>
						</tr>
					</table>
				</body>
			</html>';
			mysqli_close($conexion);
			exit();
		}
	}
}
//Respuesta cuando el input oculto vale 2
function respuestaEstado2(){
//Se comprueba la fecha de nacimiento
if(!comprobarFechNac($_POST['fechNac1']))
{
	exit();
}
	
//En caso de no haber introducido segundo titular, se muestra un boton de confirmación y se pasa al estado 4
	if($_POST['radio']==0)
	{
		echo '<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<script src="js/creaCuenta.js" type="text/javascript"></script>
				
				</head>
				<body>
					<input type="hidden" value="4" id="estado"/>
					<input type="hidden" value="" id="tit2"/>
					<h2>Creación de cuentas</h2>
					<table>
						<tr>
							<td>Numero cuenta:</td><td> <input disabled value="'.$_POST['numCu'].'" type="text" id="numCu"/></td>
						</tr>
						<tr>
							<td>DNI titular:</td><td><input type="text" id="tit1" value="'.$_POST['tit1'].'" disabled />
						</td>
						<tr>
							<td>Nombre:</td><td><input type="text" id="nom1" value="'.$_POST['nom1'].'" disabled /></td>
						</tr>
						<tr>
							<td>Direccion:</td><td><input type="text" id="dir1"value="'.$_POST['dir1'].'" disabled /></td>
						<tr>
							<td>Telefono:</td><td><input type="text" id="tel1" value="'.$_POST['tel1'].'" disabled /></td>
						</tr>
						<tr>
							<td>Email:</td><td><input type="text" id="email1" value="'.$_POST['email1'].'" disabled /></td>
						</tr>
						<tr>
							<td>Fecha Nacimiento:</td><td><input type="text" id="fechNac1" value="'.$_POST['fechNac1'].'" disabled /></td>
						</tr>
						<tr>
							<td>Fecha de alta:</td><td><input type="text" id="fechAlt1" value="'.$_POST['fechAlt1'].'" disabled /></td>
						</tr>
						<tr>
							<td>Numero de cuentas:</td><td><input type="text" id="cuentas1" value="'.$_POST['cuentas1'].'" disabled /></td>
						</tr>
						<tr>
							<td>Saldo:</td><td><input type="tex" id="sald1" value="'.$_POST['sald1'].'" disabled /></td>
						</tr>
						<tr>
							<td>Importe de apertura:</td><td><input type="text" id="apertura"/></td>
						</tr>
						<tr>
								<td colspan="2"><div class="error" id="error_apertura"></div></td>
						</tr>										
						<tr>
							<td><a  href="" id="confAlta" class="boton">Confirmar</a></td>
							<td><a  href="" id="cancAlta" class="boton">Cancelar</a></td>
						</tr>
					</table>
			
				</body>
			</html>';
	}
	//Si se ha introducido segundo titular
	if($_POST['radio']==1)
	{
		//Se comprueba que el DNI del segundo titular sea válido
		if(comprobarDNI('tit2'))
		{
			//Se comprueba que los DNI de los titulares no sean los mismos
			if(strtolower($_POST['tit1'])==strtolower($_POST['tit2']))
			{
				echo '<h2>Los DNI no pueden ser iguales</h2>';
			}
			else
			{
				//Se conecta a la base de datos
				$conexion= new mysqli("localhost","root","nohay2sin3","Banco");
				if(mysqli_connect_errno())
				{
					echo "ERROR!--".mysqli_connect_error($conexion);
					mysqli_close($conexion);
					exit();
				}
				$comprobarTit2= "SELECT * FROM clientes WHERE cl_dni='".$_POST['tit2']."'";
				//Si el segundo titular no existe en la base de datos se muestra un formulario
				// para introducir datos
				if(mysqli_num_rows(mysqli_query($conexion,$comprobarTit2))<=0)
				{
						echo '<html>
								<head>
									<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
									<script src="js/creaCuenta.js" type="text/javascript"></script>
								
								</head>
								<body>
									<input type="hidden" value="3" id="estado"/>
									<h2>Creación de cuentas</h2>
									<table>
										<tr>
											<td>Numero cuenta:</td><td> <input disabled value="'.$_POST['numCu'].'" type="text" id="numCu"/></td>
										</tr>
										<tr>
											<td>DNI titular:</td><td><input type="text" id="tit1" value="'.$_POST['tit1'].'" disabled />
										</td>
										<tr>
											<td>Nombre:</td><td><input type="text" id="nom1" value="'.$_POST['nom1'].'" disabled /></td>
										</tr>
										<tr>
											<td>Direccion:</td><td><input type="text" id="dir1"value="'.$_POST['dir1'].'" disabled /></td>
										<tr>
											<td>Telefono:</td><td><input type="text" id="tel1" value="'.$_POST['tel1'].'" disabled /></td>
										</tr>
										<tr>
											<td>Email:</td><td><input type="text" id="email1" value="'.$_POST['email1'].'" disabled /></td>
										</tr>
										<tr>
											<td>Fecha Nacimiento:</td><td><input type="text" id="fechNac1" value="'.$_POST['fechNac1'].'" disabled /></td>
										</tr>
										<tr>
											<td>Fecha de alta:</td><td><input type="text" id="fechAlt1" value="'.$_POST['fechAlt1'].'" disabled /></td>
										</tr>
										<tr>
											<td>Numero de cuentas:</td><td><input type="text" id="cuentas1" value="'.$_POST['cuentas1'].'" disabled /></td>
										</tr>
										<tr>
											<td>Saldo:</td><td><input type="tex" id="sald1" value="'.$_POST['sald1'].'" disabled /></td>
										</tr>
										<tr>
											<td colspan="2">¿Introducir segundo titular?<label> Si<input type="radio" name="segTit" id="segTit" disabled checked value="1"/></label><label>No<input type="radio" name="segTit" disabled id="segTit" value="0"/></label></td>
										</tr>
										<tr><td>DNI segundo titular:</td><td><input type="text" id="tit2" value="'.$_POST['tit2'].'" disabled/></td></tr>
										<tr>
											<td>Nombre:</td><td><input type="text" id="nom2"/></td>
										</tr>
										<tr>
											<td>Direccion:</td><td><input type="text" id="dir2"/></td>
										</tr>
										<tr>
											<td>Telefono:</td><td><input type="text" id="tel2"/></td>
										</tr>
										<tr>
											<td>Email:</td><td><input type="text" id="email2"/></td>
										</tr>
										<tr>
											<td>Fecha Nacimiento:</td><td><input placeholder="YYYY-MM-DD" type="text" id="fechNac2"/></td>
										</tr>
										<tr>
											<td colspan="2"><div class="error" id="error_fechNac2"></div></td>
										</tr>';
									$Factual= date('Y-m-d');
								echo	'<tr>
											<td>Fecha de alta:</td><td><input type="text" disabled id="fechAlt2" value="'.$Factual.'"/></td>
										</tr>
										<tr>
											<td>Numero de cuentas:</td><td><input type="text" id="cuentas2" disabled value="0"/></td>
										</tr>
										<tr>
											<td colspan="2"><a  href="" id="finalizar" class="boton">Finalizar</a></td>
										</tr>
									</table>
									<input type="hidden" id="sald2" value="0"/>
								</body>
							</html>';
					 }
					 //Si el segundo titular existe en la base de datos se muestran sus datos
					 else
					 {
					 	$resultado=mysqli_query($conexion,$comprobarTit2);
					 	echo '<html>
								<head>
									<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
									<script src="js/creaCuenta.js" type="text/javascript"></script>
					 	
								</head>
								<body>
									<input type="hidden" value="3" id="estado"/>
									<h2>Creación de cuentas</h2>
									<table>
										<tr>
											<td>Numero cuenta:</td><td> <input disabled value="'.$_POST['numCu'].'" type="text" id="numCu"/></td>
										</tr>
										<tr>
											<td>DNI titular:</td><td><input type="text" id="tit1" value="'.$_POST['tit1'].'" disabled />
										</td>
										<tr>
											<td>Nombre:</td><td><input type="text" id="nom1" value="'.$_POST['nom1'].'" disabled /></td>
										</tr>
										<tr>
											<td>Direccion:</td><td><input type="text" id="dir1"value="'.$_POST['dir1'].'" disabled /></td>
										<tr>
											<td>Telefono:</td><td><input type="text" id="tel1" value="'.$_POST['tel1'].'" disabled /></td>
										</tr>
										<tr>
											<td>Email:</td><td><input type="text" id="email1" value="'.$_POST['email1'].'" disabled /></td>
										</tr>
										<tr>
											<td>Fecha Nacimiento:</td><td><input type="text" id="fechNac1" value="'.$_POST['fechNac1'].'" disabled /></td>
										</tr>
										<tr>
											<td>Fecha de alta:</td><td><input type="text" id="fechAlt1" value="'.$_POST['fechAlt1'].'" disabled /></td>
										</tr>
										<tr>
											<td>Numero de cuentas:</td><td><input type="text" id="cuentas1" value="'.$_POST['cuentas1'].'" disabled /></td>
										</tr>
										<tr>
											<td>Saldo:</td><td><input type="tex" id="sald1" value="'.$_POST['sald1'].'" disabled /></td>
										</tr>
										<tr>
											<td colspan="2">¿Introducir segundo titular?<label> Si<input type="radio" name="segTit" id="segTit" disabled checked value="1"/></label><label>No<input type="radio" name="segTit" disabled id="segTit" value="0"/></label></td>
										</tr>
										<tr><td>DNI segundo titular:</td><td><input type="text" id="tit2" value="'.$_POST['tit2'].'" disabled/></td></tr>';
										while ($fila = mysqli_fetch_row($resultado)) {
							echo '
										<tr>
											<td>Nombre:</td><td><input type="text" id="nom2" disabled value="'.$fila[1].'"/></td>
										</tr>
										<tr>
											<td>Direccion:</td><td><input type="text" id="dir2" disabled value="'.$fila[2].'"/></td>
										</tr>
										<tr>
											<td>Telefono:</td><td><input type="text" id="tel2" disabled value="'.$fila[3].'"/></td>
										</tr>
										<tr>
											<td>Email:</td><td><input type="text" id="email2" disabled value="'.$fila[4].'"/></td>
										</tr>
										<tr>
											<td>Fecha Nacimiento:</td><td><input type="text" id="fechNac2" disabled value="'.$fila[5].'"/></td>
										</tr>
										<tr>
											<td>Fecha de alta:</td><td><input type="text" id="fechAlt2" disabled value="'.$fila[6].'"/></td>
										</tr>
										<tr>
											<td>Numero de cuentas:</td><td><input type="text" id="cuentas2" disabled value="'.$fila[7].'"/></td>
										</tr>
										<tr>
											<td>Saldo:</td><td><input type="tex" id="sald2" disabled value="'.$fila[8].'"/></td>
										</tr>'			
							;
						}
												
						echo '			<tr>
											<td colspan="2"><a  href="" id="finalizar" class="boton">Finalizar</a></td>
										</tr>
									</table>
								</body>
							</html>';
					 }
					 mysqli_close($conexion);
					 
			}
		}
	}
}
//Respuesta cuando el input oculto vale 3
function respuestaEstado3(){
	//Se comprueba el nacimiento del segundo titular
	if(!comprobarFechNac($_POST['fechNac2']))
	{
		exit();
	}
	//Se muestra un formulario con botones de confirmación,y se pide importe de apertura
	echo '<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<script src="js/creaCuenta.js" type="text/javascript"></script>
	
				</head>
				<body>
					<input type="hidden" value="4" id="estado"/>
					<h2>Creación de cuentas</h2>
					<table>
						<tr>
							<td>Numero cuenta:</td><td> <input disabled value="'.$_POST['numCu'].'" type="text" id="numCu"/></td>
						</tr>
						<tr>
							<td>DNI titular:</td><td><input type="text" id="tit1" value="'.$_POST['tit1'].'" disabled />
						</td>
						<tr>
							<td>Nombre:</td><td><input type="text" id="nom1" value="'.$_POST['nom1'].'" disabled /></td>
						</tr>
						<tr>
							<td>Direccion:</td><td><input type="text" id="dir1"value="'.$_POST['dir1'].'" disabled /></td>
						<tr>
							<td>Telefono:</td><td><input type="text" id="tel1" value="'.$_POST['tel1'].'" disabled /></td>
						</tr>
						<tr>
							<td>Email:</td><td><input type="text" id="email1" value="'.$_POST['email1'].'" disabled /></td>
						</tr>
						<tr>
							<td>Fecha Nacimiento:</td><td><input type="text" id="fechNac1" value="'.$_POST['fechNac1'].'" disabled /></td>
						</tr>
						<tr>
							<td>Fecha de alta:</td><td><input type="text" id="fechAlt1" value="'.$_POST['fechAlt1'].'" disabled /></td>
						</tr>
						<tr>
							<td>Numero de cuentas:</td><td><input type="text" id="cuentas1" value="'.$_POST['cuentas1'].'" disabled /></td>
						</tr>
						<tr>
							<td>Saldo:</td><td><input type="tex" id="sald1" value="'.$_POST['sald1'].'" disabled /></td>
						</tr>
						<tr>
							<td>---------------</td><td>----------------</td>
						</tr>
						<tr>
							<td>DNI segundo titular:</td><td><input type="text" id="tit2" value="'.$_POST['tit2'].'" disabled />
						</td>
						<tr>
							<td>Nombre:</td><td><input type="text" id="nom2" value="'.$_POST['nom2'].'" disabled /></td>
						</tr>
						<tr>
							<td>Direccion:</td><td><input type="text" id="dir2"value="'.$_POST['dir2'].'" disabled /></td>
						<tr>
							<td>Telefono:</td><td><input type="text" id="tel2" value="'.$_POST['tel2'].'" disabled /></td>
						</tr>
						<tr>
							<td>Email:</td><td><input type="text" id="email2" value="'.$_POST['email2'].'" disabled /></td>
						</tr>
						<tr>
							<td>Fecha Nacimiento:</td><td><input type="text" id="fechNac2" value="'.$_POST['fechNac2'].'" disabled /></td>
						</tr>
						<tr>
							<td>Fecha de alta:</td><td><input type="text" id="fechAlt2" value="'.$_POST['fechAlt2'].'" disabled /></td>
						</tr>
						<tr>
							<td>Numero de cuentas:</td><td><input type="text" id="cuentas2" value="'.$_POST['cuentas2'].'" disabled /></td>
						</tr>
						<tr>
							<td>Saldo:</td><td><input type="tex" id="sald2" value="'.$_POST['sald2'].'" disabled /></td>
						</tr>
						<tr>
							<td>Importe de apertura:</td><td><input type="text" id="apertura"/></td>
						</tr>
						<tr>
								<td colspan="2"><div class="error" id="error_apertura"></div></td>
						</tr>				
						<tr>
							<td><a  href="" id="confAlta" class="boton">Confirmar</a></td>
							<td><a  href="" id="cancAlta" class="boton">Cancelar</a></td>
						</tr>
					</table>
		
				</body>
			</html>';
}	
//Respuesta cuando el input oculto vale 4
function respuestaEstado4()
{
	//Se comprueba el importe de apertura
	if(!is_numeric($_POST['apertura']) || $_POST['apertura']<=0)
	{
		echo '<h2>El importe introducido no es válido</h2>';
		exit();
	}
		
	//Se conecta a la base de datos
	$conexion= new mysqli("localhost","root","nohay2sin3","Banco");
	if(mysqli_connect_errno())
	{
		echo "ERROR!--".mysqli_connect_error($conexion);
		mysqli_close($conexion);
		exit();
	}
	
	
	$tit1=$_POST['tit1'];
	$numCu=$_POST['numCu'];
	$nom1=$_POST['nom1'];
	$dir1=$_POST['dir1'];
	$tel1=$_POST['tel1'];
	$email1=$_POST['email1'];
	$fechNac1=$_POST['fechNac1'];
	$fechAlt1=$_POST['fechAlt1'];
	$cuentas1=$_POST['cuentas1'];
	$sald1=$_POST['sald1'];
	$apertura=$_POST['apertura'];
	//Se comprueba si existe el titular
	$sentenciaTitular="SELECT * FROM clientes where cl_dni='".$tit1."'";
	
	//Si no existe el titular se da de alta
	if(mysqli_num_rows(mysqli_query($conexion,$sentenciaTitular))<=0)
	{
			
		$alta="INSERT INTO clientes (cl_dni,cl_nom,cl_dir,cl_tel,cl_ema,cl_fna,cl_fcl,cl_ncu,cl_sal) VALUES
				('".$tit1."', '".$nom1."', '".$dir1."', '".$tel1."', '".$email1."', '".$fechNac1."', '".$fechAlt1."', ".(int)($cuentas1+1).", $apertura );";
		$resultado1=mysqli_query($conexion, $alta);
	}
	//Si existe se actualiza el saldo
	else
	{
		$actualizar="UPDATE clientes SET cl_sal=cl_sal+".(int)$apertura.", cl_ncu=".(int)($cuentas1 +1)." WHERE cl_dni='".$tit1."'";
		$resultado1=mysqli_query($conexion,$actualizar);
	}
	
	$resultado2=true;
	$tit2=$_POST['tit2'];
	//Si existe segundo titular
	if($tit2!="")
	{
		$tit2=$_POST['tit2'];
		$nom2=$_POST['nom2'];
		$dir2=$_POST['dir2'];
		$tel2=$_POST['tel2'];
		$email2=$_POST['email2'];
		$fechNac2=$_POST['fechNac2'];
		$fechAlt2=$_POST['fechAlt2'];
		$cuentas2=$_POST['cuentas2'];
		$sald2=$_POST['sald2'];
		//Se comprueba si existe el segundo titular
		$sentenciaTitular2="SELECT * FROM clientes where cl_dni='".$tit2."'";
		//Si no existe el segundo titular se da de alta
		if(mysqli_num_rows(mysqli_query($conexion,$sentenciaTitular2))<=0)
		{
	
			$alta="INSERT INTO clientes (cl_dni,cl_nom,cl_dir,cl_tel,cl_ema,cl_fna,cl_fcl,cl_ncu,cl_sal) VALUES
					('".$tit2."', '".$nom2."', '".$dir2."', '".$tel2."', '".$email2."', '".$fechNac2."', '".$fechAlt2."', ".(int)($cuentas2+1).", $apertura );";
			$resultado2=mysqli_query($conexion, $alta);
		}
		//Si existe se actualiza el saldo
		else
		{
			$actualizar="UPDATE clientes SET cl_sal=cl_sal+".(int)$apertura.", cl_ncu=".(int)($cuentas2 +1)." WHERE cl_dni='".$tit2."'";
			$resultado2=mysqli_query($conexion,$actualizar);
		}
	}
	
	
	//Modificacion tabla CUENTAS ( se da de alta la cuenta)
	$sentenciaCuentas="INSERT INTO cuentas (cu_ncu, cu_dn1, cu_dn2, cu_sal) VALUES
  				('".$numCu."','".$tit1."','".$tit2."',$apertura);";
	$resultado3=mysqli_query($conexion, $sentenciaCuentas);
	
	//Modificacion tabla  MOVIMIENTOS ( se añade un movimiento )
	$fechaActual= getDate();
	$hora=$fechaActual['hours'].$fechaActual['minutes'].$fechaActual['seconds'];
	$fech=$fechaActual['year']."-".$fechaActual['mon']."-".$fechaActual['mday'];
	$sentenciaMov="INSERT INTO movimientos (mo_ncu, mo_fec, mo_hor, mo_des, mo_imp) VALUES
			   ('".$numCu."','$fech','$hora ', 'Apertura de Cuenta','".$apertura."')";
	$resultado4=mysqli_query($conexion, $sentenciaMov);
	
	//Si ha ocurrido algun error hace Rollback
	if(!$resultado1 || !$resultado2 || !$resultado3 || !$resultado4)
	{
		echo '<h2>Ha ocurrido un error durante la operación</h2>';
		mysqli_rollback($conexion);
		mysqli_close($conexion);
		exit();
	}
	
	echo "<h2>Operacion realizada correctamente</h2>";
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
if($_POST['estado']==2)
{
	respuestaEstado2();
}
if($_POST['estado']==3)
{
	respuestaEstado3();
}
if($_POST['estado']==4)
{
	respuestaEstado4();
}

?>