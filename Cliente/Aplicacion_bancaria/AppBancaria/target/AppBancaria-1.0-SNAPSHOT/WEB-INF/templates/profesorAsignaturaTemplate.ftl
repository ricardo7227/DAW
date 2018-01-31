<#ftl strip_whitespace = true>


<#assign charset="UTF-8">
<#assign title="Profesores - Asignaturas">

<!DOCTYPE html>
<html>
    <head>
        <title>${title}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet prefetch" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script>
             var formPagination = "formPagination";
            function previousPage(){
                    var offsetacutal =  document.getElementById("offset").value;

                    if(offsetacutal!=0){
                        document.getElementById("offset").value = offsetacutal - 10;                
                        document.getElementById(formPagination).submit();                          
                }
             }   
                function nextPage(){
                    var offsetacutal =  parseInt(document.getElementById("offset").value);
                    document.getElementById("offset").value = offsetacutal + 10;            
                    document.getElementById(formPagination).submit();
                }
            
            </script>

        </head>
    <body>
        <#escape x as x?html>
        <div class="container">
            <#include "/menuTemplate.ftl">
            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <h2>Profesores - Asignaturas</h2>
                    <table class="table">
                        <tr>
                            <th></th>
                            <th>Profesor</th>
                            <th>Asignatura</th>                

                            </tr>

<#if listaProfesoresAsignaturas??>
            <#list listaProfesoresAsignaturas as profe_asig>
                        <form action="profesor-asignaturas">
                            <input type="hidden" name="id" id="id" value="${profe_asig.id}"/>
                            <input type="hidden" name="ACTION" id="ACTION" value="DELETE"/>
                            <tr>

                                <td><button id="borrar_profe_asig" type="submit" class="btn btn-danger" >Eliminar</button>
                                    </td>
                                <td>
                    ${profe_asig.nombre_profe}
                                    </td>
                                <td>
                    ${profe_asig.nombre_asignatura}
                                    </td>                

                                </tr>
                            </form>


             </#list>

                        </table>


                    </div>
                </div>
            <form id="formPagination" action="">                    
                <input type="hidden" id="offset"  name="offset" value="${offset}"/>

                </form>
            <div class="row justify-content-center">
                <div class="col-sm-6 ">
                    <div class="pagination">
                        <#if (offset > 0)>
                        <button class="btn btn-info" onclick="previousPage();">&larr; Previous</button>                        
                        </#if>                           
                        <#if (listaProfesoresAsignaturas?size > 9)>
                        <button class="btn btn-info" onclick="nextPage();">Next &rarr;</button>
                        </#if>                       
                        </div>
</#if>
        <#if messageToUser??>
                    <div class="alert alert-primary" role="alert">
                ${messageToUser?js_string}    
                        </div>

        </#if>
                    </div>
                </div>
            <div class="row justify-content-center">
                <div class="col-sm-9">
                    <#if listaProfesores??>
                    <h5>Selecciona un profesor y la asignatura que va impartir</h5>
                    <h4>Profesores</h4> 
                    <form action="profesor-asignaturas">
                        <select name="id_profesor" id="id_profesor_lista" >
                            <option disabled selected value> -- selecciona un Profesor -- </option>
                <#list listaProfesores as profesor>
                            <option id ="profesor.id" value="${profesor.id}">${profesor.nombre}</option>
                 </#list>                
                            </select> 

                        <h4>Asignaturas</h4> 
                        <select name="id_asignatura" id="id_asignatura_lista" >
                            <option disabled selected value> -- selecciona una Asignatura -- </option>
                <#list listaAsignaturas as asig>
                            <option id ="asig.id" value="${asig.id}">${asig.nombre}</option>
                 </#list>                
                            </select> 
                        <br>
                        <input type="hidden" name="ACTION" id="ACTION" value="INSERT"/>
                        <button type="submit" class="btn btn-primary">Añadir Relación</button>
                        </from>
                    </#if>
                    </div>
                </div>
            </div>
        </#escape>
        <#include "/libreria.ftl">
        </body>
    </html>
