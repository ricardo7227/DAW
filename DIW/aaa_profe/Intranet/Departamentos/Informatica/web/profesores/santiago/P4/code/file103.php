<?php
print "<B><U>Foreach con matrices (ejemplo file103.php)</U></B><BR><BR>";


$mat = array("Espa�a"=>100,"Italia"=>80, "Francia"=>300,"Alemania"=>190);

foreach ($mat as &$value){
 	if ($value > 90){
		$value++;}
}	

print_r ($mat); 
// produce
// Array ( [Espa�a] => 101 [Italia] => 80 [Francia] => 301 
// [Alemania] => 191 )  
?>
