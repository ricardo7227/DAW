/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$("#talk").click(crearMensaje);
$("#create_channel").click(crearCanal);
$("#subscribe_to_channel").click(subscribeToChannel);
$("#response_from_server").on("click", "#give_access_user", giveAccessToChannel);
$("#response_from_server").on("click", "#decline_access_user", declineAccessToChannel);

function crearMensaje() {
    var mensaje = $("#textarea_talk").val();
    var destino = $("#mis_canales_disponibles").val();

    var guardar = ($("#save_message").val() == "on") ? true : false;
    var msjObj = new Mensaje(MensajeTipo.TEXTO, mensaje, destino, new Date(), usuario, guardar);
    hablar(JSON.stringify(msjObj));
}
function crearCanal() {
    var canal = $("#new_channel_name").val();
    var password = $("#new_channel_pass").val();
    var destino = 1;
    var newCanal = {password: password, canal: canal};
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
    //$(response).appendTo("#response_from_server").show("slow");

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


