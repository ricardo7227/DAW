<?php
if(isset($_GET['modulo']))
{
	if($_GET['modulo'] == "daw")
		{
			include('secciones/daw.inc');
		}
	elseif($_GET['modulo'] == "asir")
		{
			include('secciones/asir.inc');
		}
}
else
{
include('secciones/inicio.inc');
}
?>