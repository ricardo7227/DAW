<?php

  echo "<div id='cuerpo-centro'>
          <h1>DIRECCION</h1>
          <hr />";
  $cons1 = mysql_query("SELECT * FROM editor where url='dirini'") or die(mysql_error());
//  echo "<p><a href='index.php?ampini" . "&editor=si'>Editar P&aacute;gina</a></p>";
  while ($ampa=mysql_fetch_assoc($cons1))
  {
    echo "<h1>" . $ampa['titulo_es']."</h1>
    <p>" . $ampa['texto_es']."</p>";
  }
  echo "</div>";
?>
