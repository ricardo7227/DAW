<?php
// Operador de omisi�n de errores (file016.php)

$var1 = 3;
$var2 = 0;
// La siguiente instrucci�n no genera error
// aunque sea una divis�n por cero
$huboerror = "Variable vac�a: Error en instrucci�n";
$nohuboerror = "Variable con valor";
 
@$resultado = $var1 / $var2;
echo (empty($resultado))? $huboerror: $nohuboerror;

?>