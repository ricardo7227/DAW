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

var wsUri = "ws://localhost:8080/Examen2EVAServidorRicardoRemache/logOperaciones";
console.log("Connecting to " + wsUri);

var websocket;



conectar();

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


function hablar() {
    var mensaje = new Object();
    mensaje.usuario = "Admin";
    mensaje.operacion = "consulta datos";
    mensaje.fecha = new Date();
    console.log("mensaje: " + mensaje);
    websocket.send(mensaje);
}


function onOpen() {
    console.log("onOpen");
    writeToScreen("CONNECTED");

}
function onClose() {

    writeToScreen("Server close conection");
}

function onMessage(evt) {
    if (typeof evt.data == "string") {
        var respuesta = JSON.parse(evt.data);
        writeToScreen(buildMessageFromServer(respuesta));


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
    return  msjObj.fecha + ": " + msjObj.usuario + ": " + msjObj.operacion;
}

setInterval(hablar,5000);


