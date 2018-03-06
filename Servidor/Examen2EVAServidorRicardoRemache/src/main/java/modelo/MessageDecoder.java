/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package modelo;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import javax.websocket.DecodeException;
import javax.websocket.Decoder;
import javax.websocket.EndpointConfig;
import utilidades.Constantes;

public class MessageDecoder implements Decoder.Text<LogUser> {

    private static final Gson gson = new GsonBuilder().setDateFormat(Constantes.DATE_FORMAT).create();

    @Override
    public LogUser decode(String mensaje) throws DecodeException {

        return gson.fromJson(mensaje, LogUser.class);
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
