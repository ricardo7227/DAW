<script>
function display_alert()
  {
  alert("Your offer has been deleted!!");
  }
</script>

<div id='cuerpo-centro'>
<html>
<head></head>
<body TEXT="black" BGCOLOR="#FFFFF" LINK="#0000FF" VLINK="#800080">
<hr>
<font face="Arial" align="right" size="+2" color="#000066">Offer</font>
<hr>
<br>
<br>
<br>
<form method ="POST" action="BolsaTrabajo/Empresa/borrarOferta/borraroferta_en.php" enctype="multipart/form-data" >

Enter the code of the offer:<INPUT TYPE="TEXT" NAME="DNI" size="20" maxlength="30"> <br><br>
<br>
<br>
<input  type="image" src="BolsaTrabajo/Estilos/boton.png" onclick="display_alert()">

</form>
</body>
</html>
</div>