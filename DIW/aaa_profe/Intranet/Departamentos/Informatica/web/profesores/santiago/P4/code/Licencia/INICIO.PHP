<?php
// inicio.php

include("header.php");

$oper = "";
if( isset( $_GET['oper'] ) ) {
	$oper = $_GET['oper'];
}


switch( $oper ) {

	case "validar":

	  // se eliminan las barras invertidas
	  $apellidos 	= stripslashes( $_POST['apellidos'] );
	  $nombre 	= stripslashes( $_POST['nombre'] );
	  $domicilio 	= stripslashes( $_POST['domicilio'] );
	  $teléfono 	= stripslashes( $_POST['teléfono'] );
	  $email 	= stripslashes( $_POST['email'] );
	  $clave1 	= stripslashes( $_POST['clave1'] );
	  $clave2 	= stripslashes( $_POST['clave2'] );
	  $texto 	= stripslashes( $_POST['texto'] );

	  // valida que los campos obligatorios no estén vacíos

	  if( isset( $_POST['apellidos'] ) && !empty( $_POST['apellidos'] ) &&
	          isset( $_POST['nombre'] ) && !empty( $_POST['nombre'] ) &&
	 	  isset( $_POST['email'] ) && !empty( $_POST['email'] ) &&
	 	  isset( $_POST['clave1'] ) && !empty( $_POST['clave1'] ) &&
	 	  isset( $_POST['clave2'] ) && !empty( $_POST['clave2'] ) )       {

          print("<br>Para solicitar la licencia de activación pulse el botón <b>Confirma datos</b>");
	  	  print("<br>Para corregir los datos pulse el botón Atrás del navegador <br><br>");
	  	  $fase = "registrar";
	  	  $pagref = "actualizar";
		  $submite = "Confirma datos";

	  }
	  else 	  {
          // si hay errores se muestra nuevamente la misma página
		print("<br><b>Faltan informar datos obligatorios (*)</b><br><br>");
		$fase = "validar";
		$pagref = "inicio";
		$submite = "Validar datos";

	   }

     break;



	default:

	// si entra por primera vez muestra el formulario vacío

	print("<br>Para solicitar la licencia de activación complete el formulario y luego pulse <b>Validar datos<br/><br/>");

	$apellidos = "";
	$nombre ="";
	$teléfono = "";
	$clave1 ="";
        $domicilio = "";
        $clave2 = "";
        $email = "";
        $texto = "";
        $fase = "validar";
        $pagref = "inicio";
        $submite = "Validar datos";


}

// se crea el formulario

print("<form action=\"$pagref.php?oper=$fase\" method=\"post\">");
print("<table>");
print("<tr><td valign=\"top\">Apellidos (*):</td><td><input type=\"text\" name=\"apellidos\" class=\"datos\" tabindex=\"1\" size\"5\" value = \"$apellidos\"></td></tr>\n");
print("<tr><td valign=\"top\">Nombre (*):</td><td><input type=\"text\" name=\"nombre\"   class=\"datos\" tabindex=\"2\" size\"5\" value = \"$nombre\"></td></tr>\n");
print("<tr><td valign=\"top\">Domicilio :</td><td><input type=\"text\" name=\"domicilio\"  class=\"datos\" tabindex=\"3\" size\"5\" value = \"$domicilio\"></td></tr>\n");
print("<tr><td valign=\"top\">Teléfono :</td><td><input type=\"text\" name=\"teléfono\" class=\"datos\" tabindex=\"4\" size\"5\" value = \"$teléfono\"></td></tr>\n");
print("<tr><td valign=\"top\">email (*):</td><td><input type=\"text\" name=\"email\" class=\"datos\" tabindex=\"5\" size\"5\" value = \"$email\" ></td></tr>\n");
print("<tr><td valign=\"top\">Clave 1(*):</td><td><input type=\"text\" name=\"clave1\" class=\"datos\" tabindex=\"6\" size\"8\" value = \"$clave1\" ></td></tr>\n");
print("<tr><td valign=\"top\">Clave 2(*):</td><td><input type=\"text\" name=\"clave2\" class=\"datos\" tabindex=\"7\" size\"4\" value = \"$clave2\"></td>\n");
print("<tr><td valign=\"top\">Observaciones :</td><td colspan =\"2\"><textarea name=\"texto\" rows=\"5\" cols=\"30\" class=\"datos\" tabindex=\"8\" >$texto</textarea></td></tr>\n");
print("<td><input type=\"submit\" value=\"$submite\" tabindex=\"9\"></td></tr>");
print("</table>");
print("</form>");

include("footer.php");
?>
