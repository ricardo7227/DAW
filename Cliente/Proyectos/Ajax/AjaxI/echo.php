<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'config/Config.php';

use controller\credentialsDatabase;
use controller\SqlQuery;

$nombre = filter_input(INPUT_POST, "nombre");


$credenciales = new credentialsDatabase();

$arrayResult = getAlumno($credenciales, $nombre);

if ($arrayResult != NULL) {
    echo "ID: " . $arrayResult[0] . " Nombre: " . $arrayResult[1] . " Fecha Nacimiento: " . $arrayResult[2];
}

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
    if (isset($enlace) && $enlace != NULL && !$enlace->connect_errno) {
        $enlace->close();
    }
}

function getAlumno($credenciales, $nombre) {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $arrayResult = null;
    $statement = NULL;
    try {
        $conexion = conexionDB($credenciales);


        $statement = $conexion->prepare(SqlQuery::SELECT_ALUMNO);
        $statement->bind_param("s", $nombre);

        $statement->execute();
        if ($resultado = $statement->get_result()) {

            $arrayResult = $resultado->fetch_row();
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    } finally {
        try {
            if ($statement != NULL) {
                $statement->close();
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        cerrarConexion($conexion);
    }
    return $arrayResult;
}
