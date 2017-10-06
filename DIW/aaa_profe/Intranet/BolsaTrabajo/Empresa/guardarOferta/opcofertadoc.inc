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
<font face="Arial" align="right" size="+2" color="#000066">Formulario Curriculum Vitae</font>
<hr>
<br>
<B><U><FONT FACE="Arial,Helvetica">NUEVA OFERTA</FONT></U></B>
<br>
<br>
<form method ="POST" action="BolsaTrabajo/Empresa/guardarOferta/ofertas.php" enctype="multipart/form-data" >
<table>

Rama : <SELECT NAME="campo"><OPTION SELECTED>Informatica<OPTION>Electronica</OPTION><FONT SIZE=-1><OPTION>FrioyCalor</OPTION><OPTION>Automocion</OPTION></SELECT></FONT><br><br>

Nombre Empresa :<INPUT TYPE="TEXT" NAME="Nombre" size="20" maxlength="30"> <br><br><br><br>
Selecciona el fichero :<input type="file" name ="imagen">

<br><br><br>
<input  type="image" onclick="display_alert()" src="BolsaTrabajo/Estilos/boton.png">
	
<INPUT TYPE="hidden" NAME="Ubicacion" size="20" maxlength="30"><br><br><br><br>
<INPUT TYPE="hidden" NAME="puestoOfertado" size="20" maxlength="30">
<INPUT TYPE="hidden" NAME="descripcion" size="20" maxlength="30">
<INPUT TYPE="hidden" NAME="jornada" size="20" maxlength="30">
<INPUT TYPE="hidden" NAME="requisitos" size="20" maxlength="30">
<INPUT TYPE="hidden" NAME="puestosVacan" size="20" maxlength="30">
<INPUT TYPE="hidden" NAME="email" size="20" maxlength="30">
<INPUT TYPE="hidden" NAME="telefono" size="20" maxlength="30">
 <input type="hidden" name="fecha" value="2011-01-01">



<br><br>

<br><br>

<br><br>
</table>
</form>
</body>
</html>
</div>




