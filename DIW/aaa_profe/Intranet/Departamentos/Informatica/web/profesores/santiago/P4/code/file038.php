<HTML>
<HEAD>
    <TITLE>Definición de matrices</TITLE>
</HEAD>
<BODY>	
	<CENTER><H3>Uso del constructor array() (ejemplo file038.php)</H3> 
	<?php 
            $Estad = array(1=>"Alemania", "Austria",5=> "Bélgica");
        ?> 
	<TABLE BORDER="1" CELLPADDING="1" CELLSPACING="2">
            <TR ALIGN="center" >
		<TD>Elemento</TD>
		<?php
                // foreach nos asegura el recorrido
                // completo por toda la matriz
        	foreach ($Estad as $clave => $valor)
                	echo"<TD>$clave</TD>";
		?>
            </TR>
            <TR ALIGN="center" >
		<TD>Valor</TD>
		<?php
		foreach ($Estad as $clave => $valor)
			echo "<TD> $valor </TD>";
		?>		 
            </TR>
	</TABLE>
</BODY>
</HTML>