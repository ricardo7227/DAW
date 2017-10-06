
<?php
	//Conexion a la base de datos
	echo "Estableciendo la conexion:";
	$conexion= new mysqli("localhost","root","nohay2sin3");
	if(mysqli_connect_errno())
	{
		echo "ERROR!--".mysqli_connect_error($conexion);
		exit();
	}
	echo " OK!<br>";
	
	//Creacion de la base de datos
	$creaBD="create database Banco;";
	echo "Creando la Base de Datos: ";
	if(!mysqli_query($conexion,$creaBD))
	{
		echo "ERROR!--".mysqli_error($conexion);
		exit();
	}
	echo " OK!<br>";
	
	//Cambio de BD
	mysqli_select_db($conexion,"Banco");
	
	//Creacion tabla clientes
	$sentencia="CREATE TABLE clientes(cl_dni VARCHAR(10) NOT NULL,".
				"cl_nom VARCHAR(50) NOT NULL,".
				"cl_dir VARCHAR(60) NOT NULL,".
				"cl_tel VARCHAR(9) NOT NULL,".
				"cl_ema VARCHAR(65) NOT NULL,".
				"cl_fna DATE,".
				"cl_fcl DATE NOT NULL,".
				"cl_ncu TINYINT(2) NOT NULL,".
				"cl_sal INT(8) NOT NULL,".
				"PRIMARY KEY(cl_dni)) ENGINE=MYISAM;";
	echo "Creando la tabla  CLIENTES: ";
	if(!mysqli_query($conexion,$sentencia))
	{
		echo " ERROR!--".mysqli_error($conexion);
		exit();
	}
	echo " OK!<br>";
	
	//Creacion tabla cuentas
	$sentencia="CREATE TABLE cuentas(cu_ncu VARCHAR(10) NOT NULL,".
				"cu_dn1 VARCHAR(9) NOT NULL,".
				"cu_dn2 VARCHAR(9) ,".
				"cu_sal INT(8) NOT NULL,".
				"PRIMARY KEY (cu_ncu),".
				"FOREIGN KEY (cu_dn1,cu_dn2) REFERENCES clientes(cl_dni,cl_dni)".
				")ENGINE=MYISAM;";
	echo "Creando la tabla CUENTAS: ";
	if(!mysqli_query($conexion,$sentencia))
	{
		echo " ERROR!--".mysqli_error($conexion);
		exit();
	}
	echo" OK!<br>";
	
	//Creacion tabla movimientos
	$sentencia="CREATE TABLE movimientos (mo_ncu VARCHAR(10) NOT NULL,".
				"mo_fec DATE NOT NULL,".
				"mo_hor VARCHAR(6) NOT NULL,".
				"mo_des VARCHAR(80) NOT NULL,".
				"mo_imp INT(8) NOT NULL,".
				"PRIMARY KEY(mo_ncu,mo_fec,mo_hor)) ENGINE=MYISAM;";
	echo "Creandola tabla MOVIMIENTOS: ";
	if(!mysqli_query($conexion,$sentencia))
	{
		echo " ERROR!--".mysqli_error($conexion);
		exit();
	}
	echo " OK!<br>";
	
	//Inserción de datos
	echo "------------------------------------------<br>";
	echo "INSERTANDO DATOS<br>";
	
	//Inserccion de datos tabla clientes
	$sentencia= "INSERT INTO clientes (cl_dni,cl_nom,cl_dir,cl_tel,cl_ema,cl_fna,cl_fcl,cl_ncu,cl_sal) VALUES
				('11111111A', 'Paco', 'Plz Orense', '692585993', 'jonathan.salozano@gmail.com', '1990-10-15', '1995-01-29', 2, 3000),
				('22222222B', 'Paquita', 'Plz Orense', '692585993', 'jonathan.salozano@gmail.com', '1990-10-15', '1995-01-29', 2, 1500),
				('33333333C', 'Paco', 'Plz Orense', '692585993', 'jonathan.salozano@gmail.com', '1990-10-15', '1995-01-29', 1, 2000);";
	echo "Insertando datos clientes:";
	if(!mysqli_query($conexion,$sentencia))
	{
		echo " ERROR!--".mysqli_error($conexion);
		exit();
	}
	echo " OK!<br>";
	
	//Inserccion de datos tabla cuentas
	$sentencia="INSERT INTO cuentas (cu_ncu, cu_dn1, cu_dn2, cu_sal) VALUES
  				('0000000011','11111111A','22222222B',1000),
 				('0000000022','11111111A','33333333C',2000),
 				('0000000033','22222222B','',500);";
	
	echo "Insertando datos cuentas:";
	if(!mysqli_query($conexion,$sentencia))
	{
		echo " ERROR!--".mysqli_error($conexion);
		exit();
	}
	echo " OK!<br>";
	
	//Inserccion de datos tabla movimientos
	$sentencia="INSERT INTO movimientos (mo_ncu, mo_fec, mo_hor, mo_des, mo_imp) VALUES
			   ('0000000011','2016-01-27','102045','descripcion1',1000),
			   ('0000000022','2016-01-28','120045','descripcion2',2000),
			   ('0000000033','2016-01-29','150045','descripcion3',500);";
	
	echo "Insertando datos movimientos:";
	if(!mysqli_query($conexion,$sentencia))
	{
		echo " ERROR!--".mysqli_error($conexion);
		exit();
	}
	echo " OK!<br>";
	
	$conexion->close();
	
?>
