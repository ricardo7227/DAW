<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'clases/validate.class.php';
session_start();

$validator=new validate();

if ( stripos($_SERVER['HTTP_REFERER'],"altaalumnos.php") >0 )
    header("Location:" . $validator->ValidateAlta());
elseif (stripos($_SERVER['HTTP_REFERER'],"updatealumno.php") >0 )        
        header("Location:" . $validator->ValidateUpdate());
elseif (stripos($_SERVER['HTTP_REFERER'],"updateparte.php") >0)
        header("Location:" . $validator->ValidateParteUpdate());
else
    header("Location:" . $validator->ValidatePHP());


?>
