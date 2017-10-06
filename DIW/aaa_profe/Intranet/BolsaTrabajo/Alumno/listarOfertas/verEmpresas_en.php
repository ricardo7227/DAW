<?php 



$cn = mysql_connect("localhost", "phpuser", "phpp@asswd1011") or die("Error en Conexion");
$db = mysql_select_db("basedatos", $cn);  
$result = mysql_query("SELECT of_codigo, of_nombreEmpresa, of_ubicacion, of_telefono, of_email of_puestoOfertado, of_descripcion, of_jornada, of_requisitos, of_puestosVacantes, of_fecha FROM ofertas"); 

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
          <img class='portrait' src='images/empresa.jpg'/>
          <div class='self'>
            <h1 class='name'> $row[0] </h1>
            <ul>
              <li class='ad'>$row[4] </li>
              <li class='mail'> $row[2] </li>
              <li class='tel'> $row[3]</li>
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
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Position offered: $row[5]</li>
			  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Description: $row[6] </li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Requirements: $row[8]</li>
		</ul>
        </div>
        <div class='entry'>
          <h2>Working day</h2>
		  <div class='content'>
            <h3>Working day</h3>
            <ul class='skills'>
              <li> $row[7] </li>
            </ul>
			</div>
        </div>
		<div class='content'>
            <h3>Posts</h3>
            <ul class='skills'>
              <li>  </li>
            </ul>
			</div>
        </div>
      </div>
	  <div class='content'>
            <h3>Date</h3>
            <ul class='skills'>
              <li> </li>
            </ul>
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