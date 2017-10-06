<html><head>
<title>ejemplo de envío de correo (file154.php)</title>
</head>
<body>
<?php
// aquí podría incluirse validación de los datos,
// registro en una base de datos, etc.
$Nombre = $_POST['Nombre'];
$Email = $_POST['Email'];
$Mensaje = $_POST['Mensaje'];


$ret = mail('test@gmail.com',
            'Pedido de información',
            "Solicitado por: $Nombre\r\n
            que escribe: $Mensaje \r\n",
            "From : $Email");
if ($ret) {
    echo "<P>Se envió su mensaje";
} else {
    echo "<P>Lo siento, no se pudo enviar su mensaje";
}
?>
</body>
</html>