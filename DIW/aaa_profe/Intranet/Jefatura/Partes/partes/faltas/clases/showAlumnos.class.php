<?php
// load error handling module
//require_once('/var/www/html/faltas/config/error_handler.php');
// load configuration file
require_once('/var/www/faltas/config/global.php');
// class supports server-side suggest & autocomplete functionality
class ShowAlumnos
{
// database handler
private $mMysqli;
// constructor opens database connection
function __construct(){
    // connect to the database
    $this->mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
}
// destructor, closes database connection
function __destruct(){
    $this->mMysqli->close();
}

//devuelve alumnos del grupo
public function getAlumnos($curso) {

$query = "SELECT idalumno,concat(apellido1,', ',apellido2, ' ',nombre) as nombre from alumnos where idcurso=? order by 2 asc";
$stmt= $this->mMysqli->prepare($query);
$stmt->bind_param("s", $grupo);
$grupo=$curso;
// execute the SQL query

$stmt->bind_result($idAlumno,$nombre);
$result = $stmt->execute();
$output='<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
$output.="<response>";
//$output.='<select id="Field35" name="idalumno" class="field select medium" tabindex="3">';
// if we have results, loop through them and add them to the output

while ( $stmt->fetch() ){
    $output .= '<option value="' . $idAlumno .'">' . $nombre . '</option>';
    //$output.=$idAlumno.";".$nombre."|";
}
// close the result stream

//$output.="</select>";
$output.="</response>";
// add the final closing tag
return $output;
}
//end class Suggest
}
?>
