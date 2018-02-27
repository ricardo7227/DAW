/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import javax.websocket.EncodeException;
import javax.websocket.Encoder;
import javax.websocket.EndpointConfig;
import utilidades.Constantes;

public class MessageEncoder implements Encoder.Text<Message> {
    
    private static final Gson gson = new GsonBuilder().setDateFormat(Constantes.DATE_FORMAT_HHMMSS).create();
    
    @Override
    public String encode(Message message) throws EncodeException {
        
        return gson.toJson(message);
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
