<?php
					require("conexion.php");
					
					$dni=$_REQUEST['DNI'];
					$apellido1=$_REQUEST['Apellidos1'];
					$apellido2=$_REQUEST['Apellidos2'];
					$nombre=$_REQUEST['Nombre'];
					$sexo=$_REQUEST['Sexo'];
					$estadoCivil = $_REQUEST['EstadoCivil'];
					$nacionalidad = $_REQUEST['Nacionalidad'];
					$fecha=$_REQUEST['fecha'];
					$lugarNacimiento=$_REQUEST['LugarNacimiento'];
					$paisNacimiento=$_REQUEST['PaisNacimiento'];
					$domicilio=$_REQUEST['Domicilio'];
					$codigoPostal=$_REQUEST['CodigoPostal'];
					$localidad=$_REQUEST['Localidad'];
					$telefono=$_REQUEST['Telefono'];
					$telefono2=$_REQUEST['Telefono2'];
					$email=$_REQUEST['Email'];
					$estudiosSinAcabar=$_REQUEST['EstudiosSinAcabar'];
					$universidadSinAcabar=$_REQUEST['UniversidadSinAcabar'];
					$finalPrevisto=$_REQUEST['FinalPrevisto'];
					$grado=$_REQUEST['Grado'];
					$estudiosAcabados=$_REQUEST['EstudiosAcabados'];
					$finalizacionEstudios=$_REQUEST['FinalizacionEstudios'];
					$lugarEstudios=$_REQUEST['LugarEstudios'];
					$lenguaMaterna=$_REQUEST['LenguaMaterna'];
					$inglesescrito=$_REQUEST['InglesEscri'];
					$inglesLeido=$_REQUEST['InglesLeido'];
					$inglesOral=$_REQUEST['InglesComprOral'];
					$francesEscrito=$_REQUEST['FrancesEscri'];
					$francesLeido=$_REQUEST['FrancesLeido'];
					$francesOral=$_REQUEST['FrancesOral'];
					
					$insertar = mysqli_query($cn, "INSERT INTO curricula (curricula`(`cv_dni`, `cv_apellido1`, `cv_apellido2`, `cv_nombre`, `cv_sexo`, `cv_estadocivil`, `cv_nacionalidad`, `cv_fechaNacimiento`, `cv_lugardenacimiento`, `cv_paisdenacimiento`, `cv_domicilio`, `cv_codigopostal`, `cv_localidad`, `cv_telefono`, `cv_telefono2`, `cv_email`, `cv_estudiossinacabar`, `cv_universidadsinacabar`, `cv_finalprevisto`, `cv_grado`, `cv_estudiosacabados`, `cv_finalizaciondeestudios`, `cv_lugardeestudios`, `cv_lenguamaternna`, `cv_inglesescrito`, `cv_inglesleido`, `cv_inglesoral`, `cv_francesleido`, `cv_francesescito`, `cv_francesoral`) VALUES ('$dni', '$apellido1', '$apellido2', '$nombre', '$sexo', '&estadoCivil', '$nacionalidad', '$fecha', '$lugarNacimiento', '$paisNacimiento', '$domicilio', '$codigoPostal', '$localidad', '$telefono', '$telefono2', '$email', '$estudiosSinAcabar', '$universidadSinAcabar', '$finalPrevisto', '$grado', '$estudiosAcabados', '$finalizacionEstudios', '$lugarEstudios', '$lenguaMaterna', '$inglesescrito', '$inglesLeido', '$inglesOral', '$francesEscrito', '$francesLeido', '$francesOral')");
					if (!$insertar){echo "Error al guardar";}else{echo "Guardado con exito";};
					mysqli_close($enlace);
					
?>