<?php
sleep(3);

//Recogemos la variable del numero de cuenta
$numcu=$_POST['cajanumcu'];
$fechaprimov=$_POST['cajaprimov'];
$fechasegmov=$_POST['cajasegmov'];

//Conectamos a la Base de datos
$conexion = mysql_connect("localhost", "root","nohay2sin3");
mysql_select_db("Banco", $conexion);



//Creamos la select
$select="SELECT * FROM movimientos WHERE mo_ncu='". $numcu ."';";
//Ejecutamos la select
$resultado = mysql_query($select, $conexion);

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

while ($row = mysql_fetch_row($resultado))
{
	echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td></tr>";
}
echo "</table>";

?>