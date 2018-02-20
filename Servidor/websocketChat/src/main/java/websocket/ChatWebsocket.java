/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package websocket;

import java.io.IOException;
import javax.servlet.http.HttpSession;
import javax.websocket.EndpointConfig;
import javax.websocket.OnMessage;
import javax.websocket.OnOpen;
import javax.websocket.Session;
import javax.websocket.server.ServerEndpoint;

/**
 *
 * @author daw
 */
@ServerEndpoint(value = "/chat", configurator = GetHttpSessionConfigurator.class)
public class ChatWebsocket {

    private Session wsSession;
    private HttpSession httpSession;

    @OnOpen
    public void onOpen(Session session, EndpointConfig config) {
        this.wsSession = session;
        this.httpSession = (HttpSession) config.getUserProperties()
                .get(HttpSession.class.getName());
        // si es con query string
        //user = session.getRequestParameterMap().get("user").get(0);

//        session.getUserProperties().put("user",
//                user);
//        if (!user.equals("google")) {
//            session.getUserProperties().put("login",
//                    "OK");
//        } else {
//            session.getUserProperties().put("login",
//                    "NO");
//        }

//        try {
//          if ! login ok 
//            session.close();
//        } catch (IOException ex) {
//            Logger.getLogger(ChatEndPoint.class.getName()).log(Level.SEVERE, null, ex);
//        }
    }

    @OnMessage
    public void echo(String msg) throws IOException {
        wsSession.getBasicRemote().sendText(msg);
    }
}//fin clase
