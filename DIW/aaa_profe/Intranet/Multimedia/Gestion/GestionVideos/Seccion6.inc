 <?php

 echo "<div id='cuerpo-centro'>";

	$video=$_POST['video'];
	$videoborrar=$_POST['videoborrar'];  
	$enviar=$_POST['enviar'];
	$eliminar=$_POST['eliminar'];
 
        //Datos del arhivo
	$nombre_archivo = $_FILES['video']['name'];
        $tipo_archivo = $_FILES['video']['type'];
        $tamano_archivo = $_FILES['video']['size'];

		if(!empty ($_POST['enviar']))
		{            
		    $destino= '/var/www/Multimedia/Videos/Archivos/galeriasVideos/index_videolb/video/';//Carpeta donde guardo vídeos              
		     if(is_file($destino."/".$nombre_archivo)) // Comprueba si el archivo ya existe  
		     {       
			echo " <h2 align='center'>  GALERÍA DE VÍDEOS </h2>
			<div id='mensajes'>Ya existe un archivo con el mismo nombre. <br><br></div>
			<form action='' method='post' enctype='multipart/form-data' id='formVid1'>
			     <fieldset>
				<legend> Subir nuevo Vídeo </legend>						 
				 <br> Seleccione archivo: 
				 <input name='video' type='file' id='vi'><br><br>
				 <input type='submit' value='Enviar' name='enviar'>
			    </fieldset><br><br>
			</form>
			<form action='Multimedia/Gestion/GestionVideos/gestionarFormularioVideos.php' method='post' 				      			       enctype='multipart/form-data' id='formVid2'>
			   <fieldset>
				<legend> Eliminar Vídeo </legend>";
			       	  $ruta="Multimedia/Videos/Archivos/galeriasVideos/index_videolb/video";
				   if (is_dir($ruta)) 
				   {
				       echo " <br>Seleccione  vídeo :";
				       echo " <select name='videoborrar' id='vb' required>  ";
				       echo "<option></option>";

					 if ($dh = opendir($ruta)) 
					 {
					    while (($file = readdir($dh))!== false)
					    {
						if($file!='.' and $file!='..' and $file!='Thumbs.db')
						{
						    echo " <option value='$file' >$file</option> ";
						}       

					     }
					   closedir($dh);
					   }
					   
					  echo "</select><br><br>" ;
				       }				       

				 echo " <input type='button' value='Eliminar' name='eliminar' id='enlaceajax4'><br><br>

			    </fieldset><br><br>
			</form>"; 	
	
		   }
		   else{

			if($tamano_archivo<=31457280)// Tamaño límite de vídeos en bytes (LÍMITE ACTUAL: 30 MB)
			{

                            if (move_uploaded_file($_FILES['video']['tmp_name'],$destino. $nombre_archivo))
                             {
                                chmod($destino.$nombre_archivo , 0777);
				echo " <h2 align='center'>  GALERÍA DE VÍDEOS </h2>
				<div id='mensajes'>¡Archivo cargado correctamente! <br><br></div>
				<form action='' method='post' enctype='multipart/form-data' id='formVid1'>
				     <fieldset>
					<legend> Subir nuevo Vídeo </legend>					 
					 <br> Seleccione archivo: 
					 <input name='video' type='file' id='vi'><br><br>
					 <input type='submit' value='Enviar' name='enviar'>
				    </fieldset><br><br>
				</form>
				<form action='Multimedia/Gestion/GestionVideos/gestionarFormularioVideos.php' method='post' 					enctype='multipart/form-data' id='formVid2'>
				   <fieldset>
					<legend> Eliminar Vídeo </legend>";
			 	
				       	  $ruta="Multimedia/Videos/Archivos/galeriasVideos/index_videolb/video";

					   if (is_dir($ruta)) 
					   {
					       echo " <br>Seleccione  vídeo :";
					       echo " <select name='videoborrar' id='vb' required>  ";
					       echo "<option></option>";

						 if ($dh = opendir($ruta)) 
						 {
						    while (($file = readdir($dh))!== false)
						    {
							if($file!='.' and $file!='..' and $file!='Thumbs.db')
							{
							    echo " <option value='$file' >$file</option> ";
							}       

						     }
						   closedir($dh);
						   }
						   
						  echo "</select><br><br>" ;
					       }				       		
					 echo " <input type='button' value='Eliminar' name='eliminar' id='enlaceajax4'><br><br>
				    </fieldset><br><br>
				</form>";               
			} else
                              {
				echo " <h2 align='center'>  GALERÍA DE VÍDEOS </h2>				
				<div id='mensajes'> Ocurrió algún error al subir el fichero.<br><br></div>			   
				<form action='' method='post' enctype='multipart/form-data' id='formVid1'>
				     <fieldset>
					<legend> Subir nuevo Vídeo </legend>						 
					 <br> Seleccione archivo: 
					 <input name='video' type='file' id='vi'><br><br>
					 <input type='submit' value='Enviar' name='enviar'>

				    </fieldset><br><br>
				</form>
				<form action='Multimedia/Gestion/GestionVideos/gestionarFormularioVideos.php' method='post' 					 enctype='multipart/form-data' id='formVid2'>
				   <fieldset>
					<legend> Eliminar Vídeo </legend>";
				       	  $ruta="Multimedia/Videos/Archivos/galeriasVideos/index_videolb/video";
					   if (is_dir($ruta)) 
					   {
					       echo " <br>Seleccione  vídeo :";
					       echo " <select name='videoborrar' id='vb' required>  ";
					       echo "<option></option>";

						 if ($dh = opendir($ruta)) 
						 {
						    while (($file = readdir($dh))!== false)
						    {
							if($file!='.' and $file!='..' and $file!='Thumbs.db')
							{
							    echo " <option value='$file' >$file</option> ";
							}       

						     }
						   closedir($dh);
						   }
						   
						  echo "</select><br><br>" ;
					       }				       
	
					 echo " <input type='button' value='Eliminar' name='eliminar' id='enlaceajax4'><br><br>
				    </fieldset><br><br>
				  </form>"; 
                         	}

		         }else{
				
			  	echo " <h2 align='center'>  GALERÍA DE VÍDEOS </h2>
				<div id='mensajes'> El archivo excede el tamaño máximo.<br><br></div>			   
				<form action='' method='post' enctype='multipart/form-data' id='formVid1'>
				     <fieldset>
					<legend> Subir nuevo Vídeo </legend>
					 <br> Seleccione archivo: 
					 <input name='video' type='file' id='vi'><br><br>
					 <input type='submit' value='Enviar' name='enviar'>
				    </fieldset><br><br>
				   </form>	
			          <form action='Multimedia/Gestion/GestionVideos/gestionarFormularioVideos.php' method='post' 
			          enctype='multipart/form-data' id='formVid2'>
				   <fieldset>
					<legend> Eliminar Vídeo </legend>";
				       	  $ruta="Multimedia/Videos/Archivos/galeriasVideos/index_videolb/video";

					   if (is_dir($ruta)) 
					   {
					       echo " <br>Seleccione  vídeo :";
					       echo " <select name='videoborrar' id='vb' required>  ";
					       echo "<option></option>";

						 if ($dh = opendir($ruta)) 
						 {
						    while (($file = readdir($dh))!== false)
						    {
							if($file!='.' and $file!='..' and $file!='Thumbs.db')
							{
							    echo " <option value='$file' >$file</option> ";
							}       
						     }
						   closedir($dh);
						   }
						   
						  echo "</select><br><br>" ;
					       }				       		
					 echo " <input type='button' value='Eliminar' name='eliminar' id='enlaceajax4'><br><br>
				    </fieldset><br><br>
				</form>"; 

			       }

		  }

                } 
		else{			
			echo " <h2 align='center'>  GALERÍA DE VÍDEOS </h2><br>
			<div id='mensajes'></div>
			<form action='' method='post' enctype='multipart/form-data' id='formVid1'>
			     <fieldset>
				<legend> Subir nuevo Vídeo </legend>
				 <br> Seleccione archivo: 
				 <input name='video' type='file' id='vi'><br><br>
				 <input type='submit' value='Enviar' name='enviar'>
			    </fieldset><br><br>
			</form>	
			<form action='Multimedia/Gestion/GestionVideos/gestionarFormularioVideos.php' method='post' enctype='multipart/form-data' 
				id='formVid2'>
			   <fieldset>
				<legend> Eliminar Vídeo </legend>";
			       	  $ruta="Multimedia/Videos/Archivos/galeriasVideos/index_videolb/video";

				   if (is_dir($ruta)) 
				   {
				       echo " <br>Seleccione  vídeo :";
				       echo " <select name='videoborrar' id='vb' required>  ";
				       echo "<option></option>";

				         if ($dh = opendir($ruta)) 
				         {
				            while (($file = readdir($dh))!== false)
				            {
				                if($file!='.' and $file!='..' and $file!='Thumbs.db')
				                {
				                    echo " <option value='$file' >$file</option> ";
				                }       
				             }
				           closedir($dh);
				           }
				           
				          echo "</select><br><br>" ;
				       }				       		
				 echo " <input type='button' value='Eliminar' name='eliminar' id='enlaceajax4'><br><br>
			    </fieldset><br><br>
			</form>"; 
		     }
 	echo "<p id='enlaceguia'><a href='Multimedia/Gestion/GestionVideos/GuiaUsuarioVideos.pdf' target='_blank' id='enlaceguia'>
	Consultar guía del usuario </a></p>";
   echo "</div>";

?>
