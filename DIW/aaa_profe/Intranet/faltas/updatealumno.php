<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once (dirname(__FILE__) . '/config/global.php');

session_start();

$mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$query="select idalumno,idcurso,nombre,apellido1,apellido2,tel1,tel2 from alumnos where idalumno=?";

$stmt= $mMysqli->prepare($query);
$stmt->bind_param("i", $_GET['idalumno']);
$stmt->bind_result($idalumno,$idGrupoOrig,$nombrea,$apellido1,$apellido2,$tel1,$tel2);
$result = $stmt->execute();
$stmt->fetch();
$stmt->close();
$mMysqli->close();


?>
<!DOCTYPE html>
<html>
<head>

<title>Actualizar Datos del Alumno</title>
<!-- Meta Tags -->
<meta charset="utf-8">
<!-- CSS -->
<link rel="stylesheet" href="css/structure.css" type="text/css" />
<link rel="stylesheet" href="css/form.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
<!-- JavaScript -->
<script src="js/wufoo.js"></script>
<script src="js/jscal2.js"></script>
<script src="js/lang/en.js"></script>
<script src="js/partes.js"></script>

</head>

<body id="public">
<div id="container" class="ltr">

<form id="formalta" name="formalta" class="wufoo topLabel page" autocomplete="off" enctype="multipart/form-data" method="post" novalidate
action="validate.php">

<header id="header" class="info">
<h2>Modificar datos del alumno</h2>
</header>
<ul>

<li id="foli0" class="     ">
<label class="desc" id="title0" for="Field25">Curso</label>
<div>
    <select id="Field25" name="idcurso" tabindex="1">
        <option selected="selected" value="--">elige grupo</option>
        <?
            $mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
            $query="select idcurso,descripcion from cursos";
            $stmt= $mMysqli->prepare($query);
            $stmt->bind_result($idGrupo,$nombre);
            $result = $stmt->execute();
            while ( $stmt->fetch() ){
                if ( $idGrupo === $idGrupoOrig )
                    echo "<option value=" . $idGrupo ." selected='selected'>" . $idGrupo . "</option>";
                else
                    echo "<option value=" . $idGrupo .">" . $idGrupo . "</option>";
            }
            $stmt->close();
            $mMysqli->close();
        ?>
    </select>
</div>
</li>

<li id="foli2" class="">
<label class="desc" id="labelnombre" for="nombre">Nombre</label>
<span>
<input id="nombre" name="nombre" type="text" class="field text" value="<?=$nombrea?>" size="30" maxlength="255" tabindex="2" />
</span> 
</li>

<li id="foli2" class="">
<label class="desc" id="labelapellido1" for="apellido1">Apellido1</label>
<span>
<input id="apellido1" name="apellido1" type="text" class="field text" value="<?=$apellido1?>" size="30" maxlength="255" tabindex="3" />
</span> 
</li>

<li id="foli2" class="">
<label class="desc" id="labelapellido1" for="apellido2">Apellido2</label>
<span>
<input id="apellido2" name="apellido2" type="text" class="field text" value="<?=$apellido2?>" size="30" maxlength="255" tabindex="4" />
</span> 
</li>

<li id="foli2" class="">
<label class="desc" id="telefono1" for="telefono1">Telf.1</label>
<span>
<input id="telf1" name="telf1" type="text" class="field text" value="<?=$tel1?>" size="10" maxlength="10" tabindex="5" />
</span> 
</li>

<li id="foli2" class="">
<label class="desc" id="telefono1" for="telefono2">Telf.2</label>
<span>
<input id="telf2" name="telf2" type="text" class="field text" value="<?=$tel2?>" size="10" maxlength="10" tabindex="6" />
<input id="idalumno" name="idalumno" type="hidden" value="<?=$idalumno?>"/>
<input id="quiereborrar" name="quiereborrar" type="hidden" value="0"/>
</span> 
</li>

</li> <li class="buttons ">
<div>
    <input id="saveForm" name="saveForm" class="btTxt submit" type="button" value="aceptar" onclick="javascript:altaalumno()"/>
      -- 
     <input id="borrar" name="borrar" class="btTxt submit" type="button" value="eliminar alumno" onclick="javascript:eliminaralumno()"/> 
</div>
</li>
</ul>
</form> 
</div><!--container-->
<img id="bottom" src="images/bottom.png" alt="" />
</body>
</html>

