<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
header('Content-Type: text/xml');
require 'config/global.php';

$mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$query = "select count(*) from partes where pa_codalu=? and pa_consid='L' and pa_asocia is null";

$stmt= $mMysqli->prepare($query);
$stmt->bind_param("i", $_GET['idalumno']);

$stmt->bind_result($cuenta);
$stmt->execute();
$stmt->fetch();

if ( $cuenta > 2){
    $output="ATENCIÓN!!!!: Este alumno tiene tres o más faltas leves acumuladas. ¡¡Comprueba su historial!!";
}else{
    switch ($cuenta) {
        case 2:
            $output="OJO!: Este alumno tiene ya dos faltas leves acumuladas. Una leve más implica añadir una sanción grave";
            break;  
        case 1:
            $output="Este alumno tiene actualmente 1 falta leve acumuladas";
            break;
        default:
            $output="Alumno sin faltas leves";
            break;
    }
}

    
$stmt->close();
$mMysqli->close();

echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><response>' . $output . '</response>';
?>
