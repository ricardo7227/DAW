/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package websocket;

import com.google.api.client.googleapis.auth.oauth2.GoogleIdToken;
import java.io.IOException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.http.HttpSession;
import javax.websocket.EndpointConfig;
import javax.websocket.OnMessage;
import javax.websocket.OnOpen;
import javax.websocket.Session;
import javax.websocket.server.ServerEndpoint;
import utilidades.Constantes;
import utilidades.IdTokenVerifierAndParser;
import utilidades.Mensajes;

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
        String idToken = (String) httpSession.getAttribute(Constantes.TOKEN);

        if (idToken != null) {
            try {
                GoogleIdToken.Payload payLoad = IdTokenVerifierAndParser.getPayload(idToken);
                String name = (String) payLoad.get(Constantes.NAME);
                wsSession.getUserProperties().put(Constantes.NAME, name);
                wsSession.getBasicRemote().sendText(String.format(Mensajes.BIENVENIDA_USER, name));

            } catch (Exception ex) {
                Logger.getLogger(ChatWebsocket.class.getName()).log(Level.SEVERE, null, ex);
            }

        } else {
            try {
                wsSession.close();
            } catch (IOException ex) {
                Logger.getLogger(ChatWebsocket.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
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
