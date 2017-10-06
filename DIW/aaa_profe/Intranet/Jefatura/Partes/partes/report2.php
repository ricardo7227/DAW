<?php
define('FPDF_FONTPATH', 'pdf/fpdf17/font/');
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

$query="select a.pa_id,a.pa_asocia,concat(b.al_nombre,' ',b.al_apell1 ) as nombre,concat(a.pa_fechas,'-',a.pa_horas) as fecha,a.pa_consid,substr(a.pa_observ,1,50) as observaciones,a.pa_codpro,a.pa_inctod,d.sa_descri as sancion
        from partes a, alumnos b, incidencias c, sanciones d 
        where a.pa_codalu=b.al_codigo and a.pa_codinc=c.in_id and a.pa_codsan=d.sa_id and
              a.pa_codalu=? order by a.pa_id";

$stmt=$mMysqli->prepare($query);
$stmt->bind_param("i", $_GET['idalumno']);

$stmt->bind_result($idparte,$asociada,$nombre,$fecha,$considerada_como,$observaciones,$profesor,$incitodas,$sancion);
$stmt->execute();
$data = array ();

while ($stmt->fetch()){
    
    //carga todas las incidencias cometidas
    $mMysqli2 = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    $query2="select in_descri from incidencias where in_id in (" . $incitodas .")";
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
