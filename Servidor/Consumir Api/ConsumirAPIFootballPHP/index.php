<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Football - API</title>
        <style>
            body {text-align: center}

        </style>
        <script>
            function cargarLiga(ligaID) {
                document.getElementById("ligaId").value = ligaID;
                document.getElementById("ACTION").value = "VIEW_LEAGUE";
                document.getElementById("formLiga").submit();
            }
            function cargarEquipo(crestUri, nombreEquipo, equipoApi) {
                document.getElementById("crestUri").value = crestUri;
                document.getElementById("hrefEquipoApi").value = equipoApi;
                document.getElementById("nombreEquipo").value = nombreEquipo;
                document.getElementById("ACTION").value = "VIEW_TEAM";
                document.getElementById("formLiga").submit();
            }


        </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>        
    </head>
    <body>
        <div class="container">
            <h4>
                <a href="/">Football API</a>
            </h4>
            <?php
            include 'ligas.php';
            ?>
        </div>
        <form id="formLiga">
            <input type="hidden" id="ligaId" name="ligaId"/>
            <input type="hidden" id="hrefEquipoApi" name="hrefEquipoApi"/>
            <input type="hidden" id="nombreEquipo" name="nombreEquipo"/>
            <input type="hidden" id="crestUri" name="crestUri"/>
            <input type="hidden" id="ACTION" name="ACTION" />
        </form> 
        <script>


        </script>
    </body>
</html>
