<?php
session_start(); 

//Compruebalogin
define ('Cintentos',5);

// Llevar a $lineas las lineas del fichero de configuracion
$lineas = file("Configuraciones/sitio.conf");

// Quita espacios y puntos y coma del principio y final de linea
for ($ind=0;$ind < count($lineas);$ind++) {
  $lineas[$ind] = trim($lineas[$ind]);
  $lineas[$ind] = trim($lineas[$ind], " ;");
};

// Quita lineas de comentarios
$lineas_buenas = array();
for ($ind=0;$ind < count($lineas);$ind++) {
  if (substr($lineas[$ind], 0, 1) != "#") {
    $lineas_buenas[] = $lineas[$ind];
//    array_push($lineas_buenas, $lineas[$ind]);
  };
};

// Separa variables de valores
$tabla_variables = array();
for ($ind=0;$ind < count($lineas_buenas);$ind++) {
  array_push($tabla_variables, explode("=", $lineas_buenas[$ind]));
};
for ($ind=0;$ind < count($tabla_variables);$ind++) {
  $tabla_variables[$ind][0] = trim($tabla_variables[$ind][0]);
  $tabla_variables[$ind][1] = trim($tabla_variables[$ind][1]);
};

/* Crea variables con valores
   servidor		Servidor MySQL.
   usuario		Usuario MySQL.
   contrasenia		Contraseña MySQL.
   usuario_admin	Usuario que puede leer y escribir en la BBDD.
   contrasenia_admin	Contraseña
   nombrebd		Nombre de Base de datos MySQL.
   dirabsoluto		Directorio absoluto de la Web.
   dirrelativo		Directorio relativo de la Web.
   dirftpabsoluto	Directorio absoluto del FTP.
   dirftprelativo	Directorio relativo del FTP
*/
for ($ind=0;$ind < count($tabla_variables);$ind++) {
  ${$tabla_variables[$ind][0]} = $tabla_variables[$ind][1];
};

// ---------------------------- OPCION 1 -----------------------------------------------
// Control por denegacion de IPs en fichero Configuraciones/denegados.txt
// Proximamente (si se activa hay que desactivar la opcion contraria
// que se programa a continuacion)

/*
$usuario_aux = $usuario;
$contrasenia_aux = $contrasenia;
$usuario     = $usuario_admin;
$contrasenia = $contrasenia_admin;

// Llevar a $equipos las lineas del fichero de Configuraciones/permitidos.txt
$equipos = file("Configuraciones/denegados.txt");

// Quita espacios y puntos y coma del principio y final de linea
for ($ind=0;$ind < count($equipos);$ind++) {
  $equipos[$ind] = trim($equipos[$ind]);
  $equipos[$ind] = trim($equipos[$ind], " ;");
};

// Quita lineas de comentarios
$equipos_buenos = array();
for ($ind=0;$ind < count($equipos);$ind++) {
  if (substr($equipos[$ind], 0, 2) != "##") {
    $equipos_buenos[] = $equipos[$ind];
//    array_push($lineas_buenas, $lineas[$ind]);
  };
};

// Comprueba si el equipo desde el que se accede empieza por
// un valor de los contenidos en el fichero

for ($ind=0;$ind < count($equipos_buenos);$ind++) {
  if (substr($_SERVER['REMOTE_ADDR'], 0, strlen($equipos_buenos[$ind])) == $equipos_buenos[$ind]) {
    $usuario = $usuario_aux;
    $contrasenia = $contrasenia_aux;
    break;
  };
};
*/

// ---------------------------- OPCION 2 (POR DEFECTO ----------------------------------
// Control por IPs permitidas en fichero Configuraciones/permitidos.txt

// Llevar a $equipos las lineas del fichero de Configuraciones/permitidos.txt
$equipos = file("Configuraciones/permitidos.txt");

// Quita espacios y puntos y coma del principio y final de linea
for ($ind=0;$ind < count($equipos);$ind++) {
  $equipos[$ind] = trim($equipos[$ind]);
  $equipos[$ind] = trim($equipos[$ind], " ;");
};

// Quita lineas de comentarios
$equipos_buenos = array();
for ($ind=0;$ind < count($equipos);$ind++) {
  if (substr($equipos[$ind], 0, 1) != "#") {
    $equipos_buenos[] = $equipos[$ind];
//    array_push($lineas_buenas, $lineas[$ind]);
  };
};

// Comprueba si el equipo desde el que se accede empieza por
// un valor de los contenidos en el fichero

for ($ind=0;$ind < count($equipos_buenos);$ind++) {
  if (substr($_SERVER['REMOTE_ADDR'], 0, strlen($equipos_buenos[$ind])) == $equipos_buenos[$ind]) {
    $usuario = $usuario_admin;
    $contrasenia = $contrasenia_admin;
    break;
  };
};
// ------------------------------- FIN OPCIONES ---------------------------------
//Conexión a la BBDD
$conexion=mysql_connect($servidor,$usuario,$contrasenia) or die(mysql_error());
mysql_select_db($nombrebd) or die(mysql_error());

?>
