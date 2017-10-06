<?php

?>

<script>
function display_alert()
  {

  }
</script>

<div id='cuerpo-centro'>
<html>
<head></head>
<body TEXT="black" BGCOLOR="#FFFFF" LINK="#0000FF" VLINK="#800080">
<hr>
<font face="Arial" align="right" size="+2" color="#000066">Form companies</font>
<hr>
<br>
<B><U><FONT FACE="Arial,Helvetica">NEW OFFER</FONT></U></B>
<br>
<br>
<form method ="POST" action="BolsaTrabajo/Empresa/guardarOferta/ofertas_en.php" enctype="multipart/form-data" >
<table>

Branch: <SELECT NAME="campo"><OPTION SELECTED>Informatica<OPTION>Electronica</OPTION><FONT SIZE=-1><OPTION>FrioyCalor</OPTION><OPTION>Automocion</OPTION></SELECT></FONT><br><br>

Company Name :<INPUT TYPE="TEXT" NAME="Nombre" size="20" maxlength="30"> <br><br><br><br>

Location :<INPUT TYPE="TEXT" NAME="Ubicacion" size="20" maxlength="30"><br><br><br><br>

Position offered :<INPUT TYPE="TEXT" NAME="puestoOfertado" size="20" maxlength="30"><br><br><br><br>
Description :<INPUT TYPE="TEXT" NAME="descripcion" size="20" maxlength="30"><br><br><br><br>
	
Working day :<INPUT TYPE="TEXT" NAME="jornada" size="20" maxlength="30"><br><br><br><br>
Requirements :<INPUT TYPE="TEXT" NAME="requisitos" size="20" maxlength="30"><br><br><br><br>
Vacancies :<INPUT TYPE="TEXT" NAME="puestosVacan" size="20" maxlength="30"><br><br><br><br>
Email:<INPUT TYPE="TEXT" NAME="email" size="20" maxlength="30"><br><br><br><br>
Telefono:<INPUT TYPE="TEXT" NAME="telefono" size="20" maxlength="30"><br><br><br><br>
Date : <input type="date" name="fecha" value="2011-01-01"><br><br><br><br>

	

<br><br>

<br><br>
<input  type="image" onclick="display_alert()" src="BolsaTrabajo/Estilos/boton.png">
<br><br>
</table>
</form>
</body>
</html>
</div>

