<?PHP
echo " ";
?>
<script>
function display_alert()
  {
  alert("You have registered!!");
  }
</script>
<div id="cuerpo-centro">
<html>
	<head>
		<title> Subscribe to job</title>
		<meta charset="utf-8">
	</head>
	<body>
		<form method ="POST" action="BolsaTrabajo/Alumno/Inscribirse/inscribirse_en.php" enctype="multipart/form-data" >

		<br>
		<b> Your email </b>
		<input type="text" name="Email" VALUE="" size="14" maxlength="12">
		<input type="submit" name="enviar" VALUE="enviar" size="14"  onclick="display_alert()" maxlength="12"> 
		</form>
	</body>	
	
</html>
</div>
	
