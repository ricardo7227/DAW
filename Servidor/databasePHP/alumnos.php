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

$listaAlumnos = NULL; //getAllAlumnos($credenciales);
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

switch ($action) {
    case Constantes::INSERT:
        $messageToUser = (insertAlumno($credenciales, $nombre, $fecha_nacimiento, $mayor_edad)) ?
                Constantes::messageQueryAlumnoInserted : Constantes::messageQueryAlumnoInsertedFail;


        break;
    case Constantes::UPDATE;

        $messageToUser = (updateAlumno($credenciales, $id, $nombre, $fecha_nacimiento, $mayor_edad)) ?
                Constantes::messageQueryAlumnoUpdated : Constantes::messageQueryAlumnoDeletedFail;


        break;
    case Constantes::DELETE:
        $deletedAlumno = -1;
        if ($id != null && strlen($id) > 0) {
            $deletedAlumno = deleteUserById($credenciales, $id);
        }
        if ($deletedAlumno == Constantes::CodeErrorClaveForanea) {

            $messageToUser = Constantes::messageQueryAlumnoDeletedFail;
        } else if ($deletedAlumno > 0 && $deletedAlumno < Constantes::CodeErrorClaveForanea) {

            $messageToUser = Constantes::messageQueryAlumnoDeleted;
        }
        break;
    case Constantes::DELETE_FORCE://pendiente probar
        if ($id != null && strlen($id) > 0) {
            $borrado = deleteAlumnoForceById($credenciales, $id);
        }
        $messageToUser = ($borrado) ? Constantes::messageQueryAlumnoDeleted : Constantes::messageQueryAlumnoDeletedFailedAgain;

        //1º -> BORRAR NOTA 
        //2º -> BORRAR ALUMNO
        break;


    default:


        break;
}


$listaAlumnos = getAllAlumnos($credenciales);


include 'index.php';


/*
 * Conexión base de datos
 */

function conexionDB($credenciales) {
    $host = $credenciales->getServername();
    $user = $credenciales->getUsername();
    $password = $credenciales->getPassword();
    $database = $credenciales->getDatabase();


    $conexion = new mysqli($host, $user, $password, $database);
    $conexion->set_charset("utf8"); //necesario de lo contrario falla con char especiales    
    if ($conexion->connect_errno) {
        exit();
    }

    return $conexion;
}

function cerrarConexion($enlace) {
    if (!$enlace->connect_errno) {
        $enlace->close();
    }
}

/**
 * Métodos
 *
 */

/**
 * 
 * @param type $credenciales
 * @return type lista de alumnos
 */
function getAllAlumnos($credenciales) {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $lista = NULL;
    $resultado = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $lista = array();
        $resultado = $conexion->query(SqlQuery::SELECT_ALL_ALUMNOS);
        while ($fila = $resultado->fetch_assoc()) {
            $alumno = array(
                SqlQuery::ID => $fila[SqlQuery::ID],
                SqlQuery::NOMBRE => $fila[SqlQuery::NOMBRE],
                SqlQuery::FECHA_NACIMIENTO => $fila[SqlQuery::FECHA_NACIMIENTO],
                SqlQuery::MAYOR_EDAD => $fila[SqlQuery::MAYOR_EDAD]
            );
            $lista[] = $alumno;
        }
    } catch (Exception $ex) {
        $ex->getMessage();
    } finally {
        try {
            if ($resultado != NULL) {
                $resultado->free();
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        cerrarConexion($conexion);
    }
    return $lista;
}

/**
 * 
 * @param type $credenciales
 * @param type $nombre
 * @param type $fecha_nacimiento
 * @param type $mayor_edad
 * @return boolean resultado inserción
 */
function insertAlumno($credenciales, $nombre, $fecha_nacimiento, $mayor_edad) {
    $insertado = FALSE;
    $conexion = NULL;
    $statement = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $statement = $conexion->prepare(SqlQuery::INSERT_ALUMNO);

        $fecha_nacimiento = date('Y-m-d', strtotime($fecha_nacimiento));

        $mayor_edad = (strcmp($mayor_edad, "on") == 0) ? TRUE : FALSE;

        $statement->bind_param('ssi', $nombre, $fecha_nacimiento, $mayor_edad);
        if ($statement->execute()) {
            $insertado = TRUE;
        }
    } catch (Exception $e) {
        $e->getMessage();
    } finally {
        try {
            if ($statement != null) {
                $statement->close();
            }
        } catch (Exception $e) {
            $e->getMessage();
        }


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
 * @param type $fecha_nacimiento
 * @param type $mayor_edad
 * @return boolean - resultado update
 */
function updateAlumno($credenciales, $id, $nombre, $fecha_nacimiento, $mayor_edad) {
    $updated = FALSE;
    $conexion = NULL;
    $statement = NULL;
    try {
        $conexion = conexionDB($credenciales);
        $fecha_nacimiento = date('Y-m-d', strtotime($fecha_nacimiento));

        $mayor_edad = (strcmp($mayor_edad, "on") == 0) ? TRUE : FALSE;

        $statement = $conexion->prepare(SqlQuery::UPDATE_ALUMNO);

        $statement->bind_param('ssii', $nombre, $fecha_nacimiento, $mayor_edad, $id);
        if ($statement->execute()) {
            $updated = TRUE;
        }
    } catch (Exception $e) {

        $e->getMessage();
    } finally {
        try {
            if ($statement != null) {
                $statement->close();
            }
        } catch (Exception $e) {
            $e->getMessage();
        }

        cerrarConexion($conexion);
    }
    return $updated;
}

/**
 * 
 * @param type $credenciales
 * @param type $id
 * @return type - filas borradas, en caso contrario un código de error
 */
function deleteUserById($credenciales, $id) {
    mysqli_report(MYSQLI_REPORT_ALL);//para las excepciones

    $filasErased = -1;
    $conexion = null;
    $statement = null;
    try {
        $conexion = conexionDB($credenciales);
        $statement = $conexion->prepare(SqlQuery::DELETE_ALUMNO);
        $statement->bind_param('i', $id);

        if ($statement->execute()) {
            $filasErased = $statement->affected_rows;
        }
    } catch (Exception $e) {

        if (preg_match('/' . Constantes::errorForeingkey . '/', $e->getMessage())) {
            $filasErased = Constantes::CodeErrorClaveForanea;
        }
    } finally {

        try {
            if ($statement != null) {
                $statement->close();
            }
        } catch (Exception $e) {
            $e->getMessage();
        }

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
function deleteAlumnoForceById($credenciales, $id) {//pendiente probar
    mysqli_report(MYSQLI_REPORT_ALL);
    $filasNota = -1;
    $filasAlumno = -1;
    $borrado = FALSE;
    $conexion = null;
    $statement = null;
    try {
        $conexion = conexionDB($credenciales);
        $conexion->autocommit(FALSE);

        $statement = $conexion->prepare(SqlQuery::DELETE_NOTA_ALUMNO);
        $statement->bind_param('i', $id);

        if ($statement->execute()) {
            $filasNota = $statement->affected_rows;
        }

        $statement = $conexion->prepare(SqlQuery::DELETE_ALUMNO);
        $statement->bind_param('i', $id);
        if ($statement->execute()) {
            $filasAlumno = $statement->affected_rows;
        }




        if ($filasNota > 0 && $filasAlumno > 0) {
            $borrado = TRUE;
            $conexion->commit();
        }
    } catch (Exception $ex) {
        $conexion->rollback();
    } finally {
        try {
            if ($statement != null) {
                $statement->close();
            }
        } catch (Exception $e) {
            $e->getMessage();
        }

        cerrarConexion($conexion);
    }
    return $borrado;
}

//fin delete force

