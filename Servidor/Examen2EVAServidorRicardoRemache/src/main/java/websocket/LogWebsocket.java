/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package websocket;

import java.io.IOException;
import javax.servlet.http.HttpSession;
import javax.websocket.CloseReason;
import javax.websocket.EncodeException;
import javax.websocket.EndpointConfig;
import javax.websocket.OnClose;
import javax.websocket.OnMessage;
import javax.websocket.OnOpen;
import javax.websocket.Session;
import javax.websocket.server.ServerEndpoint;
import modelo.LogUser;
import modelo.MessageDecoder;
import modelo.MessageEncoder;
import utilidades.Constantes;

/**
 *
 * @author daw
 */
@ServerEndpoint(value = "/logOperaciones",
        configurator = GetHttpSessionConfigurator.class,
        decoders = MessageDecoder.class,
        encoders = MessageEncoder.class)
public class LogWebsocket {

    private Session wsSession;
    private static LogWebsocket instance;
    private HttpSession httpSession;

    public static LogWebsocket getInstance() {
        if (instance == null) {
            instance = new LogWebsocket();
        }
        return instance;
    }

    public LogWebsocket() {

    }
  

    @OnOpen
    public void onOpen(Session session, EndpointConfig config) {
        this.wsSession = session;
        this.httpSession = (HttpSession) config.getUserProperties()
                .get(HttpSession.class.getName());

    }

    @OnMessage
    public void onMessage(LogUser message) throws IOException, EncodeException {

        LogUser operacion = (LogUser) httpSession.getAttribute(Constantes.LOG_OPERACIONES);
        for (Session s : wsSession.getOpenSessions()) {
            s.getBasicRemote().sendObject(operacion);
        }
    }

    @OnClose
    public void onClose(Session ss, CloseReason re) throws IOException {

    }

}
