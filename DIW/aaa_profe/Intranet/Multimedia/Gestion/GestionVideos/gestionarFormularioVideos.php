<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
        <title> Formulario Vídeos</title>
    </head>
    <body>       
        <?php
          
            $video=$_POST['video'];
	    $videoborrar=$_POST['videoborrar'];
	    $enviar=$_POST['enviar'];
	    $eliminar=$_POST['eliminar'];

            //Datos del arhivo
	    $nombre_archivo = $_FILES['video']['name'];
            $tipo_archivo = $_FILES['video']['type'];
            $tamano_archivo = $_FILES['video']['size'];

		if(!empty($videoborrar))// Si envía datos en la opción de crear carpeta
                {    
		     $borrarVideo='/var/www/Multimedia/Videos/Archivos/galeriasVideos/index_videolb/video/'.$videoborrar;		
                     unlink($borrarVideo);// Elimina la carpeta indicada
		      echo ( "¡El vídeo ha sido eliminado con éxito!<br><br>");
		}

        ?>
    </body>
</html>  
