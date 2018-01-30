<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use controller\SqlQuery;
use controller\Constantes;

if ($deletedAsignatura == Constantes::CodeErrorClaveForanea) {//cuando no pueda borrar
    echo ' <form action="asignaturas.php">
                <h3>' . $messageToUser . '</h3>
                <input type="hidden" name="ID" value="' . $id . '" ><br>           
                <button name="ACTION"  value="DELETE_FORCE" type="submit">Borrar Completamente</button>
                <button name="ACTION"  value="CANCEL" type="submit">Cancelar</button>

            </form>';
}

if ($messageToUser != NULL && $deletedAsignatura != Constantes::CodeErrorClaveForanea) {
    echo $messageToUser . "<br>";
}

echo '<table class="table">
            <tr>
                <th></th>
                <th>Nombre</th>
                <th>Curso</th>                
                <th>Ciclo</th>
            </tr>';
foreach ($listaAsignaturas as &$valor) {
    $id = $valor[SqlQuery::ID];
    $nombre = htmlspecialchars($valor[SqlQuery::NOMBRE]);
    $curso = htmlspecialchars($valor[SqlQuery::CURSO]);
    $ciclo = htmlspecialchars($valor[SqlQuery::CICLO]);
    echo '<tr>
                    <td>
                    <button id="cargarAsignatura" onClick="
                cargarAsignatura(' . $id . ',\'' . str_replace("'", "\'", $nombre) . '\',\'' . str_replace("'", "\'", $curso) . '\',\'' . str_replace("'", "\'", $ciclo) . '\')">Cargar</button>';
    echo '</td>
                    <td contenteditable="true">
                        ' . $nombre . '
                    </td>
                    <td contenteditable="true">
                        ' . $curso . '
                    </td>
                    <td contenteditable="true">
                        ' . $ciclo . '
                    </td>

                </tr>';
}
unset($valor);
echo '</table>'
 . '<form action="asignaturas.php" >
                    <input type="hidden" name="ID" id="id" ><br>
                    Nombre:
                    <input type="text" name="NOMBRE" id="nombre" ><br>
                    Curso:
                    <input type="text" name="CURSO" id="curso" placeholder=""><br>
                    Ciclo: 
                    <input type="text" name="CICLO" id="ciclo" placeholder=""><br>
                    <br>
                    <input type="submit" name="ACTION" value="INSERT">
                    <input type="submit" name="ACTION" value="UPDATE">
                    <input type="submit" name="ACTION" value="DELETE">
                </form>  
                <p>Nº Alumnos: ';
echo count($listaAsignaturas);
echo '</p>';
