/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$("#talk").click(crearMensaje);
$("#create_channel").click(crearCanal);
$("#subscribe_to_channel").click(subscribeToChannel);
$("#retrieve_messages").click(getMessagesByDates);
$("#launch_login").click(launchLogin);
$("#response_from_server").on("click", "#give_access_user", giveAccessToChannel);
$("#response_from_server").on("click", "#decline_access_user", declineAccessToChannel);
$("#response_from_server").on("click", "#button_login", requestLogin);
$("#response_from_server").on("click", "#button_registro", requestRegistro);

function crearMensaje() {
    var mensaje = $("#textarea_talk").val();
    var destino = $("#mis_canales_disponibles").val();
    var keys = getKeys(destino);
    if (typeof keys.salt != "undefined") {
        mensaje = aesUtil.encrypt(keys.salt, keys.iv, keys.password, mensaje);
    }
    var guardar = $("#save_message").prop('checked');
    var msjObj = new Mensaje(MensajeTipo.TEXTO, mensaje, destino, new Date(), usuario, guardar);
    hablar(JSON.stringify(msjObj));
}
function crearCanal() {
    var canal = $("#new_channel_name").val();
    var password = $("#new_channel_pass").val();
    var destino = 1;
    var iv = CryptoJS.lib.WordArray.random(128 / 8).toString(CryptoJS.enc.Hex);
    var salt = CryptoJS.lib.WordArray.random(128 / 8).toString(CryptoJS.enc.Hex);
    var newCanal = {password: password, canal: canal, salt: salt, iv: iv};
    var guardar = false;
    var msjObj = new Mensaje(MensajeTipo.ADD_CANAL, JSON.stringify(newCanal), destino, new Date(), usuario, guardar);
    hablar(JSON.stringify(msjObj));
}
function subscribeToChannel() {
    var destino = $("#canales_disponibles").val();
    var mensaje = null;
    var guardar = false;
    var msjObj = new Mensaje(MensajeTipo.REQUEST_PERMISO, mensaje, destino, new Date(), usuario, guardar);
    hablar(JSON.stringify(msjObj));
}
function getMessagesByDates() {
    var destino = $("#canales_disponibles").val();
    var fecha_1 = $("#fecha1").val();
    var fecha_2 = $("#fecha2").val();
    var rango = {fecha1: fecha_1, fecha2: fecha_2};
    var guardar = false;
    var msjObj = new Mensaje(MensajeTipo.GET_MENSAJES, JSON.stringify(rango), destino, new Date(), usuario, guardar);
    hablar(JSON.stringify(msjObj));
}
function giveAccessToChannel() {
    var destino = request_permiso_channel;
    var mensaje = null;
    var guardar = false;
    var msjObj = new Mensaje(MensajeTipo.GIVE_PERMISO, mensaje, destino, new Date(), request_permiso_user, guardar);
    hablar(JSON.stringify(msjObj));
}
function declineAccessToChannel() {
    var destino = request_permiso_channel;
    var mensaje = null;
    var guardar = false;
    var msjObj = new Mensaje(MensajeTipo.DECLINE_ACCESS, mensaje, destino, new Date(), request_permiso_user, guardar);
    hablar(JSON.stringify(msjObj));
}
//ENUMS MENSAJE TIPO
var mt = {TEXTO: 0, ADD_CANAL: 1, REQUEST_PERMISO: 2, GIVE_PERMISO: 3, GET_CANALES: 4, GET_MENSAJES: 5, CONFIG: 6, SERVER_INFO: 7, DECLINE_ACCESS: 8}
var MensajeTipo = Object.freeze(mt);

//mensaje
function  Mensaje(tipo, contenido, destino, fecha, user, guardar) {
    this.tipo = tipo;
    this.contenido = contenido;
    this.destino = destino;
    this.fecha = fecha;
    this.user = user;
    this.guardar = guardar;
}

function crearMensajeResponseServer(alert_type, mensaje, tiempo) {
    var response = '<div class="alert alert-' + alert_type + '" role="alert" style="display: none;" >' + mensaje.contenido + '</div>';

    $(response).appendTo("#response_from_server").show("slow", function () {
        setTimeout(function () {
            $(".alert").hide("slow")
        }, tiempo);
    });

}

function createModalResponse(mensaje) {
    var response = mensaje.contenido;
    $("#response_from_server").html(response);


}

function getNameChannel(lista_canales, mensaje) {
    var name;
    lista_canales.forEach(function (elem) {

        if (mensaje.destino == elem.id) {
            name = elem.canal;
        }
    });
    return name;
}

function buildRequestBox(mensaje) {
    request_permiso_channel = mensaje.destino;
    request_permiso_user = mensaje.user;
    var cabecera = "Nueva petición";
    var okText = "Dar Acceso";
    var noText = "Denegar";
    var code = '<div class="modal fade" tabindex="-1" role="dialog" id="request_permiso_modal">' +
            '<div class="modal-dialog" role="document">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<h5 class="modal-title">' + cabecera + '</h5>' +
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '</div>' +
            '<div class="modal-body">' +
            '<p>' + mensaje.contenido + '</p>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-primary" data-dismiss="modal" id="give_access_user">' + okText + '</button>' +
            '<button type="button" class="btn btn-secondary" data-dismiss="modal"id="decline_access_user">' + noText + '</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';


    return code;
}
function buildLoginRequestBox(mensaje) {
    //request_permiso_channel = mensaje.destino;
    //request_permiso_user = mensaje.user;
    var cabecera = "Login o Registro";
    var okTextLogin = "Dar Acceso";
    var noTextLogin = "Denegar";
    var code = '<div class="modal fade" tabindex="-1" role="dialog" id="request_login_modal">' +
            '<div class="modal-dialog" role="document">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<h5 class="modal-title">' + cabecera + '</h5>' +
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '</div>' +
            '<div class="modal-body">' +
            '<p>Login</p>' +
            '<form action="">' +
            ' <div class="form-group">' +
            '<label for="exampleInputEmail1">Nombre de Usuario</label>' +
            '<input type="text" class="form-control" name="NOMBRE" id="user_login" aria-describedby="emailHelp" placeholder="Username">' +
            '</div>' +
            '<div class="form-group">' +
            '<label for="exampleInputPassword1">Contraseña</label>' +
            '<input type="password" class="form-control" name="PASSWORD" id="password_login" placeholder="Password">' +
            '</div>' +
            '</form>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-primary" name="ACTION" data-dismiss="modal" value="LOGIN" id="button_login">Login</button>' +
            '</div>' +
            '<div class="modal-body">' +
            '<p>Registro</p>' +
            '<form>' +
            '<div class="form-group">' +
            '<label for="exampleInputEmail1">Nombre de Usuario</label>' +
            '<input type="text" class="form-control" name="NOMBRE" id="user_registro" aria-describedby="emailHelp" placeholder="Username" required >                                    ' +
            '</div>' +
            '<div class="form-group">' +
            '<label for="exampleInputEmail1">Email:</label>' +
            '<input type="email" class="form-control" name="EMAIL" id="email_registro" aria-describedby="emailHelp" placeholder="user@gmail.com" required>                                    ' +
            '</div>' +
            '<div class="form-group">' +
            '<label for="exampleInputPassword1">Contraseña</label>' +
            '<input type="password" class="form-control" name="PASSWORD" id="password_registro" placeholder="Password">' +
            '</div>' +
            '</form>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-primary" name="ACTION" data-dismiss="modal" value="REGISTRAR" id="button_registro">Registrar</button>   ' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';


    return code;
}
function loadMessages(mensajes) {
    mensajes.forEach(function (elem) {
        writeToScreen(buildMessageFromServerToChannel(elem, getNameChannel(lista_canalesDB, elem)));
    });
}

function launchLogin() {
    var respuesta = new Object();
    respuesta.contenido = buildLoginRequestBox(respuesta);
    createModalResponse(respuesta);
    $('#request_login_modal').modal('show');
}
function getKeys(canalID) {
    var keys = new Object();
    lista_canalesDB.forEach(function (elem) {
        if (elem.id == canalID) {
            keys.salt = elem.salt;
            keys.iv = elem.iv;
            keys.password = elem.password;
        }
    });
    return  keys;
}

function requestLogin() {
    var user = $("#user_login").val();
    var pass = $("#password_login").val();
    $.ajax({
        type: "POST",
        url: "myChat",
        data: {
            NOMBRE: user,
            PASSWORD: pass,
            ACTION: "LOGIN"
        },
        success: function (result) {

            console.log("Respuesta Server Login");
            conectar();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest + textStatus + errorThrown);
        }
    });
}
function requestRegistro() {
    var user = $("#user_registro").val();
    var email = $("#email_registro").val();
    var pass = $("#password_registro").val();
    $.ajax({
        type: "POST",
        url: "myChat",
        data: {
            NOMBRE: user,
            EMAIL: email,
            PASSWORD: pass,
            ACTION: "REGISTRAR"
        },
        success: function (result) {
            var respuesta = new Object();
            respuesta.contenido = "Acabas de crear un nuevo usuario, ya puedes hacer Login";
            crearMensajeResponseServer("success", respuesta, 5000);
            console.log("Respuesta Server Registro");
//            conectar();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest + textStatus + errorThrown);
        }
    });
}
function heCerrado() {
    var user = $("#user_registro").val();
    var email = $("#email_registro").val();
    var pass = $("#password_registro").val();
    $.ajax({
        type: "POST",
        url: "controlRoom",
        data: {
            NOMBRE: user,
            EMAIL: email,
            PASSWORD: pass,
            ACTION: "REGISTRAR"
        },
        success: function (result) {
            var respuesta = new Object();
            respuesta.contenido = "Acabas de crear un nuevo usuario, ya puedes hacer Login";
            crearMensajeResponseServer("success", respuesta, 5000);
            console.log("Respuesta Server Registro");
//            conectar();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest + textStatus + errorThrown);
        }
    });
}

