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
        <h2 id="AmpaSubtitulo">PAGAR CUOTA SOCIO</h2>
        <form action="index.php?ampsocgespagar" method="POST">
        <fieldset>
            <legend id="AmpaLegend">INFORMACION DE CUOTA ANUAL SOCIO</legend><br/>

        <table id="AmpaTabla" >
            <tr>
                <td>
                    <label>DNI Socio (sin guiones) (*)............</label>
                </td>
                <td>
                    <input type="text" name="cdni" value="00000000X">
                </td>
            </tr>
            <tr>
                <td>
                    <label>A&ntilde;o de Cuota (nnnn)(*)..................</label>
                </td>
                <td>
                    <input type="text" name="canio" value="0000">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Fecha de Pago (dd/mm/aaaa)(*)..</label> 
                </td>
                <td>
                    <input type="text" name="cfecha" value="00/00/0000">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Importe de Cuota (n.nn)(*)...........</label>
                </td>
                <td>
                    <input type="text" name="cimporte" value="0.00">
                </td>
            </tr>
            
                <td colspan="2">
                    <br><input type="submit" id="botonenviar" name="enviar" value="Guardar Datos">
                </td>
            </tr>
        </table> 
        </form>';
        if($_POST['enviar']=='Guardar Datos')
        {
            if($_POST['cdni']!=''&&$_POST['canio']!=''&&$_POST['cfecha']!=''&&$_POST['cimporte']!='')
            {
                $dni = strtoupper($_POST['cdni']);
            
                $query='select * from socios where so_dni="'. $dni. '"';
                
                $socio = mysql_fetch_assoc(mysql_query('select * from socios where so_dni="'. $dni. '"'));
                echo '<h2> Cofirme si el nombre de socio y cuota anual son correctos :</h2>
                      <h3>'.$socio['so_nombre'].' '.$socio['so_apell1'].' '.$socio['so_apell2'].'<br/>Pagar cuota del a&ntilde;o '.$_POST['canio'].' importe '.$_POST['cimporte'].' euros</h3>';                                   
            
                echo '<form action="index.php?ampsocgespagar" method="POST">
                        <br/>
                        <input type="submit" id="botonenviar" name="boton1" value="Aceptar">
                        <input type="submit" id="botonenviar" name="boton2" value="Rechazar">
                        <input type="hidden" name="cdni" value="'.$_POST['cdni'].'">
                        <input type="hidden" name="canio" value="'.$_POST['canio'].'">
                        <input type="hidden" name="cfecha" value="'.$_POST['cfecha'].'">
                        <input type="hidden" name="cimporte" value="'.$_POST['cimporte'].'">
                    </form>';
            }
            else 
            {
                echo '<p id="AmpaError">Los campos con (*) no pueden estar en blanco.</p>';
            }
        }
        if($_POST['boton1']=='Aceptar')
        {
            
            $fechaemision=$_POST['cfecha'];
            $expl = explode("/", $fechaemision);
            $fechEmision = $expl[2] . "-" . $expl[1] . "-" . $expl[0];
                    
            $dni = strtoupper($_POST['cdni']);
            
            $query = "INSERT INTO cuotas_socios(cs_codigo, cs_dni, cs_anio_cuota, cs_fecha_emision, cs_importe)" .
							" VALUES (
                                                                '"."', 
								'".$dni."', 
								'".$_POST['canio']."', 
								'".$fechEmision ."',
								'".$_POST['cimporte']."'
                                                                );";
            if(mysql_query($query))
            { 
                echo '<p id="AmpaError">Los datos se han guardado corectamente</p>';
            }
            else
            {
                echo '<p id="AmpaError">El numero de DNI no esta dado de alta aun como socio del AMPA vuelva a introducir los datos</p>';
            }
        }
        if($_POST['boton2']=='Rechazar')
        {
            echo '<p id="AmpaError">Vuelva a introducir los datos</p>';
        }
            
          
            //$nombrecli=mysql_fetch_assoc(mysql_query('select * from clientes where id_cliente='.$cliente.''));
              
            
         echo '</fieldset>';
        
        echo'</div>';
   
  echo "</div>";

  
?>
