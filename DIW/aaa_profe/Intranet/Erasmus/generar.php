	<?php
	
	require('fpdf/fpdf.php');
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$apellido2=$_POST['apellido2'];
	$curso=$_POST['curso'];	
	
	$fechaAnio="(Curso ".(date(Y)-1)."/".date(Y).")";
	$fecha=" Madrid a ".date(d)." de ".date(F)." de ".date(Y); 
	$texto0=utf8_decode("CARTA DE COMPROMISO");
	$texto1=utf8_decode(" 
					 Don/a $nombre $apellido $apellido2, alumno/a del 2º curso 
					del Ciclo Formativo de Grado Superior $curso, se 
					compromete a realizar el módulo de FCT en la empresa que sea elegida para llevarlas a 
					efecto, en tiempo y forma, ateniéndose a las siguientes del Centro: ");

	$texto2=utf8_decode("	      1. Una vez aceptado el compromiso de realizar la FCT en el extranjero, el 
				          alumno/a no podrá renunciar, salvo por enfermedad debidamente certificada o 
				          asunto familiar grave que valorará el equipo educativo. En el caso de que la 
				          renuncia no esté justificada no podrá realizar la FCT hasta el período siguiente. 
				      2. El incumplimiento por parte de los alumnos en la realización de las horas 
				          pactadas de FCT, así como las conductas inadecuadas que den lugar a quejas por 
				          parte de la empresa, dará lugar a la calificación en dicho módulo de NO APTO. 
				      3. Una vez comenzado el período de prácticas, si el alumno o la empresa deciden 
				          interrumpirlas, el alumno deberá devolver la cantidad que le ha sido transferida 
				          con cargo al importe de la Beca Erasmus. 
				      4. Si por alguna razón ajena al Centro, el alumno pierde el billete, será su 
				          responsabilidad costearse uno nuevo. 
				      5. Es responsabilidad del alumno tener la documentación necesaria en regla. 
				      6. Todos los alumnos extranjeros deberán tener permiso de residencia vigente y el 
				          visado para el país de acogida. 
				      7. La comunicación con los tutores y responsables del proyecto será por correo 
				          electrónico, nunca a través de amigos u otros intermediarios. 
				      8. El alumno se hará cargo de que la empresa le firme el CERTIFICADO DE 
				          ESTANCIA y el ANEXO 5 de calificación de las prácticas, así como de la 
				          entrega del ANEXO 5 a su tutor de FCT. 
				      9. A su regreso, el alumno redactará y entregará a los coordinadores Erasmus el 
				          FORMULARIO DEL INFORME DEL ESTUDIANTE. 
				      10. El hecho de NO ENTREGAR la documentación a la que se hace referencia en 
				          los apartados 8 y 9 supondrá la devolución de la cantidad que le ha sido 
				          transferida con cargo al importe de la Beca Erasmus");

	
	$codigo ="262046-IC-1-2012-ES-ERASMUS-EUCX-1";
	$firma=utf8_decode("Fdo:$nombre $apellido $apellido2");

	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial', '', 10);
	$pdf->Image('logo.jpg',20,10,-200);
	$pdf->Cell(0,5,'CONVOCATORIA',0,1,'C');
	$pdf->Cell(0,5,'PROGRAMA ERASMUS',0,1,'C');
	$pdf->Cell(0,5,$fechaAnio,0,1,'C');
	$pdf->Image('programa.jpg',150,10,-200);
	$pdf->Ln(10); //Salto de linea 
	$pdf->Cell(0,7,$texto0,0,1,'C');
	$pdf->Ln(10); //Salto de linea 
	
	
	$pdf->MultiCell(0,5,$texto1,0,'L',false);
	 $pdf->Ln(10); //Salto de linea 
	$pdf->MultiCell(0,5,$texto2,0,'L',false);
	$pdf->Ln(10); //Salto de linea 
	$pdf->Cell(0,5,$fecha,0,1,'R');
	$pdf->Ln(10); //Salto de linea 
	$pdf->Ln(10); //Salto de linea 
	
	$pdf->Cell(0,5,$firma,0,1,'R');
	$pdf->Ln(10); //Salto de linea 
	$pdf->Cell(0,5,$codigo,1,1,'R');
	$pdf->Cell(20,10,'Nombre',1,0,'C');
	$pdf->Cell(20,10,'Eduardo',0,1,'C');
	//$pdf->Output();
	
	echo "guardado";


 
?>
