<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('config/global.php');


$hoy=date("Y/m/d");

?>
<!DOCTYPE html>
<html>
<head>

<title>Alta de Alumnos</title>
<!-- Meta Tags -->
<meta charset="utf-8">
<!-- CSS -->
<link rel="stylesheet" href="../../../css/structure.css" type="text/css" />
<link rel="stylesheet" href="../../../css/form.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="../../../css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="../../../css/border-radius.css" />
<link rel="stylesheet" type="text/css" href="../../../css/steel/steel.css" />
<!-- JavaScript -->
<script src="../../../js/wufoo.js"></script>
<script src="../../../js/jscal2.js"></script>
<script src="../../../js/lang/en.js"></script>
<script src="../../../js/partes.js"></script>

</head>

<body id="public">
<div id="container" class="ltr">

<form id="formalta" name="formalta" class="wufoo topLabel page" autocomplete="off" enctype="multipart/form-data" method="post" novalidate
action="validate.php">

<header id="header" class="info">
<h2>Alta de alumnos</h2>
</header>
<ul>

<li id="foli0" class="     ">
<label class="desc" id="title0" for="Field25">Curso</label>
<div>
    <select id="Field25" name="idcurso" tabindex="1">
        <option selected="selected" value="--">elige grupo</option>
        <?php
            $mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
            $query="select gr_codigo,gr_descri from grupos";
            $stmt= $mMysqli->prepare($query);
            $stmt->bind_result($idGrupo,$nombre);
            $result = $stmt->execute();
            while ( $stmt->fetch() ){
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
<input id="nombre" name="nombre" type="text" class="field text" value="" size="30" maxlength="255" tabindex="2" />
</span> 
</li>

<li id="foli2" class="">
<label class="desc" id="labelapellido1" for="apellido1">Apellido1</label>
<span>
<input id="apellido1" name="apellido1" type="text" class="field text" value="" size="30" maxlength="255" tabindex="3" />
</span> 
</li>

<li id="foli2" class="">
<label class="desc" id="labelapellido1" for="apellido2">Apellido2</label>
<span>
<input id="apellido2" name="apellido2" type="text" class="field text" value="" size="30" maxlength="255" tabindex="4" />
</span> 
</li>

<li id="foli2" class="">
<label class="desc" id="telefono1" for="telefono1">Telf.1</label>
<span>
<input id="telf1" name="telf1" type="text" class="field text" value="" size="10" maxlength="10" tabindex="5" />
</span> 
</li>

<li id="foli2" class="">
<label class="desc" id="telefono1" for="telefono2">Telf.2</label>
<span>
<input id="telf2" name="telf2" type="text" class="field text" value="" size="10" maxlength="10" tabindex="6" />
</span> 
</li>

</li> <li class="buttons ">
<div>
<input id="saveForm" name="saveForm" class="btTxt submit" type="button" value="aceptar" onclick="javascript:altaalumno()"/></div>
</li>
</ul>
</form> 
</div><!--container-->
<img id="bottom" src="../../../Comun/imagenes/partes/bottom.png" alt="" />
</body>
</html>
