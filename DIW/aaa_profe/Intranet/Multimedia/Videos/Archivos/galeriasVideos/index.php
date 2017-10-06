<!DOCTYPE html>
	<head>	
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" href="index_videolb/videolightbox.css" type="text/css" />
		<link rel="stylesheet" type="text/css" href="index_videolb/overlay-minimal.css"/>
		<script src="index_videolb/jquery.js" type="text/javascript"></script>
		<script src="index_videolb/swfobject.js" type="text/javascript"></script>
		<script src="index_videolb/jquery.tools.min.js" type="text/javascript"></script>
		<script src="index_videolb/videolightbox.js" type="text/javascript"></script>
	  
	</head>
	<body>

	<br><br><h2 class="titselectorvid"> GALERÍA DE VÍDEOS </h2>

         <div class="selectorvid" >
		<div class="videogallery">

		 <!-- Código PHP que genera galería de vídeos automática a partir de los archivos contenidos en carpeta vídeo -->
		   <?php

		      $directorio = opendir("index_videolb/video"); //Ruta actual donde están los vídeos
		      
		        while ($archivo = readdir($directorio))//Obtiene archivos sucesivamente
		        {
		            if (is_dir($archivo))//verificamos si es o no un directorio
		            {// si es directorio no hace nada
		             }
		              else//si no lo es muestra el vídeo y su nombre(alt)
		                  {
		                  
			              if($archivo !='Thumbs.db')
			              {   
			                $nombre1=substr($archivo,0,-4);  
   
			                 echo "<a class='voverlay' href='index_videolb/vdbplayer.swf?volume=100&url=video/$archivo' title='$nombre1'>
			                  <img src='index_videolb/thumbnails/imgvideo.png' alt='$nombre1'/ class='iconoimg'>
					  <strong><p class='pselectorvid'>$nombre1</p><strong> </a>";
			                }

		                  }          
		           }
		      ?>        

		</div>
            </div>
	</body>
</html>


