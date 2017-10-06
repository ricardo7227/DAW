<?PHP
echo " ";
?>

<script>
function display_alert()
  {
  alert("Tu curriculum ha sido enviado!!");
  }
</script>

<div id="cuerpo-centro">
<html>
	<head>
	<style>
	td {
		ALIGN=left;
	}
	</style>
		<title> Creacion Curriculum Vitae</title>
		<meta charset="uft-8">
	</head>
<font face="Arial" align="left" size="+2" color="#000066">Formulario Curriculum Vitae</font>
	<body>
		<form method ="POST" action="BolsaTrabajo/Alumno/guardarCurriculum/guardar.php" enctype="multipart/form-data" >

		
		
		<br><br>
			DNI:<INPUT TYPE="TEXT" NAME="DNI" size="11" maxlength="11">
		
		<br><br>	<br><br>
		
					Rama : 
			</td>
				
				
					<td>
					<SELECT NAME="campo"><OPTION SELECTED>Informatica<OPTION>Electronica</OPTION><FONT SIZE=-1><OPTION>FrioyCalor</OPTION><OPTION>Automocion</OPTION></SELECT></FONT>
					</td>
					
					</tr>

		
		<br>
		<br><br>
		<input  type="file" name="imagen" >
		<br>
		<p><br>
		
		<input  type="image" onclick="display_alert()" src="BolsaTrabajo/Estilos/boton.png">

			</form>		
	</body>
	

</html>	
</div>
