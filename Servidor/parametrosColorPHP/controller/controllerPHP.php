<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'controller/errorMessages.php'; //mensajes de error a mostrar
include 'controller/paths.php'; //rutas de las vistas

echo 'Ejemplo: /index.php?blue=azul<br>';
//colors permitidos
$colors = ["blue", "red", "yellow", "green"];

$destinoURL = "";

if (empty($_REQUEST)) {

    $error = $errorParamsEmpty;
    $destinoURL = $vistaError;
} else {

//comprobamos que todos los parametros introducidos pertenecen a un color válido
    foreach ($_REQUEST as $color => $valor) {
        $colorExist = false;

        for ($i = 0; $i < count($colors); $i++) {
            if ($colors[$i] == $color) {
                $colorExist = true;
            }
        }
        if (!$colorExist) {
            $error = $errorParamsWrong;
            $destinoURL = $vistaError;
        }
    }//fin foreach
    if ($colorExist) {

        $destinoURL = $vistaVista;
    }
}
include $destinoURL;



