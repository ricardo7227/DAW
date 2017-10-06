<?php session_start();?>
<html>
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<head>
<script type="text/javascript">

function textoini1() { //
	document.getElementById("textolect").style.display= "block";
	document.getElementById("textoescr").style.display= "none";
	document.getElementById("textoimpr").style.display= "none";
	document.getElementById("javas").style.display = "none";
	document.getElementById("enc1").style.background='url(imagen/fondo2.png)';
	document.getElementById("enc2").style.background='url(imagen/fondo.png)';
	document.getElementById("enc3").style.background='url(imagen/fondo.png)';
}
function textoini(){
	
	document.getElementById("textolect").style.display= "none";
	document.getElementById("textoescr").style.display= "none";
	document.getElementById("textoimpr").style.display= "none";
	document.getElementById("javas").style.display = "block";
	document.getElementById("enc1").style.background='url(imagen/fondo.png)';
	document.getElementById("enc2").style.background='url(imagen/fondo2.png)';
	document.getElementById("enc3").style.background='url(imagen/fondo.png)';
}
function textoini2(){
	document.getElementById("textolect").style.display= "none";
	document.getElementById("textoescr").style.display= "block";
	document.getElementById("textoimpr").style.display= "none";
	document.getElementById("javas").style.display = "none";
	document.getElementById("enc1").style.background='url(imagen/fondo.png)';
	document.getElementById("enc2").style.background='url(imagen/fondo2.png)';
	document.getElementById("enc3").style.background='url(imagen/fondo.png)';
}
function textoini3(){
	document.getElementById("textolect").style.display= "none";
	document.getElementById("textoescr").style.display= "none";
	document.getElementById("textoimpr").style.display= "block";
	document.getElementById("javas").style.display = "none";
	document.getElementById("enc1").style.background='url(imagen/fondo.png)';
	document.getElementById("enc2").style.background='url(imagen/fondo.png)';
	document.getElementById("enc3").style.background='url(imagen/fondo2.png)';
}
</script>
<link rel="stylesheet" type="text/css" href="jef_seg.css">
<title>
Página de Consultas
</title>
</head>
<body class="seg_ini_general">
<div class="seg_cons_enc0">
<h1>Consultas</h1>
<table border="0" align="center" width="300px" height="25px">
<tr align="center">
	<td><a href="inicio.php"><img src="imagen/home.png" width="25px" height="25px"></a></td>
	<td><a href="inicio.php"><img src="imagen/atras.png" width="25px" height="25px"></a></td>
	<td><a href='javascript:window.print(); void 0;'><img src="imagen/impresora.gif" width="25px" height="25px"></a></td>
	<td><a href="faq.html" target="_blank"><img src="imagen/faq.png" width="25px" height="25px"></a></td>
</tr>
</table>
</div>
<div class="seg_cons_enc1" onclick="textoini1()" id="enc1">
PROFESORES
</div>
<div class="seg_cons_enc2" onclick="textoini2()" id="enc2">
JEFE DE DEPARTAMENTOS
</div>
<div class="seg_cons_enc3" onclick="textoini3()" id="enc3">
J.ESTUDIOS/DIRECCIÓN
</div>
<div class="seg_cons_enc4" id="javas">
<span id="seg_ini_id1"> Esta aplicación dispone de 3 apartados según el rol que tengas:</span>
<br><br>
<span id="seg_ini_id2">
 * CONSULTA PROFESOR. En esta sección cada profesor puede consultar el seguimiento de sus propias programaciones<br><br><br>
 * CONSULTA JEFE DE DEPARTAMENTO. En esta sección el jefe de departamento puede consultas las programaciones de todos los profesores de los que es jefe, incluido él.<br><br><br>
 * CONSULTA DIRECCIÓN. En esta sección el director podrá consultar las programaciones de toda la plantilla de profesores del centro.<br><br><br><br>
 * Aunque pulse en otras opciones, si su cuenta no tiene el rol adecuado no le permitirá consultar.<br><br>
 * Se recuerda que se puede acceder a la ayuda, pulsando en la imágen del dado rojo. Se abrirá en una nueva pantalla.<br><br><br>
</span>
<br><br><br><br><br>
<center><span id="seg_ini_id3">Si encuentra algun problema pongase en contacto con el siguiente correo:xxxxxxxxx@hotmail.com
<br><br>
 NOTA: ESTO ES UN ACCESO RESTRINGIDO, SI NO ES USTED PROFESOR/A O DEL EQUIPO DIRECTIVO, POR FAVOR SALGA DE ESTE APARTADO</span></center>
</div>
<div class="seg_cons_enc5" id="textolect">
<?php
	$conexion = mysql_connect("localhost", "phpuser", "phpp@asswd1011");
	mysql_select_db("basedatos");
	$var=$_SESSION['prueba'];/*El codigo este se supone que lo recibe del login, cuando lo recibe busca el usuario*/
	?>
<form action="consultaprof.php" method="post">
<hr width="400px">
<br>
<?php
$sql="select pr_nombre from profesores where pr_cuenta='$var'";
$s_prof = mysql_query ($sql);
$r_prof = mysql_fetch_row ($s_prof);
$prof=$r_prof[0];
?>

Profesor..................... <SELECT class="seg_cajas" name="prof" size="1" width:[20]>
	<?php
	
	$sql = "SELECT pr_codigo, pr_nombre FROM profesores where pr_nombre='$prof' ORDER BY pr_nombre";
	$s_prof = mysql_query ($sql);
	while ($r_prof = mysql_fetch_row ($s_prof)) {
		echo ("<option value='$r_prof[0]'>$r_prof[1]</option>\n");
	}
	?>
	<br><br>
	</select>
<br>
Departamento................. <SELECT class="seg_cajas" name="dto" size="1">
	<?php
	$sql="select pr_coddep from profesores where pr_nombre='$prof'";
	$cons1= mysql_query ($sql);
	$cons2= mysql_fetch_row($cons1);

	$sql = "SELECT de_codigo, de_descri_es FROM departamentos where de_codigo='$cons2[0]' ORDER BY de_codigo";
	$s_dto = mysql_query ($sql);
	while ($r_dto = mysql_fetch_row ($s_dto)) {
		echo ("<option value='$r_dto[0]'>$r_dto[1]</option>\n");
	}
	?>
	</SELECT>
	<br>
Asignatura................... <SELECT class="seg_cajas" name="asig" size="1">
	<?php
	$sql = "SELECT as_codigo, as_descri FROM asignaturas ORDER BY as_codigo";
	$s_asig = mysql_query ($sql);
	while ($r_asig = mysql_fetch_row ($s_asig)) {
		echo ("<option value='$r_asig[0]'>$r_asig[1]</option>\n");
	}
	?>
	</select>
	<br>
Grupo........................ <select class="seg_cajas" name="grupo" size="1">
<?php
	$sql = "SELECT gr_codigo, gr_descri FROM grupos ORDER BY gr_codigo";
	$s_grupo = mysql_query ($sql);
	while ($r_grupo = mysql_fetch_row ($s_grupo)) {
		echo ("<option value='$r_grupo[0]'>$r_grupo[1]</option>\n");
	}
	mysql_close(conexion);
	?>
	</SELECT>
	<br><br>
	<hr width="400px">
	<br>

    <strong>Entre las siguientes fechas:</strong>
    <br>
	<br>
    Fecha inicial (aaaa-mm-dd)....... <INPUT maxlength="10" size="15" name="fecini" type="text">
    <br><br>
    Fecha final   (aaaa-mm-dd)......... <INPUT maxlength="10" size="15" name="fecfin" type="text">
    <br><br>
	<hr width="400px">
	<br>
	<INPUT size="10" value="CONSULTAR" name="seguir" type="submit">
	<INPUT size="10" value="BORRAR" name="seguir" type="reset">
  	</div>
	</FORM>
</form>
</div>
<div class="seg_cons_enc5" id="textoescr">
<form action="consultajefe.php" method="post">
<hr width="400px">
<br>
	
<?php
$var=$_SESSION['prueba'];/*El codigo este se supone que lo recibe del login, cuando lo recibe busca el usuario*/
$sql="select pr_nombre from profesores where pr_cuenta='$var'";
$s_prof = mysql_query ($sql);
$r_prof = mysql_fetch_row ($s_prof);

$nombre=$r_prof[0];

$sql="select pr_codigo from profesores where pr_cuenta='$var'";
$t_prof = mysql_query ($sql);
$u_prof = mysql_fetch_row ($t_prof);

$jprof=$u_prof[0];

$sql="select pr_coddep from profesores where pr_cuenta='$var'";
$x_prof = mysql_query ($sql);
$y_prof = mysql_fetch_row ($x_prof);

$departamento=$y_prof[0];
?>
J.Departamento................. <?php echo "<input class='seg_cajas' type='text' name='jprof' size='33' value='$nombre' readonly>"
/*
	$sql = "SELECT de_codigo, de_descri FROM departamentos ORDER BY de_codigo";
	$s_dep = mysql_query ($sql);
	while ($r_dep = mysql_fetch_row ($s_dep)) {
		echo ("<option value='$r_dep[0]'>$r_dep[1]</option>\n");
	
	}*/
	?>
	<br>

Departamento................... <select class="seg_cajas" name="dto" size="1">
	<?php
	/*
	$sql="select pr_coddep from profesores where pr_codigo='$jprof'";
	$cons1= mysql_query ($sql);
	$cons2= mysql_fetch_row($cons1);*/

	$sql = "SELECT de_codigo, de_descri_es FROM departamentos where de_jefe='$jprof' ORDER BY de_codigo";
	$s_dto = mysql_query ($sql);
	while ($r_dto = mysql_fetch_row ($s_dto)) {
		echo ("<option value='$r_dto[0]'>$r_dto[1]</option>\n");
	}
	?>
	</select>
	<br><br>
 Profesor...................... <SELECT class="seg_cajas" name="prof" size="1"> 

 <?php
	$sql = "SELECT pr_codigo, pr_nombre FROM profesores where pr_coddep='$departamento' ORDER BY pr_nombre";
	$s_prof = mysql_query ($sql);
	while ($r_prof = mysql_fetch_row ($s_prof)) {
		echo ("<option value='$r_prof[0]'>$r_prof[1]</option>\n");
	}
	?>
	</select>
	<br>
Asignatura.................... <SELECT class="seg_cajas" name="asig" size="1">
	<?php
	$sql = "SELECT as_codigo, as_descri FROM asignaturas ORDER BY as_codigo";
	$s_asig = mysql_query ($sql);
	while ($r_asig = mysql_fetch_row ($s_asig)) {
		echo ("<option value='$r_asig[0]'>$r_asig[1]</option>\n");
	}
	?>
	</select>
	<br>
Grupo......................... <select class="seg_cajas" name="grupo" size="1">
<?php
	$sql = "SELECT gr_codigo, gr_descri FROM grupos ORDER BY gr_codigo";
	$s_grupo = mysql_query ($sql);
	while ($r_grupo = mysql_fetch_row ($s_grupo)) {
		echo ("<option value='$r_grupo[0]'>$r_grupo[1]</option>\n");
	}
	mysql_close(conexion);
	?>-->
	</SELECT>
	<br><br>
	<hr width="400px">
	<br>

    <strong>Entre las siguientes fechas:</strong>
    <br>
	<br>
    Fecha inicial (aaaa-mm-dd)....... <INPUT maxlength="10" size="15" name="fecini" type="text">
    <br><br>
    Fecha final   (aaaa-mm-dd)......... <INPUT maxlength="10" size="15" name="fecfin" type="text">
    <br><br>
	<hr width="400px">
	<br>
	<INPUT size="10" value="CONSULTAR" name="seguir" type="submit">
	<INPUT size="10" value="BORRAR" name="seguir" type="reset">
  	</div>
	</FORM>
</div>
<div class="seg_cons_enc5" id="textoimpr">
<form action="consultaest.php" method="post">
<hr width="400px">
<br><?php

$var=$_SESSION['prueba'];/*El codigo este se supone que lo recibe del login, cuando lo recibe busca el usuario*/
$sql="select pr_nombre from profesores where pr_cuenta='$var'";
$s_prof = mysql_query ($sql);
$r_prof = mysql_fetch_row ($s_prof);

$nombre=$r_prof[0];

?>
J.Estudios.................... <SELECT class="seg_cajas" name="jest" size="1">
	<?php

	$sql = "SELECT  pr_codigo, pr_nombre FROM profesores where pr_nombre='$nombre' ORDER BY pr_nombre";
	$s_dep = mysql_query ($sql);
	while ($r_dep = mysql_fetch_row ($s_dep)) {
		echo ("<option value='$r_dep[0]'>$r_dep[1]</option>\n");
	}
	?>
	</SELECT><br><br>
 Profesor...................... <SELECT class="seg_cajas" name="prof" size="1">

 <?php
	$sql = "SELECT pr_codigo, pr_nombre FROM profesores ORDER BY pr_nombre";
	$s_prof = mysql_query ($sql);
	while ($r_prof = mysql_fetch_row ($s_prof)) {
		echo ("<option value='$r_prof[0]'>$r_prof[1]</option>\n");
	}
	?>
	</select>
	<br>
Departamento.................. <SELECT class="seg_cajas" name="dto" size="1">
	<?php
/*	$prof="Botilol";
	/*$sql="select pr_coddep from profesores where pr_nombre='$prof'";
	$cons1= mysql_query ($sql);
	$cons2= mysql_fetch_row($cons1);

	$sql = "SELECT de_codigo, de_descri_es FROM departamentos where de_codigo='$cons2[0]' ORDER BY de_codigo";
	$s_dto = mysql_query ($sql);
	while ($r_dto = mysql_fetch_row ($s_dto)) {
		echo ("<option value='$r_dto[0]'>$r_dto[1]</option>\n");
	}
	?>*/

	$sql = "SELECT de_codigo, de_descri_es FROM departamentos ORDER BY de_codigo";
	$s_dto = mysql_query ($sql);
	while ($r_dto = mysql_fetch_row ($s_dto)) {
		echo ("<option value='$r_dto[0]'>$r_dto[1]</option>\n");
	}
	?>
	</select>
	<br>
Asignatura.................... <SELECT class="seg_cajas" name="asig" size="1">
	<?php
	$sql = "SELECT as_codigo, as_descri FROM asignaturas ORDER BY as_codigo";
	$s_asig = mysql_query ($sql);
	while ($r_asig = mysql_fetch_row ($s_asig)) {
		echo ("<option value='$r_asig[0]'>$r_asig[1]</option>\n");
	}
	?>
	</select>
	<br>
Grupo......................... <select class="seg_cajas" name="grupo" size="1">
<?php
	$sql = "SELECT gr_codigo, gr_descri FROM grupos ORDER BY gr_codigo";
	$s_grupo = mysql_query ($sql);
	while ($r_grupo = mysql_fetch_row ($s_grupo)) {
		echo ("<option value='$r_grupo[0]'>$r_grupo[1]</option>\n");
	}
	mysql_close(conexion);
	?>
	</SELECT>
	<br><br>
	<hr width="400px">
	<br>

    <strong>Entre las siguientes fechas:</strong>
    <br>
	<br>
     Fecha inicial (aaaa-mm-dd)....... <INPUT maxlength="10" size="15" name="fecini" type="text">
    <br><br>
    Fecha final    (aaaa-mm-dd)......... <INPUT maxlength="10" size="15" name="fecfin" type="text">
    <br><br>
	<hr width="400px">
	<br>
	<INPUT size="10" value="CONSULTAR" name="seguir" type="submit">
	<INPUT size="10" value="BORRAR" name="seguir" type="reset">
  	</div>
	</FORM>
</div>
</body>
</html>
