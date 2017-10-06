<HTML>
    <HEAD>
	<TITLE>Primera prueba de análisis de un documento XML (file145.php)</TITLE>
    </HEAD>
        
<?php
$archivo = "file145.xml";
// abre el archivo en modo lectura
$fp = fopen($archivo, "r");
// lee todo el archivo
$datos = fread ($fp, filesize ($archivo));
// cierre del archivo
fclose ($fp);

// impresión del contenido
print $datos;

// Análisis de un documento XML
function detecta_etiqueta_inicio($analiza,$etiqueta,$atributos){
    echo "<B>Etiqueta de apertura : </B>$etiqueta<BR>";
} 

function detecta_etiqueta_cierre($analiza,$etiqueta){
    echo "<B>Etiqueta de cierre : </B>$etiqueta<BR><BR>";
} 

function detecta_datos($analiza,$datos){
    echo "<B>Datos del elemento : </B>$datos<BR>";
} 

// crea el parser
$analiza = xml_parser_create();
// se definen las funciones para gestionar etiquetas
xml_set_element_handler($analiza,"detecta_etiqueta_inicio","detecta_etiqueta_cierre");
// se define la función que gestiona los datos
xml_set_character_data_handler($analiza,"detecta_datos");

echo "<BODY><H2>ANALISIS DE UN DOCUMENTO XML</H2><HR>";
// analiza los datos
if (!xml_parse($analiza,$datos,true)){
	echo "Error XML: ", xml_error_string(xml_get_error_code($analiza));
}

// libera los recursos
xml_parser_free($analiza);
?>
	<HR>
    </BODY>
</HTML>