<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="https://v40.pingendo.com/assets/4.0.0/default/theme.css" type="text/css"> 

        </head>


    <body>
        <nav class="navbar navbar-expand-md bg-primary navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="#"><i class="fa d-inline fa-lg fa-cloud"></i><b>Asterisk&nbsp;Chat</b></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
                    <a class="btn navbar-btn ml-2 text-white btn-secondary"><i class="fa d-inline fa-lg fa-user-circle-o"></i>LOGIN
                        <br> </a>                    
                    </div>               
                <div class="g-signin2" data-onsuccess="onSignIn"></div>                                   
                </div>
            </nav>
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <form class="">
                            <div class="form-group"> <label for="exampleInputCanales1">Canales</label> <select class="form-control">
                                    <option>canal 1</option>
                                    </select>
                                <button type="submit" class="btn btn-primary">Subscripción</button>
                                </div>
                            <div class="form-group"> <label for="exampleInputEmail1">Nuevo Canal</label>
                                <input type="text" class="form-control" id="new_channel_name" aria-describedby="emailHelp" placeholder="InfinityDiscution"> <small id="emailHelp" class="form-text text-muted">Crea tu propio canal para charlar</small>
                                <button type="button" id="create_channel" class="btn btn-primary">Crear</button>
                                </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input"> <label for="exampleInputPassword1">Guardar Mensajes</label> </div>
                            <div class="form-group"> <label for="exampleInputEmail1">Canales Disponibles</label> <select class="form-control">
                                    <option>canal 1</option>
                                    </select> <textarea class="form-control" id="textarea_talk" rows="3" placeholder="Habla..."></textarea> <small id="emailHelp" class="form-text text-muted">Selecciona un canal y Habla</small>
                                <button type="button" id="talk" class="btn btn-primary">Talk</button>
                                </div>
                            </form>
                        </div>
                    <div class="col-md-6">
                        <form class="">
                            <div class="form-group"> <label for="exampleInputEmail1">Chat</label>
                                <br> <textarea class="form-control" id="textarea_chat" rows="10" placeholder="Se esta comentando..." disabled></textarea> </div>
                            <div class="form-group"> <small id="emailHelp" class="form-text text-muted">Filtra los mensajes por fechas</small> <label for="exampleInputEmail1">Fecha Inicial</label>
                                <input type="date" class="form-control" id="exampleInputEmail1" placeholder="">
                                <div class="form-group"> <label for="exampleInputEmail1">Fecha Final</label>
                                    <input type="date" class="form-control" id="exampleInputEmail1" placeholder=""> </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Cargar Mensajes</button>
                                    </div>
                                </div>
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

        <script type="text/javascript" src="js/lib/aes.js"></script>
        <script type="text/javascript" src="js/lib/pbkdf2.js"></script>
        <script type="text/javascript" src="js/AesUtil.js"></script>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-scope" content="profile email"/>
        <meta name="google-signin-client_id"
              content="548370054429-f59e7h4lpkq9ba1q43oegpl88lv7roa2.apps.googleusercontent.com"/>
        <script>
            
             var idToken;
             function onSignIn(googleUser) {
                var profile = googleUser.getBasicProfile();
                console.log('ID: ' + profile.getId());
                console.log('Name: ' + profile.getName());
                console.log('Image URL: ' + profile.getImageUrl());
                console.log('Email: ' + profile.getEmail());
                console.log('id_token: ' + googleUser.getAuthResponse().id_token);

                //do not post above info to the server because that is not safe.
                //just send the id_token

                 var redirectUrl = 'login';
                 //using jquery to post data dynamically
                 idToken =  googleUser.getAuthResponse().id_token;
                 var form = $('<form action="' + redirectUrl + '" method="post">' +
                                     '<input type="text" name="id_token" value="' +
                                      googleUser.getAuthResponse().id_token + '" />' +
                                                                           '</form>');
               //$('body').append(form);
               //form.submit();
                   llamada(idToken);
                       
                           
               }
               function llamada(token) {
                 $.ajax({
                    type: "POST",
                    url: "myChat",
                    data: {
                        token: token,
                        ACTION: "check_num_cuenta"
                    },
                    success: function (result) {
                        
                        console.log("Respuesta Server");
                        conectar();
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {                        
                        console.log(XMLHttpRequest + textStatus + errorThrown);
                    }
             });
               }
            </script>
        <script language="javascript" type="text/javascript" src="websocket.js"></script>
        <script type="text/javascript" src="js/OperacionesJS.js"></script>
        </body>

    </html>