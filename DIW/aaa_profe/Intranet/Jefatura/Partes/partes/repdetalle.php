<?php

require_once 'config/global.php';
require('pdf/fpdf17/fpdf.php');
//header('Content-type: application/pdf; charset=utf-8');
class PDF extends FPDF
{
    
function ChapterTitle($alumno)
{
    // Arial 12
    $this->SetFont('Arial','',14);
    // Background color
    $this->SetFillColor(200,220,255);
    // Title
    $this->Cell(0,6,"Parte de conducta para " . utf8_decode($alumno)  ,0,1,'L',true);
    // Line break
    $this->Ln(4);
}

// Page header
function Header()
{
    // Logo
    $this->Image('images/logo.gif',10,6,70);
    // Arial bold 15
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
//
$mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$query="select a.pa_id,
        a.pa_asocia,
        concat(e.gr_codigo, ' - ',e.gr_tutor1) as grupo,
        concat(b.al_apell1,' ',b.al_apell2,',  ',b.al_nombre ) as nombre,
        b.al_telef1,
        concat(a.pa_fechas,' - ',a.pa_horas) as fecha,
        case when a.pa_consid='L' then 'Leve' else 'Grave' end as considerada_como,
        c.in_descri as incidencia, 
        d.sa_descri as sancion,
        a.pa_observ as observaciones,
        a.pa_codpro as profesor,
        a.pa_inctod
        from partes a, alumnos b, incidencias c, sanciones d,grupos e 
        where       a.pa_codalu=b.al_codigo 
                and a.pa_codinc=c.in_id
                and a.pa_codsan=d.sa_id 
                and b.al_codgru=e.gr_codigo 
                and a.pa_id=?";
//$mMysqli->set_charset("utf8");
$stmt=$mMysqli->prepare($query);
$stmt->bind_param("i", $_GET["idparte"]);

$stmt->bind_result($idparte,$asociada,$grupo,$nombre,$tel1,$fecha,$considerada_como,$incidencia,$sancion,$observaciones,$profesor,$incitodas);
$stmt->execute();
$data = array ();

$stmt->fetch();
array_push($data, array($idparte,$asociada,$grupo,$nombre,$fecha,$considerada_como,$incidencia,$sancion,$observaciones,$profesor));

$stmt->close();
$mMysqli->close();
// Instanciation of inherited class
$pdf = new PDF('P','mm','A4');
$pdf->SetDisplayMode('fullpage', 'continuous');
$pdf->AliasNbPages();

$pdf->AddPage();
$pdf->ChapterTitle($nombre);

/// imprime datos del parte
$pdf->SetFont('Times','b',12);
$pdf->Cell(40,7,'Id.Parte: ',0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(10,7,$idparte,0,1);

$pdf->SetFont('Times','b',12);
$pdf->Cell(40,7,'Asoc.Grave: ',0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(10,7,$asociada,0,1);

$pdf->SetFont('Times','b',12);
$pdf->Cell(40,7,'Grupo y Tutor: ',0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(40,7,utf8_decode($grupo),0,1);

$pdf->SetFont('Times','b',12);
$pdf->Cell(40,7,'Alumno: ',0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(100,7,utf8_decode($nombre),0,1);

$pdf->SetFont('Times','b',12);
$pdf->Cell(40,7,'Fecha: ',0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(100,7,$fecha,0,1);

$pdf->SetFont('Times','b',12);
$pdf->Cell(40,7,'Tipo Falta: ',0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(100,7,$considerada_como,0,1);

$pdf->SetFont('Times','b',12);
$pdf->Cell(40,10,'Profesor: ',0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(100,10,utf8_decode($profesor),0,1);

//recorreo todas las faltas y mete linea
$pdf->SetFont('Times','b',12);
$pdf->Cell(40,10,'Faltas cometidas: ',0,1);
$mMysqli2 = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$query2="select in_descri from incidencias where in_id in (" . $incitodas .")";
$stmt2=$mMysqli2->prepare($query2);

$stmt2->bind_result($descripcion);
$stmt2->execute();
while ( $stmt2->fetch()){
    $pdf->SetFont('Times','',12);
    $pdf->Cell(100,5,"  *. " . utf8_decode($descripcion),0,1);
}
$stmt2->close();
$mMysqli2->close();
////////////////////////////////////////////

$pdf->SetFont('Times','b',12);
$pdf->Cell(40,10,utf8_decode('Sanción aplicada: '),0,1);
$pdf->SetFont('Times','',12);
$pdf->Cell(100,5,"  *. " . utf8_decode($sancion),0,1);


//para las observaciones hay que recoger varias lineas hasta final
//observaciones
$pdf->Ln(5);

$pdf->SetFont('Times','b',12);
$pdf->Cell(40,10,'Observaciones: ',0,1);

$longobservaciones=strlen($observaciones);
$i=0;
if ( $longobservaciones > 70 ){
    $resto=$longobservaciones % 70;
    $partes=(int)$longobservaciones / 70;
    
    for ( $j=0; $j<$partes;$j++ ) {
        $pdf->SetFont('Times','',12);
        $pdf->Cell(100,5, substr(utf8_decode($observaciones),$i,$i+70),0,1);
        $i+=70;
    }
    //imprime resto
    $pdf->Cell(100,5, substr(utf8_decode($observaciones),$i,$i+$resto),0,1);
}else{
    $pdf->SetFont('Times','',12);
    $pdf->Cell(100,5, utf8_decode($observaciones),0,1);
}

///

$pdf->Output();
?>
