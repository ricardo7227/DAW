/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package websocket;

import com.google.api.client.googleapis.auth.oauth2.GoogleIdToken;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import dao.RecuperarCanal;
import java.io.IOException;
import java.util.Date;
import java.util.List;
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
import utilidades.MensajeTipo.Tipo;
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

                Gson gson = new GsonBuilder().setDateFormat(Constantes.DATE_FORMAT_HHMMSS).create();

                Message mensajeBienvenida = null;
                Message mensajeGetCanales = null;
                List<Canal> canalesCliente = null;
                if (user != null) {
                    wsSession.getUserProperties().put(Constantes.ID, user.getId());
                    wsSession.getUserProperties().put(Constantes.NAME, user.getNombre());
                    wsSession.getUserProperties().put(Constantes.EMAIL, user.getEmail());
                    
                    canalesCliente = new CanalServicios().getCanales(name);
                    java.sql.Date fecha = new java.sql.Date(new Date().getTime());
                    mensajeGetCanales = new Message(gson.toJson(canalesCliente), fecha, name, Tipo.GET_CANALES.ordinal());
                    mensajeBienvenida = new Message(String.format(Mensajes.BIENVENIDA_USER, name), fecha, name, Tipo.CONFIG.ordinal());
                }

                wsSession.getBasicRemote().sendText(gson.toJson(mensajeBienvenida));
                wsSession.getBasicRemote().sendText(gson.toJson(mensajeGetCanales));
                //wsSession.getBasicRemote().sendText(String.format(Mensajes.BIENVENIDA_USER, name));
                //echo(String.format(Mensajes.NUEVO_USUARIO_EN_CHAT, name));

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

        Gson gson = new GsonBuilder().excludeFieldsWithoutExposeAnnotation().setDateFormat(Constantes.JS_DATE_FORMAT).create();
        Message mensaje = gson.fromJson(msg, Message.class);

        Tipo messageType = Tipo.values()[mensaje.getTipo()];
        switch (messageType) {
            case ADD_CANAL:
                String newCanal = mensaje.getMensaje();
                Canal canal = gson.fromJson(newCanal, Canal.class);
                canal.setAdmin((String) wsSession.getUserProperties().get(Constantes.NAME));
                new CanalServicios().insertCanal(canal, this);
                break;
            case TEXTO:

                break;
            case REQUEST_PERMISO:

                break;
            case GIVE_PERMISO:

                break;
            case GET_CANALES:

                break;
            case GET_MENSAJES:

                break;
            case CONFIG:

                break;

        }
        Gson gson2 = new GsonBuilder().setDateFormat(Constantes.DATE_FORMAT_HHMMSS).create();
        mensaje.setNombre_user((String) wsSession.getUserProperties().get(Constantes.NAME));
        String ms = gson2.toJson(mensaje);
        for (Session s : wsSession.getOpenSessions()) {
            String user = (String) s.getUserProperties().get(Constantes.NAME);
            s.getBasicRemote().sendText(ms);
        }

    }

    @Override
    public void getCanal(Canal canal) {
        long id = canal.getId();
    }
}//fin clase
