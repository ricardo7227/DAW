<?php
print "<B><U>Crear una matriz con array_unique() (ejemplo file052.php)</U></B><BR><BR>";

// esta matriz después formará parte de la matriz $mat1 
// $mat0 está cargada de elementos duplicados
$mat0 = array(3,"C","A",3,"003","C");

// esta es la matriz a la que luego le aplicaremos la función array_unique())
$mat1 = array(3,"003","A","B","A","003",$mat0);
 
$mat2 = array_unique($mat1);
 
print "Contenido actual de la matriz: cantidad de elementos :" . count($mat2) . "<BR><BR>";
// Con estos valores debería crear la matriz con 5 elementos
// téngase en cuenta que la matriz se cuenta como un elemento más
// en $mat2 (independientemente de los elementos que tenga $mat0)
print_r ($mat2); 

?>