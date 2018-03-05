/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package websocket;

import java.io.IOException;
import javax.websocket.OnMessage;
import javax.websocket.OnOpen;
import javax.websocket.Session;
import javax.websocket.server.ServerEndpoint;

/**
 *
 * @author daw
 */
@ServerEndpoint("/logOperaciones")
public class LogWebsocket {
private static LogWebsocket instance;
private Session sess;

    public LogWebsocket() {
        
    }
    public static LogWebsocket getInstance(){
        if (instance == null) {
            instance = new LogWebsocket();
        }
        return instance;
    }
    
    @OnOpen
    public void open(){
        
    }
    
    @OnMessage
    public void onMessage(Session session ,String message) throws IOException {
        for (Session s : session.getOpenSessions()) {
            s.getBasicRemote().sendText(message);
        }
    }
    
}
