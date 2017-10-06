<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
        <title> Formulario Imágenes</title>
    </head>
    <body>
        
        <?php
           
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

                if(!empty ($carpetanueva))// Si envía datos en la opción de crear carpeta
                {    
                        $destino='/var/www/Multimedia/Imagenes/Archivos/galeriasFotos/'.$carpetanueva;// Carpeta donde se guardan las imágenes

                        if(is_dir($destino))// Mira si esta carpeta ya existe
                       { 
                           echo "Ya existe una carpeta con el mismo nombre. <br><br>";
                          
                       }else{// Si no existe
                                mkdir($carpetanueva);// Crea carpeta nueva 
				chmod($carpetanueva,0777);// Da permisos a la carpeta
                            	rename($carpetanueva, "/var/www/Multimedia/Imagenes/Archivos/galeriasFotos/".$carpetanueva);// Mueve carpeta a galería
                                mkdir('imagenes');// Crea carpeta imágenes
				chmod('imagenes',0777);                    
                                rename('imagenes', "/var/www/Multimedia/Imagenes/Archivos/galeriasFotos/".$carpetanueva."/imagenes"); //Mueve imágenes 
				copy ('/var/www/Multimedia/Imagenes/Archivos/iconos/index.php', 
				 '/var/www/Multimedia/Imagenes/Archivos/galeriasFotos/'.$carpetanueva.'/index.php');
				chmod('/var/www/Multimedia/Imagenes/Archivos/galeriasFotos/'.$carpetanueva.'/index.php',0777);  
                                echo "¡ La carpeta ha sido creada con éxito !<br><br>";
                             }               

                }
              
		
		if(!empty($carpetaborrar))// Si envía datos en la opción de crear carpeta
                {    
		     $borraIndex='/var/www/Multimedia/Imagenes/Archivos/galeriasFotos/'.$carpetaborrar.'/index.php';
		     $borraCarImg='/var/www/Multimedia/Imagenes/Archivos/galeriasFotos/'.$carpetaborrar.'/imagenes';		
		     $borraGaleria='/var/www/Multimedia/Imagenes/Archivos/galeriasFotos/'.$carpetaborrar;			   
		     unlink($borraIndex);// Elimina el archivo index.php
		     $borrarImg = opendir('/var/www/Multimedia/Imagenes/Archivos/galeriasFotos/'.$carpetaborrar.'/imagenes');
 
		     while ($archivo = readdir($borrarImg))//Obtiene archivos sucesivamente
			{
			   	
			   if (is_dir($archivo))//verificamos si es o no un directorio
			   {// si es directorio no hace nada
			    }
			    else//si no lo es muestra la imagen y su nombre(alt)
			      {
			        unlink($borraCarImg.'/'.$archivo);
			      }   						
			 }
				
		     rmdir ($borraCarImg);// Elimina la carpeta imágenes	
                     rmdir ($borraGaleria);// Elimina la carpeta indicada
		     echo ( "!La galería ha sido eliminada con éxito!<br><br>");
		}


        ?>

    </body>
</html> 
 
