<?php
// IAuxDB.php

interface IAuxDB
{
// funciones que se deben implementar
// en la clase que elija utilizar esta interfaz

	function conectar();
	function desconectar();
	function ejecutarSQL($strsql);
	function siguienteFila($rst);
	function liberarRecursos($rst);
}

?>