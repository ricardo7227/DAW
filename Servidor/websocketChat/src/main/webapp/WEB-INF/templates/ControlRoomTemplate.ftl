<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="https://v40.pingendo.com/assets/4.0.0/default/theme.css" type="text/css"> </head>

    <body>
        <nav class="navbar navbar-expand-md bg-primary navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="myChat"><i class="fa d-inline fa-lg fa-cloud"></i><b>Asterisk&nbsp;Chat</b></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent"> </div>
                </div>
            </nav>
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <form class="">
                            <div class="form-group"> <label for="exampleInputEmail1">Usuarios Conectados</label>
                                <br> <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" placeholder="No tenemos usuarios conectados..." disabled>
<#if users_online??>                                   
<#list users_online as user>
${user.nombre}
                                    </#list>         
</#if>
                                    </textarea> </div>
                            <div class="form-group"> <label for="exampleInputEmail1">Usuarios Desconectados</label>
                                <br> <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" placeholder="Estos son nuestros usuarios..." disabled>
<#if users_online??>                                   
<#list users_offline as user>
${user.nombre}
                                    </#list>         
</#if>
                                    </textarea> </div>
                            </form>
                        </div>
                    <div class="col-md-6">
                        <form class="" id="response_from_server">
                            <label for="exampleInputEmail1">Canales y usuarios asignados</label><br>
<#if channels??>    

<#list channels as canal>

<#if canal[0]??>            
                            <div class="form-group"> 
                                
                                <label for="exampleInputEmail1">Canal: ${canal[0].nombre}</label>                            

                            </#if>
                                <br> <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Usuarios del canal">
<#list canal as u>   
        ${u.user}        
                                    </#list>         
                                    </textarea> </div>                    
                                    </#list>         
</#if>


                            </form>
                        </div>
                    <div class="col-md-6"> </div>
                    </div>
                <script
                    src="http://code.jquery.com/jquery-3.3.1.js"
                    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
                crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                </div>
            <pingendo onclick="window.open('https://pingendo.com/', '_blank')" style="cursor:pointer;position: fixed;bottom: 10px;right:10px;padding:4px;background-color: #00b0eb;border-radius: 8px; width:180px;display:flex;flex-direction:row;align-items:center;justify-content:center;font-size:14px;color:white">Made with Pingendo&nbsp;&nbsp;
                <img src="https://pingendo.com/site-assets/Pingendo_logo_big.png" class="d-block" alt="Pingendo logo" height="16">
                </pingendo>
            </div>
        </body>

    </html>