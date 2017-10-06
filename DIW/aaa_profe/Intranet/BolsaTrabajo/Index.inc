<?php

if (!isset($_SESSION['prueba']))
{
	$rol=0;
}
else 
{
 $usuario=mysql_query("select us_codrol from usuarios where us_cuenta='".$_SESSION['prueba']."'") or die(mysql_error());
 $obtengoRol=mysql_fetch_array($usuario) or die(mysql_error());
 $rol=$obtengoRol[0];
}
 
?>

<div id='cuerpo-centro'>




<style>



h2 { 
  font: oblique bold 250% cursive; 
  color: white; text-shadow: black 0.1em 0.1em 0.2em;
}

a { 
  font: oblique bold 100% cursive; 
  color: blue; 
 
}

a:hover { 
  font: oblique bold 100% cursive; 
  color: white; 
 
}

</style>
<?php

if ($rol==14)
{
echo '
<h2>Alumno</h2>
<a href="index.php?opccurriculum" target="_self" >subir curriculum</a><br><br>

<a href="index.php?inscribirse"> Inscribirse </a><br><br>

<a href="index.php?vofertas"> Ver ofertas </a><br><br>

<a href="index.php?borCurriculum"> Borrar curriculum </a><br><br>
';
}

elseif ($rol>14)
{
echo '
<h2>Alumno</h2>
<a href="index.php?opccurriculum" target="_self" >subir curriculum</a><br><br>

<a href="index.php?inscribirse"> Inscribirse </a><br><br>

<a href="index.php?vofertas"> Ver ofertas </a><br><br>

<a href="index.php?borCurriculum"> Borrar curriculum </a><br><br>

<h2>Empresas</h2>



<br>
<a href="index.php?listarcurriculum" >Ver Curricula</a><br><br>



<a href="index.php?opcofertas">subir oferta</a><br><br>

<a href="index.php?boferta">borrar oferta</a><br><br>
';
}
else
{
	echo 'No tienes permisos para acceder a esta secci&oacute;n.';	
}
?>
</body>
</html>

</div>

