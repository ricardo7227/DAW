<?php

include_once('Configuracion.inc');

if (isset($_GET['opcion'])) 
{
    $pagina = $_GET['opcion'];
	
	if ($pagina == "login") 
	{ 
		login(); 
	}
    elseif ($pagina == 'compruebalogin') 
	{ 
		compruebalogin(); 
	}
	elseif ($pagina == 'login2') 
	{ 
		login2(); 
	}
	elseif ($pagina == 'login3') 
	{ 
		login3(); 
	}
	elseif ($pagina == 'logout') 
	{ 
		logout(); 
	}
	else
	{
		inicio();
	}
}
elseif(!(isset($_GET["opcion"])))
{
	inicio();
}


function inicio()
{
	echo "
    <div id='secc1'>
    <div id='idioma'> ";
  
	if (!$_SERVER['QUERY_STRING'])
	{
		echo " <a href='index.php'><img src='Comun/imagenes/es2.jpg'/></a>&nbsp;&nbsp;&nbsp;
		<a href='index_en.php'><img src='Comun/imagenes/en2.jpg'/></a>";
	}
	else
	{
		echo " <a href='index.php?".$_SERVER['QUERY_STRING']."'><img src='Comun/imagenes/es2.jpg'/></a>&nbsp;&nbsp;&nbsp;
		<a href='index_en.php?".$_SERVER['QUERY_STRING']."'><img src='Comun/imagenes/en2.jpg'/></a>";
	}
	
	if (isset($_SESSION['login']) && ($_SESSION['login']=='ok'))
	{
	echo "</div>
	<div id='login'>
<!-- Para que salga antes la de educamadrid
		<form method='post' action='index.php?opcion=logout'-->
		<form method='post' action='index.php?iniini&opcion=logout'>
		<p><b>Bienvenido ".$_SESSION['prueba']."!!</b></p>
			<input type='submit' value='Logout'/>
		</form>
	</div>
	</div> 
	";
	}
	else
	{
	echo " 
	</div>
	<div id='login'>
<!-- Lo de educamadrid
		<form method='post' action='index.php?opcion=compruebalogin'-->
		<form method='post' action='index.php?iniini&opcion=compruebalogin'>
			Usuario:<br />
			<input type='text' maxlength='32' size='14' name='usuario'><br />
			Contrase&ntilde;a:<br />
			<input type='password' maxlength='32' size='14' name='contrasenia'><br /><br />
			<input id='boton_login' value='LOGIN' type='submit'>
		</form>
	</div>
	</div> 
	";
	}
}
function login()
{
	if ($_SESSION['contador2'] != 1)
	{
		echo "
		<div id='secc1'>
		<div id='idioma'> ";
  
	if (!$_SERVER['QUERY_STRING'])
	{
		echo " <a href='index.php'><img src='Comun/imagenes/es2.jpg'/></a>&nbsp;&nbsp;&nbsp;
		<a href='index_en.php'><img src='Comun/imagenes/en2.jpg'/></a>";
	}
	else
	{
		echo " <a href='index.php?".$_SERVER['QUERY_STRING']."'><img src='Comun/imagenes/es2.jpg'/></a>&nbsp;&nbsp;&nbsp;
		<a href='index_en.php?".$_SERVER['QUERY_STRING']."'><img src='Comun/imagenes/en2.jpg'/></a>";
	}
	  
	echo " 
	</div>
		<div id='login'>
<!-- Lo de educamadrid
			<form method='post' action='index.php?opcion=compruebalogin'-->
			<form method='post' action='index.php?iniini&opcion=compruebalogin'>
			Usuario:<br />
			<input type='text' maxlength='32' size='14' name='usuario'><br />
			Contrase&ntilde;a:<br />
			<input type='password' maxlength='32' size='14' name='contrasenia'><br />
			<input id='boton_login' value='LOGIN' type='submit'>
			</form>
		</div>
	</div> 
";
include_once ('Seccion2.inc');

			echo "
			<div id='cuerpo'>
			<div id='cuerpo-izda'></div>
			<div id='cuerpo-centro'>
			
			Usuario o contrase&ntilde;a incorrectos. Te quedan ".$_SESSION['contador2']." intentos.
<!-- Si aun no estas registrado puedes acerlo <a href='index.php?opcion=registro'>aqu&iacute;</a--><br /><br />
<!-- Lo de educamadrid
			<form action='index.php?opcion=compruebalogin' method='post'-->
			<form action='index.php?iniini&opcion=compruebalogin' method='post'>
			Usuario<input type='text' name='usuario'><br />
			Contrase&ntilde;a<input type='password' name='contrasenia'><br />
			<input type='submit' value='Enviar'>
			</form>
			</div>
			<div id='cuerpo-dcha'></div>
			</div>			
			";
		}
		else
		{
		echo "
		<div id='secc1'>
		<div id='idioma'> ";
  
		if (!$_SERVER['QUERY_STRING'])
		{
		  echo " <a href='index.php'><img src='Comun/imagenes/es2.jpg'/></a>&nbsp;&nbsp;&nbsp;
		  <a href='index_en.php'><img src='Comun/imagenes/en2.jpg'/></a>";
		}
		else
		{
		  echo " <a href='index.php?".$_SERVER['QUERY_STRING']."'><img src='Comun/imagenes/es2.jpg'/></a>&nbsp;&nbsp;&nbsp;
		  <a href='index_en.php?".$_SERVER['QUERY_STRING']."'><img src='Comun/imagenes/en2.jpg'/></a>";
		}
	  
	echo " 
	</div>
		<div id='login'>
<!-- Lo de educamadrid
			<form method='post' action='index.php?opcion=compruebalogin'-->
			<form method='post' action='index.php?iniini&opcion=compruebalogin'>
			Usuario:<br />
			<input type='text' maxlength='32' size='14' name='usuario'><br />
			Contrase&ntilde;a:<br />
			<input type='password' maxlength='32' size='14' name='contrasenia'><br />
			<input id='boton_login' value='LOGIN' type='submit'>
			</form>
		</div>
	</div> 
";
include_once('Seccion2.inc');

			echo "
			<div id='cuerpo'>
			<div id='cuerpo-izda'></div>
			<div id='cuerpo-centro'>
			
			Usuario o contrase&ntilde;a incorrectos. Te queda ".$_SESSION['contador2']." intento. Si aun no estas registrado puedes acerlo <a href='index.php?opcion=registro'>aqu&iacute;</a><br /><br />
			
<!--
			<form action='index.php?opcion=compruebalogin' method='post'-->
			<form action='index.php?iniini&opcion=compruebalogin' method='post'>
			Usuario<input type='text' name='usuario'><br />
			Contrase&ntilde;a<input type='password' name='contrasenia'><br />
			<input type='submit' value='Enviar'>
			</form>
			</div>
			<div id='cuerpo-dcha'></div>
			</div>";
		}
		
}

function login2()
{
echo "
  <div id='secc1'>
  <div id='idioma'> ";
  
	  if (!$_SERVER['QUERY_STRING'])
	  {
		  echo " <a href='index.php'><img src='Comun/imagenes/es2.jpg'/></a>&nbsp;&nbsp;&nbsp;
		  <a href='index_en.php'><img src='Comun/imagenes/en2.jpg'/></a>";
	  }
	  else
	  {
		  echo " <a href='index.php?".$_SERVER['QUERY_STRING']."'><img src='Comun/imagenes/es2.jpg'/></a>&nbsp;&nbsp;&nbsp;
		  <a href='index_en.php?".$_SERVER['QUERY_STRING']."'><img src='Comun/imagenes/en2.jpg'/></a>";
	  }
	  
	echo " 
	</div>
		<div id='login'>
<!-- Lo de educamadrid
			<form method='post' action='index.php?opcion=compruebalogin'-->
			<form method='post' action='index.php?iniini&opcion=compruebalogin'>
			Usuario:<br />
			<input type='text' maxlength='32' size='14' name='usuario'><br />
			Contrase&ntilde;a:<br />
			<input type='password' maxlength='32' size='14' name='contrasenia'><br />
			<input id='boton_login' value='LOGIN' type='submit'>
			</form>
		</div>
	</div> 
";
include_once('Seccion2.inc');

			echo "
			<div id='cuerpo'>
			<div id='cuerpo-izda'></div>
			<div id='cuerpo-centro'>
<!-- Lo de educamadrid
			<form action='index.php?opcion=compruebalogin' method='post'-->
			<form action='index.php?iniini&opcion=compruebalogin' method='post'>
			Usuario<input type='text' name='usuario'><br />
			Contrase&ntilde;a<input type='password' name='contrasenia'><br />
			<input type='submit' value='Enviar'>
			</form>
			</div>
			<div id='cuerpo-dcha'></div>
			</div>";
}

function login3()
{
echo "
  <div id='secc1'>
  <div id='idioma'> ";
  
	  if (!$_SERVER['QUERY_STRING'])
	  {
		  echo " <a href='index.php'><img src='Comun/imagenes/es2.jpg'/></a>&nbsp;&nbsp;&nbsp;
		  <a href='index_en.php'><img src='Comun/imagenes/en2.jpg'/></a>";
	  }
	  else
	  {
		  echo " <a href='index.php?".$_SERVER['QUERY_STRING']."'><img src='Comun/imagenes/es2.jpg'/></a>&nbsp;&nbsp;&nbsp;
		  <a href='index_en.php?".$_SERVER['QUERY_STRING']."'><img src='Comun/imagenes/en2.jpg'/></a>";
	  }
	  
	echo " 
	</div>
		<div id='login'>
<!-- Lo de educamadrid
			<form method='post' action='index.php?opcion=compruebalogin'-->
			<form method='post' action='index.php?iniini&opcion=compruebalogin'>
			Usuario:<br />
			<input type='text' maxlength='32' size='14' name='usuario'><br />
			Contrase&ntilde;a:<br />
			<input type='password' maxlength='32' size='14' name='contrasenia'><br />
			<input id='boton_login' value='LOGIN' type='submit'>
			</form>
		</div>
	</div> 
";
include_once('Seccion2.inc');

			echo "
			<div id='cuerpo'>
			<div id='cuerpo-izda'></div>
			<div id='cuerpo-centro'>
			<p>Para poder acceder necesitas estar logeado.</p>
<!-- Lo de educamadrid
			<form action='index.php?opcion=compruebalogin' method='post'-->
			<form action='index.php?iniini&opcion=compruebalogin' method='post'>
			Usuario<input type='text' name='usuario'><br />
			Contrase&ntilde;a<input type='password' name='contrasenia'><br />
			<input type='submit' value='Enviar'>
			</form>
			</div>
			<div id='cuerpo-dcha'></div>
			</div>";
}

function compruebalogin()
{
	$usuario=$_POST['usuario'];
	$contrasenia=md5($_POST['contrasenia']);
	$query = mysql_query("SELECT * FROM usuarios where us_cuenta='$usuario' AND us_varios='$contrasenia'");
	$intentos=3;
	
	if (!isset($_SESSION['contador']))
	{
		$_SESSION['contador']=1;
		$_SESSION['contador2']=3;
	}
	
	if ($_SESSION['contador'] == Cintentos)
	{
		Fdenegado($usuario,$contrasenia);
		echo "
		<div id='secc1'>
		<div id='idioma'> ";
  
		if (!$_SERVER['QUERY_STRING'])
		{
		  echo " <a href='index.php'><img src='Comun/imagenes/es2.jpg'/></a>&nbsp;&nbsp;&nbsp;
		  <a href='index_en.php'><img src='Comun/imagenes/en2.jpg'/></a>";
		}
		else
		{
		  echo " <a href='index.php?".$_SERVER['QUERY_STRING']."'><img src='Comun/imagenes/es2.jpg'/></a>&nbsp;&nbsp;&nbsp;
		  <a href='index_en.php?".$_SERVER['QUERY_STRING']."'><img src='Comun/imagenes/en2.jpg'/></a>";
		}
	  
  echo " 
	</div>
		<div id='login'>
<!-- Lo de educamadrid
			<form method='post' action='index.php?opcion=compruebalogin'-->
			<form method='post' action='index.php?iniini&opcion=compruebalogin'>
			Usuario:<br />
			<input type='text' maxlength='32' size='14' name='usuario'><br />
			Contrase&ntilde;a:<br />
			<input type='password' maxlength='32' size='14' name='contrasenia'><br />
			<input id='boton_login' value='LOGIN' type='submit'>
			</form>
		</div>
	</div> 
";
include_once('Seccion2.inc');

		echo "
		<div id='cuerpo'>
		<div id='cuerpo-izda'></div>
		<div id='cuerpo-centro'>
		Has superado el n&uacute;mero de intentos. Vuelva a intentarlo m&aacute;s tarde.
		</div>
		<div id='cuerpo-dcha'></div>
		</div>
		";
	}
else
	{
		
			if(mysql_num_rows($query) == 1)
			{
				$var=1;
				$break;
			}
			else
			{
				$var=0;
			}

		if ($var==1)
		{
			$_SESSION['login']='ok';
			$_SESSION['prueba']=$usuario;
// Lo de educamadrid
//			header('location: index.php');
			header('location: index.php?iniini');
		}
		elseif ($var==0)
		{
			Fdenegado($usuario,$contrasenia);
			$_SESSION['contador']++;
			$_SESSION['contador2']--;
// Lo de educamadrid
//			header('location: index.php?opcion=login');	
			header('location: index.php?iniini&opcion=login');	
		}
	}		
}

function Fdenegado($usuario,$contrasenia)
{
$ip=$_SERVER['REMOTE_ADDR'];
$consulta=mysql_query("INSERT INTO denegados (de_cuenta,de_varios,de_ip) values ('".$usuario."','".$contrasenia."','".$ip."')") or die(mysql_error());
}

function logout()
{
	session_destroy ();
// Lo de educamadrid
//	header ("location: index.php");
	header ("location: index.php?iniini");
}

?>
