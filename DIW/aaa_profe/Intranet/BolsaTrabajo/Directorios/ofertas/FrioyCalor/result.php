<?PHP
error_reporting(0);
?>

<html>
<head>

</head>
<body>


<ul>
<?php echo "DNI: ". $_REQUEST['DNI'];?><br>
<?php  echo "Apellidos: ".$_REQUEST['Apellidos'];?><br>
<?php echo  "Nombre: ".$_REQUEST['Nombre'];?><br>
<?php  echo "Sexo: ". $_REQUEST['Sexo'];?><br>
<?php  echo "Estado civil: ".$_REQUEST['EstadoCivil'];?><br>
<?php  echo "Nacionalidad: ".$_REQUEST['Nacionalidad'];?><br>
<?php  echo "fecha: ". $_REQUEST['fecha'];?><br>
<?php  echo "Lugar de nacimiento: ".$_REQUEST['LugarNacimiento'];?><br>
<?php echo  "Pais de nacimiento: ".$_REQUEST['PaisNacimiento'];?><br>
<?php  echo "Domicilio: ". $_REQUEST['Domicilio'];?><br>
<?php  echo "Codigo Postal: ".$_REQUEST['CodigoPostal'];?><br>
<?php echo  "Localidad: ".$_REQUEST['Localidad'];?><?php  "Texto de busqueda: ". $_REQUEST['DNI'];?><br>
<?php echo  "Telefono: ".$_REQUEST['Telefono'];?><br>
<?php  echo "Telefono 2: ".$_REQUEST['Telefono2'];?><?php  "Texto de busqueda: ". $_REQUEST['DNI'];?><br>
<?php  echo "desde: ".$_REQUEST['desde'];?><br>
<?php  echo "Estudios sin acabar: ".$_REQUEST['EstudiosSinAcabar'];?><?php  "Texto de busqueda: ". $_REQUEST['DNI'];?><br>
<?php echo  "Universidad sin acabar: ".$_REQUEST['UniversidadSinAcabar'];?><br>
<?php echo  "Final previsto: ".$_REQUEST['FinalPrevisto'];?><br>
<?php echo  "Grado: ". $_REQUEST['Grado'];?><br>
<?php  echo "Estudios acabados: ".$_REQUEST['EstudiosAcabados'];?><br>
<?php  echo "Finalizacion de estudios: ".$_REQUEST['FinalizacionEstudios'];?><br>
<?php echo  "Lugar de estudios: ".$_REQUEST['LugarEstudios'];?><br>
<?php  echo "Lengua materna: ".$_REQUEST['LenguaMaterna'];?><?php  "Texto de busqueda: ". $_REQUEST['DNI'];?><br>
<?php echo  "Ingles escrito: ".$_REQUEST['EuskeraEscri'];?><br>
<?php echo  "Ingles leido: ".$_REQUEST['EuskeraLeido'];?><br>
<?php echo  "Comprension oral de Ingles: ". $_REQUEST['EuskeraComprOral'];?><br>
<?php echo  "Frances leido".$_REQUEST['InglesLeido'];?><br>
<?php echo  "Frances escrito".$_REQUEST['InglesEscri'];?><br>
<?php echo  "campo".$_REQUEST['campo'];?><br>
<?php echo  "Comprension oral Frances ".$_REQUEST['InglesComprOral'];



echo "Inscripcion Correcta."

?>



	
<?php if (empty($_FILES['imagen']))
	
	 echo "Sin fichero";
	
	
	else
	$img=$_FILES["imagen"];
	$fichero_tmp = $_FILES["imagen"]["tmp_name"];
	$nombre= $_FILES["imagen"]["name"];
	$directorio_subidas = 'Aplicacion\curriculum\ '.$nombre;
	echo "<a href='$directorio_subidas'>".$nombre."</a>";
	move_uploaded_file($fichero_tmp, $directorio_subidas);// 
	
	?>
	
</ul>


</body>
</form>
</html>