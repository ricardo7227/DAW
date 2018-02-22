/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package websocket;

import com.fasterxml.jackson.core.JsonGenerator;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.google.api.client.googleapis.auth.oauth2.GoogleIdToken;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import dao.RecuperarCanal;
import java.io.IOException;
import java.util.Date;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.http.HttpSession;
import javax.websocket.EndpointConfig;
import javax.websocket.OnMessage;
import javax.websocket.OnOpen;
import javax.websocket.Session;
import javax.websocket.server.ServerEndpoint;
import model.Canal;
import model.Message;
import model.User;
import servicios.CanalServicios;
import servicios.RegistroServicios;
import utilidades.Constantes;
import utilidades.IdTokenVerifierAndParser;
import utilidades.MensajeTipo;
import utilidades.Mensajes;

/**
 *
 * @author daw
 */
@ServerEndpoint(value = "/chat", configurator = GetHttpSessionConfigurator.class)
public class ChatWebsocket implements RecuperarCanal {

    private Session wsSession;
    private HttpSession httpSession;

    @OnOpen
    public void onOpen(Session session, EndpointConfig config) {
        this.wsSession = session;
        this.httpSession = (HttpSession) config.getUserProperties()
                .get(HttpSession.class.getName());
        String idToken = (String) httpSession.getAttribute(Constantes.TOKEN);
        RegistroServicios servicios = new RegistroServicios();
        if (idToken != null) {
            try {
                GoogleIdToken.Payload payLoad = IdTokenVerifierAndParser.getPayload(idToken);
                String name = (String) payLoad.get(Constantes.NAME);
                String email = (String) payLoad.get(Constantes.EMAIL.toLowerCase());

                User user = new User(name, Constantes.GOOGLE, email);
                if (servicios.getDuplicateUser(user) == null) {
                    user = servicios.insertUser(user);
                } else {
                    user = servicios.selectLoginUser(user);
                }
                Message mensaje = null;
                if (user != null) {
                    wsSession.getUserProperties().put(Constantes.ID, user.getId());
                    wsSession.getUserProperties().put(Constantes.NAME, user.getNombre());
                    wsSession.getUserProperties().put(Constantes.EMAIL, user.getEmail());
                    mensaje = new Message(String.format(Mensajes.BIENVENIDA_USER, name), new java.sql.Date(new Date().getTime()), name, MensajeTipo.CONFIG.ordinal());
                }

                Gson gson = new GsonBuilder().setDateFormat("HH:mm:ss").create();

                wsSession.getBasicRemote().sendText(gson.toJson(mensaje));
                //wsSession.getBasicRemote().sendText(String.format(Mensajes.BIENVENIDA_USER, name));
                //echo(String.format(Mensajes.NUEVO_USUARIO_EN_CHAT, name));
                new CanalServicios().insertCanal(new Canal(0, "canal4", "Claudia", "Asterisk"), this);
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
        
        Gson gson = new Gson();
        Message mensaje = gson.fromJson(msg, Message.class);
        for (Session s : wsSession.getOpenSessions()) {
            String user = (String) wsSession.getUserProperties().get(Constantes.NAME);
            s.getBasicRemote().sendText(msg);
        }

    }

    @Override
    public void getCanal(Canal canal) {
        long id = canal.getId();
    }
}//fin clase
