	<!-- CONTENIDO EXTRAESCOLARES JAVASCRIPT -->
	<script type="text/javascript">

		// AL ENTRAR EN ESTA SECCION hacemos un fundido al inicio
		$(document).ready(function(){
			// realizamos un efecto de encendido
			$("#cuerpo-centro").fadeOut("slow");
			$("#cuerpo-centro").fadeIn("slow");

			// el texto del parrafo sera sustituido por el del array
			$("#parrafoExtra").text( arrayFrasesActividades[0] );
		});

		// ARRAY FRASES DE LO IMPORTANTE QUE ES LA ACTIVIDAD EXTRAESCOLAR
		var arrayFrasesActividades = new Array();
		<?php 
			$i = 0;
			$arrayFrasesPhp = leerArchivoFrases();

			// Conversor para transferir el contenido del array de PHP al de Javascript
			foreach ($arrayFrasesPhp as $key => $value) {
				if (strlen($value) > 1) {
					echo "arrayFrasesActividades[". $i++ ."]='". substr($value, 0, -1) ."';\n";
				}					
			}
		?>
		
		// para que continue con el segundo texto del array
		var i=1; 
		
		// MUESTRA LOS TEXTOS, SOBRE LOS VENEFICIOS DE LAS ACTIVIDADES EXTRAESCOLARES
		function ciclo(){
			// verificar si esta cargado jQuery, para usar los efectos visuales
			if(!window.jQuery) {
				document.getElementById("parrafoExtra").innerHTML = arrayFrasesActividades[i];
			} else {
				// apagado del texto, por darle efecto animado
				$("#parrafoExtra").hide("slow");
				$("#parrafoExtra").fadeOut("slow");

				// el texto del parrafo sera sustituido por el del array
				$("#parrafoExtra").text( arrayFrasesActividades[i] );

				// encendido del texto, por darle efecto animado
				$("#parrafoExtra").fadeIn("slow");			
			}

			// contador/verficador de por cual parrafo va del array, realizando un bucle
			if (i<arrayFrasesActividades.length) i++; else i=0;					
		}
		
		// intervalo de tiempo aproximado de 6 segundos para leer los textos del 'parrafoExtra' 
		var intervalo = setInterval("ciclo()", 6000);
	</script>



	<!-- CONTENIDO EXTRAESCOLARES HTML -->
	<h1 id="tituloextraescolar">Extracurricular Activities</h1>
	<img src="Comun/imagenes/Extraescolares/Extraescolares_portada.png" alt="Logo Extracurricular activities"/>

	<!-- DOCUMENTACION PARA LOS PERMISOS -->
	<div class='extraescolar'>
		<h3>EXTRACURRICULAR ACTIVITIES</h3>
			
 		<ul style="list-style-image:url(Comun/imagenes/Extraescolares/yes.png);" >
	        <li><a href="ftp/Extraescolares/Comunicacion.doc">
	        	Communication to the person in charge</a></li>

	        <li><a href="ftp/Extraescolares/Listado.doc">
	        	Attendees listing</a></li>

	        <li><a href="ftp/Extraescolares/Normas.doc">
	        	Standards for outputs</a></li>

	        <li><a href="ftp/Extraescolares/Permiso.doc">
	        	Permit for students</a></li>
	    </ul>
		
		<p id="parrafoExtra"></p>
	</div><!-- end class extraescolares -->


<?php 
/**
 *	Lectura del archivo de texto con las frases de los veneficios de las actividades
 */
function leerArchivoFrases() {
	$frasesActividades = array();
	$file = "ftp/Extraescolares/frasesActividades_en.txt";

	$f = fopen($file,"r");
	$array = explode("\n", fread($f, filesize($file)));

	return $array;
}