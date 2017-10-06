
<script>
	function Mostrar_ocultar(id)
	{
		 $('#'+id).slideToggle();
	}
 </script>	
<div id='cuerpo-centro'>
<?php
$Contador = 1;
$Carpeta = array("AUTO" => "Automocion",
	"BIOGE" => "Biografia",
	"DIBUJ" => "Dibujo",
	"ECONO" => "Economia",
	"EDFIS" => "Educacion_Fisica",
	"ELECT" => "Electricidad_Electronica",
	"EXT" => "Extraexcolares",
	"FILOS"=>"Filosofia",
	"FIYQU"=>"Fisica_Quimica",
	"FOL"=>"Fol",
	"FRAN"=>"Frances",
	"FRYCA"=>"Frio_Calor",
	"GEYHI"=>"Geografia_Historia",
	"INFOR"=>"Informatica",
	"INGLE"=>"Ingles",
	"LEYLI"=>"Lengua_Literatura",
	"MATEM"=>"Matematicas",
	"MUSIC"=>"Musica",
	"ORIEN"=>"Orientacion",
	"RELIG"=>"Religion",
	"TECNO"=>"Tecnologia");
if (isset($_SESSION['login']) && ($_SESSION['login']=='ok'))
{
	$usuario= $_SESSION['prueba'];
	$sql ="Select us_codrol from usuarios where us_cuenta = ".$usuario.";";
	$query = mysql_query($sql);
	while ($fila = mysql_fetch_assoc($query))
	{
		$rol= $fila['us_codrol'];
	}
	if($rol=='60')
	{
		$sql ="SELECT de_codigo, de_descri_es FROM departamentos WHERE de_jefe=(SELECT pr_codigo FROM profesores WHERE pr_cuenta=".$usuario.");";
		$query = mysql_query($sql);
		while ($fila = mysql_fetch_assoc($query))
		{
			$CodigoDepartamento= $fila['de_codigo'];
			$DescripcionDepartamento= $fila['de_descri_es'];
		}
		RolDepartamento($Carpeta,$CodigoDepartamento,$DescripcionDepartamento );
	}else if($rol>='70')
	{
		echo "<h1>Consultas de las Actas Por Departamentos</h1>";
		echo "<hr size='5' width='600' color='white' />";
		echo "<div class='ActConTodosDep'>";
		RolDireccion($Carpeta);
		echo "</div>";
	}
}

function RolDireccion($Carpeta)
{
	foreach($Carpeta as $indice => $valor)
	{
		
		ColsultarActas($valor);
		
	}
}

function RolDepartamento($Carpeta , $Departamento , $Nombre)
{
	echo "<h1>Consultas de las Actas de ".$Nombre."</h1>";
	echo "<hr size='5' width='600' color='white' />";
	echo "<div class='ActConTodosDep'>";
	foreach($Carpeta as $indice => $valor)
	{
		if(strcmp($indice,$Departamento)==0){
		ColsultarActas($valor);
		}
	}
	echo "</div>";
}

function ColsultarActas($NombreCarpeta)
{
	global $Contador;
	$path="actas/".$NombreCarpeta;
	if (is_dir($path)) {
    if ($dir_handle = @opendir($path)) {
	echo "<div class='ActConDep' id='$NombreCarpeta' onClick=Mostrar_ocultar('Contenido".$Contador."');>$NombreCarpeta</div>";
	echo "<div class='ActConDepCont' style='display:none;' id='Contenido$Contador'>";
		$Contador++;
        while (($file = readdir($dir_handle))!== false)
		{
			$Pos=strrpos($file,".");
			$Extension=substr($file,$Pos);
			if ($Extension == '.pdf')
			{
				echo "<a href=".$path."/".$file." target='_blank' id=ActConEnlace title=\"$file\"><div class='ActConAct'>";
				echo substr($file,0,strlen($file)-strlen(strrchr($file,'.')));
				echo "</div></a>";
			}
        }
		echo "</div>";
        closedir($dir_handle);
    }
}
}	
?>
</div>