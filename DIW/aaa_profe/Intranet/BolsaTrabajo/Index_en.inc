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
<h2>Student</h2>
<a href="index_en.php?opccurriculum" target="_self" >Upload resume</a><br><br>

<a href="index_en.php?inscribirse"> Register </a><br><br>

<a href="index_en.php?vofertas"> See deals </a><br><br>

<a href="index_en.php?borCurriculum"> Remove resume</a><br><br>';
}

elseif ($rol>14)
{
echo '
<h2>Student</h2>
<a href="index_en.php?opccurriculum" target="_self" >Upload resume</a><br><br>

<a href="index_en.php?inscribirse"> Register </a><br><br>

<a href="index_en.php?vofertas"> See deals </a><br><br>

<a href="index_en.php?borCurriculum"> Remove resume</a><br><br>

<h2>Company</h2>

<br>
<a href="index_en.php?listarcurriculum">Ver Curricula</a><br><br>



<a href="index_en.php?ofertas">Upload deals</a><br><br>

<a href="index_en.php?boferta">Remove deals</a><br><br>';
}
else
{
	echo 'You dont have privileges to access in this section.';	
}
?>


</body>
</html>

</div>

