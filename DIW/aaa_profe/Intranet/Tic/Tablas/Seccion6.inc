
<div id="cuerpo-centro">

<?php
 //metemos al principio del codigo ese div para centrar todo el contenido de la aplicacion
//Aplicación implementada por Javier Cañadas Martin 2014
// En caso de duda contactar en jcanadasmartin arroba gmail punto com
 
		//Para establecer la conexión con la base de datos.
 
	$mysqli = new mysqli('localhost', 'phpuser', 'phpp@asswd1011', 'basedatos'); 
	
	
		//aqui comprobamos (retornara true) si todas las variables que se le pasaron estan definidas. si es asi entraremos a dar de alta al alumno, en concreto al formulario

	if (isset($_GET['action']) && $_GET['action']=='altaAlum'){

			//aqui entraremos para insertar la información en la base de datos
		
		if (isset($_GET['enviar']) && $_GET['enviar']=='ok'){
		
				// en esta variable metemos el numero de matricula, que es el código de alumno, clave primaria de la tabla.
			
			$codigo = $_POST['numMatricula'];
			
				// select para para tomar el codigo del alumno, eso se utilizara para comprobar si ya existe
			
			$query = "SELECT al_codigo FROM alumnos WHERE al_codigo='$codigo'";
			
				//metemos en una variable la busqueda realizada en la tabla de la base de datos
			
			$result = $mysqli->query($query);
			
				// si el valor que inserta en boo es 0 indicara que no existe ningun alumno con ese codigo y por lo tanto saldra el formulario para crearlo
			
			$boo = $mysqli->affected_rows;
			
			if($boo==0){
			
				// almacenamos en stmt el contenido resultante de una consulta de cadena
			
			$stmt = $mysqli->prepare("INSERT INTO alumnos(al_codigo ,
					al_codgru ,
					al_nombre ,
					al_apell1 ,
					al_apell2 ,
					al_direcc ,
					al_poblac ,
					al_provin ,
					al_codpos ,
					al_telef1 ,
					al_telef2 ,
					al_email ,
					al_cuenta) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					
					//vinculamos los parametros a los marcadores
					
			$stmt->bind_param('issssssssssss',$_POST['numMatricula'],$_POST['grupo'],$_POST['nombre'],$_POST['apellido1'],$_POST['apellido2'],
							$_POST['direccion'],$_POST['poblacion'],$_POST['provincia'],$_POST['postal'],$_POST['telefono1'],$_POST['telefono2'],$_POST['email'],$_POST['usuario']
						);
						
						//ejecutamos la consulta
			$stmt->execute();
			
			//cerramos la sentencia
			$stmt->close();
			
		
			
			echo' 
			<br>
			Dado de alta con exito.
			<br>
			<a href="index.php?tictab">Volver</a>
			
			';
			
			//si el resultado no ha sido cero es que ese alumno ya existe y no procede.
			}else{

				echo' 
				<p>
				Alumno ya existe.
				</p>
				<a href="index.php?tictab&action=altaAlum">Volver</a>
				
				';
			}
		}
		
		
		// si no existia entrariamos al formulario de alta para una fila alumno en la tabla alumnos de la base de datos.
		
		else{
			echo' 					
				<form action="index.php?tictab&action=altaAlum&enviar=ok" method="POST">
				//este es el formulario con sus campos.
					<div style="position:absolute; width:289px;">
						<blockquote>N&uacute;mero de matricula:</blockquote><blockquote> <input type="text" name="numMatricula" maxlength="11"  "></blockquote>
						<blockquote>Grupo:</blockquote><blockquote> <input type="text" name="grupo" maxlength="5"></blockquote>
						<blockquote>Nombre:</blockquote><blockquote> <input type="text" name="nombre" maxlength="30"></blockquote>
						<blockquote>Primer Apellido:</blockquote><blockquote> <input type="text" name="apellido1" maxlength="30"></blockquote>
						<blockquote>Segundo Apellido:</blockquote><blockquote> <input type="text" name="apellido2" maxlength="30"></blockquote>
						<blockquote>Direcci&oacute;n:</blockquote><blockquote> <input type="text" name="direccion" maxlength="50"></blockquote>
						<blockquote>Poblaci&oacute;n:</blockquote><blockquote> <input type="text" name="poblacion" maxlength="50"></blockquote>
						
					</div>	

					<div style="position:absolute; width:289px; margin-left:289px;">
						<blockquote>Provincia:</blockquote><blockquote> <input type="text" name="provincia" maxlength="30"></blockquote>
						<blockquote>Cod. Postal:</blockquote><blockquote> <input type="text" name="postal" maxlength="5"></blockquote>
						<blockquote>Tel&eacute;fono 1:</blockquote><blockquote> <input type="text" name="telefono1" maxlength="12"></blockquote>
						<blockquote>Tel&eacute;fono 2:</blockquote><blockquote> <input type="text" name="telefono2" maxlength="12"></blockquote>
						<blockquote>Email:</blockquote><blockquote> <input type="text" name="email" maxlength="50"></blockquote>
						<blockquote>Usuario:</blockquote> <blockquote><input type="text" name="usuario" maxlength="30"></blockquote>
					</div>
					
					
					
					<div style="position:relative; top:520px;">
					
					<input type="submit" value="enviar" name="enviar"></blockquote>
					
					</div>		
				</form>
				
				
			';

		}

	}elseif(isset($_GET['action']) && $_GET['action']=='bajaAlum'){
	
		if (isset($_GET['lista'])){
		// asignamos a variables globales el valor introducido en los formularios nombre, apellido1 y apellido2.
		
			$nb = $_POST['nombre'];
			$ap1 = $_POST['apellido1'];
			$ap2 = $_POST['apellido2'];
			
			//introducimos en la variable global $al el array con los campos a introducir.
			
			$al = array("codigo","codigoGrupo","nombre","apellido1","apellido2");
			
			// introucimos en la variable global la consulta para elegir una determinada fila
			
			$query = "SELECT al_codigo,al_nombre,al_apell1,al_apell2,al_codgru FROM alumnos WHERE al_nombre='$nb'  and al_apell1= '$ap1' and al_apell2= '$ap2'";
			
			
			//a la variable resul le asgina lo que se ha ejecutado en la sentencia y vemos si coincide con algo
			
				if ($result = $mysqli->query($query) ) {
					$boo = $mysqli->affected_rows;
			
					// si el resultado es cero es porque no ha obtenido ningun resultado y por lo tanto no hay ningun alumno con esos campos.
					
					if ($boo == 0) {
					echo' 
						<p>No existe ningun alumno</p><br>
						<a href ="index.php?tictab&action=bajaAlum">Volver</>
					';
					//si no, si el resultado ha sido igual a uno se generara una tabla con la información del alumno elegido
					
					}elseif($boo == 1){
						
						$numfields= $result->field_count;
							echo "<table border=1>";
							   
							echo"<tr>";
						 
							for($i=0;$i<$numfields;$i++){
									 
									 echo '<th>'.$al[$i].'</th>';
							}

							echo "</tr>";
			
						//te crea un array con todo lo que te devuelve la sentencia, con el for each lo recorremos, 
						
							while ($row = $result->fetch_assoc()) {
									echo'<tr align="center">';
									foreach($row as $elem){
										echo'<td>'.$elem.'</td>';
									}
									echo"</tr>";
							}
							
							echo "</table><br>";
							//con esta sentencia liberamos espacio
							
							$result->free();
							
							//paramos ejecucion
							$mysqli->close();
							
							//una vez que esta localizado el alumno le pasamos el id unico para eliminarlo.
							//solicitamos el identificador del alumno, que es unico ya que es primary key para garantiza que no hay errores por dos alumnos que tengan igual nombre o algo similar.
							
							echo'
								<form action="index.php?tictab&action=bajaAlum&enviar=ok" method="POST">
								
									<div style="position:absolute; width:289px;">
										<blockquote>ID alumno:</blockquote><blockquote> <input type="text" name="idAlumno" maxlength="11"></blockquote>
							
										<input type="submit" value="enviar" name="enviar"></blockquote>
									</div>
									
								</form>
							
							';

					}
					else{
					
					//esto es cuando la consulta que hagamos da como resultado más de un alumno.
					
						$numfields= $result->field_count;
							echo "<table border=1>";
							   
							echo"<tr>";
						 
							for($i=0;$i<$numfields;$i++){
									 
									 echo '<th>'.$al[$i].'</th>';
							}

							echo "</tr>";
			
							while ($row = $result->fetch_assoc()) {
									echo'<tr align="center">';
									foreach($row as $elem){
										echo'<td>'.$elem.'</td>';
									}
									echo"</tr>";
							}
							//de nuevo , para filtrar en caso de que haya alumnos que compartan nombre o apellidos filtramos por el codigo de alumno.
							
							echo "</table><br>";
							$result->free();
							$mysqli->close();
							echo'
								<form action="index.php?tictab&action=bajaAlum&enviar=ok" method="POST">
								
									<div style="position:absolute; width:289px;">
										<blockquote>ID alumno:</blockquote><blockquote> <input type="text" name="idAlumno" maxlength="11"></blockquote>
										<input type="submit" value="enviar" name="enviar"></blockquote>
									</div>
								</form>
							
							';
					}
				}
		
		}elseif (isset($_GET['enviar']) && $_GET['enviar']=='ok'){
		
			//aqui ya ejecutamos la sentencia para eliminar alumno
			
			$stmt = $mysqli->prepare("delete from alumnos where al_codigo = ?");
			
			$stmt->bind_param('i',$_POST['idAlumno']);
			
			$stmt->execute();
			$stmt->close();
			
			echo' 
			<br>
			Alumno eliminado con exito
			</br>
			<a href ="index.php?tictab">Volver</a>


			
			';
		

		
		}else{
			
			echo' 					
				<form action="index.php?tictab&action=bajaAlum&lista" method="POST">
				
					<div style="position:absolute; width:289px;">
						<blockquote>Nombre:</blockquote><blockquote> <input type="text" name="nombre" maxlength="30"></blockquote>
						<blockquote>Primer Apellido:</blockquote><blockquote> <input type="text" name="apellido1" maxlength="30"></blockquote>
						<blockquote>Segundo Apellido:</blockquote><blockquote> <input type="text" name="apellido2" maxlength="30"></blockquote>
					</div>
					<div style="position:relative; top:220px;">
						<input type="submit" value="enviar" name="lista"></blockquote>
					</div>
				</form>
				
				
			';
			
		}
		

	}elseif(isset($_GET['action']) && $_GET['action']=='buscarAlum'){
	
		if (isset($_GET['lista'])){
			$nb = $_POST['nombre'];
			$ap1 = $_POST['apellido1'];
			$ap2 = $_POST['apellido2'];
			$al = array("codigo","codigoGrupo","nombre","apellido1","apellido2","direccion","poblacion","provincia","codigoPostal","telefono1","telefono2","email","cuenta");
			$query = "SELECT * FROM alumnos WHERE al_nombre='$nb'  and al_apell1='$ap1' and al_apell2='$ap2'";
			
				if ($result = $mysqli->query($query) ) {
					$boo = $mysqli->affected_rows;
			
					if ($boo == 0) {
					echo' 
						<p>No existe ningun alumno con esos datos</p>
						<br>
						<a href ="index.php?tictab&action=buscarAlum">Volver</>

					';
						
					}
					else{
					
						
						$numfields= $result->field_count;
							echo "<table border=1>";
							   
							echo"<tr>";
						 
							for($i=0;$i<$numfields;$i++){
									 
									 echo '<th>'.$al[$i].'</th>';
							}

							echo "</tr>";
			
							while ($row = $result->fetch_assoc()) {
									echo'<tr align="center">';
									foreach($row as $elem){
										echo'<td>'.$elem.'</td>';
									}
									echo"</tr>";
							}
							
							echo "</table><br>";
						$result->free();
						$mysqli->close();
						echo' 
				
							<form action="index.php?tictab&action=buscarAlum&enviar=ok" method="POST">
							
								<div style="position:absolute; width:289px;">
									<blockquote>ID alumno:</blockquote><blockquote> <input type="text" name="idAlumno" maxlength="11"></blockquote>

									<input type="submit" value="enviar" name="enviar"></blockquote>
								</div>
								
							</form>
							
						';

					}
				
					  
				} 
					
				

		}elseif(isset($_GET['enviar']) && $_GET['enviar']=='ok'){
			$al = array("codigo","codigoGrupo","nombre","apellido1","apellido2","direccion","poblacion","provincia","codigoPostal","telefono1","telefono2","email","cuenta");
			$cod = $_POST['idAlumno'];
			$query = "SELECT * FROM alumnos WHERE al_codigo='$cod'";
			$result = $mysqli->query($query);
			$numfields= $result->field_count;
				echo "<table border=1>";
					   
				 echo"<tr>";
				 
				for($i=0;$i<$numfields;$i++){
							 
							 echo "<th>".$al[$i]."</th>";
				}
						
				 echo"</tr>";
				 if ($result = $mysqli->query($query)) {
					 while ($row = $result->fetch_assoc()) {
								echo '<tr align="center">';
								foreach($row as $elem){
									
									echo "<td>".$elem."</td>";
								}
								echo "</tr>";

						   }
				}
					  
				 echo "</table><br>";
				 
		 echo '<a href ="index.php?tictab">Volver</a>';
		}else{
			
			echo' 					
				<form action="index.php?tictab&action=buscarAlum&lista" method="POST">
				
					<div style="position:absolute; width:289px;">
						<blockquote>Nombre:</blockquote><blockquote> <input type="text" name="nombre" maxlength="30"></blockquote>
						<blockquote>Primer Apellido:</blockquote><blockquote> <input type="text" name="apellido1" maxlength="30"></blockquote>
						<blockquote>Segundo Apellido:</blockquote><blockquote> <input type="text" name="apellido2" maxlength="30"></blockquote>
					</div>
					
					<div style="position:relative; top:220px;">
						<input type="submit" value="enviar" name="lista"></blockquote>
					</div>
					
				</form>
				
			';
			
		}
		
	
	}elseif(isset($_GET['action']) && $_GET['action']=='actualizarAlum'){
	
		if (isset($_GET['lista'])){
			
			$nb = $_POST['nombre'];
			$ap1 = $_POST['apellido1'];
			$ap2 = $_POST['apellido2'];
			$cont =0;
			
			$al = array("codigo","codigoGrupo","nombre","apellido1","apellido2","direccion","poblacion","provincia","codigoPostal","telefono1","telefono2","email","cuenta");
			$field = array("al_codigo","al_codgru","al_nombre","al_apell1","al_apell2","al_direcc","al_poblac","al_provin","al_codpos","al_telef1","al_telef2","al_email","al_cuenta");
			$query = "SELECT * FROM alumnos WHERE al_nombre='$nb'  and al_apell1= '$ap1' and al_apell2= '$ap2'";
			
			if ($result = $mysqli->query($query) ) {
				$numfields= $result->field_count;
				$boo = $mysqli->affected_rows;
			
				if ($boo == 0) {
					echo' 

					 <p>No existe ningun alumno</p><br>
					<a href ="index.php?tictab&action=actualizarAlum">Volver</>
					
					
					
					';
				}
				else{
					if($boo >=2){
						

						$numfields= $result->field_count;
						echo'
						<table border=1>';
													   
						echo"<tr>";
				
						for($i=0;$i<$numfields;$i++){
															 
							 echo '<th>'.$al[$i].'</th>';
						}
				
				
						echo"</tr>";
						
						while ($row = $result->fetch_assoc()) {
								echo '<tr align="center">';
								foreach($row as $elem){
									
									echo '<td>'.$elem.'</td>';
								}
								echo "</tr>";

						}
			
					  
						echo "</table><br>";
						
						echo'
						
							<form action="index.php?tictab&action=actualizarAlum&byOne" method="POST">
														
								<div style="position:absolute; width:289px;">
									<blockquote>ID alumno:</blockquote><blockquote> <input type="text" name="idAlumno" maxlength="11"></blockquote>
								
							
									<input type="submit" value="enviar" name="enviar"></blockquote>
								</div>
								
							</form>
							
							
						';
						
					}else{
			
						echo $boo;
						echo'<form action="index.php?tictab&action=actualizarAlum&enviar=ok" method="post">';
						while ($row = $result->fetch_assoc()) {
								
							foreach($row as $elem){
								if($al[$cont]=="codigo"){
									echo ''.$al[$cont].'<input type ="text" value='.$elem.' name='.$field[$cont].' readonly><br>';
								}
								elseif($elem==''){
									echo ''.$al[$cont].'<input type ="text" value="" name='.$field[$cont].'><br>';
								}
								else{
									echo ''.$al[$cont].'<input type ="text" value='.$elem.' name='.$field[$cont].'><br>';
								}
								$cont++;
							}
							
										
						}
						$result->free();
						$mysqli->close();
						echo'<input type="submit" value ="enviar" name="enviar">';
						echo'</form>';
					}
			}
			
		}
			
			//cuando haces la consulta y te encuentra más de uno-->
	}elseif(isset($_GET['byOne'])){
			$id = $_POST['idAlumno'];
			$cont =0;
			$al = array("codigo","codigoGrupo","nombre","apellido1","apellido2","direccion","poblacion","provincia","codigoPostal","telefono1","telefono2","email","cuenta");
			$field = array("al_codigo","al_codgru","al_nombre","al_apell1","al_apell2","al_direcc","al_poblac","al_provin","al_codpos","al_telef1","al_telef2","al_email","al_cuenta");
			$query = "SELECT * FROM alumnos WHERE al_codigo='$id'";
				if ($result = $mysqli->query($query) ) {
							echo'<form action="index.php?tictab&action=actualizarAlum&enviar=ok" method="post">';
								while ($row = $result->fetch_assoc()) {
								
									foreach($row as $elem){
										if($al[$cont]=="codigo"){
											echo ''.$al[$cont].'<input type ="text" value='.$elem.' name='.$field[$cont].' readonly><br>';
										}
										elseif($elem==''){
											echo ''.$al[$cont].'<input type ="text" value="" name='.$field[$cont].'><br>';
										}
										else{
											echo ''.$al[$cont].'<input type ="text" value='.$elem.' name='.$field[$cont].'><br>';
										}
										$cont++;
									}
							
										
								}
								$result->free();
								$mysqli->close();
							echo'<input type="submit" value ="enviar" name="enviar">';
							echo'</form>';
				}
					
			
		
		
		
		
		
		
		
		//aqui comprobamos (retornara true) si todas las variables que se le pasaron estan definidas. si es asi entraremos y actualizara el alumno
		
	}elseif(isset($_GET['enviar']) && $_GET['enviar']=='ok'){
				$cod = $_POST['al_codigo'];
				$codgru =$_POST['al_codgru'];
				$nb=$_POST['al_nombre'];
				$ap1=$_POST['al_apell1'];
				$ap2=$_POST['al_apell2'];
				$dir=$_POST['al_direcc'];
				$pob = $_POST['al_poblac'];
				$pro = $_POST['al_provin'];
				$pos = $_POST['al_codpos'];
				$tel1 = $_POST['al_telef1'];
				$tel2 = $_POST['al_telef2'];
				$email = $_POST['al_email'];
				$cue = $_POST['al_cuenta'];
				

		
				$query =  "UPDATE alumnos SET al_codigo='$cod', al_codgru='$codgru',al_nombre='$nb',al_apell1='$ap1',
				al_apell2='$ap2',al_direcc='$dir',al_poblac='$pob',al_provin='$pro',al_codpos='$pos',
				al_telef1='$tel1',al_telef2='$tel2',al_email='$email',al_cuenta='$cue'
				WHERE al_codigo='$cod'";

				
				$result = $mysqli->query($query);
				
				echo"<br>"."Alumno modificado con exito"."<br>";
				$mysqli->close();
				
				echo "<br>".'<a href ="index.php?tictab">Volver</a>';

		
		}else{
			//si no, entraremos aqui para poner de nuevo los valores del alumno
			
			echo' 
					
				<form action="index.php?tictab&action=actualizarAlum&lista" method="POST">
				
					<div style="position:absolute; width:289px;">
						<blockquote>Nombre:</blockquote><blockquote> <input type="text" name="nombre" maxlength="30"></blockquote>
						<blockquote>Primer Apellido:</blockquote><blockquote> <input type="text" name="apellido1" maxlength="30"></blockquote>
						<blockquote>Segundo Apellido:</blockquote><blockquote> <input type="text" name="apellido2" maxlength="30"></blockquote>

						<input type="submit" value="enviar" name="lista"></blockquote>
					</div>
					
				</form>
				
			';
			
		}
		
		
	}elseif (isset($_GET['action']) && $_GET['action']=='altaProfe'){
	
		if (isset($_GET['enviar']) && $_GET['enviar']=='ok'){
			if (isset($_GET['enviar']) && $_GET['enviar']=='ok'){
				$codigo = $_POST['codPro'];
				$query = "SELECT pr_codigo FROM profesores WHERE pr_codigo='$codigo'";
				$result = $mysqli->query($query);
				$boo = $mysqli->affected_rows;
				if($boo==0){

						$stmt = $mysqli->prepare("INSERT INTO profesores(pr_codigo ,
								pr_nombre ,
								pr_apell1 ,
								pr_apell2 ,
								pr_direcc ,
								pr_poblac ,
								pr_provin ,
								pr_codpos ,
								pr_telef1 ,
								pr_telef2 ,
								pr_email ,
								pr_coddep,
								pr_cuenta) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
								
						$stmt->bind_param('sssssssssssss',$_POST['codPro'],$_POST['nombre'],$_POST['apellido1'],$_POST['apellido2'],
										$_POST['direccion'],$_POST['poblacion'],$_POST['provincia'],$_POST['postal'],$_POST['telefono1'],$_POST['telefono2'],$_POST['email'],$_POST['codDep'],$_POST['usuario']
									);
						$stmt->execute();
						$stmt->close();
						echo' 
						<br>
						Profesor dado de alta con exito
						<br>
						<a href="index.php?tictab">Volver</a>
						
						
						';
				}
				else{
						echo' 
						<br>
						Profesor ya existe
						<br>
						<a href="index.php?tictab&action=altaProfe">Volver</a>
						
						
						';
				
				}
		}
		}else{
			echo' 
					
				<form action="index.php?tictab&action=altaProfe&enviar=ok" method="POST">
				
					<div style="position:absolute; width:289px;">
						<blockquote>Código profesor:</blockquote><blockquote> <input type="text" name="codPro" maxlength="5"></blockquote>
						<blockquote>Nombre:</blockquote><blockquote> <input type="text" name="nombre" maxlength="30"></blockquote>
						<blockquote>Primer Apellido:</blockquote><blockquote> <input type="text" name="apellido1" maxlength="30"></blockquote>
						<blockquote>Segundo Apellido:</blockquote><blockquote> <input type="text" name="apellido2" maxlength="30"></blockquote>
						<blockquote>Direcci&oacute;n:</blockquote><blockquote> <input type="text" name="direccion" maxlength="50"></blockquote>
						<blockquote>Poblaci&oacute;n:</blockquote><blockquote> <input type="text" name="poblacion" maxlength="50"></blockquote>
						
					</div>	

					<div style="position:absolute; width:289px; margin-left:289px;">
						<blockquote>Provincia:</blockquote><blockquote> <input type="text" name="provincia" maxlength="30"></blockquote>
						<blockquote>Cod. Postal:</blockquote><blockquote> <input type="text" name="postal" maxlength="5"></blockquote>
						<blockquote>Tel&eacute;fono 1:</blockquote><blockquote> <input type="text" name="telefono1" maxlength="12"></blockquote>
						<blockquote>Tel&eacute;fono 2:</blockquote><blockquote> <input type="text" name="telefono2" maxlength="12"></blockquote>
						<blockquote>Email:</blockquote><blockquote> <input type="text" name="email" maxlength="50"></blockquote>
						<blockquote>Código del departamento:</blockquote><blockquote> <input type="text" name="codDep" maxlength="5"></blockquote>
						<blockquote>Usuario:</blockquote> <blockquote><input type="text" name="usuario" maxlength="30"></blockquote>
					
					</div>
					<div style="position:relative; top:350px;">
					
					<input type="submit" value="enviar" name="enviar"></blockquote>
					
					</div>		
				</form>
				
			';

		}

	}elseif(isset($_GET['action']) && $_GET['action']=='bajaProfe'){
	echo"";
		if (isset($_GET['lista'])){
			$nb = $_POST['nombre'];
			$ap1 = $_POST['apellido1'];
			$ap2 = $_POST['apellido2'];
			$al = array("codigoProfe","nombre","apellido1","apellido2");			
			$query = "SELECT pr_codigo,pr_nombre,pr_apell1,pr_apell2 FROM profesores WHERE pr_nombre='$nb'  and pr_apell1= '$ap1' and pr_apell2= '$ap2'";
			
			
			
				if ($result = $mysqli->query($query) ) {
				$boo = $mysqli->affected_rows;
			
					if ($boo == 0) {
						 echo '<p>No existe ningun pprfesor</p><br>
						<a href ="index.php?tictab&action=bajaProf">Volver</>';
					}
					else{
						echo' ';
						$numfields= $result->field_count;
							echo "<table border=1>";
							   
							echo"<tr>";
						 
							for($i=0;$i<$numfields;$i++){
									 
									 echo '<th>'.$al[$i].'</th>';
							}

							echo "</tr>";
			
							while ($row = $result->fetch_assoc()) {
									echo'<tr align="center">';
									foreach($row as $elem){
										echo'<td>'.$elem.'</td>';
									}
									echo"</tr>";
							}
							echo '</div>';
							echo "</table><br>";

						$result->free();
						$mysqli->close();
						echo' 
					
							<form action="index.php?tictab&action=bajaProfe&enviar=ok" method="POST">
							
								<div style="position:absolute; width:289px;">
									<blockquote>ID profesor:</blockquote><blockquote> <input type="text" name="idProfe" maxlength="5"></blockquote>
								
									<input type="submit" value="enviar" name="enviar"></blockquote>
								</div>
								
							</form>
							
						';
					}
				}
		
		}elseif (isset($_GET['enviar']) && $_GET['enviar']=='ok'){
			
			$stmt = $mysqli->prepare("delete from profesores where pr_codigo = ?");
			$stmt->bind_param('s',$_POST['idProfe']);
			$stmt->execute();
			$stmt->close();
			echo'<br>'.' Se ha eliminado con exito al profesor.'.'<br>';
			echo'<a href ="index.php?tictab">Volver</a>';


			
		

		
		}else{
			
			echo' 
					
				<form action="index.php?tictab&action=bajaProfe&lista" method="POST">
				
					<div style="position:absolute; width:289px;">
						<blockquote>Nombre:</blockquote><blockquote> <input type="text" name="nombre" maxlength="30"></blockquote>
						<blockquote>Primer Apellido:</blockquote><blockquote> <input type="text" name="apellido1" maxlength="30"></blockquote>
						<blockquote>Segundo Apellido:</blockquote><blockquote> <input type="text" name="apellido2" maxlength="30"></blockquote>
					
				
						<input type="submit" value="enviar" name="lista"></blockquote>
					</div>
					
				</form>
				
			';
			
		}
		
	
	}elseif(isset($_GET['action']) && $_GET['action']=='buscarProfe'){
	
		if (isset($_GET['lista'])){
			$nb = $_POST['nombre'];
			$ap1 = $_POST['apellido1'];
			$ap2 = $_POST['apellido2'];
			$al = array("codigoProfe","nombre","apellido1","apellido2","direccion","poblacion","provincia","codigoPostal","telefono1","telefono2","email","codDep","cuenta");
			$query = "SELECT * FROM profesores WHERE pr_nombre='$nb' and pr_apell1='$ap1' and pr_apell2='$ap2'";
			
				if ($result = $mysqli->query($query) ) {
					$boo = $mysqli->affected_rows;
			
					if ($boo == 0) {
					echo' 
						 <p>No existe ningun profesor con esos datos. Revisa que has rellenado todos los campos. </p><br>
						<a href ="index.php?tictab&action=buscarProfe">Volver</a>
						
						
						';
					}
					elseif($boo == 1){
					
					$numfields= $result->field_count;
						echo' 

						<table border=1>
						   
						<tr>
						
						';
					 
						for($i=0;$i<$numfields;$i++){
								 
								echo ' <th>'.$al[$i].'</th>';
								 
						
						
						}
							
						echo"</tr>";
						
						while ($row = $result->fetch_assoc()) {
								echo '<tr align="center">';
								foreach($row as $elem){
									
									echo "<td>".$elem."</td>";
								}
								echo "</tr>";
						}
										 echo "</table><br>";
						$result->free();
						$mysqli->close();
						echo '<br><a href ="index.php?tictab">Volver</a>';
					
					}
					else{
						$numfields= $result->field_count;
						echo' 

							<table border=1>
							   
							<tr>
							
							';
						 
							for($i=0;$i<$numfields;$i++){
									 
									echo ' <th>'.$al[$i].'</th>';
									 
							
							
							}
								
						echo"</tr>";
						
						while ($row = $result->fetch_assoc()) {
								echo '<tr align="center">';
								foreach($row as $elem){
									
									echo "<td>".$elem."</td>";
								}
								echo "</tr>";
						}
										 echo "</table><br>";
						$result->free();
						$mysqli->close();
						
						echo '
							<form action="index.php?tictab&action=buscarProfe&enviar=ok" method="POST">
							
								<div style="position:absolute; width:289px;">
									<blockquote>ID Profe:</blockquote><blockquote> <input type="text" name="idProfe" maxlength="5"></blockquote>
								
							
									<input type="submit" value="enviar" name="enviar"></blockquote>
								</div>
								
							</form>
							
						';
					
					}
				}

		}elseif(isset($_GET['enviar']) && $_GET['enviar']=='ok'){
			$al = array("codigoProfe","nombre","apellido1","apellido2","direccion","poblacion","provincia","codigoPostal","telefono1","telefono2","email","codDep","cuenta");			
			$cod = $_POST['idProfe'];
			$query = "SELECT * FROM profesores WHERE pr_codigo='$cod'";
			$result = $mysqli->query($query);
			$numfields= $result->field_count;
				echo "<table border=1>";
					   
				 echo"<tr>";
				 
				for($i=0;$i<$numfields;$i++){
							 
							 echo "<th>".$al[$i]."</th>";
				}
						
				 echo"</tr>";
				 if ($result = $mysqli->query($query)) {
					 while ($row = $result->fetch_assoc()) {
								echo '<tr align="center">';
								foreach($row as $elem){
									
									echo "<td>".$elem."</td>";
								}
								echo "</tr>";

					 }
				}
					  
				 echo "</table><br>";
				 
		 echo '<a href ="index.php?tictab">Volver</a>';
		}else{
			
			echo' 
						
				<form action="index.php?tictab&action=buscarProfe&lista" method="POST">
				
					<div style="position:absolute; width:289px;">
						<blockquote>Nombre:</blockquote><blockquote> <input type="text" name="nombre" maxlength="30"></blockquote>
						<blockquote>Primer Apellido:</blockquote><blockquote> <input type="text" name="apellido1" maxlength="30"></blockquote>
						<blockquote>Segundo Apellido:</blockquote><blockquote> <input type="text" name="apellido2" maxlength="30"></blockquote>
						</div>
					
					<div style="position:relative; top:220px;">
						<input type="submit" value="enviar" name="lista"></blockquote>
					</div>
				</form>
				
			';
			
		}
	
	
}elseif(isset($_GET['action']) && $_GET['action']=='actualizarProfe'){
	echo" ";
		if (isset($_GET['lista'])){
			
			$nb = $_POST['nombre'];
			$ap1 = $_POST['apellido1'];
			$ap2 = $_POST['apellido2'];
			$cont =0;
			
			$al = array("codigo","nombre","apellido1","apellido2","direccion","poblacion","provincia","codigoPostal","telefono1","telefono2","email","codDep","cuenta");
			$field = array("pr_codigo","pr_nombre","pr_apell1","pr_apell2","pr_direcc","pr_poblac","pr_provin","pr_codpos","pr_telef1","pr_telef2","pr_email","pr_coddep","pr_cuenta");
			$query = "SELECT * FROM profesores WHERE pr_nombre='$nb'  and pr_apell1= '$ap1' and pr_apell2= '$ap2'";
			
			if ($result = $mysqli->query($query) ) {
				$numfields= $result->field_count;
				$boo = $mysqli->affected_rows;
			
				if ($boo == 0) {
					 echo '<p>No existe ningun profesor</p><br>
					<a href ="index.php?tictab&action=actualizarProfe">Volver</>';
				}
				else{
					if($boo >=2){
						echo" ";
						$numfields= $result->field_count;
						echo "<table border=1>";
													   
						echo"<tr>";
				
						for($i=0;$i<$numfields;$i++){
															 
							 echo "<th>".$al[$i]."</th>";
						}
				
				
						echo"</tr>";
						
						while ($row = $result->fetch_assoc()) {
								echo '<tr align="center">';
								foreach($row as $elem){
									
									echo "<td>".$elem."</td>";
								}
								echo "</tr>";

						   }
			
					  
						echo "</table><br>";
						
						echo' 
					
							<form action="index.php?tictab&action=actualizarProfe&byOne" method="POST">
														
								<div style="position:absolute; width:289px;">
									<blockquote>ID PRofe:</blockquote><blockquote> <input type="text" name="idProfe" maxlength="5"></blockquote>
								
								
									<input type="submit" value="enviar" name="enviar"></blockquote>
								</div>
								
							</form>
							
							
						';
						
					}else{
			
						echo $boo;
						echo'<form action="index.php?tictab&action=actualizarProfe&enviar=ok" method="post">';
						while ($row = $result->fetch_assoc()) {
								
							foreach($row as $elem){
								if($al[$cont]=="codigo"){
									echo ''.$al[$cont].'<input type ="text" value='.$elem.' name='.$field[$cont].' readonly><br>';
								}
								 elseif($elem==''){
									echo ''.$al[$cont].'<input type ="text" value="" name='.$field[$cont].'><br>';
								}
								else{
									echo ''.$al[$cont].'<input type ="text" value='.$elem.' name='.$field[$cont].'><br>';
								}
								$cont++;
							}
							
										
						}
						$result->free();
						$mysqli->close();
						echo'<input type="submit" value ="enviar" name="enviar">';
						echo'</form>';
					}
			}
			
		}
			
			
	}elseif(isset($_GET['byOne'])){
			$id = $_POST['idProfe'];
			$cont =0;
			$al = array("codigoProfe","nombre","apellido1","apellido2","direccion","poblacion","provincia","codigoPostal","telefono1","telefono2","email","codDep","cuenta");
			$field = array("pr_codigo","pr_nombre","pr_apell1","pr_apell2","pr_direcc","pr_poblac","pr_provin","pr_codpos","pr_telef1","pr_telef2","pr_email","pr_coddep","pr_cuenta");
			$query = "SELECT * FROM profesores WHERE pr_codigo='$id'";
				if ($result = $mysqli->query($query) ) {
							echo'<form action="index.php?tictab&action=actualizarProfe&enviar=ok" method="post">';
								while ($row = $result->fetch_assoc()) {
								
									foreach($row as $elem){
										if($al[$cont]=="codigo"){
											echo ''.$al[$cont].'<input type ="text" value='.$elem.' name='.$field[$cont].' readonly><br>';
										}
										elseif($elem==''){
											echo ''.$al[$cont].'<input type ="text" value="" name='.$field[$cont].'><br>';
										}		
										else{
											echo ''.$al[$cont].'<input type ="text" value='.$elem.' name='.$field[$cont].'><br>';
										}
										$cont++;
									}
							
										
								}
								$result->free();
								$mysqli->close();
							echo'<input type="submit" value ="enviar" name="enviar">';
							echo'</form>';
				}

		
	}elseif(isset($_GET['enviar']) && $_GET['enviar']=='ok'){
				$cod = $_POST['pr_codigo'];
				$nb=$_POST['pr_nombre'];
				$ap1=$_POST['pr_apell1'];
				$ap2=$_POST['pr_apell2'];
				$dir=$_POST['pr_direcc'];
				$pob = $_POST['pr_poblac'];
				$pro = $_POST['pr_provin'];
				$pos = $_POST['pr_codpos'];
				$tel1 = $_POST['pr_telef1'];
				$tel2 = $_POST['pr_telef2'];
				$email = $_POST['pr_email'];
				$codDep = $_POST['pr_coddep'];
				$cue = $_POST['pr_cuenta'];
				

		
				$query =  "UPDATE profesores SET pr_codigo='$cod',pr_nombre='$nb',pr_apell1='$ap1',
				pr_apell2='$ap2',pr_direcc='$dir',pr_poblac='$pob',pr_provin='$pro',pr_codpos='$pos',
				pr_telef1='$tel1',pr_telef2='$tel2',pr_email='$email',pr_coddep='$codDep',pr_cuenta='$cue'
				WHERE pr_codigo='$cod'";

				
				$result = $mysqli->query($query);
				
				echo'<br>'.'Profesor actualizado con exito.'.'<br>';
				$mysqli->close();
				
				echo'<a href ="index.php?tictab">Volver</a>';

		
		}else{
			
			echo' 
					
				<form action="index.php?tictab&action=actualizarProfe&lista" method="POST">
				
					<div style="position:absolute; width:289px;">
						<blockquote>Nombre:</blockquote><blockquote> <input type="text" name="nombre" maxlength="30"></blockquote>
						<blockquote>Primer Apellido:</blockquote><blockquote> <input type="text" name="apellido1" maxlength="30"></blockquote>
						<blockquote>Segundo Apellido:</blockquote><blockquote> <input type="text" name="apellido2" maxlength="30"></blockquote>
						</div>
					
					<div style="position:relative; top:220px;">
						<input type="submit" value="enviar" name="lista"></blockquote>
						</div>
					
				</form>
				
			';
			
		}
		

}elseif (isset($_GET['action']) && $_GET['action']=='altaDep'){
	
		if (isset($_GET['enviar']) && $_GET['enviar']=='ok'){
			if (isset($_GET['enviar']) && $_GET['enviar']=='ok'){
				$codigo = $_POST['codDep'];
				$query = "SELECT de_codigo FROM departamentos WHERE de_codigo='$codigo'";
				$result = $mysqli->query($query);
				$boo = $mysqli->affected_rows;
				if($boo==0){
					$stmt = $mysqli->prepare("INSERT INTO departamentos(de_codigo,
							de_descri_es,de_descri_en,de_tipo, de_url,
							de_jefe) 
							VALUES (?, ?, ?, ?, ?, ?)");
							
					$stmt->bind_param('sssiss',$_POST['codDep'],$_POST['desCa'],$_POST['desEn'],$_POST['tipo'],$_POST['url'],$_POST['depJefe']);
					$stmt->execute();
					$stmt->close();
					echo' 
					<br>
					Departamento creado con exito.
					<br>
					<a href="index.php?tictab">Volver</a>
					
					
					';
					}
				else{
					echo' 
					<br>
					Departamento ya existe.
					<br>
					<a href="index.php?tictab&action=altaDep">Volver</a>
					
					
					';
				
				}
		}
		}else{
			echo' 
					//Esto es el formulario para dar de alta un departamento
				<form action="index.php?tictab&action=altaDep&enviar=ok" method="POST">
				
					<div style="position:absolute; width:289px;">
						<blockquote>Codigo departamento:</blockquote><blockquote> <input type="text" name="codDep" maxlength="5"></blockquote>
						<blockquote>Descripcion castellano:</blockquote><blockquote> <input type="text" name="desCa" maxlength="30"></blockquote>
						<blockquote>Descripcion ingles:</blockquote><blockquote> <input type="text" name="desEn" maxlength="30"></blockquote>
						<blockquote>Tipo:</blockquote><blockquote> <input type="text" name="tipo" maxlength="1"></blockquote>
						<blockquote>Url:</blockquote><blockquote> <input type="text" name="url" maxlength="4"></blockquote>
						<blockquote>Departamento jefe:</blockquote><blockquote> <input type="text" name="depJefe" maxlength="5"></blockquote>
						
						
					</div>	

					
					<div style="position:relative; top:350px;">
					
					<input type="submit" value="enviar" name="enviar"></blockquote>
					</div>
							
				</form>
				
			';

		}
	
	
	}elseif(isset($_GET['action']) && $_GET['action']=='bajaDep'){
	
		if (isset($_GET['lista'])){
			$nb = $_POST['codigo'];

			$query = "SELECT * FROM departamentos WHERE de_codigo='$nb'";
			
			
			
				if ($result = $mysqli->query($query) ) {
				$boo = $mysqli->affected_rows;
			
					if ($boo == 0) {
					echo' 
						<p>No existe ningun departamento</p><br>
						<a href ="index.php?tictab">Volver</a>
						
						';
					}
					else{
						$stmt = $mysqli->prepare("delete from departamentos where de_codigo = ?");
						$stmt->bind_param('s',$_POST['codigo']);
						$stmt->execute();
						$stmt->close();
						echo' 
						<br>
						Se ha eliminado con exito el departamento.
						<br>
						<a href ="index.php?tictab">Volver</a>
						
						';
					}


					
				}
		
		}elseif (isset($_GET['enviar']) && $_GET['enviar']=='ok'){
			
			$stmt = $mysqli->prepare("delete from departamentos where de_codigo = ?");
			$stmt->bind_param('s',$_POST['codigo']);
			$stmt->execute();
			$stmt->close();

			echo'<a href ="index.php?tictab">Volver</a>';


			
		

		
		}else{
			
			echo' 					
				<form action="index.php?tictab&action=bajaDep&lista" method="POST">
				
					<div style="position:absolute; width:289px;">
						<blockquote>Codigo de departamento:</blockquote><blockquote> <input type="text" name="codigo" maxlength="5"></blockquote>

					
					
						<input type="submit" value="enviar" name="lista"></blockquote>
					</div>
					
				</form>
				
			';
			
		}
		
	
	
}elseif(isset($_GET['action']) && $_GET['action']=='buscarDep'){
	
		if (isset($_GET['lista'])){
			$nb = $_POST['codigo'];
			$al = array("codigoDep","descripcion castellano", "descripcion ingles ", "tipo","url", "depJefe");
			$query = "SELECT * FROM departamentos WHERE de_codigo='$nb'";
			
				if ($result = $mysqli->query($query) ) {
					$boo = $mysqli->affected_rows;
			
					if ($boo == 0) {
						 echo '<p>No existe ningun departamento</p><br>
						<a href ="index.php?tictab&action=buscarDep">Volver</a>';
					}
					else{
						$numfields= $result->field_count;
						echo "<table border=1>";
						   
						echo"<tr>";
					 
						for($i=0;$i<$numfields;$i++){
								 
								 echo "<th>".$al[$i]."</th>";
						}
							
						echo"</tr>";
		
						while ($row = $result->fetch_assoc()) {
								echo '<tr align="center">';
								foreach($row as $elem){
									
									echo "<td>".$elem."</td>";
								}
								echo "</tr>";
						}
										 echo "</table><br>";
						$result->free();
						$mysqli->close();
						 echo '<a href ="index.php?tictab">Volver</a>';

					}

					
				}
				 
		
		}else{
			
			echo '						
				<form action="index.php?tictab&action=buscarDep&lista" method="POST">
				
					<div style="position:absolute; width:289px;">
						<blockquote>Codigo departamento:</blockquote><blockquote> <input type="text" name="codigo" maxlength="5"></blockquote>

				
						<input type="submit" value="enviar" name="lista"></blockquote>
					</div>
					
				</form>
			';
			
		}
		
	
}elseif(isset($_GET['action']) && $_GET['action']=='actualizarDep'){
	
		if (isset($_GET['lista'])){
			
			$nb = $_POST['codigo'];
			$cont =0;
			
			$al = array("codigoDep","descripcion castellano", "descripcion ingles ", "tipo","url", "depJefe");
			$field = array("de_codigo","de_descri_es","de_descri_en","de_tipo" ,"de_url","de_jefe");
			$query = "SELECT * FROM departamentos WHERE de_codigo='$nb' ";
			
			if ($result = $mysqli->query($query) ) {
				$numfields= $result->field_count;
				$boo = $mysqli->affected_rows;
			
				if ($boo == 0) {
					 echo '<p>No existe ningun departamento</p><br>
					<a href ="index.php?tictab&action=actualizarDep">Volver</>';
				}
				else{

						echo'<form action="index.php?tictab&action=actualizarDep&enviar=ok" method="post">';
						while ($row = $result->fetch_assoc()) {
								
							foreach($row as $elem){
								if($al[$cont]=="codigoDep"){
									echo ''.$al[$cont].'<input type ="text" value='.$elem.' name='.$field[$cont].' readonly><br>';
								}
								elseif($elem==''){
									echo ''.$al[$cont].'<input type ="text" value="" name='.$field[$cont].'><br>';
								}
								else{
									echo ''.$al[$cont].'<input type ="text" value='.$elem.' name='.$field[$cont].'><br>';
								}
								$cont++;
							}
							
										
						}
						$result->free();
						$mysqli->close();
						echo'<input type="submit" value ="enviar" name="enviar">';
						echo'</form>';
					}
			}
			
		
			
			
	
		
		}elseif(isset($_GET['enviar']) && $_GET['enviar']=='ok'){
				$cod = $_POST['de_codigo'];
				$desCas=$_POST['de_descri_es'];
				$desEn=$_POST['de_descri_en'];
				$tipo=$_POST['de_tipo'];
				$url=$_POST['de_url'];
				$jefe=$_POST['de_jefe'];
				
				

		
				$query =  "UPDATE departamentos SET de_codigo='$cod',de_descri_es='$desCas', de_descri_en='$desEn', de_tipo='$tipo', de_tipo='$tipo', de_url='$url', de_jefe='$jefe'
				WHERE de_codigo='$cod'";

				
				$result = $mysqli->query($query);
				
				$mysqli->close();
				echo'<br>'.'Departamento actualizado con exito'.'<br>'.'<br>';
				
				echo'<a href ="index.php?tictab">Volver</a>';

		
		}else{
			
			echo '						
				<form action="index.php?tictab&action=actualizarDep&lista" method="POST">
				
					<div style="position:absolute; width:289px;">
						<blockquote>Codigo departamento:</blockquote><blockquote> <input type="text" name="codigo" maxlength="5"></blockquote>
					
				
						<input type="submit" value="enviar" name="lista"></blockquote>
					</div>
					
				</form>
			';
			
		}
		
		// Aqui corrresponden las acciones para cada una de las tablas. (alumnos, profesores, departamentos)

	}else{
		if(isset($_POST['siguiente'])){
			
			if($_POST['tipo'] == 'alumno' ){
				
					
					echo' 
					
					<br>
					TABLA ALUMNOS
					<br>
					
					<br>
						<form action="index.php?tictab&action=altaAlum" method="POST">
							
							<input type="submit" value="ALTA" name="altaAlum">

							
						</form>
						<form action="index.php?tictab&action=bajaAlum" method="POST">
							
							<input type="submit" value="BAJA" name="bajaAlum">

							
						</form>
						<form action="index.php?tictab&action=buscarAlum" method="POST">

							<input type="submit" value="BUSCAR" name="buscar">
						
						</form>
						<form action="index.php?tictab&action=actualizarAlum" method="POST">

							<input type="submit" value="MODIFICAR" name="modificar"></blockquote>
							
						</form>
						
						
					';
				
			
			}
			elseif($_POST['tipo'] == 'profesor' ){
				

					echo' 
					<br>
					TABLA PROFESORES
					<br>
					<br>
						<form action="index.php?tictab&action=altaProfe" method="POST">
							
							<input type="submit" value="ALTA" name="altaProfe">

							
						</form>
						
						<form action="index.php?tictab&action=bajaProfe" method="POST">
							
							<input type="submit" value="BAJA" name="bajaProfe">

							
						</form>
						<form action="index.php?tictab&action=buscarProfe" method="POST">

							<input type="submit" value="BUSCAR" name="buscarProfe">
						
						</form>
						<form action="index.php?tictab&action=actualizarProfe" method="POST">

							<input type="submit" value="MODIFICAR" name="modificarProfe"></blockquote>
							
						</form>
						
						
					';
				
			
			}
			elseif($_POST['tipo'] == 'departamento' ){
				

					echo' 
					<br>
						<br>
					TABLA DEPARTAMENTOS
					<br>
					
						<form action="index.php?tictab&action=altaDep" method="POST">
							
							<input type="submit" value="ALTA" name="altaDep">

							
						</form>
						<form action="index.php?tictab&action=bajaDep" method="POST">
							
							<input type="submit" value="BAJA" name="bajaDep">

							
						</form>
						<form action="index.php?tictab&action=buscarDep" method="POST">

							<input type="submit" value="BUSCAR" name="buscarDep">
						
						</form>
						<form action="index.php?tictab&action=actualizarDep" method="POST">

							<input type="submit" value="MODIFICAR" name="modificarDep"></blockquote>
							
						</form>
						
						
					';
				
			
			}
			//en el caso de que pulses a siguiente sin elegir una tabla. te aparecera este mensaje. Menu desplegable del principio (en caso de que no elijas opcion)
			else{
				echo '
					Debes seleccionar una tabla
				
					<form action="" method="POST">
					<br />Seleccione el tipo de tabla: 
						<select name="tipo">
							<option value="">Seleccione una opci&oacute;n</option>
							<option value="alumno">Alumno</option>
							<option value="profesor">Profesor</option>
							<option value="departamento">Departamento</option>
						</select>
						<br /><br /><input type="submit" name="siguiente" value="Siguiente" />
					</form>
				
			';
			}
	
		}
		// mediante este else podremos seleccionar el tipo de tabla sobre el que queremos interactuar. Menu desplegable del principio
		else{
			echo ' 
				
					<form action="" method="POST">
					<br />Seleccione el tipo de tabla: 
						<select name="tipo">
							<option value="">Seleccione una opci&oacute;n</option>
							<option value="alumno">Alumno</option>
							<option value="profesor">Profesor</option>
							<option value="departamento">Departamento</option>
						</select>
						<br /><br /><input type="submit" name="siguiente" value="Siguiente" />
					</form>
				
			';
		}

	}
	

	
	



?>

</div>