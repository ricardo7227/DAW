<?php
print "<B>Función include_once (ejemplo file032.php)</B><BR><BR>";
 
$var1 = 1; 
// primera llamada a file033.php
print "primera include_once<BR>";
include_once 'file033.php';

// segunda llamada a file033.php
$var1++;
print "segunda include_once<BR>";
include_once 'file033.php';

$var1 = 1; 
print "primera include<BR>";
// primera llamada a file033.php
include 'file033.php';

// segunda llamada a file033.php
print "segunda include<BR>";
$var1++;
include 'file033.php';
?> 