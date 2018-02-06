<?php

ini_set('display_errors', 'On');
require_once 'config/Config.php';
include 'header.php';

use api\AlumnosApi;
use model\Alumno;
use utilidades\Constantes;
use utilidades\SqlQuery;

$listaAlumnos = NULL;
$deletedAlumno = 0; //controla el borrado con clave foranea
//recibe del formulario
$id = filter_input(INPUT_GET, SqlQuery::ID);
$nombre = filter_input(INPUT_GET, SqlQuery::NOMBRE);
$fecha_nacimiento = filter_input(INPUT_GET, SqlQuery::FECHA_NACIMIENTO);
$mayor_edad = filter_input(INPUT_GET, SqlQuery::MAYOR_EDAD);
$action = filter_input(INPUT_GET, Constantes::ACTION);

$messageToUser = NULL;

/* * *
 * 
 * Operaciones
 * 
 */
$alumno = new Alumno($id, $nombre, $fecha_nacimiento, ($mayor_edad == "on") ? 1 : 0);

switch ($action) {
    case Constantes::INSERT:


        $alumno = AlumnosApi::getInstance()->insertAlumno($alumno);

        $messageToUser = ($alumno != null) ?
                Constantes::messageQueryAlumnoInserted : Constantes::messageQueryAlumnoInsertedFail;


        break;
    case Constantes::UPDATE;
        $alumno = AlumnosApi::getInstance()->updateAlumno($alumno);

        $messageToUser = ($alumno != null) ?
                Constantes::messageQueryAlumnoUpdated : Constantes::messageQueryAlumnoDeletedFail;


        break;
    case Constantes::DELETE:

        $deletedAlumno = -1;
        if ($id != null && strlen($id) > 0) {

            $deletedAlumno = AlumnosApi::getInstance()->deleteAlumno($alumno, FALSE);
        }
        if (is_int($deletedAlumno) && $deletedAlumno == Constantes::CodeConflict) {

            $messageToUser = Constantes::messageQueryAlumnoDeletedFail;
        } else if (is_object($deletedAlumno)) {

            $messageToUser = Constantes::messageQueryAlumnoDeleted;
        }
        break;
    case Constantes::DELETE_FORCE:
        if ($id != null && strlen($id) > 0) {
            $borrado = AlumnosApi::getInstance()->deleteAlumno($alumno, TRUE);
        }
        $messageToUser = (is_object($borrado)) ? Constantes::messageQueryAlumnoDeleted : Constantes::messageQueryAlumnoDeletedFailedAgain;

        //1º -> BORRAR NOTA 
        //2º -> BORRAR ALUMNO
        break;


    default:


        break;
}


$listaAlumnos = AlumnosApi::getInstance()->getAllAlumnos();


include './alumnosVista.php';
include './footer.php';

