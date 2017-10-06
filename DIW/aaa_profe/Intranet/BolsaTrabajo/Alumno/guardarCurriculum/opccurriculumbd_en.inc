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
		<title> Creacion Curriculum Vitae</title>
		<meta charset="utf-8">
	</head>
<font face="Arial" align="right" size="+2" color="#000066">Formulario Curriculum Vitae</font>
	<body>
		<form method ="POST" action="BolsaTrabajo/Alumno/guardarCurriculum/guardar_en.php" enctype="multipart/form-data" >

		<br>
		<b> ID card </b>
		<input type="text" name="DNI" VALUE="" size="14" maxlength="12">
		<table>
			<tr>
				<td>
					<b>Subname</b>
				
				<td>
					Subname 1: <input ="text" name="Apellido1" size="20" maxlength="30">
					<br>
					Subname 2: <input ="text" name="Apellido2" size="20" maxlength="30">
				</td>
				
				<br>
				
				<td>
					<b> Name </b>
				</td>
				
				<TD>
					<INPUT TYPE="TEXT" NAME="Nombre" VALUE=""size="15" maxlength="30"></TD>
				
				
				<br>
				<tr>
				</td>

					Branch : <SELECT NAME="campo"><OPTION SELECTED>Computing<OPTION>Electronics</OPTION><FONT SIZE=-1><OPTION>Refrigeration networks</OPTION><OPTION>Automotive</OPTION></SELECT></FONT>
				</td>

				</tr>
		</table>
		
		<br>
		<br>
		
		<table>
			<tr>
				<td>
					<B><FONT COLOR="#000000" SIZE=-1>Gender</FONT></B>
				</td>
				
				<TD>
					<font size=-1>Man</font><INPUT TYPE="radio" NAME="Sexo" VALUE="Hombre" checked><font size=-1> Women</font><INPUT TYPE="radio" NAME="Sexo" VALUE="Mujer">
				</TD>
				
				<td width=20>
				
				</td>
				
				<td>
					<b><FONT COLOR="#000000" SIZE=-1>Marital status</FONT></B>
				</TD>

				<TD>
					<SELECT NAME="EstadoCivil"><OPTION SELECTED><OPTION><FONT SIZE=-1>Single<OPTION>Married</SELECT></FONT>
				</TD>
				
				<td>
					<B><FONT COLOR="#000000" SIZE=-1> Nationality </FONT></B>
				</TD>
				
				<TD>
					<INPUT TYPE="TEXT" NAME="Nacionalidad" VALUE=""size="15" maxlength="30">	
				</TD>
			</tr>
		</table>
		
		<br>
		<br>

		<TABLE>
			<tr>
				<td>
					<b><FONT COLOR="#000000" SIZE=-1>Date of Birth:</FONT></b></td><td><input type="date" name="fecha" value="2011-01-01">
				</td>
			</tr>
			
			<tr>
				<td>
					<B><FONT COLOR="#000000" SIZE=-1>Birthplace: </FONT></B>
				</TD>
				
				<TD>
					<INPUT TYPE="TEXT" NAME="LugarNacimiento" size="10" maxlength="30">
				</TD>
				
				<TD>
					<B><FONT COLOR="#000000"><FONT SIZE=-1>Country of birth</FONT></FONT></B>
				</TD>
				
				<td>
					<INPUT TYPE="TEXT" NAME="PaisNacimiento" VALUE=""size="10" maxlength="30">
				</TD>
			</tr>
			
		</table>
		
		<br>
		<br>
		
		<p><B><U><FONT FACE="Arial,Helvetica">ADDRESS</FONT></U></B></p>
		<br>
		<B><FONT COLOR="#000000" SIZE=-1>Place of residence&nbsp;</FONT></B>
		<INPUT TYPE="TEXT" NAME="Domicilio" size="50" maxlength="60">
		<table>
			<tr>
				<TD>
					<B><FONT COLOR="#000000" SIZE=-1>Postcode</FONT></B>
				</TD>
				
				<TD>
					<INPUT TYPE="TEXT" NAME="CodigoPostal" size="5" maxlength="5">
				</TD>
				
				<TD>
					<B><FONT COLOR="#000000" SIZE=-1>Location</FONT></B>
				</TD>

				<TD>
					<INPUT TYPE="TEXT" NAME="Localidad" size="20" maxlength="20">
				</TD>

				<TD>
					<B><FONT COLOR="#000000" SIZE=-1>Country</FONT></B>
				</TD>

				<TD>
					<INPUT TYPE="TEXT" NAME="Pais" size="20" maxlength="20">
				</TD>
			</TR>
		</table>
		<br>
		<br>
		<table>
			<TR>
				<TD>
					<B><FONT COLOR="#000000" SIZE=-1>Telephone number</FONT></B>
				</TD>
				
				<TD>
					<INPUT TYPE="TEXT" NAME="Telefono" size="11" maxlength="11"><INPUT TYPE="TEXT" NAME="Telefono2" size="11" maxlength="11">
				</TD>
				
				<TD>
					<B><FONT COLOR="#000000" SIZE=-1>E-Mail</FONT></B></TD><td><INPUT NAME="Email" size="30" value="anonimo@anonimo.es">
				</TD>
			</tr>
		</table>

		<br>
		<br>
		<P><br>
		<B><U><FONT FACE="Arial,Helvetica">Training</FONT></U></B>
		<P><B><FONT COLOR="#000000" SIZE=-1>Only students, please</FONT></B>&nbsp;
		<p>
		<TABLE>
			<TR>
				<TD>
					<B><FONT COLOR="#000000" SIZE=-1>Schooling</FONT></B>
				</TD>
				
				<TD>
					<INPUT TYPE="TEXT" NAME="EstudiosSinAcabar" VALUE="" size="25" maxlength="40">
				</TD>
				
				<TD>
					<B><FONT COLOR="#000000" SIZE=-1>University</FONT></B>
				</TD>
				
				<TD>
					<INPUT TYPE="TEXT" NAME="UniversidadSinAcabar" VALUE="" size="25" maxlength="40">
				</TD>
			</tr>
			
			<tr>
				<TD>
					<B><FONT COLOR="#000000" SIZE=-1>Final plans<br>Graduation</FONT></B>
				</TD>
				
				<TD>
					<INPUT TYPE="TEXT" NAME="FinalPrevisto" VALUE="" size="4" maxlength="4">
				</TD>
			</TR>
		</table>
		
		<br>
		<br>
		<P><B><FONT COLOR="#000000" SIZE=-1>Only studients with studies completed:</FONT></B>&nbsp;
		<p><br>
		<B><FONT COLOR="#000000" SIZE=-1>Higher degree:</FONT></B>
		<INPUT TYPE="radio" NAME="Grado" VALUE="Graduado" checked><FONT SIZE=-1>Graduate&nbsp;<INPUT TYPE="radio" NAME="Grado" VALUE="Licenciado">Degree&nbsp;<INPUT TYPE="radio" NAME="Grado" VALUE="Doctor">Doctor</FONT>
		<TABLE>
			<TR>
				<TD>
					<B><FONT COLOR="#000000" SIZE=-1>Studies</FONT></B>
				</TD>
				
				<TD>
					<INPUT TYPE="TEXT" NAME="EstudiosAcabados" size="25" maxlength="40">
				</TD>
				
				<TD>
					<B><FONT COLOR="#000000" SIZE=-1>Year of graduation</FONT></B>
				</TD>
				
				<TD>
					<INPUT TYPE="TEXT" NAME="Final" size="4" maxlength="4">
				</TD>
			</TR>
			
			<TR>
				<TD>
					<B><FONT COLOR="#000000" SIZE=-1>University&nbsp;</FONT></B>
				</TD>
				
				<TD>
					<INPUT TYPE="TEXT" NAME="Universidad" size="25" maxlength="40">
				</TD>
			</TR>
		</table>
		
		<br>
		<br>
		<P><B><FONT COLOR="#000000" SIZE=-1>Only no studients, please:</FONT></B>&nbsp;
		<P>&nbsp;
		<TABLE>
			<TR>
				<TD>
					<B><FONT COLOR="#000000" SIZE=-1>Studies</FONT></B>
				</td>
				
				<TD>
					<INPUT TYPE="TEXT" NAME="Estudios" VALUE="" size="25" maxlength="40">
				</TD>
				
				<TD>
					<B><FONT COLOR="#000000" SIZE=-1>Year of graduation&nbsp;</FONT></B>
				</TD>
				
				<TD>
					<INPUT TYPE="TEXT" NAME="FinalizacionEstudios" VALUE="" size="4" maxlength="4">
				</TD>
			</TR>
			
			<TR>
				<TD>
					<B><FONT COLOR="#000000" SIZE=-1>Where?&nbsp;</FONT></B>
				</TD>
				
				<TD>
					<INPUT TYPE="TEXT" NAME="LugarEstudios" size="25" maxlength="40">
				</TD>
			</TR>
		</TABLE>
		
		<br>
		<br>
		<p><br>
		<B><U><FONT FACE="Arial,Helvetica">Language</FONT></U></B>
		<p><br>
		<B><FONT COLOR="#000000" SIZE=-1>Mother Tongue&nbsp;</FONT></B><INPUT TYPE="TEXT" NAME="LenguaMaterna" size="10" maxlength="20">
		
		<TABLE>
			<TR>
				<TD>
					<CENTER>
						<B><FONT COLOR="#0000FF" SIZE=-1>Language</FONT></B>
					</CENTER>
				</TD>
				<TD>
					<CENTER>
						<B><FONT COLOR="#0000FF" SIZE=-1>Writing</FONT></B>
					</CENTER>
				</TD>
				
				<TD>
					<CENTER>
						<B><FONT COLOR="#0000FF" SIZE=-1>Reading</FONT></B>
					</CENTER>
				</TD>
				
				<TD>
					<CENTER>
						<B><FONT COLOR="#0000FF" SIZE=-1>Oral comprehension</FONT></B>
					</CENTER>
				</TD>
			</TR>
			
			<tr>
				<TD>
					<font size="-1" color="#000000"><b>French</b></font>
				</TD>
				
				<TD>
					<SELECT NAME="FrancesEscri">
						<OPTION SELECTED><OPTION>Null<OPTION>low<OPTION>Regular<OPTION>High<OPTION>Expert
					</SELECT>
				</TD>
				
				<TD>
					<SELECT NAME="FrancesLeido">
						<OPTION SELECTED><OPTION>Null<OPTION>low<OPTION>Regular<OPTION>High<OPTION>Expert
					</SELECT>
				</TD>
				
				<TD>
					<SELECT NAME="FrancesOral">
						<OPTION SELECTED><OPTION>Null<OPTION>low<OPTION>Regular<OPTION>High<OPTION>Expert
				</TD>
			</tr>
			
			<br>
			
			<tr>
			
				<TD>
					<font size="-1" color="#000000"><b>Inglés</b></font>
				</TD>
				
				<TD>
					<SELECT NAME="InglesEscri">
						<OPTION SELECTED><OPTION>Null<OPTION>low<OPTION>Regular<OPTION>High<OPTION>Expert
				</TD>
					
				<TD>
					<SELECT NAME="InglesLeido">
						<OPTION SELECTED><OPTION>Null<OPTION>low<OPTION>Regular<OPTION>High<OPTION>Expert
					</SELECT>
				</TD>
				
				<TD>
					<SELECT NAME="InglesComprOral">
						<OPTION SELECTED><OPTION>Null<OPTION>low<OPTION>Regular<OPTION>High<OPTION>Expert
					</SELECT>
				</TD>
			</tr>
			
		</table>
		<input  type="file" name="imagen" >
		<br>
		<p><br>
		<input  type="image" onclick="display_alert()" src="BolsaTrabajo/Estilos/boton.png">

			</form>		
	</body>

</html>	
</div>
