<#ftl strip_whitespace = true>

<#assign charset="UTF-8">
<#assign title="Example">

<!DOCTYPE html>
<html>
    <head>
        <title>${title}</title>
        <meta charset="${charset}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
        <script>




             function insertar() {

                 document.getElementById("op").value = "INSERT";
             }

             function update() {

                 document.getElementById("op").value = "UPDATE";
             }

             function borrar() {

                 document.getElementById("op").value = "DELETE";
             }

             function cargarAlumno(id, nombre, fecha, mayor) {
                 document.getElementById("nombre").value = nombre;
                 document.getElementById("idalumno").value = id;
                 document.getElementById("fecna").value = fecha;
                 if (mayor === true) {
                     document.getElementById("mayor").checked = mayor;
                 }

             }





            </script>

    <#if  filas == 0>
        <script>alert("La operacion ha fallado");</script>
        </#if>

    <#if  filas == 1>
        <script>alert("La operacion se ha realizado correctamente");</script>
        </#if>


    <script>
        function borrarSiosi() {
        <#if  filas == 2>
            var borrar = confirm("Desea borrar las notas de el alumno");
                if (borrar) {
                document.getElementById("op").value = "DELETESIOSI";
                document.getElementById("formalum").submit();
                }
                </#if>
        }

                </script>

                </head>
                <body onload="borrarSiosi();">

            <#include "/menuTemplate.ftl">
                    <h2>Alumnos</h2>
                    <table  class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Fecha Activacion</th>
                                <th>Administrador</th>
                                </tr>
                            </thead>
             <#list alumnos as alumno>  
                        <tr>
                            <td>
                                <input type="button" value="cargar ${alumno.id}" 
                                       onclick="cargarAlumno('${alumno.id}',
                                               '${alumno.nombre}',
                                              '${alumno.fecha_nacimiento?string["dd-MM-yyyy"]}',
                               '${alumno.mayor_edad?c}');"/>
                                </td> 
                            <td>
                        ${alumno.nombre}
                                </td>

                            <td>
                        ${alumno.fecha_nacimiento?string["dd-MM-yyyy"]}
                        </td>

                        <td>
                            <input type="checkbox" <#if alumno.mayor_edad?c>checked</#if> />
                            </td>
                        </tr>


            </#list>

                        </table>

                    <form id="formalum" action="alumnos?">
                        <input type="hidden" id="iduser" name="iduser"/>
                        <input type="hidden" id="op"  name="op"/>
                        <label>Nombre</label><input type="text" id="nombre" name="nombre" size="12"/>
                        <label>Email</label><input type="date" id="email" name="fecna" />
                        <label>Mayor de Edad</label><input type="checkbox" id="mayor" name="mayor" />
                        <br>
                        <button type="submit" onclick="insertar();" >insert</button>
                        <button type="submit" onclick="update();">update</button>
                        <button type="submit" onclick="borrar();">delete</button>
                    </form>

                    </body>
                </html>
