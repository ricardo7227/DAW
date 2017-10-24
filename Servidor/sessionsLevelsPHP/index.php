<?php
 ini_set('display_errors', 'On');//muestra los errores del PHP
//require_once 'config/Config.php';
require __DIR__ . '/vendor/autoload.php';

$variable = new \controller\controllerNivel1();
$variable->processRequest("usando autoload desde Composer");
 