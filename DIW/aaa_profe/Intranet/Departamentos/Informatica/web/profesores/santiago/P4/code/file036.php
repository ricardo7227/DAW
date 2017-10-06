<HTML>
<HEAD>
    <TITLE>Definición de matrices</TITLE>
</HEAD>
<BODY>	
    <CENTER><H3>Uso del constructor array()(ejemplo file036.php)</H3> 
        <?php 
            $Estad=array("Alemania","Austria","Bélgica");
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