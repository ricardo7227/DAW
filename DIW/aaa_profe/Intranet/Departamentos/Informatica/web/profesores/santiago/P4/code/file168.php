<?php
// funciones de volcado de variables (archivo file168.php)

$ar = array('España' => 'Madrid',
            'Francia' => 'París',
            'UK' => 'Londres');

print "<BR><B>Matriz vista por echo</B><BR>";
echo $ar;

print "<BR><BR><B>Matriz vista por print_r </B><BR>";
print_r ($ar);

print "<BR><BR><B>Matriz vista por var_dump() </B><BR>";
var_dump($ar);

$acceso = date("d/m/Y H:i:s");
syslog(LOG_WARNING, "Acceso no autorizado (TEST): $acceso {$_SERVER['REMOTE_ADDR']} ({$_SERVER['HTTP_USER_AGENT']})");


?>