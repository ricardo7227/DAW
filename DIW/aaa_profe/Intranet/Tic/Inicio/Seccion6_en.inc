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
	include 'Tic/Reservas/Seccion6_en.inc';
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
	<a href='index_en.php?tic&opcion=gestion'>User management</a><br />
	<a href='index.php?tic&opcion=incidencias'>Incidencias</a><br />
	<a href='index.php?tic&opcion=reservas'>Reserves</a><br />
	<a href='index_en.php?ticcon'>Terms of use</a>
	</div>
	";
}

function gestionUsuarios()
{
	echo "<div id='cuerpo-centro'>
	<a href='index_en.php?tic&opcion=altausuario'>Add user</a><br />
	<a href='index_en.php?tic&opcion=modificarusuario'>Modify user</a><br />
	<a href='index_en.php?tic&opcion=eliminarusuario'>Delete user</a>
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
				echo '<div id="cuerpo-centro">The user was successfully created.</div>';
				echo '<meta http-equiv="refresh" content="3;url=index_en.php?tic" />';
			}
			else
			{
				echo '<div id="cuerpo-centro">Error: Passwords do not match.</div>';
				echo '<meta http-equiv="refresh" content="3;url=index_en.php?tic&opcion=alta" />';
			}
		}
		else
		{
			echo '<div id="cuerpo-centro">Error: You must fill all fields.</div>';
			echo '<meta http-equiv="refresh" content="3;url=index_en.php?tic&opcion=alta" />';
		}
	}
	else
	{
		$grupos=mysql_query("select * from grupos");
		$roles=mysql_query("select * from roles");
		echo '
		<div id="cuerpo-centro">
		<form action="" method="POST">
		<blockquote>User:</blockquote><blockquote> <input type="text" name="usuario"></blockquote>
		<blockquote>Rol:</blockquote> <blockquote> <select name="rol" style="width:150px;">
							<option value="">Seleccione un rol</option>';
		while ($sacoroles=mysql_fetch_assoc($roles))
		{
			echo '<option value="'.$sacoroles["ro_codigo"].'">'.$sacoroles["ro_descri"].'</option>';
		}
		echo '		</select></blockquote>
		<blockquote>Password:</blockquote> <blockquote><input type="password" name="contrasenia"></blockquote>
		<blockquote>Repeat password:</blockquote> <blockquote><input type="password" name="v_contrasenia"></blockquote><br />
		
		<blockquote><input type="submit" value="Confirm" name="registro"></blockquote>

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
				echo '<div id="cuerpo-centro">The user is modified successfully.</div>';
				echo '<meta http-equiv="refresh" content="3;url=index_en.php?tic" />';
			}
			else
			{
				echo '<div id="cuerpo-centro">Error: Passwords do not match.</div>';
				echo '<meta http-equiv="refresh" content="3;url=index_en.php?tic&opcion=modificarusuario" />';
			}
		}
		else
		{
			echo '<div id="cuerpo-centro">Error: You must fill all fields.</div>';
			echo '<meta http-equiv="refresh" content="3;url=index_en.php?tic&opcion=modificarusuario" />';
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
			<blockquote>User:</blockquote><blockquote> <input type="text" name="usuario" value="'.$_POST['usuario'].'" readonly></blockquote>
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
			<blockquote>Password:</blockquote> <blockquote><input type="password" name="contrasenia"></blockquote>
			<blockquote>Repeat password:</blockquote> <blockquote><input type="password" name="v_contrasenia"></blockquote><br />
			
			<blockquote><input type="submit" value="Confirm" name="modificar"></blockquote>

			</form>
			</div>';
		}
	}
	else
	{
		$usuarios=mysql_query("select * from usuarios") or die(mysql_error());
		echo '<div id="cuerpo-centro">
		<form action="" method="POST">
		<blockquote>User: <select name="usuario"></blockquote> <blockquote>';
		while ($sacouser=mysql_fetch_assoc($usuarios))
		{
			echo '<option value="'.$sacouser["us_cuenta"].'">'.$sacouser["us_cuenta"].'</option>';
		}
		echo '</select></blockquote>
		
		<blockquote><input type="submit" value="Continue" name="continuar"></blockquote>
		</div>';
	}
}
function eliminarUsuario()
{
	if(isset($_POST['eliminar']))
	{
		$borrarusuario=mysql_query("delete from usuarios where us_cuenta='".$_POST['usuario']."'") or die(mysql_error());
		echo '<div id="cuerpo-centro">The user was successfully deleted.</div>';
		echo '<meta http-equiv="refresh" content="3;url=index_en.php?tic" />';
	}
	else
	{
		$usuarios=mysql_query("select * from usuarios") or die(mysql_error());
		echo '<div id="cuerpo-centro">
		<form action="" method="POST">
		Select the user you want to delete:
		<blockquote>User: <select name="usuario"></blockquote> <blockquote>';
		while ($sacouser=mysql_fetch_assoc($usuarios))
		{
			echo '<option value="'.$sacouser["us_cuenta"].'">'.$sacouser["us_cuenta"].'</option>';
		}
		echo '</select></blockquote>
		
		<blockquote><input type="submit" value="Confirm" name="eliminar"></blockquote>
		</form>
		</div>';
	}
}

?>
