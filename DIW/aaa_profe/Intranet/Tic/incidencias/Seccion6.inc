<?php	//Funciones 
//include 'Tic/conexion_poo.inc';
$_SESSION["falta"] = false;
function comprobarFormulario ($formulario){
	if ($formulario == "formInsertar"){
		if ($_POST["tic_enviodatos"] == "send"){
			if ($_POST["profesor"] != ""  
					//&& $_POST["email"] != "" 
					&& $_POST["incidencia"] != ""
					&& $_POST["lugar"] != "" && $_POST["titulo"] != ""){
				//$mensajeFallo= "";
				return true;
				
			} else{
				//$mensajeFallo = "No se ha introducido algún campo obligatorio";
				$_SESSION["falta"] = true;
				
				return false;
			}
		}
	}else if ($formulario == "formActualizar"){
		if ($_POST["tic_enviodatos"] == "send"){
			if ($_POST["profesor"] != ""  
					//&& $_POST["email"] != "" 
					&& $_POST["incidencia"] != ""
					&& $_POST["lugar"] != "" && $_POST["titulo"] != ""
					&& $_POST["estado"] != "" && $_POST["respuesta"] != ""){
				//$mensajeFallo= "";
				return true;
				
			} else{
				//$mensajeFallo = "No se ha introducido algún campo obligatorio";
				$_SESSION["falta"] = true;
				
				return false;
			}
		}
	}
}

function guardar_datos (){
 	$bd_servidor = "localhost";
 	$bd_usuario = "phpuser";
 	$bd_password = "phpp@asswd1011";
 	$bd_basedatos = "basedatos";
	$conexion = new mysqli($bd_servidor, $bd_usuario, $bd_password, $bd_basedatos);
	//$conexion = new mysqli($servidor, $usuario , $contrasenia, $nombrebd);
	
	if (mysqli_connect_errno()) {
		printf("Error de conexión: %s\n", mysqli_connect_error());
		exit();
	}
	if($_POST["email"] == ""){
		$email = "Sin email";
	}else{
		$email = $_POST["email"];
	}
	//$descripcion = utf8_encode($descripcion);
	$id_prof = utf8_encode($_POST["id_prof"]);
	$lugar = utf8_encode($_POST["lugar"]);
	$titulo = utf8_encode($_POST["titulo"]);
	$respuesta = utf8_encode("Sin Respuesta");
	$incidencia = utf8_encode($_POST["incidencia"]);
	$profesor = utf8_encode($_POST["profesor"]);
	$descripcion = $profesor . " - " . $lugar .
	"\n" . $incidencia . "\n" . $email;
	
	
	//$sql .= "VALUES (?, ?, ?,'Sin Respuesta', 'E')";
	$sql = "INSERT INTO anomalias_tic (at_codpro, at_titulo, at_descri, at_lugar, at_respue, at_estado) ".
		" VALUES ('" . $id_prof . "', '" . $titulo . "', '". $descripcion . "', 
			'" . $lugar . "','" . $respuesta . "', 'E')";
	// RESPUESTA: E - 
	// echo $sql;
	
	if ($sentencia = $conexion->prepare($sql)){
		
		//$sentencia->bind_param("iss", $_POST["id_prof"], $descripcion,
		//		$_POST["lugar"]);
		$sentencia->execute() or die ("Error execute: " . $conexion->error);
		$sentencia->close();
		
		
	} else{
		echo "Fallo con el prepare " . $conexion->error;
		echo $sql;
	}
	
}

function actualizar_datos(){
	$conexion = new mysqli("localhost", "phpuser", "phpp@asswd1011", "basedatos");
	
	if (mysqli_connect_errno()) {
		printf("Error de conexión: %s\n", mysqli_connect_error());
		exit();
	}
	
	$estado = $_POST["estado"];
	$respuesta = utf8_encode($_POST["respuesta"]);
	
	/* UPDATE anomalias_tic SET at_titulo = 'Titulo 2', at_lugar = 'Matematicas'
	WHERE at_id = 4 */
	
	
	$sql = "UPDATE anomalias_tic SET at_estado = '" . $estado . "', 
			at_respue = '" . $respuesta . "' WHERE at_id = " . $_POST["id_incidencia"];
	
	
	if ($sentencia = $conexion->prepare($sql)){
	
		$sentencia->execute() or die ("Error execute: " . $conexion->error);
		$sentencia->close();
	
	
	} else{
		echo "Fallo con el prepare " . $conexion->error;
		echo $sql;
	}
}

function enviar_mensaje (){
	//ini_set($varname, $newvalue);
	//$titulo = "Incidencia de: " . $_POST["profesor"];
	$titulo = $_POST["titulo"];
	$para = "hkr.dimove@gmail.com";
	$mensaje = $_POST["profesor"] . " - " . $_POST["departamento"] .
		"\n" . $_POST["incidencia"] . "\n" . $_POST["email"];
	$cabeceras = "From: " . $_POST["email"] . "\r\n";
	mail($para, $titulo, $mensaje, $cabeceras);
	// Parametros a configurar del php.ini
	// SMTP - nombre de DNS o IP del servidor SMTP para mail()
	// sendmail_from - cuenta email que deberia usarse en el email que se envia desde
	// PHP (windows (?) no estoy del todo seguro que pasa con ubuntu)
	
}

function comprobar_permisos(){
	$conexion = new mysqli("localhost", "phpuser", "phpp@asswd1011", "basedatos");
	
	if (mysqli_connect_errno()) {
		printf("Error de conexión: %s\n", mysqli_connect_error());
		exit();
	}
	
	$sql = "SELECT us_codrol FROM usuarios WHERE us_cuenta = '" . $_SESSION["prueba"] ."'";
	
	if ($sentencia = $conexion->prepare($sql)){
		$sentencia->execute() or die ("Error execute: " . $conexion->error);
		$sentencia->bind_result($rol);
		$sentencia->fetch();
		$sentencia->close();
	} else{
		echo "Fallo con el prepare " . $conexion->error;
		//echo $sql;
	}
	if ($rol == 90) 	return true;
	else 				return false;
}

function borrar_datos(){
	$conexion = new mysqli("localhost", "phpuser", "phpp@asswd1011", "basedatos");
	
	if (mysqli_connect_errno()) {
		printf("Error de conexión: %s\n", mysqli_connect_error());
		exit();
	}
	
	$sql = "DELETE FROM anomalias_tic WHERE at_id = " . $_POST["id_incidencia"];
	
	if ($sentencia = $conexion->prepare($sql)){
	
		$sentencia->execute() or die ("Error execute: " . $conexion->error);
		$sentencia->close();
	
	
	} else{
		echo "Fallo con el prepare " . $conexion->error;
		echo $sql;
	}
}


?>

<div id='cuerpo-centro'>



	<form name="form1" action="index.php?tic&opcion=incidencias" method="post">
		<div id="tic_CntMenu">
			<div>
			<a href="javascript:document.form1.tic_oculto.value=1; document.form1.submit();">
				Introducir una petici&oacute;n o incidencia</a>
			</div>
			<div style="border-right: 2px solid black; border-left: 2px solid black;">
			<a href="javascript:document.form1.tic_oculto.value=2; document.form1.submit();">
				Consulta estado de una petici&oacute;n o incidencia</a>
			</div>
			<div>
			<a href="javascript:document.form1.tic_oculto.value=3; document.form1.submit();">
				Administraci&oacute;n incidencias</a>
			</div>
			<input class="tic_inputOculto" id="tic_oculto" name="tic_oculto" value="">
		</div>
	</form>
<?php 
	//Comprobamos si es la primera entrada en la zona
	if (!isset($_SESSION["tic_oculto"]) && !isset($_POST["tic_oculto"])){
		//Esta variable POST, cuando se envia el formulario de los datos, 
		//se borrará. Para mantener la variable de sesion, se checkea
		//que post no inutilice session
		echo '	<script type="text/javascript">
					var obj = document.getElementById("senda");
					obj.removeChild(obj.firstChild);
					obj.innerHTML = "Usted se encuentra en la p&aacute;gina: TIC - Incidencias";
				</script>';
	//Miramos si no es primera vez,  si se ha seleccionado ya una
	}else if (!isset($_SESSION["tic_oculto"]) && isset($_POST["tic_oculto"])){
		$_SESSION["tic_oculto"] = $_POST["tic_oculto"];
	// Tras la navegacion continuada ambas tendran datos
	}else if (isset($_SESSION["tic_oculto"]) && isset($_POST["tic_oculto"])){
		// Comprobamos si se ha enviado otra opcion
		if ($_SESSION["tic_oculto"] != $_POST["tic_oculto"]){
			//Si Post tiene otro valor, nos aseguramos que no este vacio
			// (Caso que se da cuando se envian datos con otros formularios)
			if ($_POST["tic_oculto"] != "")
				//Si Post tiene un valor de otra opcion se le asigna para su carga
				//En la su visualización 
				$_SESSION["tic_oculto"] = $_POST["tic_oculto"];
		}
		
	}
	
	// Si session tiene una opcion se procede a checkearse y a mandar
	// a la zona correspondiente.
	if (isset($_SESSION["tic_oculto"])){
		if ($_SESSION["tic_oculto"] == 1){
			//Se comprueba mediante un campo oculto si se han enviado los datos
			// de la incidencia	
			//$mensajeFallo;		
			if (isset($_POST["tic_enviodatos"]) && comprobarFormulario("formInsertar")){
				guardar_datos();
				//enviar_mensaje();
				echo "Datos Correctos<br/>";
				echo "<a href='index.php?tic&opcion=incidencias'>Volver</a>";
			}else { //Si no se carga el formulario
				
				//Recogemos los datos del profesor que se encuentra logeado.
				$conexion = new mysqli($servidor, $usuario , $contrasenia, $nombrebd);
				if (mysqli_connect_errno()) {
					printf("Error de conexión: %s\n", mysqli_connect_error());
					exit();
				}
				
				//echo $_SESSION["prueba"];
				$sql = "SELECT pr_codigo, pr_nombre, pr_email FROM profesores WHERE pr_cuenta = '" . $_SESSION["prueba"] ."'";
				//echo $sql;
				
				if ($sentencia = $conexion->prepare($sql)){
					//$sentencia->bind_param("s", $_SESSION["prueba"]);
					$sentencia->execute();
					$sentencia->bind_result($codigo, $nombre, $email);
					$sentencia->fetch();
					//echo $codigo;
				}else {
					printf("Error de conexión: %s\n", mysqli_connect_error());
					exit();
				}
				
				
				
				
				//echo $_SESSION["prueba"];
?>
			<script type="text/javascript">
				var obj = document.getElementById("senda");
				obj.removeChild(obj.firstChild);
				obj.innerHTML = "Usted se encuentra en la p&aacute;gina: TIC - Incidencias - Alta";
			</script>
			<form name="formInsertar" action="index.php?tic&opcion=incidencias" method="post">
				<h2 id="tic_h2">Alta de incidencias</h2>
				
				<table class="tic_tabla" cellspacing="0">
				<tr>
					<td colspan="2"  class="tic_TDcabecera">
						<span style="float: left;">Rellena campos de la incidencia</span> <span style="float: right; margin-right: 5px;">(*) Obligatorios</span>
					</td>
				</tr>
				<tr>
					<td class="tic_TDetiqueta">
						Profesor(*)
					</td>
					<td class="tic_TDcontent">
						<INPUT type="TEXT" name="profesor" maxlength="50"
							style="width: 97%; background-color: silver; color: grey;" 
							value="" readonly="readonly"> 
						<input type="text" class="tic_inputOculto" name="id_prof">
						<input type="text" class="tic_inputOculto" name="id_incidencia">
					</td>
				</tr>
				<tr>
					<td class="tic_TDetiqueta">
						T&iacute;tulo(*)
					</td>
					<td class="tic_TDcontent">
						<INPUT type="TEXT" name="titulo" maxlength="50"
							style="width: 97%" value="">
					</td>
				</tr>
		<!-- 		<tr> -->
		<!-- 			<td class="tic_TDetiqueta"> -->
		<!-- 				Departamento(*) -->
		<!-- 			</td> -->
		<!-- 			<td class="tic_TDcontent"> -->
		<!-- 				<INPUT type="TEXT" name="departamento" maxlength="50" -->
		<!-- 					style="width: 97%" value=""> -->
		<!-- 			</td> -->
		<!-- 		</tr> -->
				<tr>
					<td class="tic_TDetiqueta">
						Email(*)
					</td>
					<td class="tic_TDcontent">
						<INPUT type="TEXT" name="email" maxlength="100"
							style="width: 97%; background-color: silver; color: grey; " 
							value="" readonly="readonly"> 
					</td>
				</tr>
				<tr>
					<td class="tic_TDetiqueta">
						Lugar(*)
					</td>
					<td class="tic_TDcontent">
						<INPUT type="TEXT" name="lugar" maxlength="100"
							style="width: 97%">
					</td>
				</tr>
				<tr>
					<td class="tic_TDetiqueta">
						Incidencia(*)
					</td>
					<td class="tic_TDcontent">
						<TEXTAREA name="incidencia" rows="5" style="width: 97%"
								onfocus="if (this.value == '[detalle su incidencia]') this.value=''">[detalle su incidencia]</TEXTAREA>
					</td>
				</tr>
				<tr>
					<td class="tic_TDalerta" colspan="2">
						<span id="tic_alerta">Alg&uacute;n campo obligatorio no esta relleno</span>
					</td>
				</tr>
				</table>
				<input type="text" class="tic_inputOculto" name="tic_enviodatos" value="">
		
				<div class="tic_enlace"><a href="javascript:document.formInsertar.tic_enviodatos.value='send';
				document.formInsertar.submit()">Guardar</a></div>
			</form>


<?php 
// 			if ($email != ""){
// 				echo "<script type='text/javascript'>" .
// 					"document.formInsertar.profesor.value = '" . utf8_decode($nombre) . "';" .
// 					"document.formInsertar.id_prof.value = '" . $codigo . "';" .
// 					"document.formInsertar.email.value = '" . utf8_decode($email) . "';" .
// 					"document.formInsertar.email.readonly = 'readonly';" . 
// 					"document.formInsertar.email.style.backgroundColor = 'silver';" .
// 					"document.formInsertar.email.style.color = 'grey';" .
					
// 					"</script>";
// 			}else{
				echo "<script type='text/javascript'>" .
						"document.formInsertar.profesor.value = '" . utf8_decode($nombre) . "';" .
						"document.formInsertar.id_prof.value = '" . utf8_decode($codigo) . "';" .
						"document.formInsertar.email.value = '" . utf8_decode($email) . "';" .
						"</script>";
// 			}
			
			$sentencia->close();
			$conexion->close();
			//Variable para reconocer si se ha realizado un envio de datos incorrectos
			//Se procede a hacer visible un div oculto
			if ($_SESSION["falta"] == true)
				echo "<script>document.getElementById('tic_alerta').style.display = 'block';</script>";
			} //FIN formulario
		}//FIN Opcion 1
		else if ($_SESSION["tic_oculto"] == 2) {
			
 			$conexion = new mysqli($servidor, $usuario , $contrasenia, $nombrebd);
 			if (mysqli_connect_errno()) {
 				printf("Error de conexión: %s\n", mysqli_connect_error());
 				exit();
 			}
						
			$sql = "SELECT a.at_id AS id_inc, a.at_titulo AS titulo, a.at_descri AS descripcion, a.at_lugar AS lugar,
					a.at_respue AS respuesta, a.at_estado AS estado, a.at_fechoy AS fecha, p.pr_codigo AS codigo,
					p.pr_nombre AS nombre, p.pr_email AS email
					FROM anomalias_tic a
					RIGHT OUTER JOIN profesores p ON p.pr_codigo = a.at_codpro
					WHERE p.pr_cuenta = '" . $_SESSION["prueba"] ."'";
			//echo $sql;
			
			$datos = array();
			$z = 0;
			if ($fetch = $conexion->query($sql)  or die ("Error: " . $conexion->error)){
				while ($obj = $fetch->fetch_object()){
					//echo $obj->id_inc . "<br/>";
					$datos[$z] = array ($obj->id_inc, $obj->titulo, $obj->descripcion, $obj->lugar,
						 $obj->respuesta, $obj->estado, $obj->fecha);
					$z++;
				}
			}
?> 
		<script type="text/javascript">
			var obj = document.getElementById("senda");
			obj.removeChild(obj.firstChild);
			obj.innerHTML = "Usted se encuentra en la p&aacute;gina: TIC - Incidencias - Consulta";
		</script>
		<form name="formConsultar" action="index.php?tic&opcion=incidencias" method="POST">
			<h2 id="tic_h2">Consulta de incidencias</h2>
			
			<select name="tic_select">
				<option value="0"> 
				<?php 
					for ($y = 0; $y < count($datos); $y++){
							echo "<option value='" . $datos[$y][0] . "'>" . utf8_decode($datos[$y][1]) . "\n";
					}
				?>
			</select><br />
			<div class="tic_enlace"><a href="javascript:
				document.formConsultar.tic_consulta.value = document.formConsultar.tic_select.value;
				document.formConsultar.submit()">Consultar</a>
			<input type="text" class="tic_inputOculto" name="tic_consulta"></div>
		</form><br />
		<?php 
			if (isset($_POST["tic_consulta"])){
				if($_POST["tic_consulta"] != "0"){
					$conexion = new mysqli($servidor, $usuario , $contrasenia, $nombrebd);
					if (mysqli_connect_errno()) {
						printf("Error de conexión: %s\n", mysqli_connect_error());
						exit();
					}
					$sql = "SELECT at_id AS id_inc,at_titulo AS titulo, at_descri AS descripcion, at_lugar AS lugar,
								at_respue AS respuesta, at_estado AS estado, at_fechoy AS fecha
								FROM anomalias_tic where at_id = " . $_POST["tic_consulta"] . "";
						
					if ($fetch = $conexion->query($sql)  or die ("Error: " . $conexion->error)){
						$obj = $fetch->fetch_object();
						if ($obj->estado == "E"){
							$obj->estado = "En espera";
						}else if ($obj->estado == "P"){
							$obj->estado = "Proces&aacute;ndose";
						}else if ($obj->estado == "R"){
							$obj->estado = "Resuelto";
						}
						//style='width:80%; margin:auto;' border='1'
						echo "<table class='tic_tabla'  cellspacing='0'> 
								<tr><td colspan='4'  class='tic_TDcabecera'></td></tr>
 								<tr><td class='tic_TDetiqueta' colspan='2'>T&iacute;tulo</td>
 								<td class='tic_TDcontent' colspan='2'>" . utf8_decode($obj->titulo) . "</td>
 								</tr>
								<tr><td class='tic_TDetiqueta' colspan='2'>Descripci&oacute;n
 								</td>
 								<td class='tic_TDcontent' colspan='2'>" . utf8_decode($obj->descripcion) . "</td>
 								</tr>
								<tr>
								<td class='tic_TDetiqueta2'>Estado</td>
								<td class='tic_TDcontent2-1'>" . utf8_decode($obj->estado) . "</td>
								<td class='tic_TDetiqueta2'>Respuesta</td>
 								<td class='tic_TDcontent2-2'>" . utf8_decode($obj->respuesta) . "</td>
 								</tr>
								<tr><td colspan='4'  class='tic_TDcabecera'></td></tr>
 								</table>
 							";
					}
				}
			}
		}else if ($_SESSION["tic_oculto"] == 3){
			if (comprobar_permisos()){
				if (isset($_POST["tic_enviodatos"])){
					if ($_POST["tic_enviodatos"] == "send" && comprobarFormulario("formActualizar")){
						actualizar_datos();
						//enviar_mensaje();
						echo "Datos actualizados<br/>";
						echo "<a href='index.php?tic&opcion=incidencias'>Volver</a>";
						// Fin datos enviados
					}else if ($_POST["tic_enviodatos"] == "del"){
						borrar_datos();
						echo "Datos borrados<br/>";
						echo "<a href='index.php?tic&opcion=incidencias'>Volver</a>";
					}
				}else{ 
				$conexion = new mysqli($servidor, $usuario , $contrasenia, $nombrebd);
				if (mysqli_connect_errno()) {
					printf("Error de conexión: %s\n", mysqli_connect_error());
					exit();
				}
				$sql = "SELECT IFNULL(a.at_id,0) AS id_inc, a.at_titulo AS titulo, a.at_descri AS descripcion, a.at_lugar AS lugar,
						a.at_respue AS respuesta, a.at_estado AS estado, a.at_fechoy AS fecha, p.pr_codigo AS codigo, 
						p.pr_nombre AS nombre, p.pr_email AS email
						FROM anomalias_tic a
						RIGHT OUTER JOIN profesores p ON p.pr_codigo = a.at_codpro
						WHERE a.at_id <> 0";
				
				$datos = array();
				$z = 0;
				if ($fetch = $conexion->query($sql)  or die ("Error: " . $conexion->error)){
					while ($obj = $fetch->fetch_object()){
						//echo $obj->id_inc . "<br/>";
						$datos[$z] = array ($obj->id_inc, $obj->titulo, $obj->descripcion , $obj->lugar,
								$obj->respuesta, $obj->estado, $obj->fecha, $obj->codigo,
								$obj->nombre, $obj->email);
						$z++;
					}
				}
?>
				<script type="text/javascript">
					var obj = document.getElementById("senda");
					obj.removeChild(obj.firstChild);
					obj.innerHTML = "Usted se encuentra en la p&aacute;gina: TIC - Incidencias - Administrar";
				</script>
				<form name="formAdministrar" action="index.php?tic&opcion=incidencias" method="POST">
					<h2 id="tic_h2">Administraci&oacute;n de incidencias</h2>
					<select name="tic_select">
						<option value="0"> 
<?php 
							//echo "<h1>" + $inc, $descri, $lugar, $respuesta, $estado, $fecha + "</h1>"; 
							//echo $datos[0][1];
							for ($y = 0; $y < count($datos); $y++){
									echo "<option value='" . $datos[$y][0] . "'>" . utf8_decode($datos[$y][1]) . "\n";
							}
?>
					</select><br />
					<div class="tic_enlace"> <a href="javascript:
						document.formAdministrar.tic_administrar.value = document.formAdministrar.tic_select.value;
						document.formAdministrar.submit()">Consultar</a></div>
					<input type="text" class="tic_inputOculto" name="tic_administrar">
				</form><br />
<?php 
			
				// Si se ha enviado una seleccion y es diferente del valor vacio inicial se carga el formulario
				if (isset($_POST["tic_administrar"])){
					if ($_POST["tic_administrar"] != 0){
						
					
						// Se busca en el array la incidencia seleccionada para sacar los datos
						for($y = 0; $y < count($datos); $y++){
							if($datos[$y][0] == $_POST["tic_administrar"]){
								//echo $_POST["tic_administrar"];
								$up_id = $datos[$y][0];
								$up_titulo = utf8_decode($datos[$y][1]);
								//$up_descripcion = trim($datos[$y][2], "\n");
								$up_descripcion = utf8_decode(str_replace("\n", " ", $datos[$y][2]));
								$up_lugar = utf8_decode($datos[$y][3]);
								$up_respuesta = utf8_decode($datos[$y][4]);
								$up_estado = $datos[$y][5];
								$up_fecha = $datos[$y][6];
								$up_codigo = $datos[$y][7];
								$up_nombre = utf8_decode($datos[$y][8]);
								$up_email = $datos[$y][9];
								break;
							}
						}
					
?>
				<form name="formActualizar" action="index.php?tic&opcion=incidencias" method="post">
					<table class="tic_tabla" cellspacing="0">
					<tr>
						<td colspan="2"  class="tic_TDcabecera">
							<span style="float: left;">Campos marcados como modificables</span> <span style="float: right; margin-right: 5px;">(*) Obligatorios</span>
						</td>
					</tr>
					<tr>
						<td class="tic_TDetiqueta">
							Profesor
						</td>
						<td class="tic_TDcontent">
							<INPUT type="TEXT" name="profesor" maxlength="50"
								style="width: 97%; background-color: silver; color: grey;" 
								value="" readonly="readonly"> 
							<input type="text" class="tic_inputOculto" name="id_prof">
							<input type="text" class="tic_inputOculto" name="id_incidencia">
						</td>
					</tr>
					<tr>
						<td class="tic_TDetiqueta">
							T&iacute;tulo
						</td>
						<td class="tic_TDcontent">
							<INPUT type="TEXT" name="titulo" maxlength="50"
								style="width: 97%" value="">
						</td>
					</tr>
		<!-- 			<tr> -->
		<!-- 				<td class="tic_TDetiqueta"> -->
		<!-- 					Departamento(*) -->
		<!-- 				</td> -->
		<!-- 				<td class="tic_TDcontent"> -->
		<!-- 					<INPUT type="TEXT" name="departamento" maxlength="50" -->
		<!-- 						style="width: 97%" value=""> -->
		<!-- 				</td> -->
		<!-- 			</tr> -->
					<tr>
						<td class="tic_TDetiqueta">
							Email
						</td>
						<td class="tic_TDcontent">
							<INPUT type="TEXT" name="email" maxlength="100"
								style="width: 97%; background-color: silver; color: grey; " 
								value="" readonly="readonly"> 
						</td>
					</tr>
					<tr>
						<td class="tic_TDetiqueta">
							Lugar
						</td>
						<td class="tic_TDcontent">
							<INPUT type="TEXT" name="lugar" maxlength="100"
								style="width: 97%">
						</td>
					</tr>
					<tr>
						<td class="tic_TDetiqueta">
							Incidencia
						</td>
						<td class="tic_TDcontent">
							<TEXTAREA name="incidencia" rows="5" style="width: 97%"  readonly="readonly"
									onfocus="if (this.value == '[detalle su incidencia]') this.value=''">[detalle su incidencia]</TEXTAREA>
						</td>
					</tr>
					<tr>
						<td class="tic_TDetiqueta">
							Respuesta(*)
						</td>
						<td class="tic_TDcontent">
							<select name="estado" size="3" style="float:left;">
								<option value = "E">En espera
								<option value = "P">Proces&aacute;ndose
								<option value = "R">Resuelto
							</select>
							<TEXTAREA name="respuesta" rows="5" style="width: 70%;" style="float:left;"></TEXTAREA>
						</td>
					</tr>
					<tr>
						<td class="tic_TDalerta" colspan="2">
							<span id="tic_alerta">Alg&uacute;n campo obligatorio no esta relleno</span>
						</td>
					</tr>
					</table>
					<input type="text" class="tic_inputOculto" name="tic_enviodatos" value="">
			
					<div class="tic_enlace"><a href="javascript:document.formActualizar.tic_enviodatos.value='send';
					document.formActualizar.submit()">Guardar</a></div>
					<div class="tic_enlace"><a href="javascript:borrar_incidencia();">Borrar</a></div>
				</form>
				
<?php 
					echo "<script type='text/javascript'>" .
							"document.formActualizar.profesor.value = '" . $up_nombre . "';" .
							"document.formActualizar.id_prof.value = '" . $up_codigo . "';" .
							"document.formActualizar.id_incidencia.value = '" . $up_id . "';" .
							"document.formActualizar.email.value = '" . $up_email . "';" .
							"document.formActualizar.lugar.value = '" . $up_lugar . "';" .
							"document.formActualizar.titulo.value = '" . $up_titulo . "';" .
							"document.formActualizar.incidencia.value = '" . $up_descripcion . "';" .
							"document.formActualizar.respuesta.value = '" . $up_respuesta . "';" .
							"document.formActualizar.estado.value = '" . $up_estado . "';" .
							"</script>";
					}
				} // Fin de la tabla de administracion
			} // Fin de datos aun no enviados
		}else {
			echo "<br /><span style='font-family: TAHOMA; font-size: 20pt; color: #666666;
					font-style: normal;'>No tienes permisos</span>";
		} // Fin de comprobación de permisos rol TIC
	} // Fin de la opcion de administracion de las incidencias
	
}// Fin de busqueda de opcion seleccionada

?>

</div>
<script type="text/javascript">
	function borrar_incidencia(){
		if (confirm("¿Esta seguro que desea borrar la incidencia?")){
			document.formActualizar.tic_enviodatos.value='del';
			document.formActualizar.submit();
		}
	}
	document.getElementById("cuerpo-centro").style.backgroundColor = "#F0F0F0";
	document.getElementById("cuerpo-centro").style.backgroundImage = "none";
</script>










