<HTML>
<HEAD>
<TITLE> Corrección de archivo de subtítulos (ejemplo fileSrt.php)</TITLE>
</HEAD>
<BODY>
<?php
// Programa para corregir el desfase de los subtítulos respecto
// al archivo avi
// Se informan los segundos de desfase del archivo de subtítulos
// y el signo + o -
// + el subtítulo saldrá x segundos  después
// - el subtítulo saldrá x segundos antes
// El archivo corregido queda escrito en subtítuloOK.srt

// No se modifica el archivo original

// primero se elige el archivo
// y se informa el desfase de tiempos
if (!isset($_POST['segundos']))
{
    print "<H2>Seleccionar un archivo de subtítulos</H2>";
    print "<FORM method='post' action='filesrt.php' enctype='multipart/form-data'>";
    print "Corrección en segundos: <INPUT type='text' name='segundos'><BR>";
    print "Signo (+ incrementa, - decrementa):<INPUT type='text' name='signo' value='+'><BR>";
    print "<INPUT type='file' name='arch'><BR>";
    print "</b><INPUT type ='submit' value='Corregir archivo'>";
    print "</FORM>";
}
else
// al pulsar el botón Corregir archivo
// se genera el archivo subtítuloOK.srt
{ 

$filein = $_FILES[arch][tmp_name];
print "Lectura del archivo:" . $_FILES[arch][name] ."<BR><BR>";

// el nombre del archivo de salida es constante
// se podría optimizar el código y hacer que sea a
// elección
$fileout = "subtituloOK.srt";

// se abre el archivo temporario creado
// al seleccionar el archivo
// (sólo lectura)
$din = @fopen($filein, "r") 
    or die ("No existe el archivo");

// en $dif se guarda el desfase temporal
// que se quiere aplicar a cada tiempo
$dif = $_POST['segundos'];

// si el signo es negativo restará
if ($_POST['signo'] == "-")
    $dif *= -1;
    
// se abre el archivo de salida
$dout = fopen ($fileout, "w");

// bucle por todo el archivo de entrada
while (!feof($din)) {
    // se obtiene el búfer leído  
    $io = fgets($din, 4096);
    // se obtiene la ioarea corregida
    $ret = tempo($io,$dif);
    // escribe el registro en la salida
    fwrite($dout,$ret);
}
print "<BR>El archivo corregido quedó escrito en <B><U> $fileout </U></B><BR> ";

// cierra los dos archivos
fclose ($din);
fclose ($dout); 
 
}
function tempo($ioarea, $dif)
{
// se utiliza una expresión regular para detectar si el registro
// leído es un registro de tiempos
$pattern= "([0-9]{2}):([0-9]{2}):([0-9]{2}),([0-9]{3}) --> ([0-9]{2}):([0-9]{2}):([0-9]{2}),([0-9]{3})";
    // si el registro es de tiempos:
    if (ereg($pattern, $ioarea, $matches))
    {
        // calcula todo en segundos y le sume o resta los segundos informados
        // primero corrige la hora desde
        $segs1 = substr($ioarea, 0,2) * 3600 + substr($ioarea, 3,2) * 60 + substr($ioarea, 6,2) + $dif;
        // llama a la función corregir()
        $ioarea = corregir($segs1) . substr($ioarea, 8);
        // segundo corrige la hora hasta
        $segs2 = substr($ioarea, 17,2) * 3600 + substr($ioarea, 20,2) * 60 + substr($ioarea, 23,2) + $dif;
        // llama a la función corregir() para la parte de la hora hasta
        $ioarea = substr($ioarea,0, 17) . corregir($segs2) . substr($ioarea, 25);
    }
    // en todo caso, devuelve el área (sólo corrige el
    // registro de tiempos)
    return $ioarea;
}
function corregir($segs)
{
    // la función corregir() devuelve la hh:mm:ss
    // corregidos en base al nuevo valor calculado
    $vhoras = $vminutos = $vsegundos = 0;
    if ($segs > 0)
    { 
        $vhoras = (int)($segs / 3600);
        $vminutos = (int)(($segs- $vhoras * 3600) / 60) ;
        $vsegundos =  $segs - ($vhoras * 3600) - ($vminutos * 60);
    }
    else
    // si los segundos calculados fuesen negativos
    // para no generar problemas se dejaría todo en 0
        print "Atención: segundos/signo informados generan hh:mm:ss negativo, se asume 00:00:00<BR>";
    // se devuelve la corrección realizada    
    return sprintf("%02d:%02d:%02d", $vhoras, $vminutos, $vsegundos);
}
?>
</BODY>
</HTML>	