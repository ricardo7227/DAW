<?php

ini_set('display_errors', 'On');
require_once 'config/Config.php';
include 'header.php';

use api\OperacionesApi;
use model\Movimiento;
use utilidades\Constantes;

$n_cuenta = filter_input(INPUT_GET, Constantes::INPUT_NCUENTA);
$descripcion = filter_input(INPUT_GET, Constantes::INPUT_DESCRIPCION);
$importe = filter_input(INPUT_GET, Constantes::INPUT_IMPORTE);
$action = filter_input(INPUT_GET, Constantes::ACTION);

$messageToUser = NULL;

/* * *
 * 
 * Operaciones
 * 
 */

$newMovimiento = new Movimiento($n_cuenta, $descripcion, $importe);

switch ($action) {
    case Constantes::NEW_MOVIMIENTO:

        $newMovimiento = OperacionesApi::getInstance()->addRecibo($newMovimiento);

        $messageToUser = $newMovimiento->description;

        break;
}

include './recibosVista.php';
include './footer.php';


