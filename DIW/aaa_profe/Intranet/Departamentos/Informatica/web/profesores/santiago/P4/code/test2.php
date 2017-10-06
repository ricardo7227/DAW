<HTML>
<HEAD>
<TITLE> Elegir archivo de subtítulos (del cliente al servidor) ejemplo fileSrt.php</TITLE>
</HEAD>
<BODY>
<?php
// si no existe el archivo emite una advertencia
// con @ evito el mensaje de advertencia


if (!isset($_POST['segundos']))
{
    print "<H2>Seleccionar un archivo para corregir tiempos de subtítulos</H2>";
    print "<FORM method='post' action='filesrt.php' enctype='multipart/form-data'>";
    print "Corrección en segundos: <INPUT type='text' name='segundos'><BR>";
    print "Signo (+ incrementa, - decrementa):<INPUT type='text' name='signo' value='+'><BR>";
    print "<INPUT type='file' name='arch'><BR>";
    print "</b><INPUT type ='submit' value='Corregir archivo'>";
    print "</FORM>";
}
else
{ 
// si no existe el archivo emite una advertencia
// con @ evito el mensaje de advertencia
$filein = $_FILES[arch][tmp_name];
print "Lectura del archivo:" . $filein."<br>";
$fileout = "subtituloOK.srt";

$din = @fopen($filein, "r") 
    or die ("No existe el archivo");
  
$dif = $_POST['segundos'];
if ($_POST['signo'] == "-")
    $dif *= -1;
    

$dout = fopen ($fileout, "w");
while (!feof($din)) {
    
    $bufer = fgets($din, 4096);
    $ret = tempo($bufer,$dif);
    fwrite($dout,$ret);
  
}
print "Archivo corregido quedó escrito en $fileout </B><BR> ";

fclose ($din);
fclose ($dout);

 
 
}
function tempo($buffer, $dif)
{
$pattern= "([0-9]{2}):([0-9]{2}):([0-9]{2}),([0-9]{3}) --> ([0-9]{2}):([0-9]{2}):([0-9]{2}),([0-9]{3})";
    if (ereg($pattern, $buffer, $matches))
    {
        $segs1 = substr($buffer, 0,2) * 3600 + substr($buffer, 3,2) * 60 + substr($buffer, 6,2) + $dif;
        $buffer = sumar($segs1) . substr($buffer, 8);
        $segs2 = substr($buffer, 17,2) * 3600 + substr($buffer, 20,2) * 60 + substr($buffer, 23,2) + $dif;
        $buffer = substr($buffer,0, 17) . sumar($segs2) . substr($buffer, 25);
    }
    return $buffer;
}
function sumar($segs)
{
    $vhoras = (int)($segs / 3600);
    $vminutos = (int)(($segs- $vhoras * 3600) / 60) ;
    $vsegundos =  $segs - ($vhoras * 3600) - ($vminutos * 60);
    return sprintf("%02d:%02d:%02d", $vhoras, $vminutos, $vsegundos);
}
?>
</BODY>
</HTML>	