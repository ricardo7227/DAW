/*
 * DO NOT ALTER OR REMOVE COPYRIGHT NOTICES OR THIS HEADER.
 *
 * Copyright (c) 2013 Oracle and/or its affiliates. All rights reserved.
 *
 * The contents of this file are subject to the terms of either the GNU
 * General Public License Version 2 only ("GPL") or the Common Development
 * and Distribution License("CDDL") (collectively, the "License").  You
 * may not use this file except in compliance with the License.  You can
 * obtain a copy of the License at
 * https://glassfish.dev.java.net/public/CDDL+GPL_1_1.html
 * or packager/legal/LICENSE.txt.  See the License for the specific
 * language governing permissions and limitations under the License.
 *
 * When distributing the software, include this License Header Notice in each
 * file and include the License file at packager/legal/LICENSE.txt.
 *
 * GPL Classpath Exception:
 * Oracle designates this particular file as subject to the "Classpath"
 * exception as provided by Oracle in the GPL Version 2 section of the License
 * file that accompanied this code.
 *
 * Modifications:
 * If applicable, add the following below the License Header, with the fields
 * enclosed by brackets [] replaced by your own identifying information:
 * "Portions Copyright [year] [name of copyright owner]"
 *
 * Contributor(s):
 * If you wish your version of this file to be governed by only the CDDL or
 * only the GPL Version 2, indicate your decision by adding "[Contributor]
 * elects to include this software in this distribution under the [CDDL or GPL
 * Version 2] license."  If you don't indicate a single choice of license, a
 * recipient has the option to distribute your version of this file under
 * either the CDDL, the GPL Version 2 or to extend the choice of license to
 * its licensees as provided above.  However, if you add GPL Version 2 code
 * and therefore, elected the GPL Version 2 license, then the option applies
 * only if the new code is made subject to such option by the copyright
 * holder.
 */

var wsUri = "ws://localhost:8080/websocketChat/chat";
console.log("Connecting to " + wsUri);

var websocket;

var usuario; //Tras el login, defino el nombre de usuario


var lista_canalesDB; //Tras el login, cargo todos los canales disponibles

var request_permiso_channel;//id del canal, que un usuario pide permiso
var request_permiso_user;//nombre del usuario que pide permiso



function conectar() {
    websocket = new WebSocket(wsUri, []);

    websocket.onopen = function (evt) {
        onOpen(evt);
    };
    websocket.onmessage = function (evt) {
        onMessage(evt);
    };
    websocket.onerror = function (evt) {
        onError(evt);
    };
    websocket.onclose = function (evt) {
        onClose(evt);
    };
}
//encriptación
var iterationCount = 1000;
var keySize = 128;
var aesUtil = new AesUtil(keySize, iterationCount);

function hablar(mensaje) {
    console.log("mensaje: " + mensaje);
    websocket.send(mensaje);
}

function echoBinary() {
//                alert("Sending " + myField2.value.length + " bytes")
    var buffer = new ArrayBuffer(myField2.value.length);
    var bytes = new Uint8Array(buffer);
    for (var i = 0; i < bytes.length; i++) {
        bytes[i] = i;
    }
//                alert(buffer);
    websocket.send(buffer);
    writeToScreen("SENT (binary): " + buffer.byteLength + " bytes");
}

function onOpen() {
    console.log("onOpen");
    writeToScreen("CONNECTED");
    //websocket.send(idToken);
}
function onClose() {

    writeToScreen("Server close conection");
}

function onMessage(evt) {
    if (typeof evt.data == "string") {
        var respuesta = JSON.parse(evt.data);
        switch (respuesta.tipo) {
            case MensajeTipo.CONFIG:

                if (typeof respuesta.user == "undefined") {
                    setAllCanalesFromServer(respuesta);
                } else {
                    writeToScreen(buildMessageFromServer(respuesta));
                    usuario = respuesta.user;
                }
                break;
            case MensajeTipo.GET_CANALES:
                if (typeof respuesta.user == "undefined") {
                    setCanalesFromServer("#canales_disponibles", respuesta);


                } else {
                    setCanalesFromServer("#mis_canales_disponibles", respuesta);
                }
                break;
            case MensajeTipo.ADD_CANAL:

                if (usuario == respuesta.user) {
                    setCanalesFromServer("#mis_canales_disponibles", respuesta);


                } else {
                    setCanalesFromServer("#canales_disponibles", respuesta);

                }
                lista_canalesDB.push(JSON.parse(respuesta.contenido));

                break;
            case MensajeTipo.SERVER_INFO:
                crearMensajeResponseServer("success", respuesta, 5000);
                break;
            case MensajeTipo.TEXTO:
                writeToScreen(buildMessageFromServerToChannel(respuesta, getNameChannel(lista_canalesDB, respuesta)));
                break;
            case MensajeTipo.REQUEST_PERMISO:
                respuesta.contenido = buildRequestBox(respuesta);
                createModalResponse(respuesta);
                $('#request_permiso_modal').modal('show');                                
                break;
            case MensajeTipo.GIVE_PERMISO:

                crearMensajeResponseServer("success", respuesta, 5000);
                break;
            case MensajeTipo.DECLINE_ACCESS:
                crearMensajeResponseServer("dark", respuesta, 5000);
                break;
            case MensajeTipo.GET_MENSAJES:
                var mens = JSON.parse(respuesta.contenido);
                loadMessages(mens);
                break;
            default:

                break;
        }

        //writeToScreen("RECEIVED (text): " + evt.data);
    } else {
        writeToScreen("RECEIVED (binary): " + evt.data);
    }
}

function onError(evt) {
    writeToScreen('<span style="color: red;">ERROR:</span> ' + evt.data);
}

function writeToScreen(message) {
    var chat_flow = $("#textarea_chat");
    chat_flow.val(chat_flow.val() + "\n" + message);
    chat_flow.animate({
        scrollTop: chat_flow[0].scrollHeight - chat_flow.height()
    }, 1000);
}

function buildMessageFromServer(msjObj) {
    return  msjObj.fecha + ":\n " + msjObj.user + ": " + msjObj.contenido;
}
function buildMessageFromServerToChannel(msjObj, canal) {
    var texto = msjObj.contenido;
    var keys = getKeys(msjObj.destino);
    if (typeof keys.salt != "undefined") {
        texto = aesUtil.decrypt(keys.salt, keys.iv, keys.password, msjObj.contenido);
    }
    return  msjObj.fecha + "::" + canal + " \n " + msjObj.user + ": " + texto;
}

function setAllCanalesFromServer(canales) {
    if (typeof lista_canalesDB == "undefined") {
        lista_canalesDB = JSON.parse(canales.contenido);
    }
}
function setCanalesFromServer(objetivo, canales) {


    var lista_canales = JSON.parse(canales.contenido);
    if (Array.isArray(lista_canales)) {
        lista_canales.forEach(function (elem) {
            addSelect(objetivo, elem);
        });
    } else {
        addSelect(objetivo, lista_canales);
    }
}
function addSelect(objetivo, elem) {
    var r;
    if (typeof elem.canal == "undefined") {
        var ms = new Object();
        ms.destino = elem.id;
        ms.id = elem.id;
        ms.canal = getNameChannel(lista_canalesDB, ms);
        r = addSelect(objetivo, ms);
    } else {
        var select = "<option value='" + elem.id + "'>" + elem.canal + "</option>";
        $(objetivo).append(select);
    }
    return r;
}

