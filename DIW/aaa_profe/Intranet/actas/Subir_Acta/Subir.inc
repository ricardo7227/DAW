<div id='cuerpo-centro'>
<script> 
function validarEntero(valor){ 
    //intento convertir a entero. 
    //si era un entero no le afecta, si no lo era lo intenta convertir 
    valor = parseInt(valor)

    //Compruebo si es un valor numérico 
    if (!isNaN(valor) | valor=="") { 
        //En caso contrario (Si era un número) devuelvo el valor 
       return valor 
    }else{ 
       //entonces (no es numero) devuelvo el valor cadena vacia
       return '' 
    } 
}

function compruebaValidoEntero(){ 
   	enteroValidado = validarEntero(document.f1.NumeroActa.value) 
   	if (enteroValidado == ""){ 
		 document.getElementById('ActSubErrorNun').innerHTML = 'Escribe un numero.';
   	}else 
		document.getElementById('ActSubErrorNun').innerHTML = '';
      	 document.f1.NumeroActa.value = enteroValidado 
} 
  function ValidarFecha() {
        // Expresion regular que representa una Fecha válida
        cadena = '^[0-3][0-9]-[0|1][0-9]-[0-9]{4}$'; 
        re = new RegExp(cadena);
 
        if (document.getElementById("FechaActa").value.match(re))
            document.getElementById('ActSubErrorFecha').innerHTML = '';  
        else 
            document.getElementById('ActSubErrorFecha').innerHTML = 'No es una Fecha Valida';
    }
</script> 
<?php
	function Formulario()
	{
	?>
	<div id='ActSubCont'>
		<div id='ActSubForm'>
			<label id='ActSubErrorPrincipal'></label></br>
			<form method="post" enctype="multipart/form-data" name="f1">
				<table >
					<tr><!--Numero del Acta-->
						<td class="ActSubForCol1"> <label id='ActSubNum'>N del Acta*:</label> </td>
						<td> <input type='text' name='NumeroActa' maxlength='3' size='1' value='' onblur="compruebaValidoEntero()"/>
						<label class='ActSubError' id='ActSubErrorNun'></label> </td>
				</tr>
				<tr><!--Fecha del Acta-->
					<td class="ActSubForCol1" valign="top"> <label >Fecha del Acta*:</label> </td>
					<td> <input type='text' name='FechaActa' id='FechaActa' maxlength='10' size='6'onblur="ValidarFecha()"> <label class='ActSubError' id='ActSubErrorFecha'></label>
					</br> <label class='ActSubEjem'>Formato:(DD-MM-AAAA)</label>
					  </td>
				</tr>
				<tr><!--Introduccir el fichero-->
					<td> <label>Seleccione el Acta*:</label></td>
				</tr>
				<tr>
					<td colspan='3'> <input name='archivo' type='file' size='10' accept='application/pdf'/></td>
				</tr>
				<tr>
					<td colspan='3'> <label class='ActSubEjem'>Solo Admite Documentos de 'Pdf'</label></td>
				</tr>
				<tr><!--Boton Subir Acta-->
					<td colspan='2'> <input id='ActSubButt' type='submit' name='Subir' value='Subir Acta'/> </td>
				</tr>
				<tr>
					<td colspan='3> <label class='ActSubEjem'>*Campos Obligatorios</label></td>
				</tr>
			</table>
		</form>
	</div>


<div id='ActSubForm'>
<div><u>Instrucciones Para subir las Actas</u></div>
<div style="font-size:13px;margin:5px 0px 0px 5px">1&deg;- Debes de introducir el numero del acta correspondiente al archivo que vayas a subir.</br>
2&deg;- Introduccir la fecha del Acta con este tipo de formato DD-MM-AAAA (17-06-2013).</br>
3&deg;- Elegir el archivo del Acta que debe de ser tipo PDF.</br>
4&deg;- Por ultimo presionar el botton subir acta. </br>
</div>
</div>
</div>
<?php
}
function validar_fecha($fecha)
{
if (preg_match("/^[0-3][0-9]-[0-1][0-9]-[0-9]{4}$/", $fecha )) {
   return true;
} else {
    return false;
}
}
function validar_numero($numero){
if(is_numeric($numero)){
     //la variable es un numero
     return true;
}else{
     //la variable no es numero
     return false;
}
}
$Directorio='';
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
		foreach($Carpeta as $indice => $valor)
	{
		if(strcmp($indice,$CodigoDepartamento)==0){
			echo "<h1>Subida de las Actas de ".$DescripcionDepartamento."</h1>";
			echo "<hr size='5' width='600' color='white' />";
			Formulario();
			$Directorio = $valor;
			break;
		}
	}
		
	}
}
	function ValidarCampos($Directorio)
	{
		$Fecha = $_POST['FechaActa'];
		$Numero = $_POST['NumeroActa'];
		if(validar_fecha($Fecha) && validar_numero($Numero))
		{
			$SubirFichero='True';
			$path="actas/".$Directorio;
			$NombreArchivo="Acta".$Numero.$Directorio."(".$Fecha.").pdf";
			if (is_dir($path)) {
				if ($dir_handle = @opendir($path)) {
					while (($file = readdir($dir_handle))!== false)
					{
						$Pos=strrpos($file,".");
						$Extension=substr($file,$Pos);
						if ($Extension == '.pdf')
						{
							if(strcasecmp($NombreArchivo,$file)==0){
								$SubirFichero='False';
								break;
						}
					}
				}
				closedir($dir_handle);
			}
			if(strcasecmp($SubirFichero,'False')==0)
			{
				echo "<script>
						alert('Hay un Acta con los mismo Datos Verificalos');
						</script>";
			}else{
				subirarchivo($Directorio,$Fecha,$Numero);
			}
		}
		}else{
			echo "<script>
			alert('Rellena correctamente los campos');
			</script>";
		}
	}
function subirarchivo($Directorio,$F,$N)
{ 
	//Para entrar en el primer if tiene que cumplir tres condiciones, una de ellas que el archivo pese menos de 1Mb,
	//que sea un archivo PDF y halla selecionado un departamento.
	if($_FILES["archivo"]['size']<150000 && $_FILES["archivo"]['type']=="application/pdf"){
		//Nombre del archivo pondra el departamento y la fecha de la subida del archivo.
		$nombre = "Acta".$N.$Directorio."(".$F.").pdf";
		//La ruta es donde se guarda el acta, que dependiendo de la seleccion se guarda en una carpeta o otra.
		$ruta = "actas/".$Directorio."/".$nombre;
		//Copia el archivo del la carpeta temporal a la ruta puesta anteriormente.
       copy($_FILES['archivo']['tmp_name'],$ruta);
	   echo "<script>
			alert('El Archivo ha sido subido correctamente al departamento ".$Directorio."');
			</script>";
	   }else{
	   if($_FILES["archivo"]['type']=="application/pdf"){
	   if($_FILES["archivo"]['size']>150000)
	     {
			echo "<script>
			alert('El Archivo es muy pesado');
			</script>";
	     }
	   }else{
			echo "<script>
			alert('El Archivo no es un PDF ó No has seleccionado un Archivo');
			</script>";
	   }
	   }
	}
	
	if(@$_POST['Subir']){
		validarCampos($Directorio);
	}
?>
</div>
