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
 		 $_POST['tel�fono'],
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

	print("Se a�adi� su pedido de licencia. <br>");

	$to = $_POST['email'];
	$subject = "Licencia de activaci�n de InfoSoft";
	$body = "<html><head><title>Clave de activaci�n de INFOSOFT. </title></head>";
	$body .= "<body>Su clave de activaci�n es $claveactiva . <br><br>";
	$body .= "Cualquier problema env�e un email soporte@technoware.net</body></html>";
	$header = "MIME-Version: 1.0\n";
	$header .= "Content-type: text/html; charset=iso-8859-1\n";
	$header .= "From: Edgar DAndrea <soporte@technoware.net>\r\n";
	//mail($to, $subject, $body, $header);
    print ("Recibir� la clave de activaci�n en su correo  $to");
 }
 else  {
	print "<br> No se pudo generar clave de activaci�n.<br> Posible problema con el n�mero de serie suministrado. <br> ";
	print "Si piensa que es un error, P�ngase en contacto por tel�fono (999 999 999)";
 }


include("footer.php");
?>
