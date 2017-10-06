<?php
$jest="Marta";

$a[0] ="Marta";
$a[1] = "Oscar";
$a[2] = "Herminio";
$a[3] = "Sagrario";
$sw=1;
for($i=0;$i<4;$i++){
	if($sw==1){
	if ($a[$i]==$jest)
	$sw=0;	
	}
}

if ($sw==0){
	//Es jefe de estudios/director}
}
else{
	echo "No es jefe de estudios";
	exit();
}

?>
