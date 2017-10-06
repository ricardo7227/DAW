<?php

require_once 'config/global.php';
require('pdf/fpdf17/fpdf.php');

class PDF extends FPDF
{
// Load data
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}

// Simple table
function BasicTable($header, $data)
{
    // Header
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

// Better table
function ImprovedTable($header, $data)
{
    // Column widths
    $w = array(10, 10, 55, 35,25,100 ,100,50);
    // Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        //$this->Cell($w[0],6,$row[0],'LR');
        
        
        $this->Cell($w[0], 10, $row[0], 1, 0, 'L', false);
        $this->Cell($w[1], 10, $row[1], 1, 0, 'L', false);
        $this->Cell($w[2], 10, $row[2], 1, 0, 'L', false);
        $this->Cell($w[3], 10, $row[3], 1, 0, 'L', false);
        $this->Cell($w[4], 10, $row[4], 1, 0, 'L', false);
        $this->Cell($w[5], 10, $row[5], 1, 0, 'L', false);
        $this->Cell($w[6], 10, $row[6], 1, 0, 'L', false);
        $this->Cell($w[7], 10, $row[7], 1, 0, 'L', false);
        
        //$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
        //$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}

// Colored table
function FancyTable($header, $data)
{
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(40, 35, 40, 45);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}
}

//carga datos de partes del alumno

$mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$query="select a.pa_id,a.pa_asocia,concat(b.al_nombre,' ',b.al_apell1 ) as nombre,concat(a.pa_fechas,'-',a.pa_horas) as fecha,a.pa_consid,substr(a.pa_observ,1,50) as observaciones,a.pa_codpro,a.pa_incitod,d.sa_descri as sancion
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
    array_push($data, array($idparte,$asociada,utf8_decode($nombre),$fecha,$considerada_como,utf8_decode($totinci),utf8_decode($observaciones),utf8_decode($profesor)) );
}
$stmt->close();
$mMysqli->close();

//////////////////////////////////
$pdf = new PDF('L','mm','A3');
// Column headings
$header = array('Id', 'Asoc.', 'Alumno', 'Fecha','Tipo(L/G)','Incidencia', 'Observaciones','Profesor');
// Data loading
//$data = $pdf->LoadData('countries.txt');
//$pdf->AutoPageBreak(auto);
$pdf->SetFont('Arial','',9);
$pdf->SetDisplayMode('fullpage', 'continuous');
//$pdf->AddPage();
//$pdf->BasicTable($header,$data);
$pdf->AddPage();
$pdf->ImprovedTable($header,$data);
//$pdf->AddPage();
//$pdf->FancyTable($header,$data);
$pdf->Output();
?>