<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'config/global.php';

session_start();

//carga los datos del parte
if (!isset ($_GET['idparte']) ){
    header("Location:index.php?jefpar");
}

$mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$query="select 
                a.pa_id,
                a.pa_codalu,
                b.al_codgru,
                concat(b.al_apell1, ' ',b.al_apell2, ', ', b.al_nombre) as nombre,
                a.pa_codinc,
                c.in_descri as incidencia,
                a.pa_inctod,
                a.pa_codsan,
                d.sa_descri as sancion,
                a.pa_fechas,
                a.pa_horas,
                a.pa_consid,
                a.pa_observ,
                a.pa_codpro                
        from partes a, alumnos b, incidencias c, sanciones d
        where 
                       a.pa_codalu=b.al_codigo
                and    a.pa_codinc=c.in_id
                and     a.pa_codsan=d.sa_id
                and     a.pa_id=?";

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
        <?php
            $mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
            $query="select al_codigo,concat(b.al_apell1, ' ',b.al_apell2, ', ', b.al_nombre) as nombre from alumnos b";
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
        <?php
            $elegidas=explode(",",$incitodas);
            $mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
            $query="select in_id,in_descri from incidencias";
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
        <?php
            $mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
            $query="select sa_id,sa_descri from sanciones";
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
<?php
    if ( $considerada_como == "L") {
        echo "<option value='L' selected='selected'>Falta Leve</option><option value='G'>Falta Grave</option>";        
    }else {
        echo "<option value='L'>Falta Leve</option><option value='G'  selected='selected'>Falta Grave</option>";      
    }
?>


</select>
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
