<HTML>
<HEAD>
    <TITLE>Definici�n de matrices</TITLE>
</HEAD>
<BODY>	
    <CENTER><H3>Uso del constructor array() (ejemplo file037.php)</H3> 
	<?php
        // se asigna el �ndice 1 para Alemania
        // Austria recibe autom�ticamente el valor 2
        // se asigna 5 para B�lgica
	$Estad = array(1=>"Alemania", "Austria",5=> "B�lgica");
        echo "cantidad de elementos de la matriz : " . count($Estad) . "<BR>";
	?> 
    <TABLE BORDER="1" CELLPADDING="1" CELLSPACING="2">
	<TR ALIGN="center" >
            <TD>Elemento</TD>
            <?php
		for ($ind=0;$ind<count($Estad);$ind++)
			echo"<TD>$ind</TD>";
            ?>
	</TR>
	<TR ALIGN="center" >
            <TD>Valor</TD>
            <?php
		for ($ind=0;$ind<count($Estad);$ind++)
			echo "<TD> $Estad[$ind] </TD>";
            ?>		 
	</TR>
    </TABLE>
</BODY>
</HTML>