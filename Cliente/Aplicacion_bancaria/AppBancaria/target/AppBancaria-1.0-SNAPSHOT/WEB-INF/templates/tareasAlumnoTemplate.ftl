<#assign charset="UTF-8">
<#assign title="Mis Tareas - Alumno">

<!DOCTYPE html>
<html>
    <head>
        <title>${title}</title>
        <meta charset="${charset}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>

       function updateTareas(id_hecho,input_hecho) {   
           var hecho = input_hecho.checked;
           var newValueHecho = document.getElementById(id_hecho);
               newValueHecho.value = (hecho == true)? 1 : 0 ;
          }
            </script>
        </head>
    <body>

<#escape x as x?html>
        <div class="container">
            <#include "/menuTemplate.ftl">

            <div class="row justify-content-center">
                <div class="col-sm-9">
                    <h2>Mis Tareas - 
                        <#if loginOnFromServer??>
                            <#if (loginOnFromServer.nombre)??>
                                ${loginOnFromServer.nombre}
                            </#if>
                        </#if>
                        </h2>                    
                    </div>
                </div>
            <div class="row justify-content-center">
                <div class="col-sm-10">
                <#if messageToUser??>
                    <div class="alert alert-primary" role="alert">
                ${messageToUser?js_string}  
                        </div>
                        </#if>
                    <ul>

                        <#if listaTareasAlumno??>


                        <br>
                        <hr> 
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>                                    
                                    <th scope="col">Asignatura</th>
                                    <th scope="col">Tarea</th>
                                    <th scope="col">Fecha Entrega</th>
                                    <th scope="col">HECHO</th>
                                    <th scope="col"/>                                     
                                    </tr>
                                </thead>
                            <tbody>
                                <#list listaTareasAlumno as tarea>
                            <form id="form_tareas_alumno" action="">
                                <input type="hidden" id="id_tareas_alumno" name="id_tareas_alumno" value="${tarea.id_tareas_alumnos}"/>
                                <input type="hidden" id="hecho_input_${tarea.id_tareas_alumnos}" name="hecho" />
                                <input type="hidden" id="action"  name="ACTION" value="UPDATE"/>            

                                <tr>
                                    <td>
                                        <div class="text-center">
                                            ${tarea.nombre}
                                            </div>
                                        </td>
                                    <td >
                                        <div class="text-center">
                                            ${tarea.tarea}
                                            </div>
                                        </td>
                                    <td >

                                            ${tarea.fecha_entrega}

                                        </td>
                                    <td >
                                        <input type="checkbox"  
                                               onchange="updateTareas('hecho_input_${tarea.id_tareas_alumnos}',this)"
                                               ${tarea.hecho?string("checked", "")}
                                               />



                                        </td>
                                    <td >

                                        <button class="btn btn-primary" >Actualizar</button>

                                        </td>
                                    </tr>
                                </form>
</#list>   
                            </tbody>
                            </table>



                        </#if>
                        </ul>



                    </div>
                </div>

            </div>
        </div>

</#escape>
    <#include "/libreria.ftl">


    </body>
</html>
