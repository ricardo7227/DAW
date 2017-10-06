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
		<meta charset="utf-8">
	</head>
<font face="Arial" align="left" size="+2" color="#000066">Formulario Curriculum Vitae</font>
	<body>
		<form method ="POST" action="BolsaTrabajo/Alumno/guardarCurriculum/guardar.php" enctype="multipart/form-data" >

		<br>
		
		<table align ="center" border ="0" >
			<tr>
				<TD ALIGN="left">
					
				<b> Documento de identidad nacional (o pasaporte) </b>
				</th>
				<TD ALIGN="left">
				<input type="text" name="DNI" VALUE="" size="14" maxlength="12">
				
				</td>
				
				<tr>
				<TD ALIGN="left">
					Primer apellido :
				</td>
				 <TD ALIGN="left"> <input ="text" name="Apellido1" size="20" maxlength="30"></td>
				<tr>
				<TD ALIGN="left">
				
				
					Segundo apellido : 
					
				</td>
				
				
				<TD ALIGN="left">
				<input ="text" name="Apellido2" size="20" maxlength="30">
				</td>
				</tr>
				<br>
				
				 <TD ALIGN="left">
					<b> Nombre </b>
				</td>
				
				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="Nombre" VALUE=""size="15" maxlength="30"></TD>
				
				
				<br>
				</tr>
				</td>

					<tr>
				<TD ALIGN="left">
			Rama : 
			</td>
				
				
					<td>
					<SELECT NAME="campo"><OPTION SELECTED>Informatica<OPTION>Electronica</OPTION><FONT SIZE=-1><OPTION>FrioyCalor</OPTION><OPTION>Automocion</OPTION></SELECT></FONT>
					</td>
					
					</tr>

		
		<br>
		<br>
		

			<tr>
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>Sexo </FONT></B>
				</td>
				
				 <TD ALIGN="left">
					<font size=-1>Hombre</font><INPUT TYPE="radio" NAME="Sexo" VALUE="Hombre" checked><font size=-1> Mujer</font><INPUT TYPE="radio" NAME="Sexo" VALUE="Mujer">
				</TD>
				</tr>
				<tr>
				
				
				 <TD ALIGN="left">
					<b><FONT COLOR="#000000" SIZE=-1>Estado civil</FONT></B>
				</TD>
				
				
				 <TD ALIGN="left">
					<SELECT NAME="EstadoCivil"><OPTION SELECTED><OPTION><FONT SIZE=-1>Soltero<OPTION>Casado</SELECT></FONT>
				</TD>
				</tr>
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>Nacionalidad</FONT></B>
				</TD>
				
				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="Nacionalidad" VALUE=""size="15" maxlength="30">	
				</TD>
			</tr>
		
		


		
			<tr>
				 <TD ALIGN="left">
					<b><FONT COLOR="#000000" SIZE=-1>Fecha de nacimiento:</FONT></b></td> <TD ALIGN="left"><input type="date" name="fecha" value="2011-01-01">
				</td>
			</tr>
			
			<tr>
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>Lugar de Nacimiento</FONT></B>
				</TD>
				
				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="LugarNacimiento" size="10" maxlength="30">
				</TD>
				</tr>
				<tr>
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000"><FONT SIZE=-1>Pa&iacute;s de nacimiento</FONT></FONT></B>
				</TD>
				
				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="PaisNacimiento" VALUE=""size="10" maxlength="30">
				</TD>
			</tr>
			
		</table>
		
		
		<table align="center" border="0">
		<p><B><U><FONT FACE="Arial,Helvetica">DIRECCION</FONT></U></B></p>
		<br>
		<tr>
		<td>
		<B><FONT COLOR="#000000" SIZE=-1>Domicilio&nbsp;</FONT></B>
		</td>
		<td>
		<INPUT TYPE="TEXT" NAME="Domicilio" size="50" maxlength="60">
		</td>
		</tr>
		
	
			<tr>
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>C&oacute;digo Postal</FONT></B>
				</TD>
				
				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="CodigoPostal" size="5" maxlength="5">
				</TD>
				</tr>
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>Localidad</FONT></B>
				</TD>
				
				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="Localidad" size="20" maxlength="20">
				</TD>
				</tr>
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>Pa&iacute;s</FONT></B>
				</TD>

				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="Pais" size="20" maxlength="20">
				</TD>
			</TR>
		
		<br>
		<br>
		
			<TR>
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>Telefono y movil</FONT></B>
				</TD>
				
				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="Telefono" size="11" maxlength="11"><INPUT TYPE="TEXT" NAME="Telefono2" size="11" maxlength="11">
				</TD>
				
				</tr>
				<tr>
				<TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>E-Mail</FONT></B></TD> 
					
					<TD ALIGN="left"><INPUT NAME="Email" size="30" value="anonimo@anonimo.es">
				</TD>
			</tr>
		</table>

		<br>
		<br>
		<P><br>
		<B><U><FONT FACE="Arial,Helvetica">FORMACION</FONT></U></B>
		<P><B><FONT COLOR="#000000" SIZE=-1>Si usted es un estudiante, complete
		por favor los campos siguientes:</FONT></B>&nbsp;
		<p>
		<TABLE>
			<TR>
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>Estudios</FONT></B>
				</TD>
				
				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="EstudiosSinAcabar" VALUE="" size="25" maxlength="40">
				</TD>
				
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>Universidad</FONT></B>
				</TD>
				
				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="UniversidadSinAcabar" VALUE="" size="25" maxlength="40">
				</TD>
			</tr>
			
			<tr>
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>A&ntilde;o previsto<br>graduaci&oacute;n</FONT></B>
				</TD>
				
				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="FinalPrevisto" VALUE="" size="4" maxlength="4">
				</TD>
			</TR>
		</table>
		
		<br>
		<br>
		<P><B><FONT COLOR="#000000" SIZE=-1>Si usted ha acabado sus estudios de la universidad, complete por favor los campos siguientes:</FONT></B>&nbsp;
		<p><br>
		<B><FONT COLOR="#000000" SIZE=-1>El grado m&aacute;s alto obtenido</FONT></B>
		<INPUT TYPE="radio" NAME="Grado" VALUE="Graduado" checked><FONT SIZE=-1>Graduado&nbsp;<INPUT TYPE="radio" NAME="Grado" VALUE="Licenciado">Licenciado&nbsp;<INPUT TYPE="radio" NAME="Grado" VALUE="Doctor">Doctor</FONT>
		<TABLE>
			<TR>
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>Estudios</FONT></B>
				</TD>
				
				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="EstudiosAcabados" size="25" maxlength="40">
				</TD>
				
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>A&ntilde;o de la graduaci&oacute;n</FONT></B>
				</TD>
				
				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="Final" size="4" maxlength="4">
				</TD>
			</TR>
			
			<TR>
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>Universidad&nbsp;</FONT></B>
				</TD>
				
				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="Universidad" size="25" maxlength="40">
				</TD>
			</TR>
		</table>
		
		<br>
		<br>
		<P><B><FONT COLOR="#000000" SIZE=-1>Si usted no ha estudiado en una universidad, complete por favor los campos siguientes:</FONT></B>&nbsp;
		<P>&nbsp;
		<TABLE>
			<TR>
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>Estudios</FONT></B>
				</td>
				
				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="Estudios" VALUE="" size="25" maxlength="40">
				</TD>
				
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>A&ntilde;o de finalizaci&oacute;n
					de&nbsp; los estudios</FONT></B>
				</TD>
				
				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="FinalizacionEstudios" VALUE="" size="4" maxlength="4">
				</TD>
			</TR>
			
			<TR>
				 <TD ALIGN="left">
					<B><FONT COLOR="#000000" SIZE=-1>¿D&oacute;nde?&nbsp;</FONT></B>
				</TD>
				
				 <TD ALIGN="left">
					<INPUT TYPE="TEXT" NAME="LugarEstudios" size="25" maxlength="40">
				</TD>
			</TR>
		</TABLE>
		
		<br>
		<B><FONT COLOR="#000000" SIZE=-1>Lengua Materna&nbsp;</FONT></B><INPUT TYPE="TEXT" NAME="LenguaMaterna" size="10" maxlength="20">
		<br>
		<p><br>
		<B><U><FONT FACE="Arial,Helvetica">IDIOMAS</FONT></U></B>
		<p><br>
		
		
		<TABLE>
			<TR>
				 <TD ALIGN="left">
					<CENTER>
						<B><FONT COLOR="#0000FF" SIZE=-1>Idioma</FONT></B>
					</CENTER>
				</TD>
				
				 <TD ALIGN="left">
					<CENTER>
						<B><FONT COLOR="#0000FF" SIZE=-1>Escritura</FONT></B>
					</CENTER>
				</TD>
				
				 <TD ALIGN="left">
					<CENTER>
						<B><FONT COLOR="#0000FF" SIZE=-1>Lectura</FONT></B>
					</CENTER>
				</TD>
				
				 <TD ALIGN="left">
					<CENTER>
						<B><FONT COLOR="#0000FF" SIZE=-1>Compresi&oacute;n Oral</FONT></B>
					</CENTER>
				</TD>
			</TR>
			
			<tr>
				 <TD ALIGN="left">
					<font size="-1" color="#000000"><b>Frances</b></font>
				</TD>
				
				 <TD ALIGN="left">
					<SELECT NAME="FrancesEscri">
						<OPTION SELECTED><OPTION>Nulo<OPTION>Bajo<OPTION>Regular<OPTION>Alto<OPTION>Muy Alto
					</SELECT>
				</TD>
				
				 <TD ALIGN="left">
					<SELECT NAME="FrancesLeido">
						<OPTION SELECTED><OPTION>Nulo<OPTION>Bajo<OPTION>Regular<OPTION>Alto<OPTION>Muy Alto
					</SELECT>
				</TD>
				
				 <TD ALIGN="left">
					<SELECT NAME="FrancesOral">
						<OPTION SELECTED><OPTION>Nulo<OPTION>Bajo<OPTION>Regular<OPTION>Alto<OPTION>Muy Alto
					</SELECT>
				</TD>
			</tr>
			
			<br>
			
			<tr>
			
				 <TD ALIGN="left">
					<font size="-1" color="#000000"><b>Inglés</b></font>
				</TD>
				
				 <TD ALIGN="left">
					<SELECT NAME="InglesEscri">
						<OPTION SELECTED><OPTION>Nulo<OPTION>Bajo<OPTION>Regular<OPTION>Alto<OPTION>Muy Alto
					</SELECT>
				</TD>
					
				 <TD ALIGN="left">
					<SELECT NAME="InglesLeido">
						<OPTION SELECTED><OPTION>Nulo<OPTION>Bajo<OPTION>Regular<OPTION>Alto<OPTION>Muy Alto
					</SELECT>
				</TD>
				
				 <TD ALIGN="left">
					<SELECT NAME="InglesComprOral">
						<OPTION SELECTED><OPTION>Nulo<OPTION>Bajo<OPTION>Regular<OPTION>Alto<OPTION>Muy Alto
					</SELECT>
				</TD>
			</tr>
			
		</table>
		
		<br><br>
			DNI:<INPUT TYPE="TEXT" NAME="Telefono" size="11" maxlength="11">
	
	
		<input  type="file" name="imagen" >
		<br>
		<p><br>
		

		
		<input  type="image" src="BolsaTrabajo/Estilos/boton.png"  onclick="display_alert()">

			</form>		
	</body>
	

</html>	
</div>
