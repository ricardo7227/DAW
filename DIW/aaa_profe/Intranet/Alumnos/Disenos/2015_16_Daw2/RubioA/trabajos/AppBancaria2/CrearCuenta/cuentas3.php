<script type="text/javascript">

$(document).ready(function()
	{
	$("#Buscar").click(function(evento)
		{	
			evento.preventDefault();
			$("#destino").load("cuentas2.php",{cajanumcu:document.getElementById('cajanumcu').value});
		});

	$("#Buscardni").click(function(evento)
			{	
				evento.preventDefault();
				$("#destino").load("cuentas3.php",{cajanumcu:document.getElementById('cajanumcu').value, cajanumcu:document.getElementById('cajanumdni').value});
			});
	
	$("#Guardar").click(function(evento)
			{	
				evento.preventDefault();
				$("#destino").load("cuentas4.php",{cajacuenta:document.getElementById('cajanumcu').value, cajadni:document.getElementById('cajanumdni').value,cajanombre:document.getElementById('nombre').value, cajadireccion:document.getElementById('direccion').value,cajatelefono:document.getElementById('telefono').value,cajaemail:document.getElementById('email').value,cajafnac:document.getElementById('fnac').value,cajafap:document.getElementById('fap').value,cajaqcuentas:document.getElementById('qcuentas').value,cajasaldo:document.getElementById('saldo').value,cajadni2:document.getElementById('cajadni2').value});
			});
	$('#selectntitulares').change(function(evento)
			{
			ntitulares();
			});
	});
	
window.onload= function () 
		{
		if(window.addEventListener) 
			 	{
		 		document.getElementById('cajanumcu').addEventListener('change', comprobarnumcuenta, false);		
		 		document.getElementById('cajadni2').addEventListener('change', comprobarnumcuenta, false);		

		 		} 
		}
function ntitulares()
{
	var ntitulares=document.getElementById('labeldni2');
	var valorntitulares= ntitulares.value;
	if (valorntitulares==1)
	{
		ntitulares.className="invisible w3-label w3-text-grey";
	}
	else
	{
		ntitulares.className="visible w3-label w3-text-grey";
	}
}

function comprobarnumcuenta()
{
	var cajacuenta= document.getElementById('cajanumcu');						
	var numcu=cajacuenta.value;
	var primeros= numcu.substr(0,9);
	var ultimo=parseInt(numcu.substr(9,1));
	var suma=0;
	for (i=0;i<9;i++)
	{
		suma=eval(suma + parseInt(primeros[i]));
	}
	if(suma%9 == ultimo)
	{
		cajacuenta.className="w3-input w3-border w3-pale-green";
	}
	else
	{
		cajacuenta.className="w3-input w3-border w3-pale-red";
	}
}
</script>

<?php 
//_________________________________________________________________________________________________________

// VARIABLES 

$numcu=$_POST['cajanumcu'];
$dni1=$_POST['cajadni1'];

//_________________________________________________________________________________________________________

// FUNCIONES

function validar_numcu($numcuenta)
{
	$primeros=substr($numcuenta, 0, -1);
	$ultimo=substr($numcuenta, -1);
	$suma=0;
	for ($i=0;$i<9;$i++)
	{
		$suma = $suma + $primeros[$i];
	}
	
	if($numcuenta!="")
	{
		if ($suma%9 == $ultimo)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	else 
		{
			echo "<div class='w3-animate-opacity w3-pale-red cabecera w3-container w3-leftbar w3-border-teal'><p> NOTA: Debes introducir un Numero de Cuenta. </p></div>";
			return 0;
	}
	
	
}


function validar_dni($dni)
{
	$letra = substr($dni, -1);
	$numeros = substr($dni, 0, -1);
	$operacion=substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1);
	if($operacion==$letra)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
//___________________________________________________________
// MAIN 


$dnivalido=validar_dni($dni1);

if ($dnivalido==1)
{	
$select="SELECT * FROM clientes WHERE cl_dni='". $numdni ."';";
$resultado = mysql_query($select, $conexion);
	if(!$resultado)
	{
		$date=getdate();
		$fecha=$date[year]."-".$date[mon]."-".$date[wday];
		//NO EXISTE EL DNI ,,,, USUARIO NUEVO
		echo "<div class='w3-animate-opacity w3-teal cabecera w3-container w3-leftbar w3-border-teal'><h3> Creación de usuario nuevo </h3></div> ";
		echo "<label class='w3-label w3-text-grey'><b>Numero de Cuenta:</b><input id='cajanumcu' value='". $numcu ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'></label>";
		echo "<label class='w3-label w3-text-grey'><b>DNI:</b><input id='cajanumdni' value='". $dni1 ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'></label>";
		echo "<label class='w3-label w3-text-grey'><b>Nombre:</b><input id='nombre' class='w3-input w3-border w3-light-grey' type='text'></label>";
		echo "<label class='w3-label w3-text-grey'><b>Dirección:</b><input id='direccion' class='w3-input w3-border w3-light-grey' type='text'></label>";
		echo "<label class='w3-label w3-text-grey'><b>Teléfono:</b><input id='telefono' class='w3-input w3-border w3-light-grey' type='text'></label>";
		echo "<label class='w3-label w3-text-grey'><b>eMail:</b><input id='email' class='w3-input w3-border w3-light-grey' type='text'></label>";
		echo "<label class='w3-label w3-text-grey'><b>Fecha de Nacimiento:</b><input id='fnac' class='w3-input w3-border w3-light-grey' type='text'></label>";
		echo "<label class='w3-label w3-text-grey'><b>Fecha de Apertura:</b><input  id='fap' value='" . $fecha . "' disabled='disabled' class='w3-input w3-border w3-light-grey' type='text'></label>";
		echo "<label class='w3-label w3-text-grey'><b>Numero de Cuentas:</b><input id='qcuentas' class='w3-input w3-border w3-light-grey' type='text'></label>";
		echo "<label class='w3-label w3-text-grey'><b>Saldo:</b><input id='saldo' class='w3-input w3-border w3-light-grey' type='text'></label>";
		echo "<label class='w3-label w3-text-grey'><b>¿Cuantos titulares desea introducir?</b><br><select id='selectntitulares' class='w3-select' name='option'><option value='1'> 1 Titular </option><option value='2'> 2 Titulares</option></select></label><br>";	
		echo "<label id='labeldni2' class='invisible w3-label w3-text-grey'><b>DNI 2º Titular:</b><input id='cajadni2' class='w3-input w3-border w3-light-grey' type='text'></label><br>";
		echo "<br><button name='Guardar' id='Guardar' class='w3-btn w3-teal'>Guardar Cliente</button>";
		
	}
	else 
	{
		while ($row = mysql_fetch_row($resultado))
		{
			$cl_dni=$row[0];
			$cl_nom=$row[1];
			$cl_dir=$row[2];
			$cl_tel=$row[3];
			$cl_ema=$row[4];
			$cl_fna=$row[5];
			$cl_fcl=$row[6];
			$cl_ncu=$row[7];
			$cl_sal=$row[8];
			echo "<label class='w3-label w3-text-teal'><b>Numero de Cuenta:</b></label><input value='". $numcu ."' id='cajanumcu' disabled='disabled' class='w3-input w3-border w3-light-grey' type='text'>";
		
			echo "<div  class='w3-animate-top' id='primertitular' ><h3 class='cabecera w3-text-grey'> 1º Titular</h3><hr>";
		
			echo "<label class='w3-label w3-text-grey'><b>DNI:</b><input value='". $cl_dni ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
			echo "<label class='w3-label w3-text-grey'><b>Nombre:</b><input value='". $cl_nom ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
			echo "<label class='w3-label w3-text-grey'><b>Dirección:</b><input value='". $cl_dir ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
			echo "<label class='w3-label w3-text-grey'><b>Teléfono:</b><input value='". $cl_tel ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
			echo "<label class='w3-label w3-text-grey'><b>eMail:</b><input value='". $cl_ema ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
			echo "<label class='w3-label w3-text-grey'><b>Fecha de Nacimiento:</b><input value='". $cl_fna ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
			echo "<label class='w3-label w3-text-grey'><b>Fecha de Apertura:</b><input value='". $cl_fcl ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
			echo "<label class='w3-label w3-text-grey'><b>Numero de Cuentas:</b><input value='". $cl_ncu ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
			echo "<label class='w3-label w3-text-grey'><b>Saldo:</b><input value='". $cl_sal ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
		}
	}
}
else
{
	echo "<div class='w3-animate-opacity w3-pale-red cabecera w3-container w3-leftbar w3-border-teal'><p> DNI NO VALIDO </p></div>";
}
	
?>