<?php

ini_set('display_errors', 'On');
require_once 'config/Config.php';

//alumnos -> mysqli
//asignaturas -> pdo
//notas -> librería mysqlidb-composer

use controller\credentialsDatabase;
use controller\SqlQuery;
use controller\Constantes;

$credenciales = new credentialsDatabase();
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

switch ($action) {
    case Constantes::VIEW:

        if ($id_alumno != NULL && $id_asignatura != NULL &&
                strlen($id_alumno) > 0 && strlen($id_asignatura) > 0) {
            $notaDB = getNota($credenciales, $id_alumno, $id_asignatura);
        }
        if ($notaDB == null || strlen($notaDB[SqlQuery::NOTA]) == 0) {
            $notaDB = -1;
            $messageToUser = Constantes::messageQueryNotaMissing;
        }


        break;
    case Constantes::UPDATE://TO-DO pendiente terminar el update y los delete force
        //actualizar nota
        //1* consultar en notas
        //si -> update
        //no -> insert
        $resultado = FALSE;
        if (getNota(claves) != null) {
            //$resultado = updateNota(claves);
        } else {
            //resultado = serviciosNotas.insertNota(claves);
        }
        $messageToUser = (resultado) ? Constantes::messageQueryNotaUpdated : Constantes::messageQueryNotaUpdatedFail;

        break;

    default:


        break;
}

$listaAlumnos = getAllAlumnos($credenciales);
$listaAsignaturas = getAllAsignaturas($credenciales);


include 'index.php';


/*
 * Métodos 
 */

function conexionDB($credenciales) {
    $host = $credenciales->getServername();
    $user = $credenciales->getUsername();
    $password = $credenciales->getPassword();
    $database = $credenciales->getDatabase();

    $conexion = null;
    $conexion = new MysqliDb($host, $user, $password, $database);

    if (!$conexion->ping()) {
        exit();
    }
    return $conexion;
}

function cerrarConexion($conexion) {
    $conexion->disconnect();
}

function getAllAlumnos($credenciales) {

    $lista = NULL;
    $resultado = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $lista = array();
        $resultado = $conexion->get(SqlQuery::ALUMNOS);
        foreach ($resultado as $alumno) {
            $alumno = array(
                SqlQuery::ID => $alumno[SqlQuery::ID],
                SqlQuery::NOMBRE => $alumno[SqlQuery::NOMBRE],
                SqlQuery::FECHA_NACIMIENTO => $alumno[SqlQuery::FECHA_NACIMIENTO],
                SqlQuery::MAYOR_EDAD => $alumno[SqlQuery::MAYOR_EDAD]
            );
            $lista[] = $alumno;
        }
    } catch (Exception $ex) {
        $ex->getMessage();
    } finally {
        cerrarConexion($conexion);
    }
    return $lista;
}

function getAllAsignaturas($credenciales) {

    $conexion = NULL;
    $lista = NULL;
    $resultado = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $lista = array();

        foreach ($conexion->get(SqlQuery::ASIGNATURAS) as $fila) {
            $asignatura = array(
                SqlQuery::ID => $fila[strtolower(SqlQuery::ID)],
                SqlQuery::NOMBRE => $fila[SqlQuery::NOMBRE],
                SqlQuery::CURSO => $fila[SqlQuery::CURSO],
                SqlQuery::CICLO => $fila[SqlQuery::CICLO]
            );
            $lista[] = $asignatura;
        }
    } catch (Exception $ex) {
        $ex->getMessage();
    } finally {

        cerrarConexion($conexion);
    }
    return $lista;
}

function getNota($credenciales, $idAlumno, $idAsignatura) {
    $nota = null;
    $conexion = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $lista = array();
        $conexion->where(\controller\SqlQuery::ID_ALUMNO, $idAlumno);
        $conexion->where(\controller\SqlQuery::ID_ASIGNATURA, $idAsignatura);
        $resultado = $conexion->get(\controller\SqlQuery::NOTAS);
        if ($conexion->count > 0) {
            $nota = array(
                SqlQuery::ID_ALUMNO => $resultado[0][SqlQuery::ID_ALUMNO],
                SqlQuery::ID_ASIGNATURA => $resultado[0][SqlQuery::ID_ASIGNATURA],
                SqlQuery::NOTA => $resultado[0][SqlQuery::NOTA]
            );
        }
    } catch (Exception $e) {
        $e->getMessage();
    } finally {

        cerrarConexion($conexion);
    }
    return $nota;
}



