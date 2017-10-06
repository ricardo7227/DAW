<?php
  error_reporting(0);    
  echo "<div id='cuerpo-centro'>
          <h1>GESTIONAR SOCIOS</h1>";
 
  
  echo 
        '<ul class="mi-menu2">
            <li><a href="index.php?ampsocges">Inicio</a></li>
            <li><a href="index.php?ampsocgesalta">Alta Socio</a></li>
            <li><a href="index.php?ampsocgesbusqueda">Buscar Socio</a></li>
            <li><a href="index.php?ampsocgespagar">Pagar Cuota</a></li>
            <li><a href="index.php?opcion=logout">Salir</a></li>
        </ul>';
  echo 
    '<div id="content">
        <h2 id="AmpaSubtitulo">ALTA SOCIO</h2>
        <form action="index.php?ampsocgesalta" method="POST">
        <fieldset>
            <legend id="AmpaLegend">INFORMACION PERSONAL</legend><br/>
        <table id="AmpaTabla">
            <tr>
                <td>
                    <label>A&ntilde;o de inscripci&oacute;n (aaaa)(*) ..</label>
                </td>
                <td>
                    <input type="text" maxlength="4" name="anio" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Nombre (*) ..................................</label>
                </td>
                <td>
                    <input type="text" name="nombre" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Primer Apellido (*) ...................</label>
                </td>
                <td>
                    <input type="text" name="apellido1" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Segundo Apellido (*) ................</label>
                </td>
                <td>
                    <input type="text" name="apellido2" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label>DNI (sin guiones) (*) .................</label>
                </td>
                <td>
                    <input type="text" name="dni" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Provincia ....................................</label>
                </td>
                <td>
                    <input type="text" name="provincia" value="Madrid">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Poblacion ....................................</label>
                </td>
                <td>
                    <input type="text" name="poblacion" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Domicilio .....................................</label>
                </td>
                <td>
                    <input type="text" name="domicilio" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Codigo Postal ............................</label>
                </td>
                <td>
                    <input type="text" name="cp" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Email ............................................</label>
                </td>
                <td>
                    <input type="text" name="email" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Telefono Movil (*).......................</label>
                </td>
                <td>
                    <input type="text" name="telef1" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Telefono Fijo ..............................</label>
                </td>
                <td>
                    <input type="text" name="telef2" value="">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <br><input type="submit" id="botonenviar" name="enviar" value="Guardar Datos">
                </td>
            </tr>
        </table> 
       
        </form>';
        if($_POST['enviar']=='Guardar Datos')
        {
            if($_POST['nombre']!='' && $_POST['anio']!=''&& $_POST['apellido1']!=''&& $_POST['apellido2']!=''&& $_POST['dni']!=''&& $_POST['telef1']!='' )
            {    
            
            
            $vdni = strtoupper($_POST['dni']);
            $vnom = strtoupper($_POST['nombre']);
            $ap1 = strtoupper($_POST['apellido1']);
            $ap2 = strtoupper($_POST['apellido2']);
            $query = "INSERT INTO socios (so_dni, so_nombre, so_apell1, so_apell2, so_direcc, so_codpos, so_poblac, so_provin, so_email, so_telef1, so_telef2, so_fecha)" .
							" VALUES (
                                                               	'".$vdni."', 
								'".$vnom."', 
								'".$ap1."',
								'".$ap2."',
                                                                '".$_POST['domicilio']."',
                                                                '".$_POST['cp']."',
                                                                '".$_POST['poblacion']."',
                                                                '".$_POST['provincia']."',
                                                                '".$_POST['email']."',
                                                                '".$_POST['telef1']."',
								'".$_POST['telef2'] ."',
                                                                '".$_POST['anio'] ."'
								);";
              if(mysql_query($query))
              {    
                echo '<p id="AmpaError">El socio se ha dado de alta correctamente.</p>  </fieldset>';
              }
              else
              {
                echo '<p id="AmpaError">El numero de DNI es igual a una ya existente.</p>';
              }
                
            }
            else
            {
                echo '<p id="AmpaError">Los campos con (*) no pueden estar en blanco.</p>';
            }
        }
        echo'</div>';
   
  echo "</div>";

  
?>
