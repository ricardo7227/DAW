  
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
          <h2>Information</h2>
		  <br>
		  <br>
		  <br>
          <ul>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gender: $row[4]</li>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Marital statusl: $row[5] </li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nationality: $row[6]</li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of Birth: $row[7]</li>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Place of Birth: $row[8]</li>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Country of Birth: $row[9]</li>
		</ul>
        </div>
        <div class='entry'>
          <h2>Education</h2>
		    <br>
			<br>
			<br>
             <ul>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ongoing studies: $row[16]</li>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Final plans: $row[17]</li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Degree: $row[18]</li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Studies completed: $row[19]</li>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Completion of studies: $row[20]</li>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Place of study: $row[21]</li>
		</ul>
        </div>
        <div class='entry'>
          <h2>Idiomas</h2>
		  <div class='content'>
            <h3>Mother Tongue</h3>
            <ul class='skills'>
              <li> $row[22] </li>
            </ul>
			</div>
          <div class='content'>
            <h3>Spanish</h3>
            <ul class='skills'>
              <li>Written: $row[23]</li>
              <li>Read: $row[24]</li>
              <li>Oral: $row[25]</li>
            </ul>
			</div>
			<div class='content'>
			<h3>Frances</h3>
            <ul class='skills'>
              <li>Written: $row[27]</li>
              <li>Read: $row[26]</li>
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