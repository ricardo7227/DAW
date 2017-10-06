<?php
$cuenta=$_POST['cajacuenta'];
$dni=$_POST['cajadni'];
$nombre=$_POST['cajanombre'];
$direccion=$_POST['cajadireccion'];
$telefono=$_POST['cajatelefono'];
$email=$_POST['cajaemail'];
$fnac=$_POST['cajafnac'];
$fap=$_POST['cajafap'];
$qcuentas=$_POST['cajaqcuentas'];
$saldo=$_POST['cajasaldo'];
$dni2=$_POST['cajadni2'];


//Conectamos a la Base de datos
$conexion = mysqli_connect("localhost", "root","nohay2sin3","Banco");


if(!$dni2)
{
	$dni2="";
}

$sentencia1="INSERT INTO clientes (cl_dni, cl_nom, cl_dir, cl_tel, cl_ema, cl_fna, cl_fcl, cl_ncu, cl_sal) VALUES ('" . $dni . "','" . $nombre . "','" . $direccion . "','" . $telefono . "','" . $email . "','". $fnac . "','". $fap ."'," . $qcuentas . "," . $saldo . ")";
$sentencia2="INSERT INTO cuentas (cu_ncu, cu_dn1, cu_dn2, cu_sal) VALUES ('" . $cuenta . "','" . $dni . "','" . $dni2 . "'," . $saldo . ")";

$resultado1=mysqli_query($conexion,$sentencia1);
$resultado2=mysqli_query($conexion,$sentencia2);

if(!$resultado1 || !$resultado2)
{
	echo "<div class='w3-animate-opacity w3-pale-red cabecera w3-container w3-leftbar w3-border-teal'><p> No ha sido posible crear la cuenta de ".$nombre.". </p></div>";
}
else
{
	echo "<div class='w3-animate-opacity w3-pale-green cabecera w3-container w3-leftbar w3-border-teal'><p> Se ha agregado la cuenta de ".$nombre." con éxito. </p></div>";
}



// SELECT GUARDAR DATOS
mysqli_close($conexion);
?>