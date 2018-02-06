<?php

ini_set('display_errors', 'On');
require_once 'config/Config.php';
include 'header.php';

use api\AsignaturasApi;
use model\Asignatura;
use utilidades\Constantes;
use utilidades\SqlQuery;

$listaAsignaturas = NULL;
$deletedAsignatura = 0; //controla el borrado con clave foranea

$id = filter_input(INPUT_GET, SqlQuery::ID);
$nombre = filter_input(INPUT_GET, SqlQuery::NOMBRE);
$curso = filter_input(INPUT_GET, SqlQuery::CURSO);
$ciclo = filter_input(INPUT_GET, SqlQuery::CICLO);
$action = filter_input(INPUT_GET, Constantes::ACTION);

$messageToUser = NULL;

/* * *
 * 
 * Operaciones
 * 
 */

$asignatura = new Asignatura($id, $nombre, $curso, $ciclo);

switch ($action) {
    case Constantes::INSERT:

        $asignatura = AsignaturasApi::getInstance()->insertAsignatura($asignatura);
        $messageToUser = ($asignatura != NULL) ?
                Constantes::messageQueryAsignaturaInserted : Constantes::messageQueryAsignaturaInsertFailed;


        break;
    case Constantes::UPDATE;
        $asignatura = AsignaturasApi::getInstance()->updateAsignatura($asignatura);
        $messageToUser = ($asignatura != NULL) ?
                Constantes::messageQueryAsignaturaUpdated : Constantes::messageQueryAsignaturaUpdateFailed;


        break;
    case Constantes::DELETE:
        $deletedAsignatura = -1;
        if ($id != null && strlen($id) > 0) {
            $deletedAsignatura = AsignaturasApi::getInstance()->deleteAsignatura($asignatura, FALSE);
        }
        if (is_int($deletedAsignatura) && $deletedAsignatura == Constantes::CodeConflict) {

            $messageToUser = Constantes::messageQueryAsignaturaDeletedFail;
        } else if (is_object($deletedAsignatura)) {

            $messageToUser = Constantes::messageQueryAsignaturaDeleted;
        }
        break;
    case Constantes::DELETE_FORCE:
        if ($id != null && strlen($id) > 0) {
            $borrado = AsignaturasApi::getInstance()->deleteAsignatura($asignatura, TRUE);
        }
        $messageToUser = (is_object($borrado)) ? Constantes::messageQueryAsignaturaDeleted : Constantes::messageQueryAlumnoDeletedFailedAgain;

        //1º -> BORRAR NOTA 
        //2º -> BORRAR Asignatura
        break;


    default:


        break;
}


$listaAsignaturas = AsignaturasApi::getInstance()->getAllAsignaturas();


include './asignaturasVista.php';
include './footer.php';


