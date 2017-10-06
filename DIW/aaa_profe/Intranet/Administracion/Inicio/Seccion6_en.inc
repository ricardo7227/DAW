<?php

  echo "<div id='cuerpo-centro'>
          <h1>ADMINISTRATION</h1>
          <hr />";
  $cons1 = mysql_query("SELECT * FROM editor where url='admini'") or die(mysql_error());
  echo "<p><a href='index.php?admini" . "&editor=si'>Edit Page</a></p>";
  while ($ampa=mysql_fetch_assoc($cons1))
  {
    echo "<h1>" . $ampa['titulo_es']."</h1>
    <p>" . $ampa['texto_es']."</p>";
  }
  if (isset($_GET['editor']) && $_GET['editor']=='si')
  {
    editor("admini");
  }
  elseif(isset($_GET['guardar']) && $_GET['guardar']=='si')
  {
    guardar("admini");
  }
  echo "</div>";

  function editor($prueba)
  {
    $cons2 = mysql_query("SELECT * FROM editor where url='".$prueba."'");
    $dept=mysql_fetch_assoc($cons2);
    echo "<div style='position:relative; left:10px;'>
	  <form method='post' action='index.php?".$prueba."&guardar=si'>
            <p><span style='font-size:15px'>Title</span><br />
            <input type='text' name='titulo' size='67' style='background-color:#F0F0EE;' value='".$dept['titulo_en']."'><br />
            <center><textarea name='content' cols='50' rows='15' class='mceEditor'>".$dept['texto_en']."</textarea>
            <input type='submit' value='Save' /></center></p>
          </form>
          </div>";
  }

  function guardar($prueba)
  {
    $cons2 = mysql_query("SELECT * FROM editor where url='".$prueba."'");
    $dept= mysql_num_rows($cons2);
    $titulo=$_POST['titulo'];
    $texto=$_POST['content'];
    if ($dept!=0)
    {
      $text = mysql_query("update editor set titulo_es='".$titulo."',texto_es='".$texto."' where url='".$prueba."'");
    } else {
      $text = mysql_query("insert into editor (url,titulo_es,texto_es) values ('".$prueba."','".$titulo."','".$texto."')");
    }
    echo '<meta http-equiv="refresh" content="0; url=index.php?admini>';
    }
?>
