<?php

  echo "<div id='cuerpo-centro'>
          <h1>ALUMNOS</h1>
          <hr />";
  $cons1 = mysql_query("SELECT * FROM editor where url='aluini'") or die(mysql_error());
//  echo "<p><a href='index.php?aluini" . "&editor=si'>Editar P&aacute;gina</a></p>";
  while ($ampa=mysql_fetch_assoc($cons1))
  {
    echo "<h1>" . $ampa['titulo_es']."</h1>
    <p>" . $ampa['texto_es']."</p>";
  }
  echo "</div>";
?>
