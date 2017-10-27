<?php

ini_set('display_errors', 'On');
require_once 'config/Config.php';

use controller\controllerNivel1;
use controller\controllerNivel2;
use controller\controllerNivel3;

//parametros 
$nivel1 = Constantes::nivel1;
$nivel2 = Constantes::nivel2;
$nivel3 = Constantes::nivel3;
$num1 = Constantes::num1;
$num2 = Constantes::num2;
$num3 = Constantes::num3;



$paramNivel1 = filter_input(INPUT_GET, $nivel1); //$_REQUEST[$nivel1];
$paramNivel2 = isset($_REQUEST[$nivel2]);
$paramNivel2Num1 = isset($_REQUEST[$num1]);
$paramNivel2Num2 = isset($_REQUEST[$num2]);
$paramNivel2Num3 = isset($_REQUEST[$num3]);
$paramNivel3 = isset($_REQUEST[$nivel3]);

$uri = $_SERVER['REQUEST_URI'];

if (strstr($uri, $nivel1)) {//path nivel1
    if (isset($paramNivel1)) {

        $control = new controllerNivel1();
        $control->processRequest($paramNivel1);
    } else {
        
        setMessage(sprintf(Constantes::messageLevelParamEmpty, $nivel1, $nivel1, $nivel1));
    }
} elseif (strstr($uri, $nivel2)) {//path nivel2
    

    if ($paramNivel2Num1 || $paramNivel2Num2 || $paramNivel2Num3) {

        $control = new controllerNivel2();
        $control->processRequest();
    } else {
        
        setMessage(sprintf(Constantes::messageLevelParamEmpty, $nivel2, $nivel2, $num1));
    }
} elseif (strstr($uri, $nivel3)) {//path nivel3
    if ($paramNivel3) {

        $control = new controllerNivel3();
        $control->processRequest3();
    } else {
        
        setMessage(sprintf(Constantes::messageLevelParamEmpty, $nivel3, $nivel3, $nivel3));
    }
} else {

    include 'index.php';
}

function setMessage($message) {
    echo $message;
}
