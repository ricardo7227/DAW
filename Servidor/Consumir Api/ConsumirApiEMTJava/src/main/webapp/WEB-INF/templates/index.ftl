<#assign charset="UTF-8">
<#assign title="CRUD - JAVA">
<!DOCTYPE html>
<html>
    <head>
        <title>${title}</title>
        <meta charset="${charset}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
    <body>
        <div class="container">            
        <#include "/menuTemplate.ftl">
            <div class="row justify-content-center">    
                <div class="col-sm-10">

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

                        <div class="col-sm-5">  
                            <#if loginOnFromServer??>   
                                <#if (loginOnFromServer.nombre)??>
                            <div class="alert alert-primary" role="alert">                                
                                Bienvenid@ ${loginOnFromServer.nombre}
                                </div>
                                </#if>
                            <#else>

                            <form action="${baseUrl}${endpoint_index}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre de Usuario</label>
                                    <input type="text" class="form-control" name="NOMBRE" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">                                    
                                    </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Contraseña</label>
                                    <input type="password" class="form-control" name="PASSWORD" id="exampleInputPassword1" placeholder="Password">
                                    </div>

                                <button type="submit" class="btn btn-primary" name="ACTION" value="LOGIN">Login</button>
                                <a href="${baseUrl}${endpoint_recuperar_password}" class="badge badge-info">Recuperar Contraseña</a>
                                <a href="${baseUrl}${endpoint_registro}" class="badge badge-dark">Registrar Usuario</a>
                                </form>
                            </#if>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <#include "/libreria.ftl">

        </body>
    </html>
