	<?php
	
	require('fpdf/fpdf.php');
	$nombreApe=$_POST['nombreApe'];
	
	$dir=$_POST['dir'];
	$dni=$_POST['nif'];
	$curso=$_POST['curso'];	
	
	$email=$_POST['email'];	
	$nacimiento=$_POST['nacimiento'];	
	$tlfM=$_POST['tlfM'];	
	$tlfF=$_POST['tlfF'];	
	$idioma=$_POST['idioma'];	
	$curso=$_POST['curso'];
	$nota=$_POST['nota'];
	
	if(filter_var($email, FILTER_VALIDATE_EMAIL) && is_numeric($tlfM) && is_numeric($tlfF) && is_numeric($nota) && ($nombreApe!='')  && ($dir!='') && ($curso!='') && ($nacimiento!='')
			&& ($idioma!='') && ($curso!='')) {
	    	$texto0=utf8_decode("SOLICITUD DE INSCRIPCIÓN");
	
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial', '', 10);
		$pdf->Image('img/logo.jpg',20,10,-200);
		$pdf->Cell(0,5,'CONVOCATORIA',0,1,'C');
		$pdf->Cell(0,5,'PROGRAMA ERASMUS',0,1,'C');
		$pdf->Cell(0,5,$fechaAnio,0,1,'C');
		$pdf->Image('img/programa.jpg',150,10,-200);
		$pdf->Ln(10); //Salto de linea 
		$pdf->Cell(0,7,$texto0,0,1,'C');
		$pdf->Ln(10); //Salto de linea 
	
		//tabla
	
		$pdf->Cell(160,10,'Datos Personales',1,1,'C');
	
		$pdf->SetFillColor('176','172','172'); 
		$pdf->Cell(50,10,'Nombre y apellido',1,0,'L',True);
		$pdf->Cell(110,10,"$nombreApe",1,1,'L');
	
		$pdf->SetFillColor('176','172','172'); 
		$pdf->Cell(50,10,utf8_decode("Dirección"),1,0,'L',True);
		$pdf->Cell(110,10,"$dir",1,1,'L');

		$pdf->SetFillColor('176','172','172'); 
		$pdf->Cell(50,10,'NIF',1,0,'L',True);
		$pdf->Cell(110,10,"$dni",1,1,'L');

		$pdf->SetFillColor('176','172','172'); 
		$pdf->Cell(50,10,utf8_decode('Correo Electrónico'),1,0,'L',True);
		$pdf->Cell(110,10,"$email",1,1,'L');

		$pdf->SetFillColor('176','172','172'); 
		$pdf->Cell(50,10,'Fecha de nacimiento',1,0,'L',True);
		$pdf->Cell(110,10,"$nacimiento",1,1,'L');

		$pdf->SetFillColor('176','172','172'); 
		$pdf->Cell(50,10,utf8_decode('Teléfono'),1,0,'L',True);
		$pdf->Cell(55,10,"fijo:$tlfF",1,0,'L');
		$pdf->Cell(55,10,utf8_decode("móvil:$tlfM"),1,1,'L');

		$pdf->SetFillColor('176','172','172'); 
		$pdf->Cell(50,10,utf8_decode('Idioma de elecion'),1,0,'L',True);
		$pdf->Cell(110,10,utf8_decode($idioma),1,1,'L');

		$pdf->SetFillColor('176','172','172'); 
		$pdf->Cell(50,10,utf8_decode('Curso Académico'),1,0,'L',True);
		$pdf->Cell(110,10,"$curso",1,1,'L');

		$pdf->SetFillColor('176','172','172'); 
		$pdf->Cell(160,10,"Nota media del primer curso:$nota" ,1,1,'L');
		$pdf->Ln(10); //Salto de linea 
		$pdf->Ln(10); //Salto de linea 
		$pdf->Cell(160,10,'DOCUMENTOS A PRESENTAR ',0,1,'L');
	
		$var= utf8_decode("    . Certificado de notas del primer curso.
					    . Fotocipia DNI
					    . Carta de motivación en inglés en la que el esstudiante explique por qué quiere 
						     obtener una beca de movilidad ERASMUS.");

		$pdf->MultiCell(0,5,$var,0,'L',false);
		//$pdf->Output();
	
		$pdf->Output("pdfGenerados/$dni.pdf","F"); 
	

	 	
	      
	      
	       
		$asunto="Programa erasmus";
	     	  $from = "From:" . $nombreApe."@Erasmus.es";
		  $para= "sagsag@hotmail.es";
		$mensaje="Se ha registrado en el programa erasmus $nombreApe ";
	       
		mail($para,$asunto,$mensaje,$from);
			
		
	
		echo "<br>Su Solicitud a sido realizada con exito<br>";
		echo "<a href='http://localhost/index.php?erasmus'>Para volver, pinche en este enlace</a>";
		session_write_close();
	}

	else{
		echo "Alguno de los datos introducidos no son correctos, reviselos <br><a href='http://localhost/index.php?era_form'>Para volver, pinche en este enlace</a>";
	}
	
	
	
?>	
	
 

