<?php
					require("../../conexion.php");
					
					$email=$_REQUEST['Email'];
					
					
					echo "conectado";
					
					echo "$email";
					
					$insertar ="INSERT INTO suscripcion(su_email) VALUES ('$email')";
					
					mysql_query($insertar);
					echo "inscrito";
					
					header('Location: ../../../index_en.php?bolsa');
?>