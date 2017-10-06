<?php
// AuxDB.php


class AuxDB implements IAuxDB
{
// esta clase es específica para trabajar con MySQL
// variable privada para guardar la cadena de conexión
private $strcon;


function conectar() {
	$this->strcon = mysqli_connect("localhost","root","0021", "LicenciaDB") or
		die("Error de aplicación: No conectó con la base de datos");
	
}

function desconectar() {
	mysqli_close($this->strcon);
}

function ejecutarSQL($strSQL) {

         print $strSQL . "<BR>";
	$result = mysqli_query($this->strcon, $strSQL);
	// Muestra el detalle del mensaje de error MySQL
	// esto no se debería dejar en una aplicación en producción
	if (!$result) {
		$msg  = 'Consulta inválida: ' . mysql_error() . "\n";
		$msg .= 'SQL: ' . $strSQL;
		die($msg);
	}

	return $result;
}

function siguienteFila($rst) {
	return mysqli_fetch_assoc($rst);
}

function cantidadFilas($rst) {
	return mysqli_num_rows($rst);
}

function liberarRecursos($rst) {
	mysqli_free_result($rst);
}
}
?>