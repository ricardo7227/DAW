<?PHP
echo " ";
?>
<script>
function display_alert()
  {
  alert("Te has inscrito!!");
  }
</script>
<div id="cuerpo-centro">
<html>
	<head>
		<title> Inscribirse a la bolsa de trabajo</title>
		<meta charset="utf-8">
	</head>
	<body>
		<form method ="POST" action="BolsaTrabajo/Alumno/Inscribirse/inscribirse.php" enctype="multipart/form-data" >

		<br>
		<b> Introduce tu email </b>
		<input type="text" name="Email" VALUE="" size="14" maxlength="12">
		<input type="submit" name="enviar" VALUE="enviar" size="14"  onclick="display_alert()" maxlength="12"> 
		</form>
	</body>	
	
</html>
</div>
	
