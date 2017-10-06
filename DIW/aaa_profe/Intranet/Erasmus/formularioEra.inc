<?php
echo "<div id='cuerpo-centro'>
	<div id='contenedor'><br><br>
            <div id='subContenedor1' >
                <form class='contacto' method='post' action='Erasmus/generar2.php'>
                   	
                	<table id='tabla' style='margin-left:10%;'>
				<tr>
					<td  colspan='3'><center><h1>DATOS PERSONALES</h1></center></td>
				</tr>
				<tr>
					<td><label>Nombre y Apellidos:</label></td>
					<td colspan='2'><input name='nombreApe' type='text' value=  '' placeholder='Nombre y Apellido'></td>
				</tr>
				<tr>
					<td><label>Direcci&oacute;n<label></td>
					<td colspan='2'><input name='dir' type='text' value='' placeholder='Calle X numero Y'></td>
				</tr>
				<tr>
					<td><label>NIF<label></td>
					<td colspan='2'><input name='nif' type='text' value='' placeholder='11111111X'></td>
				</tr>
				<tr>
					<td><label>Correo Electr&oacute;nico<label></td>
					<td colspan='2'><input name='email' type='text' value='' placeholder='correo@host.com'></td>
				</tr>
				<tr>
					<td><label>Fecha de nacimiento<label></td>
					<td colspan='2'><input name='nacimiento' type='text' value='' placeholder='09/02/1990'></td>
				</tr>
				<tr>
					<td><label>Tel&eacute;fono<label></td>
					<td ><label>Fijo <label><input name='tlfF' type='text' value='' placeholder='913335588' style='width:80px'></td>
					<td ><label>Mvl<label><input name='tlfM' type='text' value=''  placeholder='667777777' style='width:80px'></td>
				</tr>
				<tr>
					<td><label>Idioma de elecci&oacute;n<label></td>
					<td colspan='2'><input name='idioma' type='text' value='' placeholder='Ingles'></td>
				</tr>
				<tr>
					<td><label>Curso academico<label></td>
					<td colspan='2'><input name='curso' type='text' value=''placeholder='Desarrollo de aplicaciones Web' ></td>
				</tr>
				<tr>
					<td><label>Nota del 1º año<label></td>
					<td colspan='2'><input name='nota' type='text' value=''placeholder='8'></td>
				</tr>
			</table>
                   <br>
                    <input type='submit' value='Enviar Mensaje' style='margin-left:10%;'>
		</form>
            </div>       
            
        </div>
</div>";
?>
