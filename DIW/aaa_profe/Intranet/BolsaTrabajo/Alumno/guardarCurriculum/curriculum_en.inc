<?PHP
echo " ";
?>

<script>
function display_alert()
  {
  alert("Your resume send!!");
  }
</script>

<div id="cuerpo-centro">
<html>
	<head>
		<title> Creacion Curriculum Vitae</title>
		<meta charset="utf-8">
	</head>
<font face="Arial" align="right" size="+2" color="#000066">Formulario Curriculum Vitae</font>
	<body>
		<form method ="POST" action="BolsaTrabajo/Alumno/guardarCurriculum/guardar.php" enctype="multipart/form-data" >

		<input  type="file" name="imagen" >
		<br>
		<p><br>
		<input  type="image" onclick="display_alert()" src="BolsaTrabajo/Estilos/boton.png">

			</form>		
	</body>

</html>	
</div>
