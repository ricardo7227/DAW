<?php

require_once 'config/Config.php';

use controller\controllerNivel1;

//parametros 
$nivel1 = Constantes::nivel1;
$nivel2 = Constantes::nivel2;
//$passNivel1 = Constantes::passNivel1;

$paramNivel1 = $_REQUEST[$nivel1];


if (isset($paramNivel1)) {
    $control = new controllerNivel1();
    $control->processRequest($paramNivel1);
}elseif (isset ($nivel2)) {
    //pendiente nivel2=?????
}
    


