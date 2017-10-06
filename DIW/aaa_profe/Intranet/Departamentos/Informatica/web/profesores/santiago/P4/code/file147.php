<?php
print "<BR><B><U> Gestor de errores personalizado (ejemplo file147.php) <BR></B></U>";
// usaremos todas las funciones de gestión de errores:
// error_reporting(), 
// set_error_handler(), 
// error_log(), 
// trigger_error()
// y restore_error_handler() 

// definir el nivel de informe de error
error_reporting(0);
 
// función de usuario para la gestion de errores  
function MiGestorErrores($num_error, $mens_error, $archivo_error,
                                  $linea_error, $contexto_error)
{
    // registra fecha y hora del error
    $fh = date("d-m-Y H:i:s (T)");
    // Genera una cadena xml con la descripción del error
    // esta cadena se utiliza en el mensaje de email y en el
    // registro de log, en mabos casos, cuando corresponda
    $err = "<logerror>\n";
    $err .= "\t<fechahora>" . $fh . "</fechahora>\n";
    $err .= "\t<error>" . $num_error . "</error>\n";
    $err .= "\t<mensaje>" . $mens_error . "</mensaje>\n";
    $err .= "\t<archivo>" . $archivo_error . "</archivo>\n";
    $err .= "\t<linea>" . $linea_error . "</linea>\n";
    $err .= "</logerror>\n\n";

	
    switch ($num_error) {
      	case E_USER_ERROR:
	// Error grave
	// se envía un email a soporte de la aplicación
	// Se guarda un registro en el log
	// se finaliza el script
	echo "<br><b>ERROR: </b> [$num_error] $mens_error<br>";
	echo "<b>Se cancela el programa </b><br>";
	mail("support@technoware.net", "Error grave en aplicación", $err);
	// mensaje enviado a archivo (tipo 3)
	error_log($err, 3, "errorphp.log");
        // se provoca el final del script
	exit;
	break;
    	case E_USER_WARNING:
        // Advertencia
	// Sólo se guarda un registro en el log
	// mensaje enviado a archivo (tipo 3)
	error_log($err, 3, "errorphp.log");
	echo "<br><b>Advertencia al usuario: </b> [$num_error] $mens_error<br>\n";
	break;
	case E_USER_NOTICE:
	// Aviso 
	echo "<br><B>Aviso al usuario: [$num_error] $mens_error</B><br>\n";
	break; 
	default:
	// El resto de los tipos de error
	// por esta opción vendrán los errores detectados por el sistema
	// siempre y cuando no sean FATAL, en tal caso,
                     
	// el error no llega a esta función 
	echo "<br>Tipo de error sin tratamiento de usuario: [$num_error] $mens_error<br>\n";
  	break;
    }
}

function calcular_pendiente($px, $py)
{
    if (!is_array($py) || !is_array($px)) {
	// este error es grave porque no podremos calcular
	trigger_error("Los dos parámetros deben ser de tipo matriz", E_USER_ERROR);
        return NULL;
    }
    if (count($px) != 2 || count($px) != 2) {
	// este error es grave porque no podremos calcular
        trigger_error("Debe haber 2 puntos x y 2 puntos y", E_USER_ERROR);
        return NULL;
    }
    for ($i=0; $i<count($px); $i++) {
	// este error se considera advertencia, ya que se asumirá un valor 0

 	if (!is_numeric($px[$i])) {
            trigger_error("Coordenada $i en el eje x 1 no es numérica: se asume 0", E_USER_WARNING);
            $px[$i] = 0;
        }
	if (!is_numeric($py[$i])) {
            trigger_error("Coordenada $i en el eje y 1 no es numérica: se asume 0", E_USER_WARNING);
            $py[$i] = 0;
        }
    }
    if ($px[0] == $px[1] ){
	// este es un aviso, que el resultado es infinito (pendiente 90 grados)
	trigger_error("La pendiente es infinito", E_USER_NOTICE);
	return "infinito";
    }
    // si se llega aquí se podrá calcular la pendiente 
    $pendiente = ($py[1] - $py[0]) / ($px[1] - $px[0]);
    return $pendiente;
}

//Establece un gestor de errores de usuario
$var = set_error_handler("MiGestorErrores");

// En $var queda el nombre de la rutina de gestión de errores
// si se usa la función restore_error_handler() se la puede restablecer 

// CASO 1
// CONECTION_FAILED es una constante indefinida
// se genera un aviso 
// pero es un error detectado por el sistema, no por el usuario
// error E_NOTICE (2) 
print "<BR><U><B> Caso 1 : uso de una constante no definida</B><BR></U>";
$conz = CONECTION_FAILED;

// CASO 2
// En este caso, el servidor MySQL detecta
// que se intenta una conexión con una contraseña
// errónea
// error E_WARNING (8)
print "<BR><U><B> Caso 2 : intento de abrir una conexión</B><BR></U>";
$con = mysql_connect("localhost","root","0022");

// CASO 3
// define puntos x e y de una recta
$puntosx = array('a', 4); // un valor alfabético, será una advertencia
$puntosy = array(1, 2); 

// llamar a una función para calcular 
// la pendiente de la recta
// Ahora comenzaremos con errores generados por nosotros
// mediante trigger_err()
print "<BR><U><B> Caso 3 : uso de trigger_error error U_USER_WARNING</B><BR></U>";
$pendiente = calcular_pendiente($puntosx, $puntosy);
print "<BR>Cálculo de la pendiente :  $pendiente <BR>";

// CASO 4
// define puntos x e y de una recta
$puntosx = array(5, 5); // dos valores iguales: pendiente infinita
$puntosy = array(1, 2); 

// llamar a una función para calcular 
// la pendiente de la recta
print "<BR><U><B> Caso 4 : uso de trigger_error error U_USER_NOTICE</B><BR></U>";
$pendiente = calcular_pendiente($puntosx, $puntosy);
print "<BR>Cálculo de la pendiente :  $pendiente <BR>";

// CASO 5
// define puntos x e y de una recta
// aquí provocamos un error serio
// no pasamos una matriz para x
$puntosx = 3; // no es una matriz, error grave
$puntosy = array(1, 2); 

// llamar a una función para calcular 
// la pendiente de la recta
print "<BR><U><B> Caso 5 : uso de trigger_error error U_USER_ERROR</B><BR></U>";
$pendiente = calcular_pendiente($puntosx, $puntosy);
// Esto no se ejecutará porque el error grave U_USER_ERROR 
// en la rutina de usuario se trata con mensaje al log,
// mensaje de email y fin de script
print "<BR>Cálculo de la pendiente :  $pendiente"; 
?> 