<!DOCTYPE html>
<html>
<head>
   <meta content="text/html; charset=UTF-8" http-equiv="content-type">
   <title>Borrar base de datos</title>
</head>
<body>
<br>
<?php
 $con = mysqli_connect("localhost", "phpuser", "phpp@asswd1011") or
        die("No se pudo establecer la conexión con el servidor MySQL");
 echo "¡BIEN!, Conexión establecida.\n";
 echo 'Procedo a borrar la base de datos <br>';
 $sql = 'DROP DATABASE basedatos';
 if (mysqli_query($con, $sql)) {
     echo "Se ha BORRADO la base de datos basedatos\n";
  } else {
     echo "Se ha producido un error al BORRAR la B.D. basedatos" .
          mysqli_error($con) . "\n";
  }
?>
<br>
<br>
</body>
</html>
