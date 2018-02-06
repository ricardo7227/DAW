<?php

ini_set('display_errors', 'On');
require_once 'config/Config.php';
include 'header.php';

use api\AlumnosApi;
use api\AsignaturasApi;
use api\NotasApi;
use model\Nota;
use utilidades\Constantes;
use utilidades\SqlQuery;

$notasView = TRUE;
$listaAlumnos = NULL;
$listaAsignaturas = NULL;
$notaDB = null;

$id_alumno = filter_input(INPUT_GET, SqlQuery::ID_ALUMNO);
$id_asignatura = filter_input(INPUT_GET, SqlQuery::ID_ASIGNATURA);
$nota = filter_input(INPUT_GET, SqlQuery::NOTA);

$action = filter_input(INPUT_GET, Constantes::ACTION);

$messageToUser = NULL;

/* * *
 * 
 * Operaciones
 * 
 */
$nota = new Nota($id_alumno, $id_asignatura, $nota);
switch ($action) {
    case Constantes::VIEW:

        if ($id_alumno != NULL && $id_asignatura != NULL &&
                strlen($id_alumno) > 0 && strlen($id_asignatura) > 0) {

            $notaDB = NotasApi::getInstance()->getNota($nota);
        }
        if (is_int($notaDB) && $notaDB == Constantes::CodeNotFound) {

            $messageToUser = Constantes::messageQueryNotaMissing;
        }


        break;
    case Constantes::UPDATE:
        //actualizar nota
        //1* consultar en notas
        //si -> update
        //no -> insert
        //$resultado = FALSE;
        if (is_object($nota)) {
            $notaDB = NotasApi::getInstance()->getNota($nota);
            if ((is_int($notaDB) && $notaDB != Constantes::CodeNotFound) || is_object($notaDB)) {

                $notaDB = NotasApi::getInstance()->updateNota($nota);
            } else {

                $notaDB = NotasApi::getInstance()->insertNota($nota);
            }

            $messageToUser = (is_object($notaDB)) ? Constantes::messageQueryNotaUpdated : Constantes::messageQueryNotaUpdatedFail;
        }
        break;

    default:


        break;
}

$listaAlumnos = AlumnosApi::getInstance()->getAllAlumnos();
$listaAsignaturas = AsignaturasApi::getInstance()->getAllAsignaturas();


include './notasVista.php';
include './footer.php';



