<?php

ini_set('display_errors', 'On'); //muestra los errores del PHP
//require_once 'config/Config.php';


echo get_current_user();

echo '<h2>Forma de uso: '
 . '</br> {path}/frontController.php/nivel1?nivel1={contraseña}'
 . '</br> {path}/frontController.php/nivel2?num{numero}={contraseña}'
 . '</br> {path}/frontController.php/nivel3?nivel3={contraseña}</h2>';
