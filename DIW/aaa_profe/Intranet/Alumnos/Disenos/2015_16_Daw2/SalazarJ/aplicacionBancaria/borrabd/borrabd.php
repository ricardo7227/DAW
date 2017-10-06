<?php
	//Conexion a la base de datos
	echo "Se intenta establecer la conexion: ";
	$conexion= new mysqli("localhost","root","nohay2sin3");
	if(mysqli_connect_errno())
	{
		echo "ERROR!--".mysqli_connect_error($conexion);
		exit();
	}
	echo " OK!<br>";
	
	//Se borra la base de datos
	$borrabd="drop database Banco;";
	echo "Borrando base de datos: ";
	mysqli_query($conexion,$borrabd);
	if(mysqli_errno($conexion))
	{
		echo "ERROR!--".mysqli_error($conexion);
		exit();
	}
	echo " OK!<br>";