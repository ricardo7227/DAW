
<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
      <style>
	 
         .selectorimg{ height:450px; width:700px; margin-top:10px; margin-left:90px; padding-top:50px;
		       padding-left: 50px; overflow-x:hidden; background:transparent;} 

           #uno{height:70px; width:100px; padding-left:30px; padding-bottom:30px;} 

           a:link { text-decoration:none;}  

	   h2 {color:white; text-align:center;text-shadow: 2px 1px black; font-family:Tahoma;}

       </style>   
    </head>
    
    <body>

      <br><br><h2> GALERÍAS DE IMÁGENES </h2>

      <div class="selectorimg" >
		
        <?php

          error_reporting(0);
          $ruta="galeriasFotos";
      
                if ($dh = opendir($ruta)) 
                {              
                                             
                   $directorio = opendir("galeriasFotos"); 
                
                   while($archivo = readdir($directorio))
                   {                  
                            $cont=1;  
                            $carpeta=$ruta."/".$archivo."/imagenes";                                    
                            $directorio1 = opendir($carpeta);

                            while($archivo1 = readdir($directorio1))
                            {               
                                if (is_dir($archivo1))
                                { // Si es un directorio no hace nada
                                }
                                else{
                                        while($cont<2)
                                        {                
                                          
                                           echo " <a href='galeriasFotos/$archivo/index.php'>
                                                   <img src='$carpeta/$archivo1' alt='$archivo' title='$archivo' id='uno'/>
                                                </a>";
                                            
                                            $cont++; 
                                            
                                         }                                
                                     }
                           
                             } 
                                                       
                    }
                       
                   
                closedir($dh);
              }
        ?>

       </div>
        
    </body>
</html>

