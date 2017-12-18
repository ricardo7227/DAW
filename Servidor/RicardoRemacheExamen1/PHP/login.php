<?php
ini_set('display_errors', 'On');
require_once 'config/Config.php';

use database\SqlQuery;
use constantes\Constantes;
use database\credentialsDatabase;
$credenciales = new credentialsDatabase();

//formulario
$nombre = filter_input(INPUT_GET, Constantes::NOMBRE);
$password = filter_input(INPUT_GET, Constantes::PASSWORD);
$action = filter_input(INPUT_GET, Constantes::ACTION);


//vista
echo '<form action="login.php" >                    
                    Nombre:
                    <input type="text" name="NOMBRE" id="nombre" ><br>
                    Password:
                    <input type="password" name="PASSWORD" id="password" placeholder="contraseña"><br>
                    <br>
                    <input type="submit" name="ACTION" value="LOGIN">
                    </form>';


if (Constantes::LOGIN == $action){
    $fecha = getdate();
    insertLogin($credenciales, $nombre, $password,$fecha);
}

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

        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//para las excepciones
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
 * @param type $nombre
 * @param type $fecha
 * @param type $password
 * @return boolean resultado inserción
 */
function insertLogin1($credenciales, $nombre, $fecha, $password) {
    $insertado = FALSE;
    $conexion = NULL;
    $statement = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $statement = $conexion->prepare(SqlQuery::INSERT_LOGIN_PHP);

        //$fecha = date('Y-m-d', strtotime($fecha));
       
        $statement->bind_param('ssd', $nombre,$password,$fecha);
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
 * @param type $nombre
 * @param type $password
 * @param type $fecha
 * @return boolean - resultado insert
 */
function insertLogin($credenciales, $nombre, $password, $fecha) {
    $insertado = FALSE;
    $conexion = NULL;
    $statement = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $statement = $conexion->prepare(SqlQuery::INSERT_LOGIN_PHP);


        $statement->bindParam(1, $nombre);
        $statement->bindParam(2, $password);
        $statement->bindParam(3, $fecha);
        if ($statement->execute()) {
            $insertado = TRUE;
        }
    } catch (Exception $e) {
        $e->getMessage();
    } finally {
        $statement = null;
        cerrarConexion($conexion);

        
    }
    return $insertado;
}
function selectNombre($credenciales) {


    $lista = NULL;
    $resultado = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $lista = array();

        foreach ($conexion->query(SqlQuery::SELECT_NOMBRE_PHP) as $fila) {
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