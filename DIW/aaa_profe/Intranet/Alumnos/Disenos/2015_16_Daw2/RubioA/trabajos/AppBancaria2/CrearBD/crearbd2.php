<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Prueba</title>
		<link rel="stylesheet" href="../../style/w3.css">
		<link rel="stylesheet" type="text/css" href="../../style/estilo.css">
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
		<script src="../../js/jquery-1.12.0.min.js" type="text/javascript"></script>  

	<script type="text/javascript">


	</script>
	
	</head>
	<body>	
		<header class="cabecera w3-container w3-teal">
  			<a href="../../index.php"><h1><i class="fa fa-bank w3-xxxlarge"></i>Aplicación Bancaria</h1></a>
		</header>
		<div class="cabecera w3-container w3-teal">
			  <h3>Nueva Base de Datos</h3>
		</div>
		
		<div class="contenedor w3-container">
		  			
  			<div class="w3-container" >
  				<div name="cargando" id="cargando" class="w3-animate-opacity w3-teal cabecera w3-container w3-leftbar w3-border-teal">
  					<i class="fa fa-spinner fa-spin"></i>
<?php
$conexion=mysqli_connect("localhost","root","nohay2sin3") or die("Error al establecer la conexion con el servidor MySQL");
echo "Conexión con la base de datos establecida con éxito";
?>
				</div>
				
				<div class="w3-animate-opacity w3-teal cabecera w3-container w3-leftbar w3-border-teal">
<?php
$conexion=mysqli_connect("localhost","root","nohay2sin3") or die("Error al establecer la conexion con el servidor MySQL");
?>
				</div>
				<div class="w3-animate-opacity w3-teal cabecera w3-container w3-leftbar w3-border-teal">
				<i class="fa fa-spinner fa-spin"></i>

<?php 
echo "Creando la base de datos..";
$sentencia="CREATE DATABASE Banco;";
?>
				</div>
				<div class="w3-animate-bottom w3-card-8 w3-teal">

<?php
if(!mysqli_query($conexion,$sentencia))
{
	die ("<strong>No se ha podido crear la base de datos </strong><br>" . mysqli_error($conexion));
}
$selectedDB=mysqli_select_db($conexion,'Banco');
?>
				</div>
				<div class="w3-animate-opacity w3-teal cabecera w3-container w3-leftbar w3-border-teal">
				<i class="fa fa-spinner fa-spin"></i>

<?php
echo "Creando tablas..";
//CREANDO TABLA CLIENTES
$sentencia="CREATE TABLE clientes (cl_dni VARCHAR(9)  NOT NULL, " .
                               "cl_nom VARCHAR(50) NOT NULL, " .
                               "cl_dir VARCHAR(60) NOT NULL, " .
                               "cl_tel VARCHAR(9)  NOT NULL, " .
                               "cl_ema VARCHAR(65) NOT NULL, " .
                               "cl_fna DATE, " .
                               "cl_fcl DATE        NOT NULL, " .
                               "cl_ncu TINYINT(2)  NOT NULL, " .
                               "cl_sal INT(8)      NOT NULL, " .
                               "PRIMARY KEY (cl_dni)) ENGINE = MYISAM;";
?>
				</div>
				<div class="w3-animate-opacity w3-teal cabecera w3-container w3-leftbar w3-border-teal">

<?php
if(!mysqli_query($conexion,$sentencia))
{
	die ("<div class='w3-animate-opacity w3-pale-red cabecera w3-container w3-leftbar w3-border-teal'>No se ha podido crear la tabla de Clientes </div><br>" . mysqli_error($conexion));
}
?>
				</div>
				<div class="w3-animate-opacity w3-teal cabecera w3-container w3-leftbar w3-border-teal">

<?php
//CREANDO TABLA CUENTAS
$sentencia="CREATE TABLE cuentas (cu_ncu VARCHAR(10)  NOT NULL, " .
                              "cu_dn1 VARCHAR(9)   NOT NULL, " .
                              "cu_dn2 VARCHAR(9), " .
                              "cu_sal INT(8)      NOT NULL, " .
                              "PRIMARY KEY (cu_ncu), " .
                              "FOREIGN KEY (cu_dn1, cu_dn2) REFERENCES clientes(cl_dni, cl_dni)" .
                              ") ENGINE = MYISAM;";
?>
				</div>
				<div class="w3-animate-bottom w3-card-8 w3-teal">

<?php
if(!mysqli_query($conexion,$sentencia))
{
	die ("<strong>No se ha podido crear la tabla Cuentas </strong><br>" . mysqli_error($conexion));
}
?>
				</div>
				<div class="w3-animate-bottom w3-card-8 w3-teal">

<?php
//CREANDO TABLA MOVIMIENTOS
$sentencia="CREATE TABLE movimientos (mo_ncu VARCHAR(10)  NOT NULL, " .
                                  "mo_fec DATE         NOT NULL, " .
                                  "mo_hor VARCHAR(6)   NOT NULL, " .
                                  "mo_des VARCHAR(80)  NOT NULL, " .
                                  "mo_imp INT(8)       NOT NULL, " .
                                  "PRIMARY KEY (mo_ncu, mo_fec, mo_hor)) ENGINE = MYISAM;";
?>
				</div>
				<div class="w3-animate-bottom w3-card-8 w3-teal">
				
<?php
if(!mysqli_query($conexion,$sentencia))
{
	die ("<strong>No se ha podido crear la tabla Movimientos </strong><br>" . mysqli_error($conexion));
}
?>
				</div>
				<div class="w3-animate-bottom w3-card-8 w3-teal">

<?php
echo "<h2>Base de datos 'BANCO' creada con éxito</h2>";
mysql_close($conexion);
?>
				</div>
  			</div>
		</div>
	
		<div class="w3-container w3-teal">
			<p>Alejandro Rubio</p>
		</div>
	</body>
</html>