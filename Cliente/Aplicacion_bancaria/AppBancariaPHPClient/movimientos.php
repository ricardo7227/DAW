<?php

ini_set('display_errors', 'On');
require_once 'config/Config.php';
include 'header.php';

use api\OperacionesApi;
use model\Rango;
use utilidades\Constantes;

//recibe del formulario
$n_cuenta = filter_input(INPUT_GET, Constantes::INPUT_NCUENTA);
$descripcion = filter_input(INPUT_GET, Constantes::INPUT_FECHA_INICIAL);
$fecha_fin = filter_input(INPUT_GET, Constantes::INPUT_FECHA_FIN);
$action = filter_input(INPUT_GET, Constantes::ACTION);
$cargaMovimientos = false;
$messageToUser = NULL;

/* * *
 * 
 * Operaciones
 * 
 */
$rangoMovimiento = new Rango($n_cuenta, $descripcion, $fecha_fin);

switch ($action) {
    case Constantes::GET_MOVIMIENTOS:

        $rangoMovimiento = OperacionesApi::getInstance()->getMovimientos($rangoMovimiento);

        if (is_array($rangoMovimiento)) {
            $cargaMovimientos = true;
        } else {

            $messageToUser = $rangoMovimiento->description;
        }

        break;
}


include './MovimientosVista.php';
include './footer.php';

