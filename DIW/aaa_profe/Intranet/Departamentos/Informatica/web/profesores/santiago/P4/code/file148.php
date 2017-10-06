<?php
print "<BR><B><U> Gestión de excepciones (ejemplo file148.php) <BR></B></U>";
 
function dividir($y,$x) {
    // el objeto se crea con un mensaje y un código de error, ambos
    // son definidos por el desarrollador 
    if ($x == 0) throw new Exception("división por cero", 12);
    return $y/$x;
} 
 
try{
    $r = dividir(23,0);
} catch (Exception $e) {
    echo "*****************************<BR>";
    echo "Se produjo este error: " . $e->getMessage() ."<BR>";
    echo "Código: " .$e->getCode() . "<BR>";
    echo "Archivo del error: " .$e->getFile() . "<BR>";
    echo "Línea del error: " .$e->getLine() . "<BR>";
    $var = $e->getTrace();
    echo "En la función: " . $var[0] ['function'] . "<BR>";
    echo "Función llamada desde la línea: " . $var[0] ['line'] . "<BR>";
    echo "*****************************<BR>";
    exit;
}

print $r;
 
?> 