<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use controller\SqlQuery;
use controller\Constantes;

if ($deletedAlumno == Constantes::CodeErrorClaveForanea) {//cuando no pueda borrar
    echo '<form action="alumnos.php">
            <h3>';
    echo $messageToUser;
    echo '  </h3>
                <input type="hidden" name="ID" value="' . $id . '" ><br>           
                <button  name="ACTION" value="DELETE_FORCE" type="submit">Borrar Completamente</button>
                <button  name="ACTION" value="CANCEL" type="submit">Cancelar</button>

            </form>';
}
if ($messageToUser != NULL && $deletedAlumno != Constantes::CodeErrorClaveForanea) {
    echo $messageToUser . "<br>";
}
echo ' 
                    <table class = "table">
                    <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th></th>
                    </tr>';
foreach ($listaAlumnos as &$valor) {
    $id = $valor[SqlQuery::ID];
    $nombre = htmlspecialchars($valor[SqlQuery::NOMBRE]);
    $fecha_nacimiento = $valor[SqlQuery::FECHA_NACIMIENTO];
    $mayor_edad = $valor[SqlQuery::MAYOR_EDAD];

    echo '<tr>
               <td><button id = "cargarAlumno" onClick = "cargarAlumno(';
    echo $id;
    echo ',\'';
    echo $nombre;
    echo '\',\'';
    echo $fecha_nacimiento;
    echo '\',';
    echo $mayor_edad;
    echo ')">Cargar</button>
                </td><td contenteditable = "true">';
    echo $nombre;
    echo '</td><td contenteditable = "true">';
    echo $fecha_nacimiento;
    echo '</td></tr>';
}

unset($valor);
echo '</table>'
 . '<form action="alumnos.php" >
                    <input type="hidden" name="ID" id="id" ><br>
                    Nombre:
                    <input type="text" name="NOMBRE" id="nombre" ><br>
                    Fecha Nacimiento:
                    <input type="date" name="FECHA_NACIMIENTO" id="fecha_nacimiento" placeholder="yyyy-mm-dd"><br>
                    Mayor de edad: <br>
                    Si: <input type="radio" name="MAYOR_EDAD" value="on" id="mayor_edad_true" required >
                    No: <input type="radio" name="MAYOR_EDAD" value="off" id="mayor_edad_false" >
                    <br>
                    <input type="submit" name="ACTION" value="INSERT">
                    <input type="submit" name="ACTION" value="UPDATE">
                    <input type="submit" name="ACTION" value="DELETE">
                </form>  
                <p>Nº Alumnos: ';
echo count($listaAlumnos);
echo '</p>';
