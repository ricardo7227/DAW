<?php
  echo "<div id='cuerpo-centro'>
        <h1>HEADSHIP</h1>
        <hr />";
  $cons1 = mysql_query("SELECT * FROM editor where url='dirini'") or die(mysql_error());
//  echo "<p><a href='index.php?ampini" . "&editor=si'>Edit Page</a></p>";
  while ($ampa=mysql_fetch_assoc($cons1))
  {
    echo "<h1>" . $ampa['titulo_en']."</h1>
          <p>" . $ampa['texto_en'] . "</p>";
  }
  echo "</div>";
?>
