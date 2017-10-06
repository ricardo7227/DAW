<?php
// Licencia.php

class Licencia {

private $AApellidos;
private $ANombre;
private $ADomicilio;
private $ATeléfono;
private $AEmail;
private $AClave1;
private $AClave2;
private $ATexto;
private $AClaveActiva;


function getAClaveActiva() {return $this->AClaveActiva;}


function Licencia($p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8) {

   	$this->AApellidos	= $p1;
	$this->ANombre	 	= $p2;
	$this->ADomicilio 	= $p3;
	$this->ATeléfono	= $p4;
	$this->AEmail		= $p5;
	$this->AClave1		= intval($p6);
	$this->AClave2		= intval($p7);
	$this->ATexto 		= $p8;

	// calcula la clave de activación con un algoritmo
	// que combina el valor de las dos claves
	$b =  intval((log($this->AClave1) + sin($this->AClave2)) * 137549);

	$this->AClaveActiva = substr($b,2,4);

}

function leer() {

	// Crear un objeto AuxDB
	$db = new AuxDB();
	$db->conectar();

	// sentencia Select para comprobar si existe el registro
	$sql = "Select * FROM Licencia Where AClave1 = " . $this->AClave1 . " ";

	// ejecución de la sentencia SQL
	$result = $db->ejecutarSQL($sql);
	$result = $db->cantidadFilas($result);

	// desconexión con el servidor de base de datos
	$db->desconectar();
	return $result;
}


function insertar() {

	// Crear un objeto AuxDB
	$db = new AuxDB();
	$db->conectar();

	// sentencia INSERT para insertar un cliente
	$sql = "Insert Into Licencia (AApellidos, ANombre, ADomicilio, ATelefono, AEmail, AClave1, AClave2,AObserv,AClaveActiva,AFecha) Values ('";
	$sql.= mysql_escape_string($this->AApellidos) . "', '";
	$sql.= mysql_escape_string($this->ANombre) . "', '";
	$sql.= mysql_escape_string($this->ADomicilio) . "', '";
	$sql.= mysql_escape_string($this->ATeléfono) . "', '";
	$sql.= mysql_escape_string($this->AEmail) . "', ";
	$sql.= mysql_escape_string($this->AClave1) . ", '";
	$sql.= mysql_escape_string($this->AClave2) . "', '";
	$sql.= mysql_escape_string($this->ATexto) . "', '";
	$sql.= mysql_escape_string($this->AClaveActiva) . "', ";
	$sql.=  "NOW() ) ";


	// ejecución de la sentencia SQL
	$db->ejecutarSQL($sql);

	// desconexión con el servidor de base de datos
	$db->desconectar();
}



}

