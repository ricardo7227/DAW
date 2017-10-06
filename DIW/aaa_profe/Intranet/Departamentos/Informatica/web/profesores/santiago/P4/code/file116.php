<HTML>
    <HEAD>
	<TITLE>Formulario HTML (file116.php)</TITLE>	
    </HEAD>
    <BODY>
    <CENTER>
	<H2>Uso de formularios con método POST</H2>
	<?php
	// Si la superglobal no existe es porque es la petición
	// por lo que se muestra el formulario para que el
	// usuario introduzca la información
	if (!$_POST){
	?>
	<FORM  method='POST' action='file116.php'>
	<TABLE>
            <TR>
		<TD ALIGN='LEFT'>Usuario:</TD>
		<TD ALIGN='LEFT'>
                    <INPUT type='text' name='usuario' size=20>
		</TD>
            </TR>
            <TR>
		<TD ALIGN='LEFT'>Contraseña:</TD>
		<TD ALIGN='LEFT'>
                    <INPUT type='password' name='psword' size=20>
		</TD>
            </TR>
            <TR>
		<TD ALIGN='LEFT'>Aplicación:</TD>
		<TD ALIGN='LEFT'>
                    <SELECT name='aplicación'>
			<OPTION value='Administración Web'>Administración Web</OPTION>
			<OPTION value='Usuario'>Usuario Web</OPTION>
		</TD>
            </TR>
	</TABLE>	
            <INPUT type='submit' value='Enviar'>
	</FORM>	
	<?php
	}
	// En caso contrario, se procesa la respuesta 
        // al cliente
	else {
	//Proceso de la respuesta
	    print "<B>Contenido de la superglobal \$_POST</B><BR>";
            print_r ($_POST);
	}
	?>	
	</CENTER>
    </BODY>
</HTML>