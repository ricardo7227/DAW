<?php

ini_set('display_errors', 'On');
require_once 'config/Config.php';
include 'header.php';

//alumnos -> mysqli
//asignaturas -> pdo
//notas -> librería mysqlidb-composer


use api\AlumnosApi;
use api\AsignaturasApi;
use api\NotasApi;
use controller\credentialsDatabase;
use controller\SqlQuery;
use model\Nota;
use utilidades\Constantes;

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

                $notaDB =NotasApi::getInstance()->insertNota($nota);
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


/*
 * Métodos 
 */

/**
 * 
 * @param type $credenciales
 * @return MysqliDb
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
    $conexion->autoReconnect = false;

    return $conexion;
}

function cerrarConexion($conexion) {
    if (isset($conexion) && $conexion != NULL) {
        $conexion->disconnect();
    }
}

/**
 * 
 * @param type $credenciales
 * @return type - lista de alumnos 
 */
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

/**
 * 
 * @param type $credenciales
 * @return type - lista de asignaturas
 */
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

/**
 * 
 * @param type $credenciales
 * @param type $idAlumno
 * @param type $idAsignatura
 * @return type - nota del alumno
 */
function getNota($credenciales, $idAlumno, $idAsignatura) {
    $nota = null;
    $conexion = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $lista = array();
        $conexion->where(SqlQuery::ID_ALUMNO, $idAlumno);
        $conexion->where(SqlQuery::ID_ASIGNATURA, $idAsignatura);
        $resultado = $conexion->get(SqlQuery::NOTAS);
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

/**
 * 
 * @param type $credenciales
 * @param type $id_alumno
 * @param type $id_asignatura
 * @param type $nota
 * @return boolean - resultado update
 */
function updateNota($credenciales, $id_alumno, $id_asignatura, $nota) {
    $filas = -1;
    $updated = false;
    $conexion = NULL;

    try {
        $conexion = conexionDB($credenciales);

        $dataNotas = Array(
            SqlQuery::NOTA => $nota
        );
        $conexion->where(SqlQuery::ID_ALUMNO, $id_alumno);
        $conexion->where(SqlQuery::ID_ASIGNATURA, $id_asignatura);

        if ($conexion->update(SqlQuery::NOTAS, $dataNotas)) {

            $filas = $conexion->count;

            if ($filas > 0) {
                $updated = true;
            }
        }
    } catch (Exception $ex) {
        
    } finally {


        cerrarConexion($conexion);
    }

    return $updated;
}

/**
 * 
 * @param type $credenciales
 * @param type $id_alumno
 * @param type $id_asignatura
 * @param type $nota
 * @return boolean - resultado insert
 */
function insertNota($credenciales, $id_alumno, $id_asignatura, $nota) {
    $conexion = NULL;

    $insertado = false;
    try {

        $conexion = conexionDB($credenciales);
        //INSERT INTO NOTAS (ID_ALUMNO, ID_ASIGNATURA, NOTA) VALUES (?,?,?)";
        $data = Array(SqlQuery::ID_ALUMNO => $id_alumno,
            SqlQuery::ID_ASIGNATURA => $id_asignatura,
            SqlQuery::NOTA => $nota
        );
        $fila = $conexion->insert(SqlQuery::NOTAS, $data);
        if ($fila) {
            $insertado = TRUE;
        }
    } catch (Exception $e) {
        $e->getMessage();
    } finally {

        cerrarConexion($conexion);
    }
    return $insertado;
}

//fin insert
