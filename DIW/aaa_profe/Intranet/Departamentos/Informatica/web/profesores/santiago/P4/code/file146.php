<?php
// Proceso de un archivo XML para generar una tabla (file146.php)

// variables globales
$ultima_etiqueta ="";
$empleado = array();
$horas = array();
$suma = array();
$cierre = False;

// Abrir el archivo XML y cargarlo en memoria
$archivo = "file146.xml";
// abre el archivo en modo lectura
$fp = fopen($archivo, "r");
// lee todo el archivo
$datos = fread ($fp, filesize ($archivo));
// se cierra el archivo
fclose ($fp); 

// crea el analizador
$analiza = xml_parser_create();

// Definición de las funciones gestoras de los eventos
// gestión de la etiqueta de inicio
function detecta_etiqueta_inicio($analiza,$etiqueta,$atributos){
    global $ultima_etiqueta, $cierre;
    // guarda qué etiqueta de apertura es
    $ultima_etiqueta = $etiqueta;
    $cierre =False;
}

// gestión de la etiqueta de cierre
function detecta_etiqueta_cierre($analiza,$etiqueta){
    global $ultima_etiqueta, $horas, $empleado, $cierre;
    if ($etiqueta == "PERSONA") {
        // finalizó un empleado, se acumula la matriz del empleado
	$horas[] = $empleado;
        $empleado = array();
    } 
    $cierre = true;	
}

// gestión de datos
function detecta_datos($analiza,$datos){
    global $ultima_etiqueta, $empleado,$ultimo_turno, $horas, $cierre;
    // va guardando los datos de un empleado
    // en la matriz $empleado
    if (!$cierre) {
        $empleado[$ultima_etiqueta] = $datos;
    }	 
}

// define gestores
xml_set_element_handler($analiza,"detecta_etiqueta_inicio","detecta_etiqueta_cierre");
xml_set_character_data_handler($analiza,"detecta_datos");

// Comienza a generar la página
echo "<HTML><HEAD><TITLE>Proceso de un documento XML (file146.php)</TITLE></HEAD>";
echo "<BODY><H2>Análisis de un documento XML</H2><HR>";

// Aquí está el proceso de análisis del archivo XML
if (!xml_parse($analiza,$datos,true)){
    echo "Error XML: ", xml_error_string(xml_get_error_code($analiza));
}


// se puede liberar el analizador
xml_parser_free($analiza);

// procesa la matriz generada
echo "<BODY><CENTER><H2>Listado de horas trabajadas y total por turno</H2>";
echo "<TABLE BORDER='4'>";

// cabecera de la tabla
echo "<TR  BGCOLOR='yellow' ALIGN ='CENTER'><TD COLSPAN='3'><B>Empleado</B></TD>";
echo "<TD COLSPAN='2'><B>Informe de horas extras</B></TD></TR>";
echo "<TR  BGCOLOR='cyan' ALIGN ='CENTER'><TD>Núm.</TD><TD>Apellido</TD>";
echo "<TD>Nombre</TD><TD>Horas</TD><TD>Turno</TD></TR>"; 

// Proceso de la matriz de horas 
for ($i=0;$i<count($horas);$i++){
	// limpiar las variables
	$n=$A=$h=$t="";
	// Proceso de cada empleado
	while (list($clave,$valor) = each ($horas[$i])) {
		switch ($clave) {
			case "NOMBRE":
				$n = $valor;
				break;
			case "APELLIDO":
				$a = $valor;
				break;
			case "HORAS":
				$h = $valor;
				break;
			case "TURNO":
				$t = $valor;
				break;
		}
	}
	// línea de detalle de la tabla		 
	echo "<TR><TD>", $i, "</TD><TD>", $a, "</TD><TD>", $n , "</TD>";
	echo "<TD ALIGN='CENTER'>", $h, "</TD><TD>", $t,"</TD></TR>";
  	
	// acumula horas por turno
	$suma[$t]= $suma [$t] + $h;
}

// Sacar los totales por turno de la matriz $suma
foreach($suma as $clave => $valor ) {
   	echo "<TR  BGCOLOR='yellow' ALIGN ='CENTER'><TD COLSPAN='3'><B>turno ", $clave, "</B></TD>";
	echo "<TD COLSPAN='2'><B>",$valor,"</B></TD></TR>";
}

// Fin de la página 
echo "<TABLE><HR></BODY></HTML>"; 
?>      