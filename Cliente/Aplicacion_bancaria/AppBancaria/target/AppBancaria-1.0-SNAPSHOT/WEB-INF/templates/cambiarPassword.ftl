

<#assign charset="UTF-8">
<#assign title="Cambiar Password">

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
                                Vas a cambiar la contraseña de  ${loginOnFromServer.nombre}
                                </div>
                                </#if>
                            
                            <p class="lead">
                                Necesitamos tu Contraseña actual y la nueva con su confirmación. 
                                </p>
                            <form action="">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contaseña Actual</label>
                                    <input type="password" class="form-control" name="OLD_PASSWORD" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Contraseña Antigua">                                    
                                    </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nueva Contraseña</label>
                                    <input type="password" class="form-control" name="NEW_PASSWORD" id="exampleInputPassword1" placeholder="Nueva Contraseña">
                                    </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Repite la nueva contraseña</label>
                                    <input type="password" class="form-control" name="NEW_PASSWORD_CONFIRM" id="exampleInputPassword1" placeholder="Confirmar Nueva Contraseña">
                                    </div>

                                <button type="submit" class="btn btn-primary" name="ACTION" value="RESET_PASSWORD">Cambiar Contraseña</button>
                                
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
