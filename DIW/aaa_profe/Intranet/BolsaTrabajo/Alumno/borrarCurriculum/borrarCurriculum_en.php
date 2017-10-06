<?php

					
					$dni=$_REQUEST['DNI'];
					$cn=mysql_connect("localhost", "phpuser", "phpp@asswd1011") or die("Error en Conexion");
					$db=mysql_select_db("basedatos", $cn); 
					echo "conectado";
					$sql = "DELETE FROM curricula WHERE cv_dni = '$dni'";
					mysql_query($sql);
					echo "borrado";
					
					header('Location: ../../../index_en.php?bolsa');
?>