<?php
$con = mysqli_connect("localhost", "phpuser", "phpp@asswd1011");
$db = mysqli_select_db($con,'basedatos');

$horas_reservadas=array();
$consulta='';

$resultado="Elige una hora para la reserva:<br><br>
		<select name='hora' id='hora' onChange='verHorario()'>";

$valores=explode(",",$_GET['valor']);
$query = mysqli_query($con,"SELECT rt_hora
							FROM reservas_tic
							WHERE rt_recur='".$valores[0]."'
							AND rt_fecha='".$valores[1]."'
							AND rt_turno='".$valores[2]."'");

$query2 = mysqli_query($con,"SELECT *
							FROM reservas_horario");

if(mysqli_num_rows($query)==0){
	if($valores[2]=='M'){
		while($fila=mysqli_fetch_array($query2)){
			if($fila['hor_turno']=='M'){
				$resultado=$resultado."<option value='".$fila['hor_num_hora']."'>".$fila['hor_texto']."</option>";
			}
		}
		echo $resultado."</select>";
	}else{
		while($fila=mysqli_fetch_array($query2)){
			if($fila['hor_turno']=='T'){
				$resultado=$resultado."<option value='".$fila['hor_num_hora']."'>".$fila['hor_texto']."</option>";
			}
		}
		echo $resultado."</select>";
	}
}else{
	while($fila=mysqli_fetch_array($query)){
		$horas_reservadas[]=$fila['rt_hora'];
	}
	if($valores[2]=='M'){
		if(count($horas_reservadas)==7){
			echo "No hay horas disponibles";
		}else{
			for($x=0;$x<count($horas_reservadas);$x++){
				if($x==0){
					$consulta=$consulta."hor_num_hora<>'".$horas_reservadas[$x]."'";
				}
				$consulta=$consulta." AND hor_num_hora<>'".$horas_reservadas[$x]."'";
			}
		
			$query = mysqli_query($con,"SELECT hor_num_hora,hor_texto
										FROM reservas_horario
										WHERE ".$consulta."
										AND hor_turno='M'");
			while($fila=mysqli_fetch_array($query)){
				$resultado=$resultado."<option value='".$fila['hor_num_hora']."'>".$fila['hor_texto']."</option>";
			}
			echo $resultado."</select>";
		}
	}else{
		if(count($horas_reservadas)==8){
			echo "No hay horas disponibles";
		}else{
			for($x=0;$x<count($horas_reservadas);$x++){
				if($x==0){
					$consulta=$consulta."hor_num_hora<>'".$horas_reservadas[$x]."'";
				}
				$consulta=$consulta." AND hor_num_hora<>'".$horas_reservadas[$x]."'";
			}
		
			$query = mysqli_query($con,"SELECT hor_num_hora,hor_texto
										FROM reservas_horario
										WHERE ".$consulta."
										AND hor_turno='T'");
			while($fila=mysqli_fetch_array($query)){
				$resultado=$resultado."<option value='".$fila['hor_num_hora']."'>".$fila['hor_texto']."</option>";
			}
			echo $resultado."</select>";
		}
	}
}


?>