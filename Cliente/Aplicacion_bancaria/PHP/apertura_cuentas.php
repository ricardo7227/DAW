<?php
require_once 'vendor/autoload.php';
ini_set('display_errors', 'On');
use db\Database;
echo 'antes';
$database = new Database();
$database->conexionDB();
echo 'antes';
var_dump($database);
$database->cerrarConexion();
echo 'despues';
var_dump($database);