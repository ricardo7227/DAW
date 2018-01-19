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

getAlumno($credenciales, $nombre);

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

    $lista = NULL;
    $statement = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $lista = array();
        $statement = $conexion->prepare(SqlQuery::SELECT_ALUMNO);        
        $statement->bind_param("s", $nombre);                
        $statement->execute();
        //var_dump($statement->);
//        while ($fila = $statement->fetch_assoc()) {
//            $alumno = array(
//                SqlQuery::ID => $fila[SqlQuery::ID],
//                SqlQuery::NOMBRE => $fila[SqlQuery::NOMBRE],
//                SqlQuery::FECHA_NACIMIENTO => $fila[SqlQuery::FECHA_NACIMIENTO],
//                SqlQuery::MAYOR_EDAD => $fila[SqlQuery::MAYOR_EDAD]
//            );
//            $lista[] = $alumno;
//        }
    } catch (Exception $ex) {
        $ex->getMessage();
    } finally {
        try {
            if ($statement != NULL) {
               // $statement->free();
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        cerrarConexion($conexion);
    }
    return $lista;
}
