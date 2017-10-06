<script type="text/javascript">

$(document).ready(function()
	{
	$("#Buscardni").click(function(evento)
			{	
				evento.preventDefault();
				$("#destino").load("cuentas3.php",{cajanumcu:document.getElementById('cajanumcu').value, cajadni1:document.getElementById('cajadni1').value});
			});
	$('#cajadni1').focusout(function(evento)
			{
			comprobardni();
			});
	});

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

function comprobardni()
{
	  var cajadni1=document.getElementById('cajadni1')
	  var dni=cajadni1.value;
	  var numero;
	  var letr;
	  var letra;
	  var expresion_regular_dni=/^\d{8}[a-zA-Z]$/;
	  
	  if(expresion_regular_dni.test (dni) == true)
		  {
	     	numero = dni.substr(0,dni.length-1);
	     	letr = dni.substr(dni.length-1,1);
	     	numero = numero % 23;
	     	letra='TRWAGMYFPDXBNJZSQVHLCKET';
	     	letra=letra.substring(numero,numero+1);
		    if (letra!=letr.toUpperCase()) 
			    {
		       	cajadni1.className="w3-input w3-border w3-pale-red";
		     	}
		    else
			    {
		       	cajadni1.className="w3-input w3-border w3-pale-green";
		     	}
	  }
	  else
		  {
	      alert('Error de DNI: formato no válido.');
	      }
}
</script>



<?php
//_________________________________________________________________________________________________________

// VARIABLES 

$numcu=$_POST['cajanumcu'];

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

//_________________________________________________________________________________________________________

// MAIN


$numcu=$_POST['cajanumcu'];

//Conectamos a la Base de datos
$conexion = mysql_connect("localhost", "root","nohay2sin3");
mysql_select_db("Banco", $conexion);
$select="SELECT * FROM cuentas WHERE cu_ncu='". $numcu ."';";
$existecuenta= mysql_num_rows(mysql_query($select));


if ($existecuenta==1)
	{		
		$select="SELECT * FROM cuentas WHERE cu_ncu='". $numcu ."';";
		$resultado = mysql_query($select, $conexion);
		while ($row = mysql_fetch_row($resultado))
		{
			$dni1=$row[1];
			$dni2=$row[2];
		}
		if($dni1)
		{
			$select="SELECT * FROM clientes WHERE cl_dni='". $dni1 ."';";
			$resultado = mysql_query($select, $conexion);
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
				echo "<div class='w3-animate-opacity w3-teal cabecera w3-container w3-leftbar w3-border-teal'><h3> Datos de la cuenta: " . $numcu . " </h3></div>";
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
					
					if($dni2!="")
					{
						$select="SELECT * FROM clientes WHERE cl_dni='". $dni2 ."';";
						$resultado = mysql_query($select, $conexion);
						while ($row = mysql_fetch_row($resultado))
						{
							$cl_dni2=$row[0];
							$cl_nom2=$row[1];
							$cl_dir2=$row[2];
							$cl_tel2=$row[3];
							$cl_ema2=$row[4];
							$cl_fna2=$row[5];
							$cl_fcl2=$row[6];
							$cl_ncu2=$row[7];
							$cl_sal2=$row[8];					
							echo "<br><div  class='w3-animate-top' id='segundotitular' ><h3 class='cabecera w3-text-grey'> 2º Titular</h3><hr>";
								
							echo "<label class='w3-label w3-text-grey'><b>DNI:</b><input value='". $cl_dni2 ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
							echo "<label class='w3-label w3-text-grey'><b>Nombre:</b><input value='". $cl_nom2 ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
							echo "<label class='w3-label w3-text-grey'><b>Dirección:</b><input value='". $cl_dir2 ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
							echo "<label class='w3-label w3-text-grey'><b>Teléfono:</b><input value='". $cl_tel2 ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
							echo "<label class='w3-label w3-text-grey'><b>eMail:</b><input value='". $cl_ema2 ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
							echo "<label class='w3-label w3-text-grey'><b>Fecha de Nacimiento:</b><input value='". $cl_fna2 ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
							echo "<label class='w3-label w3-text-grey'><b>Fecha de Apertura:</b><input value='". $cl_fcl2 ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
							echo "<label class='w3-label w3-text-grey'><b>Numero de Cuentas:</b><input value='". $cl_ncu2 ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
							echo "<label class='w3-label w3-text-grey'><b>Saldo:</b><input value='". $cl_sal2 ."' class='w3-input w3-border w3-light-grey' disabled='disabled' type='text'>";
						}
					}
					else
					{	
						echo "<br><div  class='w3-animate-top' id='segundotitular' ><h3 class='cabecera w3-text-grey'> 2º Titular</h3><hr>";
						echo "<label class='w3-label w3-text-grey'><b>DNI:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
						echo "<label class='w3-label w3-text-grey'><b>Nombre:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
						echo "<label class='w3-label w3-text-grey'><b>Dirección:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
						echo "<label class='w3-label w3-text-grey'><b>Teléfono:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
						echo "<label class='w3-label w3-text-grey'><b>eMail:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
						echo "<label class='w3-label w3-text-grey'><b>Fecha de Nacimiento:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
						echo "<label class='w3-label w3-text-grey'><b>Fecha de Apertura:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
						echo "<label class='w3-label w3-text-grey'><b>Numero de Cuentas:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
						echo "<label class='w3-label w3-text-grey'><b>Saldo:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
					}
			}
		}//SI EXISTE EL DNI
		else 
		{
			//SI QUIERES METER UN SEGUNDO TITULAR A UNA CUENTA YA EXISTENTE PERO NO FUNCIONA
			echo "<label class='w3-label w3-text-grey'><b>DNI:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
			echo "<label class='w3-label w3-text-grey'><b>Nombre:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
			echo "<label class='w3-label w3-text-grey'><b>Dirección:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
			echo "<label class='w3-label w3-text-grey'><b>Teléfono:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
			echo "<label class='w3-label w3-text-grey'><b>eMail:</b><input class='w3-input w3-border w3-light-grey' type='text'>";
			echo "<label class='w3-label w3-text-grey'><b>Fecha de Nacimiento:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
			echo "<label class='w3-label w3-text-grey'><b>Fecha de Apertura:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
			echo "<label class='w3-label w3-text-grey'><b>Numero de Cuentas:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
			echo "<label class='w3-label w3-text-grey'><b>Saldo:</b><input class='w3-input w3-border w3-light-grey' type='text'></label>";
				
		}//SI NO EXISTE EL DNI
	}// SI EXISTE LA CUENTA
	else 
	{
		?> <?php
		echo "<div class='w3-animate-opacity w3-teal cabecera w3-container w3-leftbar w3-border-teal'><h3> La cuenta ". $numcu." está libre.</h3></div> ";
		echo "<label class='w3-label w3-text-teal'><b>Numero de Cuenta:</b></label><input value='". $numcu ."' id='cajanumcu' disabled='disabled' class='w3-input w3-border w3-light-grey' type='text'>";
		echo "<label class='w3-label w3-text-teal'><b>DNI (1º Titular)</b></label><input id='cajadni1' class='w3-input w3-border w3-light-grey' type='text'><br><button value='Buscardni' id='Buscardni'' class='w3-btn w3-teal'>Buscar</button>";
	}//Si no existe la cuenta 


?>
