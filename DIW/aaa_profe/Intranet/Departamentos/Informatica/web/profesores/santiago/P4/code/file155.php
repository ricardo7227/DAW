<html><head>
<title>ejemplo de envío de correo con mensaje HTML(file155.php)</title>
</head>
<body>
<?php
// aquí podría incluirse validación de los datos,
// registro en una base de datos, etc.
$Nombre = $_POST['Nombre'];
$Email = $_POST['Email'];
$Mensaje = $_POST['Mensaje'];

$cabs = array();
$cabs[] =  'MIME-Version: 1.0';
$cabs[] =  'Content-type: text/html; charset=iso-8859-1';
$cabs[] =  'Content-Transfer-Encoding: 7bit';
$cabs[] =  'From: ' . $Email;


$ret = mail('test@gmail.com',
            'Pedido de información',
            "Solicitado por: $Nombre\r\n
            que escribe: $Mensaje \r\n",
            join("\r\n", $cabs));
if ($ret) {
    echo "<P>Se envió su mensaje";
} else {
    echo "<P>Lo siento, no se pudo enviar su mensaje";
}
?>
</body>
</html>