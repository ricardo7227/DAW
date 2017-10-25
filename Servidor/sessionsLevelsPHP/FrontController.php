<?php

require_once 'config/Config.php';

use controller\controllerNivel1;

//parametros 
$nivel1 = Constantes::nivel1;
$nivel2 = Constantes::nivel2;
$num1 = Constantes::num1;
$num2 = Constantes::num2;
$num3 = Constantes::num3;
//$passNivel1 = Constantes::passNivel1;

$paramNivel1 = $_REQUEST[$nivel1];
$paramNivel2 = $_REQUEST[$nivel2];
$paramNivel2Num1 = $_REQUEST[$num1];
$paramNivel2Num2 = $_REQUEST[$num2];
$paramNivel2Num3 = $_REQUEST[$num3];


if (isset($paramNivel1)) {
    
    $control = new controllerNivel1();
    $control->processRequest($paramNivel1);
    
} elseif (isset($paramNivel2) 
        || isset ($paramNivel2Num1) || isset ($paramNivel2Num2) || isset ($paramNivel2Num3)) {
    
    $control = new controller\controllerNivel2();
    $control->processRequest($paramNivel2,$paramNivel2Num1,$paramNivel2Num2,$paramNivel2Num3);
    //pendiente nivel2=?????
}
    


