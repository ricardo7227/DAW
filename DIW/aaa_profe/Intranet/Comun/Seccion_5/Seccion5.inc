<div id='cuerpo-izda'>
<?php
//Codigo slide
	$directorio = "Comun/imagenes/slide/";
	$abrir = dir($directorio);
	echo "

	<div class='slideshow'>";
	while(($archivo = $abrir->read())!= false)
	{
	if (preg_match("/gif/i", $archivo) || preg_match("/jpg/i", $archivo) || preg_match("/png/i", $archivo) || preg_match("/jpeg/i", $archivo)) {
		echo "<img src='$directorio/$archivo' width='170px' height='170px'>";}
	}
	echo "</div>";	
	$abrir->close();
?>
	<center>
<table id='evtcal' border='0' cellpadding='0' cellspacing='0'>
	<tbody>
           <tr>
              <td style="bgcolor:'#aaddff';" valign='top' width='314'>
                <div id='calendar'><!--  Dynamically Filled --></div>
              </td>
           </tr>
			<tr>
			<td style='padding: 3px 3px 15px 3px;' bgcolor='#99FFFF' valign='top' width='180' height='100'>
				<center><b><u>Events</u></b>
				<form id='eventform' name='eventform' action='#' method='get'>
					<textarea name='eventlist' cols='21' rows='11' wrap='soft'>Select a date to see the event.</textarea>
				</form>
				</center>
			</td>
		</tr>
	</tbody>
</table>
	
</div>
</center>
