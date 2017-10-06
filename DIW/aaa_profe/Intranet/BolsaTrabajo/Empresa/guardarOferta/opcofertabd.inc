<?php

?>

<script>
function display_alert()
  {
  alert("Tu oferta ha sido enviada!!");
  }
</script>

<div id='cuerpo-centro'>
<html>
<head></head>
<body TEXT="black" BGCOLOR="#FFFFF" LINK="#0000FF" VLINK="#800080">
<hr>
<hr>
<br>
<B><U><FONT FACE="Arial,Helvetica">NUEVA OFERTA</FONT></U></B>
<br>
<br>
<form method ="POST" action="BolsaTrabajo/Empresa/guardarOferta/ofertas.php" enctype="multipart/form-data" >
<table>

Rama : <SELECT NAME="campo"><OPTION SELECTED>Informatica<OPTION>Electronica</OPTION><FONT SIZE=-1><OPTION>FrioyCalor</OPTION><OPTION>Automocion</OPTION></SELECT></FONT><br><br>

Nombre Empresa :<INPUT TYPE="TEXT" NAME="Nombre" size="20" maxlength="30"> <br><br><br><br>

Ubicacion :<INPUT TYPE="TEXT" NAME="Ubicacion" size="20" maxlength="30"><br><br><br><br>

Puesto ofertado :<INPUT TYPE="TEXT" NAME="puestoOfertado" size="20" maxlength="30"><br><br><br><br>
Descripcion :<INPUT TYPE="TEXT" NAME="descripcion" size="20" maxlength="30"><br><br><br><br>
Jornada :<INPUT TYPE="TEXT" NAME="jornada" size="20" maxlength="30"><br><br><br><br>
Requisitos :<INPUT TYPE="TEXT" NAME="requisitos" size="20" maxlength="30"><br><br><br><br>
Puestos vacantes:<INPUT TYPE="TEXT" NAME="puestosVacan" size="20" maxlength="30"><br><br><br><br>
Email:<INPUT TYPE="TEXT" NAME="email" size="20" maxlength="30"><br><br><br><br>
Telefono:<INPUT TYPE="TEXT" NAME="telefono" size="20" maxlength="30"><br><br><br><br>
fecha : <input type="date" name="fecha" value="2011-01-01"><br><br><br><br>

	

<br><br>

<br><br>
<input  type="image" onclick="display_alert()" src="BolsaTrabajo/Estilos/boton.png">
<br><br>
</table>
</form>
</body>
</html>
</div>

