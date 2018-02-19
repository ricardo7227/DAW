/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package websocket;

import java.io.IOException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.websocket.OnMessage;
import javax.websocket.OnOpen;
import javax.websocket.Session;
import javax.websocket.server.PathParam;
import javax.websocket.server.ServerEndpoint;

/**
 *
 * @author Gato
 */
@ServerEndpoint("/chat/{user}/{pass}")
public class ChatWebsocket {

    @OnOpen
    public void onOpen(Session session,
            @PathParam("user") String user,
            @PathParam("pass") String pass) {
        // si es con query string
        //user = session.getRequestParameterMap().get("user").get(0);

        session.getUserProperties().put("user",
                user);
        if (!user.equals("google")) {
            session.getUserProperties().put("login",
                    "OK");
        } else {
            session.getUserProperties().put("login",
                    "NO");
        }

//        try {
//          if ! login ok 
//            session.close();
//        } catch (IOException ex) {
//            Logger.getLogger(ChatEndPoint.class.getName()).log(Level.SEVERE, null, ex);
//        }
    }

    @OnMessage
    public void echoText(String mensaje, Session session) {
        for (Session s : session.getOpenSessions()) {
            try {
                String user = (String) session.getUserProperties().get("user");
                //if (!s.equals(sessionQueManda)) {
                s.getBasicRemote().sendText(user + "::" + mensaje);
                //}
            } catch (IOException ex) {
                Logger.getLogger(ChatWebsocket.class.getName()).log(Level.SEVERE, null, ex);
            }
        }

    }

}
