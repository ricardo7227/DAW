<html><head>
<title>ejemplo de env�o de correo (file154.php)</title>
</head>
<body>
<?php
// aqu� podr�a incluirse validaci�n de los datos,
// registro en una base de datos, etc.
$Nombre = $_POST['Nombre'];
$Email = $_POST['Email'];
$Mensaje = $_POST['Mensaje'];


$ret = mail('test@gmail.com',
            'Pedido de informaci�n',
            "Solicitado por: $Nombre\r\n
            que escribe: $Mensaje \r\n",
            "From : $Email");
if ($ret) {
    echo "<P>Se envi� su mensaje";
} else {
    echo "<P>Lo siento, no se pudo enviar su mensaje";
}
?>
</body>
</html>