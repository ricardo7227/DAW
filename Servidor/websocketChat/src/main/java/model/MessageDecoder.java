/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import javax.websocket.DecodeException;
import javax.websocket.Decoder;
import javax.websocket.EndpointConfig;
import utilidades.Constantes;

public class MessageDecoder implements Decoder.Text<Message> {

    private static final Gson gson = new GsonBuilder().excludeFieldsWithoutExposeAnnotation().setDateFormat(Constantes.JS_DATE_FORMAT).create();

    @Override
    public Message decode(String mensaje) throws DecodeException {

        return gson.fromJson(mensaje, Message.class);
    }

    @Override
    public boolean willDecode(String s) {
        return (s != null);
    }

    @Override
    public void init(EndpointConfig endpointConfig) {
        // Custom initialization logic
    }

    @Override
    public void destroy() {
        // Close resources
    }
}
