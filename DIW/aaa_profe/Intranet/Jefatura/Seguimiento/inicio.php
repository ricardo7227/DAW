<?php session_start(); ?>
<html>
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<head>
<script type="text/javascript">
// con esta función se mantiene el espacio ocupado
// por el bloque <div>
function textoini1() { //
	 document.getElementById("javas").style.display= "none";
	 document.getElementById("textolect").style.display = "block";
	 document.getElementById("enc1").style.background='url(imagen/fondo2.png)';
	document.getElementById("enc2").style.background='url(imagen/fondo.png)';
}
function textoini(){
	
	document.getElementById("textolect").style.display= "none";
	document.getElementById("textoescr").style.display= "none";
	document.getElementById("javas").style.display = "block";
	 document.getElementById("enc1").style.background='url(imagen/fondo.png)';
	document.getElementById("enc2").style.background='url(imagen/fondo.png)';
}
function textoini2(){
document.getElementById("javas").style.display= "none";
	 document.getElementById("textoescr").style.display = "block";
	 document.getElementById("enc1").style.background='url(imagen/fondo.png)';
	document.getElementById("enc2").style.background='url(imagen/fondo2.png)';
}
function textoini3(){
document.getElementById("javas").style.display= "none";
	 document.getElementById("textoimp").style.display = "block";

}
</script>
<link rel="stylesheet" type="text/css" href="jef_seg.css">
<title>
Ejemplo interfaz Proyecto 2013
</title>
<body class="seg_ini_general">
<div class="seg_ini_enc0">
<h1>Registro de programaciones para el profesorado</h1> <br>
<table border="0" align="center" width="200px" height="25px">
<tr align="center">
	<td><a href="inicio.php"><img src="imagen/home.png" width="25px" height="25px"></a></td>
	<td><a href='javascript:window.print(); void 0;'><img src="imagen/impresora.gif" width="25px" height="25px"></a></td>
	<td><a href="faq.html" target="_blank"><img src="imagen/faq.png" width="25px" height="25px"></a></td>
</tr>
</table>
</div>
<div class="seg_ini_enc1" onmouseover="textoini1()" onmouseout="textoini()" id="enc1">
<a href="consulta.php" class="link">CONSULTA</a>
</div>
<div class="seg_ini_enc2" onmouseover="textoini2()" onmouseout="textoini()" id="enc2">
<a href="registro.php" class="link">REGISTRO</a>
</div>
<div class="seg_ini_enc4" id="javas">
<span id="seg_ini_id1">Instrucciones para consultar/registrar el seguimiento de la programación:</span>
<br><br>
<span id="seg_ini_id2">- Para escoger una opción sólo debes pulsar en CONSULTA o REGISTRO y te llevará a la sección escogida.<br><br>
- Si pasas por encima de la opción, te mostrará información en este cuadro de texto.<br><br>
- Si necesita ayuda, pulse el dado que hay en cada página, le llevará a una página de ayuda con imagenes explicativas<br><br>
- La opción CONSULTA puede estar limitada a ciertos tipos de usuarios con privilegios.
</span>
<br><br><br><br><br>
<center><span id="seg_ini_id3">Si encuentra algun problema pongase en contacto con el responsable TIC
<br><br>
NOTA: ESTO ES UN ACCESO RESTRINGIDO, SI NO ES USTED PROFESOR/A O DEL EQUIPO DIRECTIVO, POR FAVOR SALGA DE ESTE APARTADO</span></center>
</div>
<div class="seg_ini_enc5" id="textolect">
En esta sección podrás: <br><br>
<span id="seg_ini_id2">- Si eres profesor, consultar tus propias programaciones.<br><br>
- Si eres jefe del departamento, consultar los seguimientos de las programaciones de los profesores de los departamentos de los que eres jefe.<br><br>
- Si eres jefe de estudios/director podrás consultar todas los seguimientos de las programaciones<br><br><br><br><br><br>
*** Se recuerda que tienes que estar logueado ***</span>
</div>
<div class="seg_ini_enc5" id="textoescr">
En esta sección podrás: <br><br>
<span id="seg_ini_id2">- Registrar el seguimiento de la programación<br><br><br><br><br><br>
*** Se recuerda que tienes que estar logueado ***</span>
</div>
</body>
</html>
