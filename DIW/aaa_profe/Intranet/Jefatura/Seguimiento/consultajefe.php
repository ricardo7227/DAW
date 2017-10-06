<html>
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<head>
<title>Registro</title>

</script>
<link rel="stylesheet" type="text/css" href="jef_seg.css">

<title>
Ejemplo interfaz Proyecto 2013
</title>
<body class="seg_ini_general">
<div class="seg_cons2_enc0">
<h1>CONSULTA PROFESOR</h1>
<table border="0" align="center" width="300px" height="25px">
<tr align="center">
	<td><a href="inicio.php"><img src="imagen/home.png" width="25px" height="25px"></a></td>
	<td><a href="consulta.php"><img src="imagen/atras.png" width="25px" height="25px"></a></td>
	<td><a href='javascript:window.print(); void 0;'><img src="imagen/impresora.gif" width="25px" height="25px"></a></td>
	<td><a href="faq.html" target="_blank"><img src="imagen/faq.png" width="25px" height="25px"></a></td>
</tr>
</table>
</div>
<div class="seg_cons2_enc1" id="enc1">
<hr width="400px">
<?php
	$prof=$_POST["prof"];
	$dto=$_POST["dto"];
	$asig=$_POST["asig"];
	$grupo=$_POST["grupo"];
	$fecini=$_POST["fecini"];
	$fecfin=$_POST["fecfin"];
	$jprof=$_POST["jprof"];
	$conexion = mysql_connect("localhost", "phpuser", "phpp@asswd1011");
	mysql_select_db("basedatos");

//Comprobar si es jefe de departamento
$sql="select pr_codigo from profesores where pr_nombre='$jprof'";
$cons1= mysql_query ($sql);
$cons11= mysql_fetch_row($cons1);
$sql="select de_jefe from departamentos where de_codigo='$dto'";
$cons2= mysql_query ($sql);
$cons22= mysql_fetch_row($cons2);
	if ($cons11[0]!=$cons22[0]){
	echo "No es jefe de departamento";
	exit();	}
	else{


	$fecini = $fecini.' 00:00:00';
	$fecfin = $fecfin.' 23:59:59';
	$sql = "SELECT se_codpro,se_coddep,se_codasi,se_codgru,se_fechoy,se_descri FROM seguimiento WHERE se_codpro='$prof' AND se_coddep='$dto' AND se_codgru='$grupo' AND se_codasi='$asig' AND se_fechoy>'$fecini' AND se_fechoy<'$fecfin'";
	$s_seg = mysql_query ($sql);
	$totalFilas= mysql_num_rows($s_seg);
	if ($totalFilas==0){
	echo "No hay programaciones para esos datos";
		}
	else{

	while ($r_seg = mysql_fetch_row ($s_seg)) {
		$sql = "SELECT pr_nombre FROM profesores WHERE pr_codigo = '$r_seg[0]'";
		$s_prof = mysql_query($sql);
		$r_prof = mysql_fetch_row($s_prof);
		echo "<strong>Profesor.- " . $r_seg[0] ."<br>  Departamento.- " . $r_seg[1]. "<br> Asignatura.- " . $r_seg[2] . "<br>  Grupo.- ";
		echo $r_seg[3] . "<br>  Fecha y hora: " . $r_seg[4] . "</strong>";
		echo "<br>";
		echo "Descripcion:".$r_seg[5];
		echo "<br>";
		echo "<br>";
	}
	}
echo "<hr width='400px'>";
	
}


	mysql_close($conexion);
	?>
</div>
</body>
</html>
