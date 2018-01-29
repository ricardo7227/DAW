<?php

ini_set('display_errors', 'On');
require_once 'config/Config.php';

use controller\credentialsDatabase;
use controller\SqlQuery;
use controller\Constantes;
use twitter\TwitterAsuka;
use Vectorface\Whip\Whip;
use mensajes\Mensaje;

$credenciales = new credentialsDatabase();

//recibe de ajax
$messageFromUser = filter_input(INPUT_POST, Constantes::MESSAGE);
$action = filter_input(INPUT_POST, Constantes::ACTION);

$messageToUser = NULL;
$tipo = Constantes::INFO;


/* * *
 * 
 * Operaciones
 * 
 */

switch ($action) {

    case Constantes::UPDATE;
        $statusTwitter = isEnableTwitter($credenciales);
        if (checkVar($statusTwitter) && $statusTwitter[SqlQuery::DISPONIBLE] == TRUE) {

            if ($statusTwitter[SqlQuery::RATIO_DISPONIBLE] == TRUE) {
                $ip_user = getIpClient();
                $agente = getNavegador();
                $statusUser = getUserStatus($credenciales, $ip_user);

                if (checkVar($statusUser) && $statusUser[0] == TRUE) {
                    enviarTweet($credenciales, $messageFromUser);
                    insertAccessClient($credenciales, $ip_user, $agente);
                } elseif (checkVar($statusUser) && $statusUser[0] == FALSE) {
                    $tipo = Constantes::WARNING;
                    $messageToUser = sprintf(Mensaje::LIMIT_TWEETS_USER,$statusUser[1]);
                } else {
                    enviarTweet($credenciales, $messageFromUser);
                    insertAccessClient($credenciales, $ip_user, $agente);
                }
            } else {
                $tipo = Constantes::WARNING;
                $messageToUser = Mensaje::LIMIT_RATIO_HORA;
            }
        } else {
            $tipo = Constantes::WARNING;
            $messageToUser = Mensaje::LIMIT_TWEETS_DAY;
        }

        if ($messageToUser != null){
            mensajeToUser($messageToUser, $tipo);
        }


        break;
    case Constantes::DELETE:


        break;


    default:


        break;
}

function enviarTweet($credenciales, $messageFromUser) {
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
}

function mensajeToUser($messageToUser, $tipo) {
    echo '<div class="alert alert-'.$tipo.'" role="alert">
            '.$messageToUser.'
            </div>';
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

function getNavegador() {
    $browser = new Browser();
    return $browser->getUserAgent() . "| movil: " . $browser->isMobile();
}

function getIpClient() {
    $whip = new Whip();
    return $whip->getValidIpAddress();
}

function getAndCheckIpAgent($ip_client, $agente) {

    return $ip_client != false && strlen($ip_client) > 6 && $agente != null;
}

function checkVar($variable) {
    return $variable != null && !empty($variable);
}

function insertAccessClient($credenciales, $ip_client, $agente) {
    $insertado = FALSE;
    $conexion = NULL;
    $statement = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $statement = $conexion->prepare(SqlQuery::INSERT_INTO_USER_ACCESS);

        $statement->bind_param('ss', $ip_client, $agente);
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

/**
 * 
 * @param type $credenciales
 * @return array (ratio y limite alcanzado diario
 */
function isEnableTwitter($credenciales) {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $isEnable = NULL;
    $resultado = NULL;
    try {
        $conexion = conexionDB($credenciales);

        $isEnable = array();
        $resultado = $conexion->query(SqlQuery::SELECT_RATIO_AND_LIMIT_DAY);
        while ($fila = $resultado->fetch_assoc()) {
            $isEnable = array(
                SqlQuery::RATIO_DISPONIBLE => $fila[SqlQuery::RATIO_DISPONIBLE],
                SqlQuery::DISPONIBLE => $fila[SqlQuery::DISPONIBLE]
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
    return $isEnable;
}

/**
 * 
 * @param type $credenciales
 * @param type $ip_address
 * @return array[update_status,count_post]  o null
 */
function getUserStatus($credenciales, $ip_address) {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $arrayResult = null;
    $statement = NULL;
    try {
        $conexion = conexionDB($credenciales);


        $statement = $conexion->prepare(SqlQuery::SELECT_STATUS_USER_BY_IP);
        $statement->bind_param("s", $ip_address);

        $statement->execute();
        $statement->bind_result($update_status,$count_post);//get_result();
        $arrayResult = array();
        while ($statement->fetch()){
        $arrayResult =  array($update_status,$count_post);   
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
