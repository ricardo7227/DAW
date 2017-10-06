<?php

 echo "<div id='cuerpo-centro'>";
	   $carpetanueva=$_POST['carpetaNueva'];
            $carpeta=$_POST['carpeta'];
	    $carpetaborrar=$_POST['carpetaborrar'];
	    $crear=$_POST['crear'];
	    $enviar=$_POST['enviar'];
	    $eliminar=$_POST['eliminar'];

            //Datos del arhivo
            $nombre_archivo = $_FILES['archivo']['name'];
            $tipo_archivo = $_FILES['archivo']['type'];
            $tamano_archivo = $_FILES['archivo']['size'];
	
              if(isset ($_POST['enviar']))
		{

			 if(!empty ($carpeta))// Si selecciona carpeta ya existente
		         {    
		            $destino= '/var/www/Multimedia/Imagenes/Archivos/galeriasFotos/'.$carpeta.'/imagenes/';//Carpeta donde guardo imagen

		         }     
		                    

		        if(!empty($nombre_archivo))//Verifica si se ha enviado archivo  
		        { 

		           if(is_file($destino."/".$nombre_archivo)) // Comprueba si el archivo ya existe  
		           {     
			     echo " </meta> <h2 align='center'>  GALERÍAS DE IMÁGENES </h2>
			     <div id='destino'> Ya existe un archivo con el mismo nombre en la carpeta seleccionada.<br><br> </div> 	
			     <form action='Multimedia/Gestion/GestionImagenes/gestionarFormularioImagenes.php' method='post' 	
				enctype='multipart/form-data' id='formImg'>
				<fieldset>
				    <legend> Crear Nueva Galería </legend>
				    <br> Introduzca nombre:
				    <input type='text' name='carpetaNueva' id='cn' > 
				    <input type='button' value='Crear' name='crear' id='enlaceajax2'><br>			   

				   </fieldset><br><br>
			      </form>

			     <form action='' method='post' name='miformulario' enctype='multipart/form-data' id='formImg2'>
				  <fieldset>
					    <legend> Subir Imágenes </legend>";							  
			 				
						$ruta="Multimedia/Imagenes/Archivos/galeriasFotos";

						   if (is_dir($ruta)) 
						   {
						       echo "<br> Seleccione galería :";
						       echo "<select name='carpeta' id='c' required>";
						       echo "<option></option>";


							 if ($dh = opendir($ruta)) 
							 {
							    while (($file = readdir($dh)) !== false)
							    {
								if($file!='.' and $file!='..')
								{
								  echo " <option value='$file' >$file</option>";
								}       

							     }
							   closedir($dh);
							   }
							   
							  echo "</select><br><br>";
						       }
					       echo" <br> Seleccione archivo: 
						<input  type='file' name='archivo' id='a'><br><br>
			  			<input type='submit' value='Enviar' name='enviar'>			

				    </fieldset><br><br>

				</form>";
				echo"<form action='Multimedia/Gestion/GestionImagenes/gestionarFormularioImagenes.php' method='post' 
				enctype='multipart/form-data' id='formImg3'>
				    <fieldset>
					<legend> Eliminar Galería </legend>";
				  
				       	  $ruta="Multimedia/Imagenes/Archivos/galeriasFotos";

					   if (is_dir($ruta)) 
					   {
					       echo " <br>Seleccione  galería :";
					       echo " <select name='carpetaborrar' id='cb' required>";
					       echo "<option></option>";

						 if ($dh = opendir($ruta)) 
						 {
						    while (($file = readdir($dh)) !== false)
						    {
							if($file!='.' and $file!='..')
							{
							  echo " <option value='$file'>$file</option>";
							}       

						     }
						   closedir($dh);
						   }
						   
						  echo "</select><br><br>" ;
					       }
					       
					echo"<input type='button' value='Eliminar' name='eliminar' id='enlaceajax3'><br><br>

				    </fieldset><br><br>
				</form> ";

		             }
			      else
		                  {       // Limita los archivos a subir a estos formatos           
		                        if($tipo_archivo=='image/jpg' ||$tipo_archivo=='image/jpeg' ||$tipo_archivo=='image/png')
		                        {      
		                            if (move_uploaded_file($_FILES['archivo']['tmp_name'],$destino. $nombre_archivo))
		                             {
		                                chmod($destino."/".$nombre_archivo , 0777);

						// Redimensión de imagen 

 						$img_original = imagecreatefromjpeg( $destino."/".$nombre_archivo);
						$ancho_final = 800;
						$alto_final = 480;
						list($ancho,$alto)=getimagesize( $destino."/".$nombre_archivo);//Obtiene alto y ancho original
						
						if($alto>=$alto_final or $ancho>=$ancho_final)// Establece calidad de imagen según tamaño original
					        {$calidad = 90;}
								else{$calidad=120;}
						
       						$img_destino = imagecreatetruecolor($ancho_final ,$alto_final );//Crea imagen según dimensiones dadas
       						imagecopyresized( $img_destino, $img_original, 0, 0, 0, 0, $ancho_final, $alto_final, 
						imagesx( $img_original), imagesy( $img_original) );
        					imagejpeg($img_destino, $nombre_archivo,$calidad);//Se guarda la nueva foto 
       						unlink( 'imagenes/'.$nombre_archivo );// Borra imagen original
        					rename($nombre_archivo, $destino.$nombre_archivo);// Mueve nueva imagen a carpeta imagenes
						chmod($destino."/".$nombre_archivo , 0777);// Da permisos a la imagen redimesionada
																			
					 echo "<h2 align='center'>  GALERÍAS DE IMÁGENES </h2>   
					     <div id='destino'> ¡Archivo subido con éxito!<br><br> </div> 	
					     <form action='Multimedia/Gestion/GestionImagenes/gestionarFormularioImagenes.php' method='post' 
						enctype='multipart/form-data' id='formImg'>
						<fieldset>
						    <legend> Crear Nueva Galería </legend>
						    <br> Introduzca nombre:
						    <input type='text' name='carpetaNueva' id='cn' > 
						    <input type='button' value='Crear' name='crear' id='enlaceajax2'><br>			   

						   </fieldset><br><br>
					      </form>

					     <form action='' method='post' name='miformulario' enctype='multipart/form-data' id='formImg2'>
						  <fieldset><br>
							    <legend> Subir Imágenes </legend>";							  
					 				
								$ruta="Multimedia/Imagenes/Archivos/galeriasFotos";

								   if (is_dir($ruta)) 
								   {
								       echo "<br> Seleccione galería :";
								       echo "<select name='carpeta' id='c' required>";
								       echo "<option></option>";


									 if ($dh = opendir($ruta)) 
									 {
									    while (($file = readdir($dh)) !== false)
									    {
										if($file!='.' and $file!='..')
										{
										  echo " <option value='$file' >$file</option>";
										}       

									     }
									   closedir($dh);
									   }
									   
									  echo "</select><br><br>";
								       }
							       echo" <br> Seleccione archivo: 
								<input  type='file' name='archivo' id='a'><br><br>
					  			<input type='submit' value='Enviar' name='enviar'>			

						    </fieldset><br><br>

						</form>";
						echo"<form action='Multimedia/Gestion/GestionImagenes/gestionarFormularioImagenes.php' method='post' 
						enctype='multipart/form-data' id='formImg3'>
						    <fieldset>
							<legend> Eliminar Galería </legend>";
						  
						       	  $ruta="Multimedia/Imagenes/Archivos/galeriasFotos";

							   if (is_dir($ruta)) 
							   {
							       echo " <br>Seleccione  galería :";
							       echo " <select name='carpetaborrar' id='cb' required>";
							       echo "<option></option>";

								 if ($dh = opendir($ruta)) 
								 {
								    while (($file = readdir($dh)) !== false)
								    {
									if($file!='.' and $file!='..')
									{
									  echo " <option value='$file'>$file</option>";
									}       

								     }
								   closedir($dh);
								   }
								   
								  echo "</select><br><br>" ;
							       }
							       
							echo"<input type='button' value='Eliminar' name='eliminar' id='enlaceajax3'><br><br>

						    </fieldset><br><br>
						</form> ";

		                             }
		                             else{ echo "<h2 align='center'>  GALERÍAS DE IMÁGENES </h2>
						     <div id='destino'> Ocurrió algún error al subir el fichero. No pudo guardarse.<br><br> </div> 
						     <form action='Multimedia/Gestion/GestionImagenes/gestionarFormularioImagenes.php' method='post' 
							enctype='multipart/form-data' id='formImg'>
							<fieldset>
							    <legend> Crear Nueva Galería </legend>
							    <br> Introduzca nombre:
							    <input type='text' name='carpetaNueva' id='cn' > 
							    <input type='button' value='Crear' name='crear' 					 
								id='enlaceajax2'><br>			   
							   </fieldset><br><br>
						      </form>
						    <form action='' method='post' name='miformulario' enctype='multipart/form-data' id='formImg2'>
						       <fieldset>
							<legend> Subir Imágenes </legend>";							  
						 				
									$ruta="Multimedia/Imagenes/Archivos/galeriasFotos";

									   if (is_dir($ruta)) 
									   {
									       echo "<br> Seleccione galería :";
									       echo "<select name='carpeta' id='c' required>";
									       echo "<option></option>";


										 if ($dh = opendir($ruta)) 
										 {
										    while (($file = readdir($dh)) !== false)
										    {
											if($file!='.' and $file!='..')
											{
											  echo " <option value='$file' >$file</option>";
											}       

										     }
										   closedir($dh);
										   }
										   
										  echo "</select><br><br>";
									       }
								       echo" <br> Seleccione archivo: 
									<input  type='file' name='archivo' id='a'><br><br>
						  			<input type='submit' value='Enviar' name='enviar'>			

							    </fieldset><br><br>

							</form>";
							echo"<form action='Multimedia/Gestion/GestionImagenes/gestionarFormularioImagenes.php' 								method='post' 
							enctype='multipart/form-data' id='formImg3'>
							    <fieldset>
								<legend> Eliminar Galería </legend>";
							  
							       	  $ruta="Multimedia/Imagenes/Archivos/galeriasFotos";

								   if (is_dir($ruta)) 
								   {
								       echo " <br>Seleccione  galería :";
								       echo " <select name='carpetaborrar' id='cb' required>";
								       echo "<option></option>";

									 if ($dh = opendir($ruta)) 
									 {
									    while (($file = readdir($dh)) !== false)
									    {
										if($file!='.' and $file!='..')
										{
										  echo " <option value='$file'>$file</option>";
										}       

									     }
									   closedir($dh);
									   }
									   
									  echo "</select><br><br>" ;
								       }
								       
								echo"<input type='button' value='Eliminar' name='eliminar' id='enlaceajax3'><br><br>

							    </fieldset><br><br>
							</form> ";
						 }
		                                    
		                        }
		                        else{								
						 echo "<h2 align='center'>  GALERÍAS DE IMÁGENES </h2>      
						     <div id='destino'> Formato de archivo no válido. <br><br>  </div> 	
						     <form action='Multimedia/Gestion/GestionImagenes/gestionarFormularioImagenes.php' method='post' 
							enctype='multipart/form-data' id='formImg'>
							<fieldset>
							    <legend> Crear Nueva Galería </legend>
							    <br> Introduzca nombre:
							    <input type='text' name='carpetaNueva' id='cn' > 
							    <input type='button' value='Crear' name='crear' 					 
								id='enlaceajax2'><br>			   

							   </fieldset><br><br>
						      </form>

						    <form action='' method='post' name='miformulario' enctype='multipart/form-data' id='formImg2'>
					               <fieldset>
							<legend> Subir Imágenes </legend>";							  
						 				
									$ruta="Multimedia/Imagenes/Archivos/galeriasFotos";

									   if (is_dir($ruta)) 
									   {
									       echo "<br> Seleccione galería :";
									       echo "<select name='carpeta' id='c' required>";
									       echo "<option></option>";


										 if ($dh = opendir($ruta)) 
										 {
										    while (($file = readdir($dh)) !== false)
										    {
											if($file!='.' and $file!='..')
											{
											  echo " <option value='$file' >$file</option>";
											}       

										     }
										   closedir($dh);
										   }
										   
										  echo "</select><br><br>";
									       }
								       echo" <br> Seleccione archivo: 
									<input  type='file' name='archivo' id='a'><br><br>
						  			<input type='submit' value='Enviar' name='enviar'>			

							    </fieldset><br><br>

							</form>";
							echo"<form action='Multimedia/Gestion/GestionImagenes/gestionarFormularioImagenes.php' 								method='post' 
							enctype='multipart/form-data' id='formImg3'>
							    <fieldset>
								<legend> Eliminar Galería </legend>";
							  
							       	  $ruta="Multimedia/Imagenes/Archivos/galeriasFotos";

								   if (is_dir($ruta)) 
								   {
								       echo " <br>Seleccione  galería :";
								       echo " <select name='carpetaborrar' id='cb' required>";
								       echo "<option></option>";

									 if ($dh = opendir($ruta)) 
									 {
									    while (($file = readdir($dh)) !== false)
									    {
										if($file!='.' and $file!='..')
										{
										  echo " <option value='$file'>$file</option>";
										}       

									     }
									   closedir($dh);
									   }
									   
									  echo "</select><br><br>" ;
								       }
								       
								echo"<input type='button' value='Eliminar' name='eliminar' id='enlaceajax3'><br><br>

							    </fieldset><br><br>
							</form> "; 
					}
		                                 
		                  }

		     }else{  echo "<h2 align='center'>  GALERÍAS DE IMÁGENES </h2>			     
			     <div id='destino'>Debe seleccionar un archivo. <br><br> </div> 	
			     <form action='Multimedia/Gestion/GestionImagenes/gestionarFormularioImagenes.php' method='post' 
				enctype='multipart/form-data' id='formImg'>
				<fieldset>
				    <legend> Crear Nueva Galería </legend>
				    <br> Introduzca nombre:
				    <input type='text' name='carpetaNueva' id='cn' > 
				    <input type='button' value='Crear' name='crear' 					 
					id='enlaceajax2'><br>			   

				   </fieldset><br><br>
			    </form>
			    <form action='' method='post' name='miformulario' enctype='multipart/form-data' id='formImg2'>
		               <fieldset>
				<legend> Subir Imágenes </legend>";							  
			 				
						$ruta="Multimedia/Imagenes/Archivos/galeriasFotos";

						   if (is_dir($ruta)) 
						   {
						       echo "<br> Seleccione galería :";
						       echo "<select name='carpeta' id='c' required>";
						       echo "<option></option>";


							 if ($dh = opendir($ruta)) 
							 {
							    while (($file = readdir($dh)) !== false)
							    {
								if($file!='.' and $file!='..')
								{
								  echo " <option value='$file' >$file</option>";
								}       

							     }
							   closedir($dh);
							   }
							   
							  echo "</select><br><br>";
						       }
					       echo" <br> Seleccione archivo: 
						<input  type='file' name='archivo' id='a'><br><br>
			  			<input type='submit' value='Enviar' name='enviar'>			

				    </fieldset><br><br>

				</form>";
				echo"<form action='Multimedia/Gestion/GestionImagenes/gestionarFormularioImagenes.php' 								method='post' 
				enctype='multipart/form-data' id='formImg3'>
				    <fieldset>
					<legend> Eliminar Galería </legend>";
				  
				       	  $ruta="Multimedia/Imagenes/Archivos/galeriasFotos";

					   if (is_dir($ruta)) 
					   {
					       echo " <br>Seleccione  galería :";
					       echo " <select name='carpetaborrar' id='cb' required>";
					       echo "<option></option>";

						 if ($dh = opendir($ruta)) 
						 {
						    while (($file = readdir($dh)) !== false)
						    {
							if($file!='.' and $file!='..')
							{
							  echo " <option value='$file'>$file</option>";
							}       

						     }
						   closedir($dh);
						   }
						   
						  echo "</select><br><br>" ;
					       }
					       
					echo"<input type='button' value='Eliminar' name='eliminar' id='enlaceajax3'><br><br>

				    </fieldset><br><br>
				</form> ";
			 }

               }else{
		        echo "<h2 align='center'>  GALERÍAS DE IMÁGENES </h2><br>
			<div id='destino'></div>
			  <form action='Multimedia/Gestion/GestionImagenes/gestionarFormularioImagenes.php' method='post' 
				enctype='multipart/form-data' id='formImg'>			    
				      <fieldset>
					    <legend> Crear Nueva Galería </legend>
					    <br> Introduzca nombre:
					    <input type='text' name='carpetaNueva' id='cn' > 
					    <input type='button' value='Crear' name='crear' id='enlaceajax2'><br>			   

				  </fieldset><br><br>
			 </form>
			 <form action='' method='post' name='miformulario' enctype='multipart/form-data' id='formImg2'>
				<fieldset>
				<legend> Subir Imágenes </legend>";			  
	 				
				$ruta="Multimedia/Imagenes/Archivos/galeriasFotos";

				   if (is_dir($ruta)) 
				   {
				       echo "<br> Seleccione galería :";
				       echo " <select name='carpeta' id='c' required>  ";
				       echo "<option></option>";


				         if ($dh = opendir($ruta)) 
				         {
				            while (($file = readdir($dh)) !== false)
				            {
				                if($file!='.' and $file!='..')
				                {
				                        echo " <option value='$file' >$file</option>";
				                }       

				             }
				           closedir($dh);
				           }
				           
				          echo "</select><br><br>" ;
				       }
			       echo" <br> Seleccione archivo: 
				<input  type='file' name='archivo' id='a'><br><br>
	  			<input type='submit' value='Enviar' name='enviar' >
				
		    </fieldset><br><br>

		</form>";
		echo"<form action='Multimedia/Gestion/GestionImagenes/gestionarFormularioImagenes.php' method='post' enctype='multipart/form-data' 			id='formImg3'>
			<fieldset>
				<legend> Eliminar Galería </legend>";
  
				$ruta="Multimedia/Imagenes/Archivos/galeriasFotos";

				if (is_dir($ruta)) 
				{
				    echo " <br>Seleccione  galería :";
				    echo " <select name='carpetaborrar'id='cb' required> ";
				    echo "<option></option>";

			             if ($dh = opendir($ruta)) 
				      {
					 while (($file = readdir($dh)) !== false)
					 {
					     if($file!='.' and $file!='..')
					    {
						echo " <option value='$file' >$file</option> ";
					     }       

				         }
					 closedir($dh);
				      }
								   
			            echo "</select><br><br>" ;
				 }
							  
				echo"<input type='button' value='Eliminar' name='eliminar' id='enlaceajax3'><br><br>

			</fieldset><br><br>
		</form> ";

		}
	 echo "<p id='enlaceguia'><a href='Multimedia/Gestion/GestionImagenes/GuiaUsuarioImagenes.pdf' target='_blank' id='enlaceguia'>Consultar guía del usuario
	</a></p>";		
  echo "</div>";


?>

