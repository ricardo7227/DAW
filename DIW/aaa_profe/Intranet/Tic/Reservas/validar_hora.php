<?php
$con = mysqli_connect("localhost", "phpuser", "phpp@asswd1011");
$db = mysqli_select_db($con,'basedatos');

$valores=explode(",",$_GET['valor']);
$query = mysqli_query($con,"SELECT hor_desc_horario
							FROM reservas_horario
							WHERE hor_num_hora='".$valores[0]."'
							AND hor_turno='".$valores[1]."'");

while($fila=mysqli_fetch_array($query)){
	echo $fila['hor_desc_horario'];
}


?>