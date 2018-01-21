<?php

ini_set('display_errors', 'On');
require_once 'config/Config.php';

use controller\credentialsDatabase;
use controller\SqlQuery;
use controller\Constantes;
use twitter\TwitterAsuka;

$credenciales = new credentialsDatabase();

//recibe de ajax
$messageFromUser = filter_input(INPUT_POST, Constantes::MESSAGE);
$action = filter_input(INPUT_POST, Constantes::ACTION);

$messageToUser = NULL;



/* * *
 * 
 * Operaciones
 * 
 */

switch ($action) {

    case Constantes::UPDATE;
        $consumerBD = getTwitterApp($credenciales);
        $tokenDB = getTwitterTokenAsuka($credenciales);
        if ($consumerBD != null) {
            $twitterAsuka = new TwitterAsuka($consumerBD[SqlQuery::CONSUMER_KEY], $consumerBD[SqlQuery::CONSUMER_SECRET], $tokenDB[SqlQuery::OAUTH_TOKEN], $tokenDB[SqlQuery::OAUTH_TOKEN_SECRET]);
            $response = $twitterAsuka->postMessage($messageFromUser);
            if ($response != null) {
                cargarResposeSuccess($response);
                // var_dump($response);
            }
        }

        break;
    case Constantes::DELETE:


        break;


    default:


        break;
}

function cargarResposeSuccess($response) {
    if (isset($response->user)) {
        $user = $response->user;

        echo '<div class="card border-info mb-3" >
                <img class="card-img-top" src="' . $user->profile_banner_url . '" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">' . $user->name . ':<a href=\'https://twitter.com/' . $user->screen_name . '\' target="_blanck"> @' . $user->screen_name . '</a></h5>
                  <p class="card-text">' . $response->text . '</p>
                  <p class="card-text"><small class="text-muted">' . $response->created_at . '</small></p>
                </div>
              </div>';
    }
}

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
    if (isset($enlace) && $enlace != NULL && !$enlace->connect_errno) {
        $enlace->close();
    }
}

/**
 * Métodos
 *
 */
function getTwitterApp($credenciales) {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $resultado = NULL;
    $consumer = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $resultado = $conexion->query(SqlQuery::SELECT_ALL_TWITTER_APP);
        while ($fila = $resultado->fetch_assoc()) {
            $consumer = array(
                SqlQuery::CONSUMER_KEY => $fila[SqlQuery::CONSUMER_KEY],
                SqlQuery::CONSUMER_SECRET => $fila[SqlQuery::CONSUMER_SECRET]
            );
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
    return $consumer;
}

function getTwitterTokenAsuka($credenciales) {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $resultado = NULL;
    $token = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $resultado = $conexion->query(SqlQuery::SELECT_ALL_TWITTER_TOKEN_ASUKA);
        while ($fila = $resultado->fetch_assoc()) {
            $token = array(
                SqlQuery::OAUTH_TOKEN => $fila[SqlQuery::OAUTH_TOKEN],
                SqlQuery::OAUTH_TOKEN_SECRET => $fila[SqlQuery::OAUTH_TOKEN_SECRET],
                SqlQuery::USER_ID => $fila[SqlQuery::USER_ID],
                SqlQuery::SCREEN_NAME => $fila[SqlQuery::SCREEN_NAME],
                SqlQuery::X_AUTH_EXPIRES => $fila[SqlQuery::X_AUTH_EXPIRES]
            );
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
    return $token;
}
