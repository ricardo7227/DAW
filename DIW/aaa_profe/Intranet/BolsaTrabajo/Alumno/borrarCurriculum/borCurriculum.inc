<div id='cuerpo-centro'>

<script>
function display_alert()
  {
  alert("Tu curriculum ha sido borrado!!");
  }
</script>
<html>
<head></head>
<body TEXT="black" BGCOLOR="#FFFFF" LINK="#0000FF" VLINK="#800080">
<hr>
<hr>
<br>
<br>
<br>
<form method ="POST" action="BolsaTrabajo/Alumno/borrarCurriculum/borrarCurriculum.php" enctype="multipart/form-data" >

Introduce DNI :<INPUT TYPE="TEXT" NAME="DNI" size="20" maxlength="30"> <br><br>
<br>
<br>
<input  type="image"  onclick="display_alert()"  src="BolsaTrabajo/Estilos/boton.png">

</form>
</body>
</html>
</div>