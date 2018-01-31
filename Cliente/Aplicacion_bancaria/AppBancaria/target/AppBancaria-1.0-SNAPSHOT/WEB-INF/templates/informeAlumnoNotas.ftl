<#ftl strip_whitespace = true>

<#assign title="Informe de Alumnos">


<!DOCTYPE html>
<html>
    <head>
        <title>${title}</title>        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        
        <script>         
            function cambiarAlumno(){
                document.getElementById("idalumno").value = document.getElementById("id_alumnos").value;  
                document.getElementById("formulario").submit();
            }
        </script>
        </head>
    <body>
<#escape x as x?html>
        <div class="container">
            <#include "/menuTemplate.ftl">

            <div class="row justify-content-center">
                <div class="col-sm-9">
                    <h2>Informe - Notas de un Alumno en concreto</h2>
                    <h5>Por favor, Selecciona el alumno del cual quieres saber sus notas:</h5>
                    <form action="" id="formulario">
                        <select name="id_curso" id="id_alumnos" onchange="cambiarAlumno()" >
                            <option disabled selected value> -- selecciona un Alumno -- </option>
                            <#list alumnos as alumno>
                                <option id ="alumno.id" value="${alumno.id}">${alumno.nombre}</option>
                            </#list>                
                        </select> 
                        <input type="hidden" name="ACTION" id="ACTION" value="VIEW"/>
                        <input type="hidden" name="idalumno" id="idalumno" />        
                    </form>        
                    </div>
                </div>
            <div class="row justify-content-center">
                <div class="col-sm-10">
                <#if messageToUser??>
                    <div class="alert alert-primary" role="alert">
                        ${messageToUser?js_string}  
                    </div>
                </#if>
                <#if notas??>
                    <br>
                    <hr> 
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nombre Asignatura</th>
                                <td scope="col"> Calificación </td>
                            </tr>
                        </thead>
                        <tbody>
                            <#list notas as nota>
                            <tr>
                                <th colspan="2">
                                    <div class="text-center">
                                        ${nota.asignatura}
                                    </div>
                                </th>
                                <th colspan="2">
                                    <div class="text-center">
                                        ${nota.nota}
                                    </div>
                                </th>
                            </tr>
                            </#list> 
                            </tbody>
                    </table> 
                </#if>
                    </div>
                </div>
            </div>
        </div>
</#escape>
    <#include "/libreria.ftl">

    </body>
</html>
