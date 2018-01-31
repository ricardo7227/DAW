
<#assign charset="UTF-8">
<#assign title="Mis Notas">

<!DOCTYPE html>
<html>
    <head>
        <title>${title}</title>
        <meta charset="${charset}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
    <body>
<#escape x as x?html>
        <div class="container">
            <#include "/menuTemplate.ftl">

            <div class="row justify-content-center">
                <div class="col-sm-9">
                    <h3>Mis Notas</h3>

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

                        <#if listaNotasAlumno??>
                        <h4><div class="alert alert-success text-center" role="alert">                               
                                Boletin 
                                <#if loginOnFromServer??>
                                    <#if (loginOnFromServer.nombre)??>
                                : ${loginOnFromServer.nombre}
                                    </#if>
                                </#if>
                                </div></h4>

                        <br>
                        <hr> 
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>

                                    <th scope="col">
                                        <div class="text-center">    
                                            Asignatura
                                            </div>
                                        </th>


                                    <th scope="col">
                                        <div class="text-center">
                                            Nota
                                            </div>
                                        </th>                                                                          

                                    </tr>
                                </thead>
                            <tbody>
                                <#list listaNotasAlumno as informe>
                                <tr>
                                    <td >
                                        <div class="text-center">
                                            ${informe.asignatura}
                                            </div>
                                        </td>
                                    <td colspan="2">
                                        <div class="text-center">
                                            ${informe.nota}
                                            </div>
                                        </td>
                                    </tr>                                
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
