<HTML>
<HEAD>
    <TITLE>Definición de matrices</TITLE>
</HEAD>
<BODY>	
    <CENTER><H3>Uso del constructor array() (ejemplo file037.php)</H3> 
	<?php
        // se asigna el índice 1 para Alemania
        // Austria recibe automáticamente el valor 2
        // se asigna 5 para Bélgica
	$Estad = array(1=>"Alemania", "Austria",5=> "Bélgica");
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