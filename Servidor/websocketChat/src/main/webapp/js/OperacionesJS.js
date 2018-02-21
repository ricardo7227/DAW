/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$("#talk").click(crearMensaje);
function crearMensaje() {
    var mensaje = $("#textarea_talk").val();
    var destino = "canal1";
     
    var guardar = false;
    var msjObj = new Mensaje(MensajeTipo.TEXTO, mensaje, destino, new Date(), usuario, guardar);
    hablar(JSON.stringify(msjObj));
}
//ENUMS MENSAJE TIPO
var mt = {TEXTO: 0, ADD_CANAL: 1, REQUEST_PERMISO: 2, GIVE_PERMISO: 3, GET_CANALES: 4, GET_MENSAJES: 5, CONFIG: 6}
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


