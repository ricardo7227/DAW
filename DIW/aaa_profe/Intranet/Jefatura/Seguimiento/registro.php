<?php session_start(); ?>
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
<h1>Registro</h1>
<table border="0" align="center" width="300px" height="25px">
<tr align="center">
	<td><a href="inicio.php"><img src="imagen/home.png" width="25px" height="25px"></a></td>
	<td><a href="inicio.php"><img src="imagen/atras.png" width="25px" height="25px"></a></td>
	<td><a href='javascript:window.print(); void 0;'><img src="imagen/impresora.gif" width="25px" height="25px"></a></td>
	<td><a href="faq.html" target="_blank"><img src="imagen/faq.png" width="25px" height="25px"></a></td>
</tr>
</table>
</div>
<div class="seg_cons2_enc1" id="enc1">
<?php
	$conexion = mysql_connect("localhost", "phpuser", "phpp@asswd1011");
	mysql_select_db("basedatos");
	$prof="Botilol";
$var=$_SESSION['prueba'];/*El codigo este se supone que lo recibe del login, cuando lo recibe busca el usuario*/

$sql="select pr_nombre from profesores where pr_cuenta='$var'";
$s_prof = mysql_query ($sql);
$r_prof = mysql_fetch_row ($s_prof);
$prof=$r_prof[0];


?>
<form action="intdesc.php" method="post">
<hr width="400px">
<br>
 Profesor....................... <SELECT class='seg_cajas' name="prof" size="1">
 <?php 
	$sql = "SELECT pr_codigo, pr_nombre FROM profesores where pr_nombre='$prof' ORDER BY pr_nombre";
	$s_prof = mysql_query ($sql);
	while ($r_prof = mysql_fetch_row ($s_prof)) {
		echo ("<option value='$r_prof[0]'>$r_prof[1]</option>\n");
	}
	?>
	</select>
	<br><br>
Departamento................... <SELECT class='seg_cajas' name="dto" size="1">
	<?php
	$sql = "SELECT de_codigo, de_descri_es FROM departamentos ORDER BY de_codigo";
	$s_dto = mysql_query ($sql);
	while ($r_dto = mysql_fetch_row ($s_dto)) {
		echo ("<option value='$r_dto[0]'>$r_dto[1]</option>\n");
	}
	?>
	</SELECT>
	<br>
Asignatura..................... <SELECT class='seg_cajas' name="asig" size="1">
	<?php
	$sql = "SELECT as_codigo, as_descri FROM asignaturas ORDER BY as_codigo";
	$s_asig = mysql_query ($sql);
	while ($r_asig = mysql_fetch_row ($s_asig)) {
		echo ("<option value='$r_asig[0]'>$r_asig[1]</option>\n");
	}
	?>
	</select>
	<br>
Grupo..........................  <select class='seg_cajas' name="grupo" size="1">
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
    <strong>Introduce descripción:</strong>
    <br>
    <textarea name="descripcion" rows="7" cols="65"></textarea>
	<br><br>
	<hr width="400px">
	<br><br>
	<INPUT size="10" value="ESCRIBIR" name="seguir" type="submit">
	<INPUT size="10" value="BORRAR" name="seguir" type="reset">
  	</div>
	</FORM>
</div>
</body>
</html>
