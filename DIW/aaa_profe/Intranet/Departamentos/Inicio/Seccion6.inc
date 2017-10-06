<?php

$cons = mysql_query("SELECT * FROM editor");


if (isset($_GET['dep']))
{
echo "<div id='cuerpo-centro'>";

	if(($_GET['dep']=='auto'))
	{	
		dept_editor($_GET['dep']);
	}

	elseif(($_GET['dep']=='bio'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='dib'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='eco'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='edu'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='ele'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='fil'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='fis'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='fol'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='fra'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='fri'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='aut'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='geo'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='inf'))
	{
		include('Departamentos/Informatica/index.php');
	}
	elseif(($_GET['dep']=='ing'))
	{
/*	    echo '<!DOCTYPE html>
                  <html>
                     <head>
                        <meta http-equiv="refresh" content="0; url=http://inglesiestiernogalvan.blogspot.com.es">
                     </head>
                     <body>
                     </body>
                   </html>';
*/
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='len'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='mat'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='mus'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='ori'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='rel'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='dib'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='tec'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='lat'))
	{
		dept_editor($_GET['dep']);
	}
	elseif(($_GET['dep']=='byg'))
	{
		dept_editor($_GET['dep']);
	}
    elseif(($_GET['dep']=='ext'))
    {
        include('Departamentos/Extraescolares/extra.inc');
    }   
	else
	{
		/*	Parte inicial listado de todos los departamentos
		 *	Se recoge de una tabla de MySQL la lista de todos los departamentos diferenciando: 
		 *	de_tipo = 0 => ESO y Bachillerato; tipo = 1 => FP
		 *	de_url: se usará para completar la dirección a la que se dirigirá el enlace
		 *	d_codigo: nombre del departamento acotado usado para la organizacion de las imagenes
		 *	d_nombre: nombre completo del departamento en espa&ntilde;ol
		 *	d_name: nombre completo del departamento en ingles
		 *	Se usará un array para la organizacion de los iconos de cada departamento segun su d_codigo  
		 */
		?>
		<h1>DEPARTAMENTOS</h1>
		<div id="dep_cntTabla">
			<div id="dep_pestania1" onClick="dep_cambiarPestania('dep_colum2','dep_colum1', 'dep_pestania1', 'dep_pestania2')">ESO/Bachillerato</div>
			<div id="dep_relleno"></div>
			<div id="dep_pestania2" onClick="dep_cambiarPestania('dep_colum1','dep_colum2', 'dep_pestania2', 'dep_pestania1')">FP</div>
			<div id="dep_cuerpoTabla">
				<div id="dep_colum1">
					
			<?php 
			$query = mysql_query("SELECT * FROM departamentos where de_tipo='0'");
			while ($departamentos=mysql_fetch_assoc($query))
			{
				echo " <div class='dep_departamento'>
    				       <a href='index.php?dep=" . $departamentos['de_url'] .
				       "'><img class='dep_imagen' src='Comun/imagenes/iconos_dept/" .
				       strtolower($departamentos['de_codigo']) . ".svg'/> " .
				       $departamentos['de_descri_es'] .
				       "</a>
					</div>";
			}
			?>
					
				</div>
				<div id="dep_colum2">
					
			<?php 
			$query2 = mysql_query("SELECT * FROM departamentos where de_tipo='1'");
			
			while ($departamentos=mysql_fetch_assoc($query2))
			{
				echo " <div class='dep_departamento'>
    				       <a href='index.php?dep=" . $departamentos['de_url'] .
				       "'><img class='dep_imagen' src='Comun/imagenes/iconos_dept/" .
				       strtolower($departamentos['de_codigo']) . ".svg'/> " .
				       $departamentos['de_descri_es'] .
				       "</a>
					</div>";
			}
			?>
					
				</div>
			</div>
		</div>
	<?php
	}
echo "</div>";
}

function dept_editor($url)
{
		$cons2 = mysql_query("SELECT * FROM departamentos where de_url=UPPER('".$url."')") or die(mysql_error());
		$cons3 = mysql_query("SELECT * FROM editor where url='".$url."'") or die(mysql_error());
		
		while ($departamentos=mysql_fetch_assoc($cons2))
		{
		echo "<h1>". strtoupper($departamentos['de_descri_es'])."</h1>";
		echo "<p><a href='index.php?dep=".$url."&editor=si'>Editar P&aacute;gina</a></p>";
		
		while ($departamentos2=mysql_fetch_assoc($cons3))
		{
			echo "<h1>".$departamentos2['titulo_es']."</h1>
			<p>".$departamentos2['texto_es']."</p>";
		}
		
		}
			if(isset($_GET['editor']) && $_GET['editor']=='si')
			{
				editor($url);
			}
			elseif(isset($_GET['guardar']) && $_GET['guardar']=='si')
			{
				guardar($url);
			}
}
function editor($prueba)
{
$cons = mysql_query("SELECT * FROM editor where url='".$prueba."'");
$dept=mysql_fetch_assoc($cons);
echo "	
	<div style='position:relative; left:10px;'>
	<form method='post' action='index.php?dep=".$prueba."&guardar=si'>
			<p>     
					<span style='font-size:15px'>T&iacute;tulo</span><br />
					<input type='text' name='titulo' size='67' style='background-color:#F0F0EE;' value='".$dept['titulo_es']."'><br />
					<center><textarea name='content' cols='50' rows='15' class='mceEditor'>".$dept['texto_es']."</textarea>
					<input type='submit' value='Guardar' /></center>
			</p>
	</form>
	</div>
";
}

function guardar($prueba)
{
	$cons = mysql_query("SELECT * FROM editor where url='".$prueba."'");
	$dept= mysql_num_rows($cons);

	$titulo=$_POST['titulo'];
	$texto=$_POST['content'];


		if ($dept!=0)
		{
			$text = mysql_query("update editor set titulo_es='".$titulo."',texto_es='".$texto."' where url='".$prueba."'");
		}
		else
		{
			$text = mysql_query("insert into editor (url,titulo_es,texto_es) values ('".$prueba."','".$titulo."','".$texto."')");
		}

	echo '<meta http-equiv="refresh" content="0; url=index.php?dep='.$prueba.'">';
}


?>
