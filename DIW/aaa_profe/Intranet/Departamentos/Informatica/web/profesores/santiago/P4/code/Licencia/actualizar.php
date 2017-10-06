<?php
// actualizar.php

include("header.php");


// se eliminan las barras invertidas
$_POST['apellidos'] = stripslashes( $_POST['apellidos'] );
$_POST['nombre']    = stripslashes( $_POST['nombre'] );
$_POST['domicilio'] = stripslashes( $_POST['domicilio'] );
$_POST['telefono']  = stripslashes( $_POST['telefono'] );
$_POST['email']     = stripslashes( $_POST['email'] );
$_POST['clave1']    = stripslashes( $_POST['clave1'] );
$_POST['clave']     = stripslashes( $_POST['clave'] );
$_POST['texto']     = stripslashes( $_POST['texto'] );

// crea un objeto Licencia
$lic = new Licencia( $_POST['apellidos'],
 		 $_POST['nombre'],
		 $_POST['domicilio'],
 		 $_POST['teléfono'],
		 $_POST['email'],
		 $_POST['clave1'],
		 $_POST['clave2'],
		 $_POST['texto'] );

 if ( $lic->getAClaveActiva() <> "")  {
 	if ($lic->Leer() <> 0) 	{
 		print "Esa clave ya fue asignada. Contacte con el vendedor del software.";
 		exit;
 	}
 }

 if ( $lic->getAClaveActiva() <> "")  {

	$lic->insertar();
	$claveactiva = $lic->getAClaveActiva();

	print("Se añadió su pedido de licencia. <br>");

	$to = $_POST['email'];
	$subject = "Licencia de activación de InfoSoft";
	$body = "<html><head><title>Clave de activación de INFOSOFT. </title></head>";
	$body .= "<body>Su clave de activación es $claveactiva . <br><br>";
	$body .= "Cualquier problema envíe un email soporte@technoware.net</body></html>";
	$header = "MIME-Version: 1.0\n";
	$header .= "Content-type: text/html; charset=iso-8859-1\n";
	$header .= "From: Edgar DAndrea <soporte@technoware.net>\r\n";
	//mail($to, $subject, $body, $header);
    print ("Recibirá la clave de activación en su correo  $to");
 }
 else  {
	print "<br> No se pudo generar clave de activación.<br> Posible problema con el número de serie suministrado. <br> ";
	print "Si piensa que es un error, Póngase en contacto por teléfono (999 999 999)";
 }


include("footer.php");
?>
