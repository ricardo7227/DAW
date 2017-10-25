<?php
 ini_set('display_errors', 'On');//muestra los errores del PHP
//require_once 'config/Config.php';
$uri = $_SERVER['REQUEST_URI'];
if ($uri == '/index.php') {
    echo 'index.php';
} elseif (strstr($uri, 'show')) {

    echo 'show';
} else {

    header('Status: 404 Not Found');
    echo '<html><body><h1>Page Not Found</h1></body></html>';
}