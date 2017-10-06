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

<title>Alta de partes de Alumnos</title>
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
<div id='cuerpo-centro' style="width:972px; height:1060px; margin-left:0px; margin-right:0px;">
<div id="container" class="ltr">

<form id="form56" name="form56" class="wufoo topLabel page" autocomplete="off" enctype="multipart/form-data" method="post" novalidate
action="Jefatura/Partes/partes/validate.php">

<header id="header" class="info">
<h2>Alta de partes</h2>
</header>
<ul>

<li id="foli0" class="     ">
<a href='Jefatura/Partes/partes/altaalumnos.php'>alta alumno</a><br/><br/>
<label class="desc" id="title0" for="Field25">Curso</label>
<div>
    <select id="Field25" name="idcurso" tabindex="1" onchange="javascript:alumnos(this.value)" >
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
<li id="foli25" class="leftHalf      ">
<label class="desc" id="title25" for="Field35">Alumno</label>
<div id="divAlumnos">
</div>
</li>
<li class="buttons ">
    <div>
        <input id="informepartes" name="informepartes" class="btTxt submit" type="button" value="verpartes" disabled="true" onclick="verParteAlumno()"/> -- 
        <input id="updatealumno" name="updatealumno" class="btTxt submit" type="button" value="actualizar datos alumno" disabled="true" onclick="updateAlumno()"/>
    </div>
</li>
<li id="foli2" class="date rightHalf     ">
<label class="desc" id="title2" for="Field2-1">Fecha del parte(yyyy-mm-dd)</label>
<span>
<input id="cdia" name="dia" type="text" class="field text" value="<?=$hoy?>" size="10" maxlength="10" tabindex="5" />
</span> 
<span id="cal2">
<img id="pick2" class="datepicker" src="Comun/imagenes/partes/calendar.png" alt="elige una fecha" />
</span>
</li>
<li id="foli13" class="leftHalf     ">
<label class="desc" id="title13" for="Field13">Hora</label>
<div>
<select id="Field25" name="hora" tabindex="3" > 
<?php
   for ($j=8;$j<=20;$j++){
       if ($j < 10){
           $val="0".$j;
       }else
           $val=$j;
?>
    <option value="<?=$val?>"><?=$val?></option>
<?php
   }
?>
</select>
:
<select id="Field25" name="minuto" tabindex="4" > 
<?php
   for ($i=1;$i<=59;$i++){
       if ($i < 10){
           $val="0".$i;
       }else
           $val=$i;
?>
    <option value="<?=$val?>"><?=$val?></option>
<?php
   }
?>
</select>
</div><br>
</li>
<li id="foli15">
<label class="desc" id="title15" for="Field15">Incidencia comentida ([crtl + click] selección múltiple)</label>
<div>
<select multiple="multiple" id="Field25" name="idincidencia[]" tabindex="6" size="15" >         
        <?php
            $mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
            $query="select in_id,in_descri from incidencias";
            $stmt= $mMysqli->prepare($query);
            $stmt->bind_result($idIncidencia,$des);
            $result = $stmt->execute();
            while ( $stmt->fetch() ){
                echo "<option value=" . $idIncidencia .">" . $des . "</option>";
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
        <?php
            $mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
            $query="select sa_id,sa_descri from sanciones order by 2 desc";
            $stmt= $mMysqli->prepare($query);
            $stmt->bind_result($idSancion,$des);
            $result = $stmt->execute();
            while ( $stmt->fetch() ){
                if ( $idSancion != "12")
                    echo "<option value=" . $idSancion .">" . $des . "</option>";
                else
                    echo "<option value=" . $idSancion ." selected='selected'>" . $des . "</option>";
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
<select id="tipoFalta" name="considerada_como" class="field select medium" tabindex="8" onchange="checkleves()"> 
<option value="--" selected="selected">--</option>    
<option value="L">Falta Leve</option>
<option value="G">Falta Grave</option>
</select>
    <br/><div id="alertasfalta"/>
</div>    
</li>
<li id="foli32">
<label class="desc" id="foli32" for="profesor">Profesor que genera el parte</label>
  
<div>
<select id="profesor" name="profesor" tabindex="9"  class="field textarea medium"> 


        <?php
            $mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
            $query="select pr_codigo,concat(pr_apell1,', ',pr_apell2,' ',pr_nombre) as nombre from profesores order by 2 asc";
            $stmt= $mMysqli->prepare($query);
            $stmt->bind_result($profesor,$des);
            $result = $stmt->execute();
            while ( $stmt->fetch() ){
                if ( $profesor != "12")
                    echo "<option value=" . $profesor .">" .$des . "</option>";
                else
                    echo "<option value=" .$profesor ." selected='selected'>" . $des . "</option>";
            }
            $stmt->close();
            $mMysqli->close();
        ?>   
</select>
</div>
</li> 
<li id="foli31"><label class="desc" id="title31" for="Field31">Observaciones</label>
<div>
<textarea id="Field31" name="observaciones" class="field textarea medium" spellcheck="true" rows="5" cols="40" tabindex="10" onkeyup="">
</textarea>
</div>
</li> <li class="buttons ">
<div>
<input id="saveForm" name="saveForm" class="btTxt submit" type="submit" value="aceptar" tabindex="11"/></div>
</li>
</ul>
</form> 
</div><!--container-->
</div>
<img id="bottom" src="Comun/imagenes/partes/bottom.png" alt="" />
 <script type="text/javascript">//<![CDATA[

      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: true
      });
      cal.manageFields("pick2", "cdia", "%Y-%m-%d");      

    //]]></script>
</body>
</html>
