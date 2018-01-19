<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ajax - php</title>
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


        </script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    </head>
    <body>
        <div class="container">
            <p>Nombre</p>
            <input type="text" name="dni" id="dni"/>            
            <br>
            <button id="botonId">Comprobar</button>
            <div id="respuesta"></div>
        </div>
        <?php
        require_once 'config/Config.php';
        ?>

        <script>
            var targetResponseId = "#respuesta";
            var botonId = "#botonId";
            
            $(document).ready(function () {
                $(botonId).click(loadAjax);

                console.log("estoy");
            });

            function loadAjax() {
                $(targetResponseId).load("echo.php", {nombre: $("#dni").val()}, function () {
                    console.log("todo correcto");
                });
            }            
        </script>

        <script
            src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>
    </body>
</html>
