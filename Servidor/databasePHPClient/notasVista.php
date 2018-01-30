<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use controller\SqlQuery;

echo '<form action="notas.php" >
                    <select name="ID_ASIGNATURA">';

foreach ($listaAsignaturas as &$valor) {
    $id = $valor[SqlQuery::ID];
    $nombre = htmlspecialchars($valor[SqlQuery::NOMBRE]);
    $curso = htmlspecialchars($valor[SqlQuery::CURSO]);
    $ciclo = htmlspecialchars($valor[SqlQuery::CICLO]);

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
    $id = $valor[SqlQuery::ID];
    $nombre = htmlspecialchars($valor[SqlQuery::NOMBRE]);
    $fecha_nacimiento = $valor[SqlQuery::FECHA_NACIMIENTO];
    $mayor_edad = $valor[SqlQuery::MAYOR_EDAD];

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

if (isset($notaDB) && is_array($notaDB)) {

    echo $notaDB[SqlQuery::NOTA] . '"> ';
} elseif (isset($nota) && !isset($notaDB)) {

    echo $nota . '"> ';
} else {

    echo '" placeholder="' . $messageToUser . '">';
}

echo
'<input type="submit" name="ACTION" value="VIEW">
            <input type="submit" name="ACTION" value="UPDATE" onclick="return comprobarInputNota()" >
        </form>';
if (!isset($notaDB)) {
    echo '<p>' . $messageToUser . '</p>';
}