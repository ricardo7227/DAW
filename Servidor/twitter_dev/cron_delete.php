<?php

ini_set('display_errors', 'On');
// pdo
echo insert();

/*
 * Métodos 
 */

/**
 * 
 * @param type $credenciales
 * @return type conexión con la base de datos
 */
function conexionDB() {
    $host = "discutivo.com";
    $user = "discu351_test";
    $password = "nohay2sin3";
    $database = "discu351_test";
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

 */
function insert() {
    $insertado = FALSE;
    $conexion = NULL;
    $resultado = NULL;
    try {
        $conexion = conexionDB();

        $resultado = $conexion->exec("INSERT INTO `CRON_DELETE_PAST` (`CRON_PAST_ID`, `CRON_IN`) VALUES (NULL, CURRENT_TIME());");

        if ($resultado > 0) {
            $insertado = TRUE;
        }
    } catch (Exception $e) {
        $e->getMessage();
    } finally {
        
        cerrarConexion($conexion);

        cerrarConexion($conexion);
    }
    return $insertado;
}

//fin insert


