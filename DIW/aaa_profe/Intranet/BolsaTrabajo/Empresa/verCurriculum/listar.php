  
<?php 



$cn = mysql_connect("localhost", "phpuser", "phpp@asswd1011") or die("Error en Conexion");
$db = mysql_select_db("basedatos", $cn);  
$result = mysql_query("SELECT cv_dni, cv_apellido1, cv_apellido2, cv_nombre, cv_sexo, cv_estadocivil, cv_nacionalidad, cv_fechaNacimiento, cv_lugardenacimiento, cv_paisdenacimiento, cv_domicilio, cv_codigopostal, cv_localidad, cv_telefono, cv_telefono2, cv_email, cv_estudiossinacabar, cv_universidadsinacabar, cv_finalprevisto, cv_grado, cv_estudiosacabados, cv_finalizaciondeestudios, cv_lugardeestudios, cv_lenguamaternna, cv_inglesescrito, cv_inglesleido, cv_inglesoral, cv_francesleido, cv_francesescito, cv_francesoral FROM curricula"); 

echo "<link type='text/css' rel='stylesheet' href='css/blue.css' />";
echo "<link type='text/css' rel='stylesheet' href='css/print.css' media='print'/>";
echo "<script type='text/javascript' src='js/jquery-1.4.2.min.js'></script>";
echo "<script type='text/javascript' src='js/jquery.tipsy.js'></script>";
echo "<script type='text/javascript' src='js/cufon.yui.js'></script>";
echo "<script type='text/javascript' src='js/scrollTo.js'></script>";
echo "<script type='text/javascript' src='js/myriad.js'></script>";
echo "<script type='text/javascript' src='js/jquery.colorbox.js'></script>";
echo "<script type=text/javascript' src='js/custom.js'></script>";
echo "<script type='text/javascript'>Cufon.replace('h1,h2');</script>";

echo "<h1 STYLE='margin-top:50px'> Curricula </h1> \n";

while ($row = mysql_fetch_row($result)){ 


echo "<body> \n"; 

echo "<div id='wrapper'>
  <div class='wrapper-top'></div>
  <div class='wrapper-mid'>
    <div id='paper'>
      <div class='paper-top'></div>
      <div id='paper-mid'>
        <div class='entry'>
          <img class='portrait' src='images/image.jpg'/>
          <div class='self'>
            <h1 class='name'> $row[3] </h1>
            <ul>
              <li class='ad'>$row[10] </li>
			  <li>Localidad: $row[8]</li>
              <li class='mail'> $row[15] </li>
              <li class='tel'> $row[13]</li>
			  <li class='tel'> $row[14] </li>
            </ul>
          </div>
          <div class='social'>
            <ul>
              <li><a class='north' href='#' title='Download .pdf'><img src='images/icn-save.jpg' alt='Download the pdf version'/></a></li>
            </ul>
          </div>
        </div>
        <div class='entry'>
          <h2>Información complementaria</h2>
		  <br>
		  <br>
		  <br>
          <ul>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sexo: $row[4]</li>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estado civil: $row[5] </li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nacionalidad: $row[6]</li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha de Nacimiento: $row[7]</li>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lugar de Nacimiento: $row[8]</li>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pais de Nacimiento: $row[9]</li>
		</ul>
        </div>
        <div class='entry'>
          <h2>Formacion</h2>
		    <br>
			<br>
			<br>
             <ul>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estudios sin Acabar: $row[16]</li>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Final previsto: $row[17]</li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grado: $row[18]</li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estudios acabados: $row[19]</li>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Finalizacion de estudios: $row[20]</li>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lugar de estudios: $row[21]</li>
		</ul>
        </div>
        <div class='entry'>
          <h2>Idiomas</h2>
		  <div class='content'>
            <h3>Lengua Materna</h3>
            <ul class='skills'>
              <li> $row[22] </li>
            </ul>
			</div>
          <div class='content'>
            <h3>Inglés</h3>
            <ul class='skills'>
              <li>Escrito: $row[23]</li>
              <li>Leido: $row[24]</li>
              <li>Oral: $row[25]</li>
            </ul>
			</div>
			<div class='content'>
			<h3>Frances</h3>
            <ul class='skills'>
              <li>Escrito: $row[27]</li>
              <li>Leido $row[26]</li>
              <li>Oral: $row[28]</li>
            </ul>
          </div>
        </div>
      </div>
      <div class='clear'></div>
      <div class='paper-bottom'></div>
    </div>
    <!-- End Paper -->
  </div>
  <div class='wrapper-bottom'></div>
</div>
<div id='message'><a href='#top' id='top-link'>Go to Top</a></div>";
  
} 
echo "</body> \n"; 
?> 