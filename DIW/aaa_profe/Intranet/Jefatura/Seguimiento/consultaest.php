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
	<td><a href="index.html"><img src="imagen/home.png" width="25px" height="25px"></a></td>
	<td><a href="index.html"><img src="imagen/atras.png" width="25px" height="25px"></a></td>
	<td><a href='javascript:window.print(); void 0;'><img src="imagen/impresora.gif" width="25px" height="25px"></a></td>
	<td><a href="faq.html" target="_blank"><img src="imagen/faq.png" width="25px" height="25px"></a></td>
</tr>
</table>
</div>
<div class="seg_cons2_enc1" id="enc1">
<hr width="400px">
<?php
	$jest=$_POST["jest"];
	$prof=$_POST["prof"];
	$dto=$_POST["dto"];
	$asig=$_POST["asig"];
	$grupo=$_POST["grupo"];
	$fecini=$_POST["fecini"];
	$fecfin=$_POST["fecfin"];
	$conexion = mysql_connect("localhost", "phpuser", "phpp@asswd1011");
	mysql_select_db("basedatos");

$a[0] ="1MMA"; //Hay que sustituir los nombres por sus códigos de profesores.
$a[1] = "1OMG";
$sw=1;
for($i=0;$i<2;$i++){
	if($sw==1){
	if ($a[$i]==$jest)
	$sw=0;	
	}
}

if ($sw==0){
	//Es jefe de estudios/director}
}
else{
	echo "No es jefe de estudios";
	echo "<hr width='400px'>";
	exit();
}


$sql="select pr_coddep from profesores where pr_codigo='$prof'";
$pert= mysql_query ($sql);
$pert1= mysql_fetch_row($pert);
if($pert1[0]==$dto){
	//Pertenece al departamento
}
else{
	echo "'$prof' No pertenece al departamento '$dto'";
	echo "<hr width='400px'>";
	exit();
}

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
		echo "<br>";
	}
echo "<hr width='400px'>";
	}



	mysql_close($conexion);
	?>
</div>
</body>
</html>
