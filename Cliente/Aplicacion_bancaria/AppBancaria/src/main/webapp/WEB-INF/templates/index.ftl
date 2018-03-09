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

        <#include "/MenuAppTemplate.ftl">
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

                            <form action="">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre de Usuario</label>
                                    <input type="text" class="form-control" name="NOMBRE" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">                                    
                                    </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Contraseña</label>
                                    <input type="password" class="form-control" name="PASSWORD" id="exampleInputPassword1" placeholder="Password">
                                    </div>

                                <button type="submit" class="btn btn-primary" name="ACTION" value="LOGIN">Login</button>                                
                                </form>
                            </#if>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script
            src="http://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

        <link rel="stylesheet/less" type="text/css" href="less/lessman.less" />
        <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.0.0/less.min.js" ></script>

        </body>
    </html>
