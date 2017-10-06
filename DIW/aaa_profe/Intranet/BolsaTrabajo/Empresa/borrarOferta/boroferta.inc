<script>
function display_alert()
  {
  alert("Tu oferta ha sido borrada!!");
  }
</script>

<div id='cuerpo-centro'>
<html>
<head></head>
<body TEXT="black" BGCOLOR="#FFFFF" LINK="#0000FF" VLINK="#800080">
<hr>
<hr>
<br>
<br>
<br>
<form method ="POST" action="BolsaTrabajo/Empresa/borrarOferta/borraroferta.php" enctype="multipart/form-data" >

Introduce el codigo de la oferta :<INPUT TYPE="TEXT" NAME="DNI" size="20" maxlength="30"> <br><br>
<br>
<br>
<input  type="image" src="BolsaTrabajo/Estilos/boton.png" onclick="display_alert()">

</form>
</body>
</html>
</div>