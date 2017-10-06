<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'config/global.php';

session_start();

//carga los datos del parte
if (!isset ($_GET['idparte']) ){
    header("Location:index.php");
}

$mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$query="select 
                a.idparte,
                a.idalumno,
                b.idcurso,
                concat(b.apellido1, ' ',b.apellido2, ', ', b.nombre) as nombre,
                a.idincidencia,
                c.descripcion as incidencia,
                a.incitodas,
                a.idsancion,
                d.descripcion as sancion,
                a.fecha,
                a.hora,
                a.considerada_como,
                a.observaciones,
                a.profesor                
        from partes a, alumnos b, incidencias c, sanciones d
        where 
                       a.idalumno=b.idalumno
                and    a.idincidencia=c.idincidencia
                and     a.idsancion=d.idsancion
                and     a.idparte=?";

$stmt= $mMysqli->prepare($query);
$stmt->bind_param("i", $_GET['idparte']);
$stmt->bind_result($idparte,$idalumno,$idcurso,$nombre,$idincidencia,$incidencia,$incitodas,$idsancion,$sancion,$fecha,$hora,$considerada_como,$observaciones,$profesor);
$result = $stmt->execute();
$stmt->fetch();
$stmt->close();
$mMysqli->close();

$hoy=date("Y/m/d");

?>
<!DOCTYPE html>
<html>
<head>

<title>Modificación de partes</title>
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

<form id="form56" name="form56" class="wufoo topLabel page" autocomplete="off" enctype="multipart/form-data" method="post" novalidate
action="validate.php">

<header id="header" class="info">
<h2>Modificación de partes </h2>
</header>
<ul>

<li id="foli25" class="leftHalf      ">
<label class="desc" id="title25" for="Field35">Alumno</label>
<div id="divAlumnos">
    <select id="idalumno" name="idalumno" tabindex="1" >
        <?
            $mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
            $query="select idalumno,concat(b.apellido1, ' ',b.apellido2, ', ', b.nombre) as nombre from alumnos b";
            $stmt= $mMysqli->prepare($query);
            $stmt->bind_result($ida,$alumno);
            $result = $stmt->execute();
            while ( $stmt->fetch() ){
                if ( $ida == $idalumno)
                    echo "<option value=" . $ida ." selected='selected'>" . $alumno . "</option>";
                else
                    echo "<option value=" . $ida .">" . $alumno . "</option>";
            }
            $stmt->close();
            $mMysqli->close();
        ?>
    </select>    
</div>
</li>
<li id="foli2" class="date rightHalf     ">
<label class="desc" id="title2" for="Field2-1">Fecha del parte(yyyy-mm-dd)</label>
<span>
<input id="cdia" name="fecha" type="text" class="field text" value="<?=$fecha?>" size="10" maxlength="10" tabindex="5" />
</span> 
<span id="cal2">
<img id="pick2" class="datepicker" src="images/calendar.png" alt="elige una fecha" />
</span>
</li>
<li id="foli13" class="leftHalf     ">
<label class="desc" id="title13" for="Field13">Hora</label>
<div>
<input id="hora" name="hora" type="text" class="field text" value="<?=$hora?>" size="8" maxlength="8" tabindex="6" />
</div><br>
</li>
<li id="foli15">
<label class="desc" id="title15" for="Field15">Incidencias comentidas</label>
<div>
<select multiple="multiple" id="Field25" name="idincidencia[]" tabindex="6" size="15" >         
        <?
            $elegidas=explode(",",$incitodas);
            $mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
            $query="select idincidencia,descripcion from incidencias";
            $stmt= $mMysqli->prepare($query);
            $stmt->bind_result($idinc,$des);
            $result = $stmt->execute();
            while ( $stmt->fetch() ){
                    if (in_array($idinc,$elegidas))
                        echo "<option value=" . $idinc ." selected='selected'>" . $des . "</option>";                    
                    else
                        echo "<option value=" . $idinc .">" . $des . "</option>";                    
            }
            $stmt->close();
            $mMysqli->close();
        ?>    

</select>
</div>
</li>
<li id="foli16">
<label class="desc" id="title16" for="Field16">Sanción aplicada</label>
<div>
<select id="Field25" name="idsancion" tabindex="7" > 
        <?
            $mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
            $query="select idsancion,descripcion from sanciones";
            $stmt= $mMysqli->prepare($query);
            $stmt->bind_result($idsan,$des);
            $result = $stmt->execute();
            while ( $stmt->fetch() ){
                if ( $idsan != $idsancion)
                    echo "<option value=" . $idsan .">" . $des . "</option>";
                else
                    echo "<option value=" . $idsan ." selected='selected'>" . $des . "</option>";
            }
            $stmt->close();
            $mMysqli->close();
        ?>     
</select>
</div>
</li>
<li id="foli33" class="phone leftHalf     ">
<label  class="desc" for="Field33">Considerada Como</label>
<div>
<select id="tipoFalta" name="considerada_como" class="field select medium" tabindex="8"> 
<?
    if ( $considerada_como == "L") {
        echo "<option value='L' selected='selected'>Falta Leve</option><option value='G'>Falta Grave</option>";        
    }else {
        echo "<option value='L'>Falta Leve</option><option value='G'  selected='selected'>Falta Grave</option>";      
    }
?>


</select>
</div>    
</li>
<li id="foli31"><label class="desc" id="title31" for="profesor">Profesor que genera el parte</label>
<div>
<input type="text" id="profesor" name="profesor" class="field textarea medium" value="<?=$profesor ?>"tabindex="9"/>
</div>
</li> 
<li id="foli31"><label class="desc" id="title31" for="Field31">Observaciones</label>
<div>
<textarea id="Field31" name="observaciones" class="field textarea medium" spellcheck="true" rows="5" cols="40" tabindex="10" onkeyup="">
<?echo $observaciones ?>
</textarea>
</div>
</li> <li class="buttons ">
<div>
<input id="hidparte" name="idparte" type="hidden" value="<?=$idparte?>"/>
<input id="saveForm" name="saveForm" class="btTxt submit" type="submit" value="aceptar" tabindex="11"/></div>
</li>
</ul>
</form> 
</div><!--container-->
<img id="bottom" src="images/bottom.png" alt="" />
 <script type="text/javascript">//<![CDATA[

      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: true
      });
      cal.manageFields("pick2", "cdia", "%Y-%m-%d");      

    //]]></script>
</body>
</html>
