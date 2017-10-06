<?php

					
					$cod=$_REQUEST['DNI'];
					$cn=mysql_connect("localhost", "phpuser", "phpp@asswd1011") or die("Error en Conexion");
					$db=mysql_select_db("basedatos", $cn); 
					echo "conectado";
					$sql = "DELETE FROM ofertas WHERE of_codigo = '$cod'";
					mysql_query($sql);
					echo "borrado";
					header('Location:../../../index.php?bolsa');
?>	