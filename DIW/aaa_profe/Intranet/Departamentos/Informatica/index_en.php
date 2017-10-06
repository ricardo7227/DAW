<?php
if(isset($_GET['modulo']))
{
	if($_GET['modulo'] == "daw")
		{
			include('secciones/daw_en.inc');
		}
	elseif($_GET['modulo'] == "asir")
		{
			include('secciones/asir_en.inc');
		}
}
else
{
include('secciones/inicio_en.inc');
}
?>