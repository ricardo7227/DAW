<?php

if (isset($_GET['opcion']) && $_GET['opcion']=='gestion')
{
	gestionUsuarios();
}
elseif (isset($_GET['opcion']) && $_GET['opcion']=='altausuario')
{
	altaUsuario();
}
elseif (isset($_GET['opcion']) && $_GET['opcion']=='modificarusuario')
{
	modificarUsuario();
}
elseif (isset($_GET['opcion']) && $_GET['opcion']=='reservas'){
	include 'Tic/Reservas/Seccion6.inc';
}
elseif (isset($_GET['opcion']) && $_GET['opcion']=='incidencias'){
	include 'Tic/incidencias/Seccion6.inc';
}
elseif (isset($_GET['opcion']) && $_GET['opcion']=='eliminarusuario')
{
	eliminarUsuario();
}
else
{
	inicio2();
}


function inicio2()
{
	echo "<div id='cuerpo-centro'>
	<a href='index.php?tic&opcion=gestion'>Gesti&oacute;n de usuarios</a><br />
	<a href='index.php?tic&opcion=incidencias'>Incidencias</a><br />
	<a href='index.php?tic&opcion=reservas'>Reservas</a><br />
	<a href='index.php?tictab'>Administrar tablas de manera interactiva</a><br />
	<a href='index.php?ticcon'>Condiciones de uso</a>
	</div>
	";
}

function gestionUsuarios()
{
	echo "<div id='cuerpo-centro'>
	<a href='index.php?tic&opcion=altausuario'>Dar de alta usuario</a><br />
	<a href='index.php?tic&opcion=modificarusuario'>Modificar usuario</a><br />
	<a href='index.php?tic&opcion=eliminarusuario'>Eliminar usuario</a>
	</div>";
}

function altaUsuario()
{

	if(isset($_POST['registro']))
	{
		extract($_POST);
		
		if ($_POST['contrasenia']!="" && $_POST['usuario']!="" && $_POST['rol']!="" && $_POST['v_contrasenia']!="")
		{
			if ($_POST['contrasenia']==$_POST['v_contrasenia'])
			{
				$contrasenia = md5($_POST['contrasenia']);
				$insertUser=mysql_query("insert into usuarios values ('".$_POST['usuario']."','".$_POST['rol']."',0,'".$contrasenia."')") or die(mysql_error());
				echo '<div id="cuerpo-centro">El usuario se ha dado de alta correctamente.</div>';
				echo '<meta http-equiv="refresh" content="3;url=index.php?tic" />';
			}
			else
			{
				echo '<div id="cuerpo-centro">Error: Las contrase&ntilde;as no coinciden.</div>';
				echo '<meta http-equiv="refresh" content="3;url=index.php?tic&opcion=altausuario" />';
			}
		}
		else
		{
			echo '<div id="cuerpo-centro">Error: debe rellenar todos los campos.</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php?tic&opcion=altausuario" />';
		}
	}
	else
	{
		$grupos=mysql_query("select * from grupos");
		$roles=mysql_query("select * from roles");
		echo '
		<div id="cuerpo-centro">
		<form action="" method="POST">
		<blockquote>Usuario:</blockquote><blockquote> <input type="text" name="usuario"></blockquote>
		<blockquote>Rol:</blockquote> <blockquote> <select name="rol" style="width:150px;">
							<option value="">Seleccione un rol</option>';
		while ($sacoroles=mysql_fetch_assoc($roles))
		{
			echo '<option value="'.$sacoroles["ro_codigo"].'">'.$sacoroles["ro_descri"].'</option>';
		}
		echo '		</select></blockquote>
		<blockquote>Contrase&ntilde;a:</blockquote> <blockquote><input type="password" name="contrasenia"></blockquote>
		<blockquote>Verificar contrase&ntilde;a:</blockquote> <blockquote><input type="password" name="v_contrasenia"></blockquote><br />
		
		<blockquote><input type="submit" value="Confirmar" name="registro"></blockquote>

		</form>
		</div>
		';
	}
}
function modificarUsuario()
{
	if(isset($_POST['modificar']))
	{
		if ($_POST['contrasenia']!="" && $_POST['usuario']!="" && $_POST['rol']!="" && $_POST['v_contrasenia']!="")
		{
			if ($_POST['contrasenia']==$_POST['v_contrasenia'])
			{
				$contrasenia = md5($_POST['contrasenia']);
				$modificarusuario=mysql_query("update usuarios set us_codrol=".$_POST['rol'].", us_varios='".$contrasenia."' where us_cuenta='".$_POST['usuario']."'") or die(mysql_error());
				echo '<div id="cuerpo-centro">El usuario se ha modificado correctamente.</div>';
				echo '<meta http-equiv="refresh" content="3;url=index.php?tic" />';
			}
			else
			{
				echo '<div id="cuerpo-centro">Error: Las contrase&ntilde;as no coinciden.</div>';
				echo '<meta http-equiv="refresh" content="3;url=index.php?tic&opcion=modificarusuario" />';
			}
		}
		else
		{
			echo '<div id="cuerpo-centro">Error: debe rellenar todos los campos.</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php?tic&opcion=modificarusuario" />';
		}
	}
	elseif(isset($_POST['continuar']))
	{
		$roles=mysql_query("select * from roles") or die(mysql_error());
		$informacion=mysql_query("select * from usuarios where us_cuenta='".$_POST['usuario']."'") or die(mysql_error());
		
		while ($sacoinfo=mysql_fetch_assoc($informacion))
		{
			echo '<div id="cuerpo-centro">
			<form action="" method="POST">
			<blockquote>Usuario:</blockquote><blockquote> <input type="text" name="usuario" value="'.$_POST['usuario'].'" readonly></blockquote>
			<blockquote>Rol:</blockquote> <blockquote> <select name="rol" style="width:150px;">
								<option value="">Seleccione un rol</option>';
			while ($sacoinforol=mysql_fetch_assoc($roles))
			{
				if ($sacoinforol['ro_codigo']==$sacoinfo['us_codrol'])
				{
					echo '<option value="'.$sacoinforol["ro_codigo"].'" selected>'.$sacoinforol["ro_descri"].'</option>';
				}
				else
				{
					echo '<option value="'.$sacoinforol["ro_codigo"].'">'.$sacoinforol["ro_descri"].'</option>';
				}
			}
			echo '		</select></blockquote>
			<blockquote>Contrase&ntilde;a:</blockquote> <blockquote><input type="password" name="contrasenia"></blockquote>
			<blockquote>Verificar contrase&ntilde;a:</blockquote> <blockquote><input type="password" name="v_contrasenia"></blockquote><br />
			
			<blockquote><input type="submit" value="Confirmar" name="modificar"></blockquote>

			</form>
			</div>';
		}
	}
	else
	{
		$usuarios=mysql_query("select * from usuarios") or die(mysql_error());
		echo '<div id="cuerpo-centro">
		<form action="" method="POST">
		<blockquote>Usuario: <select name="usuario"></blockquote> <blockquote>';
		while ($sacouser=mysql_fetch_assoc($usuarios))
		{
			echo '<option value="'.$sacouser["us_cuenta"].'">'.$sacouser["us_cuenta"].'</option>';
		}
		echo '</select></blockquote>
		
		<blockquote><input type="submit" value="Continuar" name="continuar"></blockquote>
		</div>';
	}
}
function eliminarUsuario()
{
	if(isset($_POST['eliminar']))
	{
		$borrarusuario=mysql_query("delete from usuarios where us_cuenta='".$_POST['usuario']."'") or die(mysql_error());
		echo '<div id="cuerpo-centro">El usuario se ha eliminado correctamente.</div>';
		echo '<meta http-equiv="refresh" content="3;url=index.php?tic" />';
	}
	else
	{
		$usuarios=mysql_query("select * from usuarios") or die(mysql_error());
		echo '<div id="cuerpo-centro">
		<form action="" method="POST">
		Seleccione el usuario que desea eliminar:
		<blockquote>Usuario: <select name="usuario"></blockquote> <blockquote>';
		while ($sacouser=mysql_fetch_assoc($usuarios))
		{
			echo '<option value="'.$sacouser["us_cuenta"].'">'.$sacouser["us_cuenta"].'</option>';
		}
		echo '</select></blockquote>
		
		<blockquote><input type="submit" value="Confirmar" name="eliminar"></blockquote>
		</form>
		</div>';
	}
}

?>
