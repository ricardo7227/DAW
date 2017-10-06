<?php
//____________________________________________________________________
// VARIABLES 

$cajanumcu=$_POST['cajanumcu'];
$cajadesc=$_POST['cajadesc'];
$cajaimporte=$_POST['cajaimporte'];

//________________________________________________________________________________________
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





//________________________________________________________________________________________
// MAIN

$comprobacionnumcu=validar_numcu($cajanumcu);
if ($comprobacionnumcu==1)
{
	
	//numero correcto HACER SELECT
	
	//Conectamos a la Base de datos
	$conexion = mysql_connect("localhost", "root","nohay2sin3");
	mysql_select_db("Banco", $conexion);
	$sentencia0="SELECT * FROM cuentas WHERE cu_ncu='". $cajanumcu ."';";
	$existecuenta= mysql_num_rows(mysql_query($sentencia0));
	$resultado = mysql_query($sentencia0, $conexion);
	
	if ($existecuenta==1)
	{
		if(!$resultado)
		{
			echo "<div class='w3-animate-opacity w3-pale-red cabecera w3-container w3-leftbar w3-border-teal'><p> Error en la select.</p></div>";
		}
		else
		{
			while ($row = mysql_fetch_row($resultado))
			{
				$cl_dni1=$row[1];
				$cu_sal=$row[3];
			}
			$sentencia1="SELECT * FROM clientes WHERE cl_dni='". $cl_dni1 ."';";
			$resultado2 = mysql_query($sentencia1, $conexion);
			if (!$resultado2)
			{
				echo "<div class='w3-animate-opacity w3-pale-red cabecera w3-container w3-leftbar w3-border-teal'><p> Error en la select de la tabla clientes. </p></div>";
			}
			else
			{
				while ($row2 = mysql_fetch_row($resultado2))
				{
					$cl_sal=$row2[8];
				}
				
				if($cu_sal>$cajaimporte) //SI EL SALDO DE LA CUENTA ES MENOR AL IMPORTE
				{
					$totalcu_sal=$cu_sal-$cajaimporte;
					$totalcl_sal=$cl_sal-$cajaimporte;
					$cu_sal=$cu_sal+$cajaimporte;
					$cl_sal=$cl_sal+$cajaimporte;
					$date=getdate();
					$fecha=$date[year]."-".$date[mon]."-".$date[wday];
					$hora=$date[hours].$date[minutes].$date[seconds];
					$sentencia2="UPDATE cuentas SET cu_sal='" . $totalcu_sal ."' WHERE cu_ncu='". $cajanumcu ."';";
					$sentencia3="UPDATE clientes SET cl_sal='". $totalcl_sal ."' WHERE cl_dni='". $cl_dni1 ."';";
					$sentencia4="INSERT INTO movimientos (mo_ncu, mo_fec, mo_hor, mo_des, mo_imp) VALUES ('".$cajanumcu."','".$fecha."','".$hora."','".$cajadesc."',".$totalcu_sal.");";
	
					$resultado3 = mysql_query($sentencia2, $conexion);
					$resultado4 = mysql_query($sentencia3, $conexion);
					$resultado5 = mysql_query($sentencia4, $conexion);
					if (!$resultado3 || !$resultado4 || !$resultado5)
					{
						echo "<div class='w3-animate-opacity w3-pale-red cabecera w3-container w3-leftbar w3-border-teal'><p> No se ha podido realizar el movimiento.</p></div>";
					}
					else
					{
						echo "<div class='w3-animate-opacity w3-pale-green cabecera w3-container w3-leftbar w3-border-teal'><h3>Los cambios se han realizado con éxito.</h3></div>";
						$sentencia5="SELECT * FROM movimientos WHERE mo_ncu='". $cajanumcu ."';";
						$resultado6 = mysql_query($sentencia5, $conexion);
						echo "<br><br><table class='w3-table w3-striped w3-border'>";
						echo "<thead>";
						echo "<tr class='w3-teal w3-opacity'>";
						echo "<th>Numero de cuenta</th>";
						echo "<th>Fecha</th>";
						echo "<th>Hora</th>";
						echo "<th>Descripción</th>";
						echo "<th>Saldo</th>";
						echo "</tr>";
						echo "</thead>";
						while ($row3 = mysql_fetch_row($resultado6))
						{
							echo "<tr><td>".$row3[0]."</td><td>".$row3[1]."</td><td>".$row3[2]."</td><td>".$row3[3]."</td><td>".$row3[4]."</td><td></tr>";
						}
						echo "</table>";
					}
				}
				else 
				{
					echo "<div class='w3-animate-opacity w3-pale-red cabecera w3-container w3-leftbar w3-border-teal'><p> No tienes suficiente dinero en la cuenta para realizar este reintegro.</p></div>";
				}
			}	
		}
	}
	else 
	{
		echo "<div class='w3-animate-opacity w3-teal cabecera w3-container w3-leftbar w3-border-teal'><p>Error: La cuenta no existe.</p></div>";
	}
	
}
else
{
	echo "<div class='w3-animate-opacity w3-teal cabecera w3-container w3-leftbar w3-border-teal'><p>Error: Numero incorrecto.</p></div>";	
}

?>