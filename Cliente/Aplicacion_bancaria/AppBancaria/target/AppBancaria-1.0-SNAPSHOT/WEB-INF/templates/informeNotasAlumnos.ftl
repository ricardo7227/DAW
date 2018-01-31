<#ftl strip_whitespace = true>
<#assign charset="UTF-8">
<#assign title="Informe notas alumnos-asig">

<!DOCTYPE html>
<html>
    <head>
        <title>${title}</title>
        <meta charset="${charset}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <#include "/libreria.ftl">
        </head>
        <script>
                 function mostrarListaAlumno(){
                    var id = document.getElementById("id_asig_lista").value;
                    var text = document.getElementById("id_asig_lista").options[document.getElementById('id_asig_lista').selectedIndex].text;
                    document.getElementById("idasignatura").value = id; 
                    document.getElementById("asignatura").value=text;
                    document.getElementById("ACTION").value="VIEWTABLA";
                    document.getElementById("formasignatura").submit(); 
                }
        </script>
    <body>
        <#escape x as x?html>
        <div class="container">
            <#include "/menuTemplate.ftl">
        <div class="row justify-content-center">
                <div class="col-sm-9">
                    <h2>Informe - Notas de una asignatura</h2>
                    <h5>Por favor Selecciona la asignatura que deseas ver:</h5>
                    <form action="" id="formasignatura">
                        <select name="id_asig" id="id_asig_lista" onchange="mostrarListaAlumno()" >
                            <option disabled selected value> -- selecciona una Asignatura -- </option>
                <#list asignaturas as asignatura>
                            <option id ="asignatura.id_asignatura" value="${asignatura.id_asignatura}">${asignatura.nombre}</option>
                 </#list>                
                            </select> 
                        <input type="hidden" name="ACTION" id="ACTION" value="VIEW"/>
                        <input type="hidden" name="idasignatura" id="idasignatura" />
                        <input type="hidden" name="asignatura" id="asignatura" />
                    </form>        
                    </div>
                </div>
                
            </br>            <div class="row justify-content-center">
                <div class="col-sm-10">
                <#if nombreAsignatura??>
                     <h2>${nombreAsignatura}</h2>
                </#if>
                     
                <#if messageToUser??>
                    <div class="alert alert-primary" role="alert">
                        ${messageToUser?js_string}  
                    </div>
                </#if>
                 </br>   
                 </br>
                <#if informeNotasAlumnos??>
                    <table  class="table">
                        <thead class="thead-warning">
                        <tr>
                            <th>Nombre Alumno</th>
                            <th>Nota</th>
                        </tr>
                        </thead>
                     <#list informeNotasAlumnos as informe>
                        <tbody>
                            <tr>
                                <td>
                                   ${informe.nombre}
                                    </td> 
                                <td>
                                    ${informe.nota}
                                    </td>
                                
                                </tr>
                            </tbody>
                    </#list>	
                    </table>
                </#if>



                    </div>
                </div>

            </div>
        </div>
</#escape>


    </body>
</html>

