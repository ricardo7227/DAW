<?php
define('FPDF_FONTPATH', '/var/www/faltas/pdf/fpdf17/font/');
require_once 'config/global.php';
require('pdf/fpdf17/mc_table.php');



$pdf=new PDF_MC_Table('L','mm','A4');
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);
$pdf->SetDisplayMode('fullpage', 'continuous');

$pdf->SetWidths(array( 50,25,10,100,50,50));
// Header
$header = array( 'Alumno', 'Fecha','(L/G)','Incidencia',utf8_decode('Sanción'), 'Observaciones');
for($i=0;$i<count($header);$i++)
        $pdf->Cell($pdf->widths[$i],7,$header[$i],1,0,'C');
$pdf->Ln();

    
//carga datos de partes del alumno

$mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$query="select a.idparte,a.asociado_a_grave,concat(b.nombre,' ',b.apellido1 ) as nombre,concat(a.fecha,'-',a.hora) as fecha,a.considerada_como,substr(a.observaciones,1,50) as observaciones,a.profesor,a.incitodas,d.descripcion as sancion
        from partes a, alumnos b, incidencias c, sanciones d 
        where a.idalumno=b.idalumno and a.idincidencia=c.idincidencia and a.idsancion=d.idsancion and
              a.idalumno=? order by a.idparte";

$stmt=$mMysqli->prepare($query);
$stmt->bind_param("i", $_GET['idalumno']);

$stmt->bind_result($idparte,$asociada,$nombre,$fecha,$considerada_como,$observaciones,$profesor,$incitodas,$sancion);
$stmt->execute();
$data = array ();

while ($stmt->fetch()){
    
    //carga todas las incidencias cometidas
    $mMysqli2 = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    $query2="select descripcion from incidencias where idincidencia in (" . $incitodas .")";
    $stmt2=$mMysqli2->prepare($query2);
    $stmt2->bind_result($descripcion);
    $stmt2->execute();
    $totinci="";
    while ($stmt2->fetch()){
        $totinci .= "*. " . $descripcion . "\n";
    }
    $totinci .= "";
    $stmt2->close();
    $mMysqli2->close();
    
    ///
    //array_push($data, array($idparte,$asociada,utf8_decode($nombre),$fecha,$considerada_como,utf8_decode($totinci),utf8_decode($observaciones),utf8_decode($profesor)) );
    $pdf->Row( array(utf8_decode($nombre),$fecha,$considerada_como,utf8_decode($totinci),utf8_decode($sancion),utf8_decode($observaciones)) );
}
$stmt->close();
$mMysqli->close();

//////////////////////////////////    
    
$pdf->Output();
?>
