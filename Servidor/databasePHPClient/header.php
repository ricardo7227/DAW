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