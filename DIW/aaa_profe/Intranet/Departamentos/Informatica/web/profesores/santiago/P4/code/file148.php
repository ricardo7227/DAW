<?php
print "<BR><B><U> Gesti�n de excepciones (ejemplo file148.php) <BR></B></U>";
 
function dividir($y,$x) {
    // el objeto se crea con un mensaje y un c�digo de error, ambos
    // son definidos por el desarrollador 
    if ($x == 0) throw new Exception("divisi�n por cero", 12);
    return $y/$x;
} 
 
try{
    $r = dividir(23,0);
} catch (Exception $e) {
    echo "*****************************<BR>";
    echo "Se produjo este error: " . $e->getMessage() ."<BR>";
    echo "C�digo: " .$e->getCode() . "<BR>";
    echo "Archivo del error: " .$e->getFile() . "<BR>";
    echo "L�nea del error: " .$e->getLine() . "<BR>";
    $var = $e->getTrace();
    echo "En la funci�n: " . $var[0] ['function'] . "<BR>";
    echo "Funci�n llamada desde la l�nea: " . $var[0] ['line'] . "<BR>";
    echo "*****************************<BR>";
    exit;
}

print $r;
 
?> 