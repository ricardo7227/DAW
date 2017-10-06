<?php
					require("../../conexion.php");
					
					$codigo = uniqid('');
					$nombre=$_REQUEST['Nombre'];
					$Ubicacion=$_REQUEST['Ubicacion'];
					$PuestoOfer=$_REQUEST['puestoOfertado'];
					$Descripcion=$_REQUEST['descripcion'];
					$Jornada=$_REQUEST['jornada'];
					$Requisitos = $_REQUEST['requisitos'];
					$email = $_REQUEST['email'];
					$telefono = $_REQUEST['telefono'];
					$PuestosVacan = $_REQUEST['puestosVacan'];
					$fecha=$_REQUEST['fecha'];
					$rama = $_REQUEST['campo'];
					
					
				
					
					$insertar ="INSERT INTO ofertas(of_codigo,of_nombreEmpresa,of_ubicacion,of_telefono,of_email,of_puestoOfertado,of_descripcion,of_jornada,of_requisitos, of_puestosVacantes, of_fecha) VALUES ('$codigo','$nombre','$Ubicacion','$telefono','$email','$PuestoOfer','$Descripcion','$Jornada','$Requisitos','$PuestosVacan','$fecha')";
					
					mysql_query($insertar);
					
					if (empty($_FILES['imagen'])){
	
					echo "Sin fichero";
					}
	
					elseif ($rama == "Informatica"){
					$img=$_FILES["imagen"];
					$fichero_tmp = $_FILES["imagen"]["tmp_name"];
					$nombre= $_FILES["imagen"]["name"];
					$directorio_subidas = "..\..\Directorios\ofertas\Informatica\ " .$nombre;
					echo "<a href='$directorio_subidas'>".$nombre."</a>";
					move_uploaded_file($fichero_tmp, $directorio_subidas);
					}
					
					
					elseif ($rama == "Electronica"){
					$img=$_FILES["imagen"];
					$fichero_tmp = $_FILES["imagen"]["tmp_name"];
					$nombre= $_FILES["imagen"]["name"];
					$directorio_subidas = "..\..\Directorios\ofertas\Electronica\ " .$nombre;
					echo "<a href='$directorio_subidas'>".$nombre."</a>";
					move_uploaded_file($fichero_tmp, $directorio_subidas);
					}
					
					elseif ($rama == "FrioyCalor"){
					echo "ENTRA EN FRIO Y CALOR";
					$img=$_FILES["imagen"];
					$fichero_tmp = $_FILES["imagen"]["tmp_name"];
					$nombre= $_FILES["imagen"]["name"];
					$directorio_subidas = "..\..\Directorios\ofertas\FrioyCalor\ " .$nombre;
					echo "<a href='$directorio_subidas'>".$nombre."</a>";
					move_uploaded_file($fichero_tmp, $directorio_subidas);
					}
					
					elseif ($rama == "Automocion"){
					$img=$_FILES["imagen"];
					$fichero_tmp = $_FILES["imagen"]["tmp_name"];
					$nombre= $_FILES["imagen"]["name"];
					$directorio_subidas = "..\..\Directorios\ofertas\Automocion\ " .$nombre;
					echo "<a href='$directorio_subidas'>".$nombre."</a>";
					move_uploaded_file($fichero_tmp, $directorio_subidas);
					}
	

	
	echo"<br>";
	

	
	echo " 
                <script language='JavaScript'> 
                alert(' tu codigo de oferta es : $codigo '); 
				
				
                </script>";
	
	if ($codigo <> " "){
					echo "  <meta http-equiv='Refresh' content='0;url=../../../index_en.php?bolsa'>";
					
					
					}
?>

