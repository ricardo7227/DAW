<TITLE>Formulario enviado con METHOD=GET (file113.php)</TITLE>
<?php
print "<B>Contenido de la superglobal \$_GET</B><BR>";
 
print_r ($_GET);

print "<BR><B>Contenido de QUERY_STRING</B><BR>";
print_r ($_SERVER['QUERY_STRING']);
?> 