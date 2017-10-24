<?php
 ini_set('display_errors', 'On');
//require_once 'config/Config.php';
require __DIR__ . '/vendor/autoload.php';

$variable = new \controller\newPHPClass();
$variable->hola("usando autoload desde Composer");
 