<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>CRUD PHP</title>
        <style>
            body {text-align: center}
            table {
                margin-left: auto;
                margin-right: auto;
            }
            .container {
                margin: 0 auto;
                text-align: center;
                width: 100%;
            }
            .container a {
                padding-left: 20px;
                font-size: 1.5em;
            }
        </style>
        <script>
            function cargarAlumno(id, nombre, fecha_nacimiento, mayor_edad) {
                document.getElementById("id").value = id;
                document.getElementById("nombre").value = nombre;
                document.getElementById("fecha_nacimiento").value = fecha_nacimiento;

                if (mayor_edad == true) {
                    document.getElementById("mayor_edad_true").checked = true;
                } else {
                    document.getElementById("mayor_edad_false").checked = true;
                }
            }
            function cargarAsignatura(id, nombre, curso, ciclo) {
                document.getElementById("id").value = id;
                document.getElementById("nombre").value = nombre;
                document.getElementById("curso").value = curso;
                document.getElementById("ciclo").value = ciclo;

            }

        </script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    </head>
    <body>
        <div class="container">
            <a href="alumnos.php">alumnos</a><a href="asignaturas.php">asignaturas</a><a href="notas.php">notas</a>
        </div>
        <?php

        use controller\SqlQuery;
        use controller\Constantes;

        if (isset($notasView) && $notasView) {//notas.php
            
            

            echo '<form action="notas.php" >
                    <select name="ID_ASIGNATURA">';

            foreach ($listaAsignaturas as &$valor) {
                $id = $valor[SqlQuery::ID];
                $nombre = htmlspecialchars($valor[SqlQuery::NOMBRE]);
                $curso = htmlspecialchars($valor[SqlQuery::CURSO]);
                $ciclo = htmlspecialchars($valor[SqlQuery::CICLO]);

                echo ' <option value="' . $id . '"';
                
                if ($id == $id_asignatura){
                    echo 'selected >';
                } else {
                    echo '>';
                }
                
                echo str_replace("'", "\'", $nombre).'</option>';
                                 
            }
            unset($valor);

            echo '</select> 
            <select name="ID_ALUMNO">';
            foreach ($listaAlumnos as &$valor) {
                $id = $valor[SqlQuery::ID];
                $nombre = htmlspecialchars($valor[SqlQuery::NOMBRE]);
                $fecha_nacimiento = $valor[SqlQuery::FECHA_NACIMIENTO];
                $mayor_edad = $valor[SqlQuery::MAYOR_EDAD];
                
                echo '<option value="'.$id.'"';
                                
                if ($id == $id_alumno){
                    echo 'selected >';
                } else {
                    echo '>';
                }
                echo $nombre.'</option>';
                           
                
            }
            unset($valor);
            echo '</select> 
            
                    <input type="text" name="NOTA" value="';
            if (isset($notaDB) && is_array($notaDB)){
                echo $notaDB[SqlQuery::NOTA].'"> ';
            } else {                
                echo '" placeholder="'.$messageToUser.'">';              
                
            }
            echo 
                                           
            '<input type="submit" name="ACTION" value="VIEW">
            <input type="submit" name="ACTION" value="UPDATE" onclick="return comprobarInputNota()" >
        </form>';
            if (!isset($notaDB)){
                echo '<p>'.$messageToUser.'</p>'; 
            }
        } elseif (isset($listaAlumnos) && $listaAlumnos != NULL) {//cuando estamos en alumnos.php
            if ($deletedAlumno == Constantes::CodeErrorClaveForanea) {//cuando no pueda borrar
                echo '<form action="alumnos.php">
                <h3>';
                echo $messageToUser;
                echo '</h3>
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
                                <td><button id = "cargarAlumno" onClick = "
                        cargarAlumno(';
                echo $id;
                echo ',\'';
                echo $nombre;
                echo '\',\'';
                echo $fecha_nacimiento;
                echo '\',';
                echo $mayor_edad;
                echo ')">Cargar</button>
                               </td>
                               <td contenteditable = "true">';
                echo $nombre;
                echo '</td>
                <td contenteditable = "true">';
                echo $fecha_nacimiento;
                echo '</td>
                            </tr>';
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
        } elseif (isset($listaAsignaturas) && $listaAsignaturas != NULL) {//asignaturas.php
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
        }
        ?>
        <script>
            if (document.getElementById("fecha_nacimiento").type !== "date") { //if browser doesn't support input type="date", initialize date picker widget:
                $(function () {
                    // Find any date inputs and override their functionality
                    $('input[type="date"]').datepicker({dateFormat: 'yy-mm-dd'});
                });
            }

            function comprobarInputNota() {
                var formulario = document.getElementsByTagName("input")[0].value;
                if (formulario.length == 0) {

                    alert("No has introducido una nota!");
                    return false;

                }
            }

        </script>
    </body>
</html>
