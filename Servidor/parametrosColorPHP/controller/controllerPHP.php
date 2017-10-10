<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'controller/errorMessages.php';

echo 'url:?blue=azul<br>';

$colors = ["blue", "red", "yellow", "green"];

$destinoURL = "";

if (empty($_REQUEST)) {

    $error = $errorParamsEmpty;
    $destinoURL = "vista/error.php";
} else {
    foreach ($_REQUEST as $key => $val) {
        $bandera = false;
        foreach ($colors as $color => $value) {
            
            if ($color == $key ) {                
                $error = $errorParamsWrong;
                $destinoURL = "vista/error.php";
            }
        }
        echo '<h1 style="color:' . $key . '">';

        echo ($key . "=" . $val);
        ?> </h1>
        <?php
    }
}
include $destinoURL;



