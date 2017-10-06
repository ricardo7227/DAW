<!DOCTYPE html>
<html>
<head>
    
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    
    <!-- Incluimos los archivos Javascript externos -->
    <script src='jquery.js'></script>
    <script src='amazingslider.js'></script>
    <script src='initslider-1.js'></script>

    <style>

      a{
	font-family:Tahoma;
	font-size:13px;
	color:#2E2E2E;
	text-decoration:none;}

      p{
	text-align:right;}

    </style>				
     
</head>
<body bgcolor="transparent"><br>


    <!-- Div contenedor general -->
    <div style="margin:70px auto;max-width:900px;">


        <!-- Div donde se muestran las imágenes -->
        <div id="amazingslider-1" style="display:block;position:relative;margin:16px auto 86px;">
           
            <ul class="amazingslider-slides" style="display:none;">
                
             <!-- Código PHP que genera galería de fotos automática a partir de los archivos contenidos en carpeta imagenes -->
              <?php

               $directorio = opendir("imagenes"); //Ruta actual donde se encuentran las imágenes

                 while ($archivo = readdir($directorio))//Obtiene archivos sucesivamente
                 {
                    if (is_dir($archivo))//verificamos si es o no un directorio
                    {// si es directorio no hace nada
                     }
                      else//si no lo es muestra la imagen y su nombre(alt)
                          {
                            echo "<li>
                                <img src='imagenes/$archivo'/ alt='$archivo'/>
                             </li> ";
                            
                            }     
                        }
                ?>        

            </ul>


        <!-- Div inferior donde se muestran barra con miniaturas--> 
          <ul class="amazingslider-thumbnails" style="display:none;">

          <!-- Código PHP que genera galería de miniaturas automática en la parte inferior, a partir de los archivos contenidos en carpeta imagenes -->
                    <?php

                 $directorio = opendir("imagenes"); //ruta actual 

                  while ($archivo = readdir($directorio))//Obtiene archivos sucesivamente
                  {
                    if (is_dir($archivo))
                           //verificamos si es o no un directorio
                     {// si es directorio no hace nada
                     }
                     else//si no lo es muestra la imagen 
                         {
                          echo "<li>
                               <img src='imagenes/$archivo'/>                     
                           </li> ";
                         }     
                 }
                 
                ?>        

            </ul>
        </div>  

    </div><br><br>
    <p>
       <a href="../../panelGalerias.php">  Volver al panel de Galerías
	  <img src="../../iconos/flecha.png" height="40px" width="40px" align="right">
       </a>
    </p>


</body>
</html>
