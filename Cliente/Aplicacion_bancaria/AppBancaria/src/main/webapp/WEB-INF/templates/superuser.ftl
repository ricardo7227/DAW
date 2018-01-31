<#ftl strip_whitespace = true>

<#assign charset="UTF-8">
<#assign title="ProyectoLogin">
<!DOCTYPE html>
<html>
    <head>
        <title>${title}</title>
        <meta charset="${charset}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <#include "/libreria.ftl">
        <script>

        function cambiarAdmin(id,idpermiso) {
            var comprobacion = document.getElementById("id_permiso").checked;
                
            if(idpermiso == 0){
                
                document.getElementById("iduser").value = id;
                document.getElementById("idpermiso").value = idpermiso;
                document.getElementById("ACTION").value = "HACERADMIN";
                document.getElementById("formsupuser").submit();
            }else{
                
                document.getElementById("iduser").value = id;
                document.getElementById("idpermiso").value = idpermiso;
                document.getElementById("ACTION").value = "QUITARADMIN";
                document.getElementById("formsupuser").submit();
            }
        }

        
        function previousPage(){
            var offsetacutal =  document.getElementById("offset").value;
                
            if(offsetacutal==0){

            }else{
                document.getElementById("offset").value = offsetacutal - 10;
                document.getElementById("ACTION").value = "VIEW";
                document.getElementById("formsupuser").submit();
            }
               
        }
            
        function nextPage(){
            var offsetacutal =  parseInt(document.getElementById("offset").value);
            document.getElementById("offset").value = offsetacutal + 10;
            document.getElementById("ACTION").value = "VIEW";
            document.getElementById("formsupuser").submit();
        }
            </script>
        </head>

    <body>  
        <#include "/menuTemplate.ftl">
        <h2>SuperUsuario</h2>
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
            <#list usuarios as usuario>
            <tbody>
                <tr>
                    <td>
                       ${usuario.id}
                        </td> 
                    <td>
                        ${usuario.nombre}
                        </td>
                    <td>
                        ${usuario.email}
                        </td>
                    <td>
                        ${usuario.fecha_activacion?string["dd-MM-yyyy"]}
                        </td>
                    <td>
                        <input type="checkbox" id="id_permiso" name="id_permiso"  
                            <#if usuario.permiso == 2> checked <#else>                      
                            </#if> onchange="cambiarAdmin('${usuario.id}','${usuario.permiso}');"/>
                        </td>
                    </tr>
                </tbody>
            </#list>	
            </table>
        <div class="pagination">
            <button onclick="previousPage();">&larr; Previous</button>
            <button onclick="nextPage();">Next &rarr;</button>
        </div>
        <#if messageToUser??>
                    <div class="alert alert-primary" role="alert">
                ${messageToUser?js_string}    
                        </div>

        </#if>

        <form id="formsupuser" action="superuser?">
            <input type="hidden" id="iduser" name="iduser"/>
            <input type="hidden" id="idpermiso" name="idpermiso"/>
            <input type="hidden" id="ACTION"  name="ACTION"/>
            <input type="hidden" id="offset"  name="offset" value="${offset}"/>

            </form>
        </body>
    </html>
