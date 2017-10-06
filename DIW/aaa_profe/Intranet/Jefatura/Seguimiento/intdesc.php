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
<h1>INTRODUCIR PROGRAMACIÓN</h1>
<table border="0" align="center" width="300px" height="25px">
<tr align="center">
	<td><a href="inicio.php"><img src="imagen/home.png" width="25px" height="25px"></a></td>
	<td><a href="registro.php"><img src="imagen/atras.png" width="25px" height="25px"></a></td>
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
	$descripcion=$_POST["descripcion"];

	$conexion = mysql_connect("localhost", "phpuser", "phpp@asswd1011");
	mysql_select_db("basedatos");

$sql="select pr_coddep from profesores where pr_codigo='$prof'";
$pert= mysql_query ($sql);
$pert1= mysql_fetch_row($pert);
if($pert1[0]==$dto){
//Pertenece al departamento
}
else{
	echo "'$prof' No pertenece al departamento '$dto'";
	exit();
}



//	Escribir variables en tabla auxiliar
	$sql = "UPDATE auxiliar SET
		au_coddep = '$dto',
		au_codpro = '$prof',
		au_codasi = '$asig',
		au_codgru = '$grupo'
		WHERE au_id = 1";
	$s_aux = mysql_query($sql);	
	if (! $s_aux) {
		echo "Error al grabar en la tabla auxiliar";
		exit();
	}
	$sql = "SELECT pr_nombre, pr_varios, pr_depart FROM profesores WHERE pr_codigo = '$prof'";
	$s_nvd = mysql_query ($sql);
	$r_nvd = mysql_fetch_row ($s_nvd);
	if ($r_nvd[1] != $clave) {
		echo "Clave erronea";
		exit();
	}
	$sql = "SELECT de_codigo, de_descri FROM departamentos WHERE de_codigo = '$dto'";
	$s_cd = mysql_query ($sql);
	$r_cd = mysql_fetch_row ($s_cd);
	if ($r_cd[0] != $r_nvd[2]) {
		echo "El profesor no pertenece al Departamento en cuestion";
		exit();
	}
	$sql = "SELECT as_descri FROM asignaturas WHERE as_codigo = '$asig'";
	$s_asig = mysql_query ($sql);
	$r_asig = mysql_fetch_row ($s_asig);
	$sql = "SELECT gr_descri FROM grupos WHERE gr_codigo = '$grupo'";
	$s_des = mysql_query ($sql);
	$r_des = mysql_fetch_row ($s_des);
	echo "<FORM action='{$PHP_SELF}' method='POST'>"
	?>

    <strong>Departamento:</strong>
	<?php
	echo "<br>";
	echo $dto;
	?>
	<br><br>
    <strong>Profesor:</strong>
	<?php
	echo "<br>";
	echo $prof;
	?>
	<br><br>
    <strong>Asignatura:</strong>
	<?php
	echo "<br>";
	echo $asig;
	?>
	<br><br>
    <strong>Grupo:</strong>
	<?php
	echo "<br>";
	echo $grupo;
?>
	<br><br>
    <strong>Descripción:</strong>
	<?php
	echo "<br>";
	echo $descripcion;
	mysql_close($conexion);
	?>
<?php
		$conexion = mysql_connect("localhost", "phpuser", "phpp@asswd1011");
		mysql_select_db("basedatos");
		$sql = "SELECT * FROM auxiliar WHERE au_id = 1";
		$s_aux = mysql_query($sql);
		$r_aux = mysql_fetch_row($s_aux);
		$sql = "INSERT INTO seguimiento SET
			se_coddep = '$r_aux[1]',
			se_codpro = '$r_aux[2]',
			se_codasi = '$r_aux[3]',
			se_codgru = '$r_aux[4]',
			se_descri = '$descripcion',
			se_fechoy = NULL ";
echo "<br>";
echo "<hr width='400px' ";
		if (mysql_query ($sql)) {
			echo ("<p>DATOS REGISTRADOS CORRECTAMENTE</p>");
		} else {
			echo ("ERROR al guardar los datos.: " . mysql_error() . "</p>");
		};
		mysql_close(conexion);
	?>


</div>
</body>
</html>
