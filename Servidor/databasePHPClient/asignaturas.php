<?php

ini_set('display_errors', 'On');
require_once 'config/Config.php';
include 'header.php';

//alumnos -> mysqli
//asignaturas -> pdo
//notas -> librería mysqlidb-composer

use controller\credentialsDatabase;
use controller\SqlQuery;
use model\Asignatura;
use utilidades\Constantes;
use api\AsignaturasApi;

$credenciales = new credentialsDatabase();

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


/*
 * Métodos 
 */

/**
 * 
 * @param type $credenciales
 * @return type conexión con la base de datos
 */
function conexionDB($credenciales) {
    $host = $credenciales->getServername();
    $user = $credenciales->getUsername();
    $password = $credenciales->getPassword();
    $database = $credenciales->getDatabase();

    $conexion = null;

    try {
        $conexion = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);

        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //para las excepciones
    } catch (PDOException $e) {
        $e->getMessage();
        $conexion = null;
    }

    return $conexion;
}

function cerrarConexion($conexion) {
    $conexion = NULL;
}

/**
 * 
 * @param type $credenciales
 * @return type - lista de asignaturas
 */
function getAllAsignaturas($credenciales) {


    $lista = NULL;
    $resultado = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $lista = array();

        foreach ($conexion->query(SqlQuery::SELECT_ALL_ASIGNATURAS) as $fila) {
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
 * @param type $nombre
 * @param type $curso
 * @param type $ciclo
 * @return boolean - resultado insert
 */
function insertAsignatura($credenciales, $nombre, $curso, $ciclo) {
    $insertado = FALSE;
    $conexion = NULL;
    $statement = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $statement = $conexion->prepare(SqlQuery::INSERT_ASIGNATURA);


        $statement->bindParam(1, $nombre);
        $statement->bindParam(2, $curso);
        $statement->bindParam(3, $ciclo);
        if ($statement->execute()) {
            $insertado = TRUE;
        }
    } catch (Exception $e) {
        $e->getMessage();
    } finally {
        $statement = null;
        cerrarConexion($conexion);

        cerrarConexion($conexion);
    }
    return $insertado;
}

//fin insert

/**
 * 
 * @param type $credenciales
 * @param type $id
 * @param type $nombre
 * @param type $curso
 * @param type $ciclo
 * @return boolean - resultado update
 */
function updateAsignatura($credenciales, $id, $nombre, $curso, $ciclo) {
    $updated = FALSE;
    $conexion = NULL;
    $statement = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $statement = $conexion->prepare(SqlQuery::UPDATE_ASIGNATURA);

        $statement->bindParam(1, $nombre);
        $statement->bindParam(2, $curso);
        $statement->bindParam(3, $ciclo);
        $statement->bindParam(4, $id);

        if ($statement->execute()) {
            $updated = TRUE;
        }
    } catch (Exception $e) {

        $e->getMessage();
    } finally {

        $statement = NULL;

        cerrarConexion($conexion);
    }
    return $updated;
}

/**
 * 
 * @param type $credenciales
 * @param type $id
 * @return type - filas o código de error en el borrado
 */
function deleteAsignaturaById($credenciales, $id) {

    $filasErased = -1;
    $conexion = null;
    $statement = null;
    try {
        $conexion = conexionDB($credenciales);
        $statement = $conexion->prepare(SqlQuery::DELETE_ASIGNATURA);
        $statement->bindParam(1, $id);

        if ($statement->execute()) {
            $filasErased = $statement->rowCount();
        }
    } catch (Exception $e) {

        if (preg_match('/' . Constantes::errorForeingkey . '/', $e->getMessage())) {
            $filasErased = Constantes::CodeErrorClaveForanea;
        }
    } finally {

        $statement = null;

        cerrarConexion($conexion);
    }
    return $filasErased;
}

//fin delete

/**
 * 
 * @param type $credenciales
 * @param type $id
 * @return boolean - resultado delete
 */
function deleteAsignaturaForceById($credenciales, $id) {
    $filasNota = -1;
    $filasAlumno = -1;
    $borrado = FALSE;
    $conexion = null;
    $statement = null;
    try {
        $conexion = conexionDB($credenciales);
        $conexion->beginTransaction();

        $statement = $conexion->prepare(SqlQuery::DELETE_NOTA_ASIGNATURA);
        $statement->bindParam(1, $id);

        if ($statement->execute()) {
            $filasNota = $statement->rowCount();
        }

        $statement = $conexion->prepare(SqlQuery::DELETE_ASIGNATURA);
        $statement->bindParam(1, $id);
        if ($statement->execute()) {
            $filasAlumno = $statement->rowCount();
        }


        if ($filasNota > 0 && $filasAlumno > 0) {
            $borrado = TRUE;
            $conexion->commit();
        }
    } catch (Exception $ex) {
        $ex->getMessage();
        $conexion->rollback();
    } finally {

        $statement = NULL;

        cerrarConexion($conexion);
    }
    return $borrado;
}

//fin delete force

