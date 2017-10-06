<?php

/* <select name="entradalista">
           <option>DNI</option>
           <option>Nonbre</option>
           <option>Primer Apellido</option>
        </select>*/

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
echo'<div id="content">';
echo '<h2 id="AmpaSubtitulo">B&Uacute;SQUEDA SOCIO</h2><br />
      <form action="index.php?ampsocgesbusqueda" method="POST">
        <select name="op">
           <option value="no">selecciona una opcion</option>
           <option value="so_dni">DNI</option>
           <option value="so_nombre">Nombre</option>
           <option value="so_apell1">Primer Apellido</option>
        </select>
        <input type="text" name="cad" size="30"><br><br> 
        <input type="submit" value="Buscar" name="buscar"> 
      </form> ';

if ($_POST['buscar']=='Buscar')
{ 
    if ($_POST['cad']==''|| $_POST['op']=='no')
    {
        echo "<p id='AmpaError'>Debe especificar una cadena a bucar o selecionar una opci&oacute;n</p>";
    }
    else
    {
        $socio = mysql_query('select * from socios where '.$_POST['op'].' LIKE "%' . $_POST['cad']. '%"');
       
        $añoActual=date("Y"); 
        $anos= array();               
            
        
            while ($socios = mysql_fetch_array($socio)) 
            {
                echo'
             <br/>
             <table id="AmpaTbusca">
                <p id="AmpaSubtitulo">SOCIO ENCONTRADO</p>
                <tr>
                    <th id="AmpaTh">DNI Socio</th>
                    <th id="AmpaTh">Nombre Socio</th>
                    <th id="AmpaTh">Apellidos Socio</th>
                    <th id="AmpaTh">Telefono movil</th>
                    <th id="AmpaTh">Telefono fijo</th>
                </tr>'; 
                echo '<tr>
                        <td>'
                            .$socios['so_dni'].
                       '</td>';
                echo   '<td>'
                        .$socios['so_nombre'].
                       '</td>';
                echo   '<td>'
                        .$socios['so_apell1'].' '.$socios['so_apell2'].
                       '</td>';
                
                echo   '<td>'
                        .$socios['so_telef1'].
                       '</td>';
                echo   '<td>'
                        .$socios['so_telef2'].
                       '</td>
                    </tr>
                </table>';
                
                $cuota = mysql_query('select * from cuotas_socios where cs_dni="'.$socios['so_dni'].'"');
                echo'
                        <br/>
                        <p id="AmpaSubtitulo">SOCIO DESDE EL A&Ntilde;O '.$socios['so_fecha'].' AL '.$añoActual.' A&Ntilde;O ACTUAL</p>
                        <table id="AmpaTbusca">
                           
                        <tr>
                            <th id="AmpaTh">A&ntilde;o de cuota anual pagado</th>
                            <th id="AmpaTh">Fecha de pago</th>
                            <th id="AmpaTh">Importe</th>
                       </tr>'; 
                while ($cuotas = mysql_fetch_array($cuota)) 
                {
                    echo '<tr>
                            <td>'
                                .$cuotas['cs_anio_cuota'].
                           '</td>
                            <td>'
                                .$cuotas['cs_fecha_emision'].
                           '</td>
                            <td>'
                                .$cuotas['cs_importe'].' &euro;'.
                           '</td>
                          </tr>';
                }
                
                echo '</table>';
                
            }
           
      }    
    }
    echo '<br/><br/><br/>';
echo '</div>';
echo "</div>";
  
?>
