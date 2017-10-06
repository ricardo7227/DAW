<?php

$a=0;

$query = mysql_query("SELECT pr_nombre
					  FROM profesores
					  WHERE pr_cuenta = '".$_SESSION['prueba']."'");
$fila=mysql_fetch_array($query);


if(isset($_GET['opcion']) && $_GET['opcion']=='reservas' && !isset($_GET['opcion2'])){
	echo "<div id='cuerpo-centro'>
		  <script type='text/javascript'>
			document.getElementById('senda').innerHTML = 'You are in the page: TIC - Reservations';
		  </script>
		  <h2>Welcome to the reserves, user ".$fila['pr_nombre']."</h2>
		  <div id='reservas_izquierda'>";

	if(isset($_POST["enviado"])){
		$query = mysql_query("SELECT pr_codigo
							  FROM profesores
							  WHERE pr_cuenta = '".$_SESSION['prueba']."'");
		$fila=mysql_fetch_array($query);
		$codig_profe=$fila['pr_codigo'];

		$array_recurso=explode(",",$_POST["recursos"]);
	
		$array_fecha=explode("/",$_POST["fecha_reser"]);
		$fecha_modif=$array_fecha[2]."-".$array_fecha[1]."-".$array_fecha[0];
	
		$query = mysql_query("INSERT INTO reservas_tic (rt_recur, rt_fecha, rt_turno, rt_hora, rt_codpro) VALUES " .
                             "('".$array_recurso[0].
							 "', '".$fecha_modif.
							 "', '".$_POST["turno"].
							 "', '".$_POST["hora"].
							 "', '".$codig_profe.
                             "')");
	}

	if(isset($_POST["anulado"])){
		$query = mysql_query("SELECT rt_id
							  FROM reservas_tic
							  WHERE rt_codpro = (SELECT pr_codigo
												 FROM profesores
												 WHERE pr_cuenta = '".$_SESSION['prueba']."')");
		while($fila=mysql_fetch_array($query)){
			foreach($_POST['reservas'] as $reserva){
				if($fila['rt_id']==$reserva){
					$query2 = mysql_query("DELETE FROM reservas_tic
										   WHERE rt_id = '".$fila['rt_id']."'");
				}
			}
		}
	}

	$query = mysql_query("SELECT rt_recur,rt_fecha,rt_turno,rt_hora
						  FROM reservas_tic 
						  WHERE rt_codpro=(
											SELECT pr_codigo
											FROM profesores
											WHERE pr_cuenta = '".$_SESSION['prueba']."')
						  ORDER BY rt_fecha");

	if(mysql_num_rows($query)!=0){
		echo "<span class='reservas_margen_izq'>Your reserves order by date are: </span>
			  <ul>";

		while($fila=mysql_fetch_array($query)){
			$query2=mysql_query("SELECT re_descor,re_locali
								 FROM recursos_tic
								 WHERE re_codigo='".$fila['rt_recur']."'");
			$fila2=mysql_fetch_array($query2);
	
			$array_fecha=explode("-",$fila['rt_fecha']);
			$fecha_modif=$array_fecha[2]."-".$array_fecha[1]."-".$array_fecha[0];
	
			echo "<li class='reservas_li'><span class='reservas_subrayado'>".$fecha_modif."</span>: 
				  resource <span class='reservas_color'>".$fila2['re_descor']."</span>, 
				  which is in <span class='reservas_color'>".$fila2['re_locali']."</span>,
				  in the shift of ";
			if($fila['rt_turno']=='T'){
				echo "<span class='reservas_color'>afternoon</span>";
			}else{
				echo "<span class='reservas_color'>morning</span>";
			}

			if($fila['rt_hora']=='1'){
				echo " at <span class='reservas_color'>first</span> hour.</li>";
			}elseif($fila['rt_hora']=='2'){
				echo " at <span class='reservas_color'>second</span> hour.</li>";
			}elseif($fila['rt_hora']=='3'){
				echo " at <span class='reservas_color'>third</span> hour.</li>";
			}elseif($fila['rt_hora']=='4'){
				echo " at <span class='reservas_color'>fourth</span> hour.</li>";
			}elseif($fila['rt_hora']=='5'){
				echo " at <span class='reservas_color'>fifth</span> hour.</li>";
			}elseif($fila['rt_hora']=='6'){
				echo " at <span class='reservas_color'>sixth</span> hour.</li>";
			}elseif($fila['rt_hora']=='R'){
				echo " in the <span class='reservas_color'>break</span>.</li>";
			}elseif($fila['rt_hora']=='E'){
				echo " in the <span class='reservas_color'>extra hour</span>.</li>";
			}
		}
		$a=1;
		echo "</ul>";
	}else{
		echo "<span class='reservas_margen_izq'>You don't have any reserve made</span>";
	}

	echo "<br><br><span class='reservas_margen_izq'>Choose the option that you prefer:</span>";
	echo "<ul>";
	if($a==0){
		echo "<li><a href='index_en.php?tic&opcion=reservas&opcion2=otraReserva'>Make a reserve</a></li>";
	}else{
		echo "<li><a href='index_en.php?tic&opcion=reservas&opcion2=otraReserva'>Make another reserve</a></li>";
		echo "<li><a href='index_en.php?tic&opcion=reservas&opcion2=anularReserva'>Cancel a reserve</a></li>";
	}

	echo "</ul>
		  </div>
		  </div>";
}


if (isset($_GET['opcion2']) && $_GET['opcion2']=='otraReserva')
{
	otraReserva();
}
elseif (isset($_GET['opcion2']) && $_GET['opcion2']=='anularReserva')
{
	anularReserva();
}


function otraReserva()
{
	$query = mysql_query("SELECT pr_nombre
						  FROM profesores
						  WHERE pr_cuenta = '".$_SESSION['prueba']."'");
	$fila=mysql_fetch_array($query);
	
	echo "<div id='cuerpo-centro'>
		  <script type='text/javascript'>
			document.getElementById('senda').innerHTML = 'You are in the page: TIC - Reservations - Make a reserve';
		  </script>
		  <h2>Let's do a reserve, user ".$fila['pr_nombre']."</h2>
		  <div id='reservas_izquierda'>
		  <form name='form1' action='index_en.php?tic&opcion=reservas' method='POST' class='reservas_margen_izq'>
		  Select one of the resources availables:
		  <br><br>
		  <select name='recursos' id='recursos' onChange='cambiarLugar()'>";

	$query = mysql_query("SELECT *
						  FROM recursos_tic
						  ORDER BY re_descor");
	while($fila=mysql_fetch_array($query)){
		echo "<option value='".$fila['re_codigo'].",".$fila['re_locali']."'>".$fila['re_descor']."</option>";
	}

	echo "</select>
		  <br><br>The chosen resource is in: 
		  <span id='lugar_recurso' class='reservas_color'></span>
		  <script type='text/javascript'>
			var cadena=document.getElementById('recursos').options[document.getElementById('recursos').selectedIndex].value;
			var valores=cadena.split(',');
			document.getElementById('lugar_recurso').innerHTML=valores[1];

			
			var http = getXMLHTTPRequest(); // creo una instancia del objeto XMLHTTPRequest.
											// Esta función se encarga de crear el objeto XMLHTTPRequest y lo devuelve.
		  </script>
		  <br><br><br>
		  
		  Select a date for the reserve:<br><br>
		  <input type='text' name='fecha_reser' size='12' id='datepicker2' />
		  <br>
		  <div id='oculto'></div>
		  <br><br>
		  
		  Select a shift for the reserve:<br><br>
		  <select id='turno' name='turno' onFocus='controlador()' onChange='validarDatos()'>
			<option value='M'>Ma&ntilde;ana</option>
			<option value='T'>Tarde</option>
		  </select>
		  <br><br>
		  <input type='button' name='validar' value='Verify hours available' onclick='controlador()'/>
		  <br><br><br>
		  
		  <div id='hora_reserva' style='display:none;'></div>
		  <div id='horarios_reserva' class='reservas_color' style='display:none;'></div>
		  <br><br>

		  <input type='submit' name='enviado' id='enviado' value='Accept' onclick='alerta()' style='display:none;'/>
		  </form>
		  </div>
		  </div>";
}

function anularReserva()
{
	$query = mysql_query("SELECT pr_nombre
						  FROM profesores
						  WHERE pr_cuenta = '".$_SESSION['prueba']."'");
	$fila=mysql_fetch_array($query);
	
	echo "<div id='cuerpo-centro'>
		  <script type='text/javascript'>
			document.getElementById('senda').innerHTML = 'You are in the page: TIC - Reservations - Cancel reserves';
		  </script>
		  <h2>Let's cancel a reserve, user ".$fila['pr_nombre']."</h2>
		  <div id='reservas_izquierda'>
		  <form name='form1' action='index_en.php?tic&opcion=reservas' method='POST' class='reservas_margen_izq'>
		  Select the reserves you want to cancel:
		  <br><br>";

	$query = mysql_query("SELECT rt_id,rt_recur,rt_fecha,rt_turno,rt_hora
						  FROM reservas_tic WHERE rt_codpro=(
															 SELECT pr_codigo
															 FROM profesores
															 WHERE pr_cuenta = '".$_SESSION['prueba']."')
						  ORDER BY rt_fecha");
	while($fila=mysql_fetch_array($query)){
		$query2=mysql_query("SELECT re_descor
							 FROM recursos_tic
							 WHERE re_codigo='".$fila['rt_recur']."'");
		$fila2=mysql_fetch_array($query2);
		
		$array_fecha=explode("-",$fila['rt_fecha']);
		$fecha_modif=$array_fecha[2]."-".$array_fecha[1]."-".$array_fecha[0];
		
		echo "<label class='reservas_li'>
				<input type='checkbox' name='reservas[]' value='".$fila['rt_id']."'>
					<span class='reservas_subrayado'>".$fecha_modif."</span>: 
					resource <span class='reservas_color'>".$fila2['re_descor']."</span>,
					in the shift of ";
		if($fila['rt_turno']=='T'){
			echo "<span class='reservas_color'>afternoon</span>";
		}else{
			echo "<span class='reservas_color'>morning</span>";
		}
		if($fila['rt_hora']=='1'){
			echo " at <span class='reservas_color'>first</span> hour.</li>";
		}elseif($fila['rt_hora']=='2'){
			echo " at <span class='reservas_color'>second</span> hour.</li>";
		}elseif($fila['rt_hora']=='3'){
			echo " at <span class='reservas_color'>third</span> hour.</li>";
		}elseif($fila['rt_hora']=='4'){
			echo " at <span class='reservas_color'>fourth</span> hour.</li>";
		}elseif($fila['rt_hora']=='5'){
			echo " at <span class='reservas_color'>fifth</span> hour.</li>";
		}elseif($fila['rt_hora']=='6'){
			echo " at <span class='reservas_color'>sixth</span> hour.</li>";
		}elseif($fila['rt_hora']=='R'){
			echo " in the <span class='reservas_color'>break</span>.</li>";
		}elseif($fila['rt_hora']=='E'){
			echo " in the <span class='reservas_color'>extra hour</span>.</li>";
		}
		echo "</label><br>";
	}

	echo "<br><input type='submit' name='anulado' value='Accept' onclick='validarAnulacion()'/>
		  </form>
		  </div>
		  </div>";
}

?>
