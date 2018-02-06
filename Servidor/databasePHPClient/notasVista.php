<?php

use utilidades\Constantes;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo '<form action="notas.php" >
                    <select name="ID_ASIGNATURA">';

foreach ($listaAsignaturas as &$valor) {
    $id = $valor->id;
    $nombre = htmlspecialchars($valor->nombre);
    $curso = htmlspecialchars($valor->curso);
    $ciclo = htmlspecialchars($valor->ciclo);

    echo ' <option value="' . $id . '"';

    if ($id == $id_asignatura) {
        echo 'selected >';
    } else {
        echo '>';
    }

    echo str_replace("'", "\'", $nombre) . '</option>';
}
unset($valor);

echo '</select> 
            <select name="ID_ALUMNO">';
foreach ($listaAlumnos as &$valor) {
    $id = $valor->id;
    $nombre = htmlspecialchars($valor->nombre);
    $fecha_nacimiento = $valor->fecha_nacimiento;
    $mayor_edad = $valor->mayor_edad;

    echo '<option value="' . $id . '"';

    if ($id == $id_alumno) {
        echo 'selected >';
    } else {
        echo '>';
    }
    echo $nombre . '</option>';
}
unset($valor);
echo '</select>            
      <input type="text" name="NOTA" value="';
if ($notaDB == null) {//primera llamada
    echo '" > ';
} else if (is_object($notaDB)) {
    echo $notaDB->nota . '"> ';
} else if (is_int($notaDB) && $notaDB == Constantes::CodeNotFound) {
    echo '" placeholder="' . $messageToUser . '">';
}

echo
'<input type="submit" name="ACTION" value="VIEW">
            <input type="submit" name="ACTION" value="UPDATE" onclick="return comprobarInputNota()" >
        </form>';
if (is_object($notaDB)) {
    echo '<p>' . $messageToUser . '</p>';
}

    