<?php
// header.php

function __autoload($objeto)
{
	include("Objetos/".$objeto.".php");
}
?>
<html>
<head>
<title>Aplicación de ejemplo: Licencia de activación (capítulo 19)</title>

<?php
include("estilos.php")
?>

</head>
<body>
<div align="center">
<table cellpadding="0" cellspacing="0" width="90%">
<tr><td colspan="3" class="título">Licencia de activación de software</td></tr>
<tr><td colspan="3"><br/></td></tr>

<tr>
  <td class="marco" width="80%">
