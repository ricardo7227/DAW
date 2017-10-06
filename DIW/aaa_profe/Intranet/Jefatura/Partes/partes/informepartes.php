<?php
require_once 'config/global.php';
$mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$query="select 
        concat('<a href=updateparte.php?idparte=',a.pa_id,'><img src=../../../Comun/imagenes/partes/file_edit.png></a>') as edita,
        concat('<a href=repdetalle.php?idparte=',a.pa_id,'><img src=../../../Comun/imagenes/partes/pdf_ico.gif></a>') as idparte,
		a.pa_id as id,a.pa_asocia,concat(b.al_nombre,' ',b.al_apell1,' - ',b.al_telef1 ) as nombre,
		concat(a.pa_fechas,'-',a.pa_horas) as fecha,
		a.pa_consid,c.in_descri,a.pa_observ,a.pa_codpro,a.pa_inctod
        from partes a, alumnos b, incidencias c, sanciones d 
        where a.pa_codalu=b.al_codigo and a.pa_codinc=c.in_id and a.pa_codsan=d.sa_id and
              a.pa_codalu=? order by a.pa_id asc";
//$query="select a.idparte as idparte,a.asociado_a_grave,concat(b.nombre,' ',b.apellido1,' - ',b.tel1 ) as nombre,concat(a.fecha,'-',a.hora) as fecha,a.considerada_como,c.descripcion,a.observaciones,a.profesor,a.incitodas
  //      from partes a, alumnos b, incidencias c, sanciones d 
    //    where a.idalumno=b.idalumno and a.idincidencia=c.idincidencia and a.idsancion=d.idsancion and
      //        a.idalumno=? order by a.idparte";
$stmt=$mMysqli->prepare($query);
$stmt->bind_param("i", $_GET['idalumno']);

$stmt->bind_result($edita,$idparte,$id,$asociada,$nombre,$fecha,$considerada_como,$incidencia,$sancion,$profesor,$incitodas);
$stmt->execute();
$data = array ();

while ($stmt->fetch()){
    
    $mMysqli2 = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    $query2="select in_descri from incidencias where in_id in (" . $incitodas .")";
    $stmt2=$mMysqli2->prepare($query2);
    $stmt2->bind_result($descripcion);
    $stmt2->execute();
    $totinci="<ol>";
    while ($stmt2->fetch()){
        $totinci .= "<li>" .$descripcion . "</li>";
    }
    $totinci .= "</ol>";
    $stmt2->close();
    $mMysqli2->close();
    
    array_push($data, array($edita,$idparte,$id,$asociada,$nombre,$fecha,$considerada_como,$totinci,$sancion,$profesor));
}
$stmt->close();
$mMysqli->close();

$page = $_REQUEST['page'];
$rows = $_REQUEST['rows'];

$offset = $page * $rows - $rows;

$response['items'] = array_slice($data, $offset, $rows, true);
$response['total'] = count($data);

echo json_encode($response);

