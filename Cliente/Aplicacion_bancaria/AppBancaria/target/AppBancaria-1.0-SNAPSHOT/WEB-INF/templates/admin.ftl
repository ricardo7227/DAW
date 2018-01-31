<#ftl strip_whitespace = true>

<#assign charset="UTF-8">
<#assign title="Administracion">
<!DOCTYPE html>
<html>
    <head>
        <title>${title}</title>
        <meta charset="${charset}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <#include "/libreria.ftl">
        </head>
    <script>
            function crearProfe(){
                document.getElementById("formprofe").submit();
            }
                    
            function crearAlumno(){
                document.getElementById("formalumno").submit();
            }
                   
            function crearAsignatura(){
                document.getElementById("formasignatura").submit();
            }
                    
            function mostrarTabla(operacion){
                document.getElementById("ACTIONTABLA").value=operacion;
                    document.getElementById("formtabla").submit();
            }
                
            
            function previousPage(){
                var offsetacutal =  document.getElementById("offset").value;

                if(offsetacutal==0){

                }else{
                    var operacion = document.getElementById("ACTIONVIEWS").value ;
                    document.getElementById("offset").value = offsetacutal - 10;
                    if(operacion == "VIEWPROFESSOR"){
                        document.getElementById("ACTIONTABLA").value = "VIEWPROFESSOR";
                    }else if(operacion == "VIEWALUMNO"){
                        document.getElementById("ACTIONTABLA").value = "VIEWALUMNO";
                    }else if(operacion == "VIEWASIGNATURA"){
                        document.getElementById("ACTIONTABLA").value = "VIEWASIGNATURA";
                    }
                    document.getElementById("formtabla").submit();
                }

            }

            function nextPage(){
                var operacion = document.getElementById("ACTIONVIEWS").value ;
                var offsetacutal =  parseInt(document.getElementById("offset").value);
                document.getElementById("offset").value = offsetacutal + 10;
                if(operacion == "VIEWPROFESSOR"){
                    document.getElementById("ACTIONTABLA").value = "VIEWPROFESSOR";
                }else if(operacion == "VIEWALUMNO"){
                    document.getElementById("ACTIONTABLA").value = "VIEWALUMNO";
                }else if(operacion == "VIEWASIGNATURA"){
                    document.getElementById("ACTIONTABLA").value = "VIEWASIGNATURA";
                }
                document.getElementById("formtabla").submit();
            }
        </script>
    <body>
       <#escape x as x?html>
        <#include "/menuTemplate.ftl">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <#if actionview == "VIEWPROFESSOR">active</#if>"  href="javascript:mostrarTabla('VIEWPROFESSOR')">Profesores</a>
                </li>
            <li class="nav-item">
                <a class="nav-link <#if actionview == "VIEWALUMNO">active</#if>"  href="javascript:mostrarTabla('VIEWALUMNO')">Alumnos</a>
                </li>
            <li class="nav-item">
                <a class="nav-link <#if actionview == "VIEWASIGNATURA">active</#if>" href="javascript:mostrarTabla('VIEWASIGNATURA')">Asignaturas</a>
                </li>
            </ul>
        <div>
            
            <table  class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                                <#if !asignaturas??>
                        <th>Fecha de entrada</th>
                                 </#if>
                                <#if !asignaturas??>
                        <th>Fecha Nacimiento</th>
                                </#if>
                               
                       
                    </thead>
                <#list elementos as elemento>  
                <tr>
                    <td>
                                ${elemento.id}
                        </td> 
                    <td>
                                ${elemento.nombre}
                        </td> 
                          <#if elemento.fecha_entrada??>
                    <td>
                                 ${elemento.fecha_entrada?string["dd-MM-yyyy"]}
                        </td>
                           </#if>
                            <#if elemento.fecha_nacimiento??>
                    <td>
                        ${elemento.fecha_nacimiento?string["dd-MM-yyyy"]}
                    </td>
                            </#if>
                            
                    </tr>


                </#list>

                </table>
            </div>
        </br>
        <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#modalProfesor">Insertar Profesor</button>
        <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#modalAlumno">Insertar Alumno</button>
        <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#modalAsignatura">Insertar Asignatura</button>
        <div class="modal fade" id="modalProfesor" tabindex="-1" role="dialog" aria-labelledby="modalProfesor" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Insertar Profesor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="modal-body">
                        <form id="formprofe" action="administrador?">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nombre:</label>
                                <input type="text" name="name" class="form-control" id="professorname">
                                </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Email:</label>
                                <input type="text" name="email" class="form-control" id="professoremail">
                                </div>
                            <div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Fecha Nacimiento:</label>
                                <input type="date" name="fecna" class="form-control" id="profefecna">

                            </div>
                           <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Fecha Entrada:</label>
                                <input type="date" name="fecha_entrada" class="form-control" id="profesorfechaentrada">

                            </div>
                                <input type="hidden" name="ACTION" class="form-control" id="ACTIONPROFESOR" value="INSERTARPROFESSOR">   
                                </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" onclick="crearProfe();" class="btn btn-primary">INSERTAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        <div class="modal fade" id="modalAlumno" tabindex="-1" role="dialog" aria-labelledby="modalProfesor" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Insertar Alumno</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="modal-body">
                        <form id="formalumno" action="administrador?">
                              <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Nombre:</label>
                            <input type="text" name="name" class="form-control" id="alumnoname">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Email:</label>
                                <input type="text" name="email" class="form-control" id="alumnoemail">
                                </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Fecha Nacimiento:</label>
                                <input type="date" name="fecna" class="form-control" id="alumnofecna">

                                </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Mayor de Edad:</label>
                                <input type="checkbox" name="mayor" class="form-control" id="alumnomayor">
                                </div>
                            <div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Fecha Entrada:</label>
                                <input type="date" name="fecha_entrada" class="form-control" id="alumnofechaentrada">

                            </div>
                                <input type="hidden" name="ACTION" class="form-control" id="ACTIONALUMNO" value="INSERTARALUMNO">   
                                </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" onclick="crearAlumno();" class="btn btn-primary">INSERTAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        <div class="modal fade" id="modalAsignatura" tabindex="-1" role="dialog" aria-labelledby="modalProfesor" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Insertar Asignatura</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="modal-body">
                        <form id="formasignatura" action="administrador?">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Asignatura:</label>
                                <input type="text" name="name" class="form-control" id="asigname">
                                </div>
                            <div>
                                <input type="hidden" name="ACTION" class="form-control" id="ACTIONASIGNATURA" value="INSERTARASIGNATURA">   
                                </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" onclick="crearAsignatura();" class="btn btn-primary">INSERTAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </br>
     <#if messageToUser??>
        <div class="alert alert-primary" role="alert">
                ${messageToUser?js_string}    
        </div>
        </br>
        </#if>
        <div class="pagination">
            <button onclick="previousPage();">&larr; Previous</button>
            <button onclick="nextPage();">Next &rarr;</button>
        </div>
        <form id="formtabla" action="administrador?"> 
                <input type="hidden" name="ACTION" class="form-control" id="ACTIONTABLA" value=""/>  
                <input type="hidden" id="offset"  name="offset" value="${offset}"/>
                <input type="hidden" name="ACTIONVIEWS" class="form-control" id="ACTIONVIEWS" value="${actionview}"/>
        </form>
   </#escape>
        </body>
    </html>
