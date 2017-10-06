<?php
sleep(3);


$numcu=$_POST['cajanumcu'];

$conexion = mysql_connect("localhost", "root","nohay2sin3");
mysql_select_db("Banco", $conexion);

$select="SELECT * FROM cuentas WHERE cu_ncu='". $numcu ."';";

$resultado = mysql_query($select, $conexion);

echo "<table class='w3-table w3-striped w3-border'>";
echo "<thead>";
echo "<tr class='w3-teal w3-opacity'>";
echo "<th>Numero de cuenta</th>";
echo "<th>DNI (1º Titular)</th>";
echo "<th>DNI (2º Titular)</th>";
echo "<th>Saldo</th>";
echo "</tr>";
echo "</thead>";

while ($row = mysql_fetch_row($resultado))
{	
	echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td><input id='seleccionado' type='checkbox'></td></tr>";		
}
echo "<tr><td colspan='4'><input type='button' onclick='pregunta()' id='Borrar' name='Borrar' value='Borrar Cuenta' class='w3-btn w3-teal'></td></tr>";
echo "</table>";

?>