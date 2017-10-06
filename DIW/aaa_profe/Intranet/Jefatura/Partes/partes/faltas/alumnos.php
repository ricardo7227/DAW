<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'clases/showAlumnos.class.php';
header('Content-Type: text/xml');
$show = new ShowAlumnos();
$curso=$_GET['curso'];
if(ob_get_length()) ob_clean();

if ($curso!="")
    echo $show->getAlumnos($curso);
else
    echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><response><select id="Field35" name="idalumno" class="field select medium" tabindex="3"><option values="--">--</option></select></response>';
?>
