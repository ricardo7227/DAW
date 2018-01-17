<#assign charset="UTF-8">
<#assign title="EMT - Líneas">
<!DOCTYPE html>
<html>
    <head>
        <title>${title}</title>
        <meta charset="${charset}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>
            function cargarLinea(linea) {
                
                document.getElementById("numLinea").value = linea;
                document.getElementById("formBus").submit();
                
                    
}
            </script>
        </head>
    <body>
        <div class="container">            

            <div class="row justify-content-center">    
                <div class="col-sm-10">
                    <h5>Líneas de Autobuses de MADRID EMT</h5>
                <#if messageToUser??>
                    <div class="alert alert-primary" role="alert">
                ${messageToUser?js_string}  
                        </div>
                    </#if>
                    </div>
                </div>
            <div class="row">    
                <div class="container">                       
                    <div class="row justify-content-center">    

                        <div class="col-sm-10">  
                            <#if lineas_autobus??>             
                            <table class="table table-striped">
                                <tr>
                                    <th>Group Number</th>
                                    <th>Date firts</th>
                                    <th>Date end</th>
                                    <th>Line</th>
                                    <th>label</th>
                                    <th>Name A</th>
                                    <th>Name B</th>
                                    <th></th>
                                    </tr>   
                                <#list lineas_autobus as linea>                            
                                <tr>
                                    <#assign valores = linea?values>                                    
                                        <#list valores as valor>
                                    <td>
                                            ${valor}

                                        </td>
                                        </#list>
                                    <td>
                                        <button class="btn btn-primary" onClick="cargarLinea(${valores[3]})">Ver Paradas</button>
                                        </td>
                                    </tr>
                                </#list>
                            </#if> 
                                </table>
                            <form id="formBus">
                                <input type="hidden" id="numLinea" name="linea">                                
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <#include "/libreria.ftl">

        </body>
    </html>
