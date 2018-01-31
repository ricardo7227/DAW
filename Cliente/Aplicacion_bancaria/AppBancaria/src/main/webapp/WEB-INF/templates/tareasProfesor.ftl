<#ftl strip_whitespace = true>
<#assign charset="UTF-8">
<#assign title="Tareas Profesor">

<!DOCTYPE html>
<html>
    <head>
        <title>${title}</title>
        <meta charset="${charset}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <#include "/libreria.ftl">
        <script>
                 
                function mostrarTareas(){
                    document.getElementById("ACTIONTABLA").value="VIEWTABLA";
                    var id = document.getElementById("lista_id_asig").value;
                    var text = document.getElementById("lista_id_asig").options[document.getElementById('lista_id_asig').selectedIndex].text;
                    document.getElementById("nombretarea").value = text; 
                    document.getElementById("idtabla").value = id; 
                    document.getElementById("formtabla").submit();
                }
                function crearTarea(){
                        var id = document.getElementById("id_asig_lista").value;
                        document.getElementById("idasignatura").value = id; 
                        document.getElementById("ACTION").value="PONERTAREA";
                        document.getElementById("formtarea").submit(); 
                    }
        </script>
    </head>
    <body>
        
        <#escape x as x?html>
        <div class="container">
            <#include "/menuTemplate.ftl">
            <div class="row justify-content-center">
                <div class="col-sm-9">
                    <h2>Tareas - Asignar tareas de una asignatura</h2>
                    <h5>Por favor Selecciona la asignatura en la cual desea asignar tarea:</h5>
                    <form action="" id="formtarea">
                        <select name="id_asig" id="id_asig_lista" onchange="" >
                            <option disabled selected value> -- selecciona una Asignatura -- </option>
                <#list asignaturas as asignatura>
                            <option id ="asignatura.id_asignatura" value="${asignatura.id_asignatura}">${asignatura.nombre}</option>
                 </#list>                
                            </select> 
                        <br>
                        <label for="recipient-name" class="col-form-label">Nombre Tarea:</label>
                        <input type="text" name="name" class="form-control" id="tarea">
                                        
                        <label for="recipient-name" class="col-form-label">Fecha de Entrega:</label>
                        <input type="date" name="fecha_entrega" class="form-control" id="fechaentrega">
                        
                        <input type="hidden" name="ACTION" class="form-control" id="ACTION" value="VIEW">   
                        <input type="hidden" name="idasignatura" id="idasignatura" />
                        </br>
                        <button type="button" onclick="crearTarea();" class="btn btn-primary">INSERTAR</button>
                    </form>   
            </br>
                      
                                  
                    <br>
                    <#if messageToUser??>
                        <div class="alert alert-primary" role="alert">
                            ${messageToUser?js_string}    
                        </div>
                        </br>
                    </#if>
                        
                    </br>
                    
                    <h2>Vista de tareas</h2>
                    <form action="" id="formtabla">
                        <select name="lista_id_asig" id="lista_id_asig" onchange="mostrarTareas()" >
                            <option disabled selected value> -- selecciona una Asignatura para ver sus tareas -- </option>
                            <#list asignaturas as asignatura>
                                        <option id ="asignatura.id_asignatura" value="${asignatura.id_asignatura}">${asignatura.nombre}</option>
                             </#list>                
                        </select> 
                        <input type="hidden" name="ACTION" class="form-control" id="ACTIONTABLA" value=""/>  
                        <input type="hidden" name="idasignatura" class="form-control" id="idtabla" value=""/>  
                        <input type="hidden" name="name" class="form-control" id="nombretarea" value=""/>
                    </form>
                    </br>
                    <#if nombreTarea??>
                        <div>
                            <h5>
                                ${nombreTarea}
                           </h5>
                        </div>
                    </#if>
                    </br>
                    <#if tareas??>
                        <table  class="table">
                            <thead class="thead-dark">
                                <tr>
                       
                                <th>Nombre</th>                          
                                <th>Fecha de entrega</th>
                            </thead>
                            <#list tareas as tarea>  
                                <tr>
                                    <td>
                                        ${tarea.nombre}
                                    </td> 
                                    <td>
                                        ${tarea.fecha_entrega?string["dd-MM-yyyy"]}
                                    </td>
                                </tr>
                            </#list>
                        </table>
                    </#if>
                </div>
            </div>
        </div>
        </#escape>
        

    </body>
    
    </html>
