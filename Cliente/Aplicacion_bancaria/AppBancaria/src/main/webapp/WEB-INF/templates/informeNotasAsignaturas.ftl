<#ftl strip_whitespace = true>

<#assign title="Informe de Notas">


<!DOCTYPE html>
<html>
    <head>
        <title>${title}</title>        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        
        

        <script>
            
                 function cambiarSelectCurso(){
                    var id = document.getElementById("id_curso_lista").value;
                    var text = document.getElementById("id_curso_lista").options[document.getElementById('id_curso_lista').selectedIndex].text;
                        document.getElementById("curso").value = text;
                            
}
    
            </script>
        </head>
    <body>
<#escape x as x?html>
        <div class="container">
            <#include "/menuTemplate.ftl">

            <div class="row justify-content-center">
                <div class="col-sm-9">
                    <h2>Informe - Asignaturas de un curso</h2>
                    <h5>Por favor Selecciona el curso que deseas ver:</h5>
                    <form action="">
                        <select name="id_curso" id="id_curso_lista" onchange="cambiarSelectCurso()" >
                            <option disabled selected value> -- selecciona un Curso -- </option>
                <#list listaCursos as curso>
                            <option id ="curso.id" value="${curso.id}">${curso.curso}</option>
                 </#list>                
                            </select> 
                        <input type="hidden" name="ACTION" id="ACTION" value="VIEW"/>
                        <input type="hidden" name="curso" id="curso" />
                        <button type="submit" class="btn btn-primary">Ver Informe</button>
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
                    <ul>

                        <#if listadoInformeNotasAsig??>
                        <h4><div class="alert alert-success text-center" role="alert">
                                Informe del curso: ${cursoSeleccionado}
                                </div></h4>
                    <#list listadoInformeNotasAsig as informe>
                        <br>
                        <hr> 
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Asignatura:</th>
                                    <td scope="col">${informe.asignatura}</td>
                                    <th scope="col">Profesor/es:</th>
                                    <td scope="col">

                                        <#list informe.profesores as profesor>
                                    ${profesor.nombre}<br>
                                        </#list>   

                                        </td>
                                    </tr>
                                </thead>
                            <tbody>
                                <tr>
                                    <th colspan="2">
                                        <div class="text-center">
                                            Alumno
                                            </div>
                                        </th>
                                    <th colspan="2">
                                        <div class="text-center">
                                            Calificación
                                            </div>
                                        </th>
                                    </tr>
                                <#list informe.notas as nota>
                                <tr>
                                    <td colspan="2">
                                        ${nota.nombre_alumno}
                                        </td>
                                    <td colspan="2">
                                        <div class="text-center">
                                        ${nota.nota}
                                            </div>
                                        </td>
                                    </tr>
                                </#list> 
                                </tbody>
                            </table>


                    </#list>   
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
