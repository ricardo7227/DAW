/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package websocket;

import com.google.api.client.googleapis.auth.oauth2.GoogleIdToken;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
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
import dao.RecuperarCanalInterface;
import java.text.DateFormat;
import javax.websocket.EncodeException;
import model.CanalesUsers;
import model.RangoMensajes;
import servicios.MensajesServicios;

/**
 *
 * @author daw
 */
@ServerEndpoint(value = "/chat", configurator = GetHttpSessionConfigurator.class)
public class ChatWebsocket implements RecuperarCanalInterface {

    private Session wsSession;
    private HttpSession httpSession;
    private String username;

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
                username = (String) payLoad.get(Constantes.NAME);
                String email = (String) payLoad.get(Constantes.EMAIL.toLowerCase());

                User user = new User(username, Constantes.GOOGLE, email);

                if (servicios.getDuplicateUser(user) == null) {
                    user = servicios.insertUser(user);
                } else {
                    user = servicios.selectLoginUser(user);
                }

                Gson gson = new GsonBuilder().setDateFormat(Constantes.DATE_FORMAT_HHMMSS).create();

                Message mensajeBienvenida = null;
                Message mensajeGetCanalesUser = null;
                Message mensajeGetCanales = null;
                Message mensajeGetAllCanales = null;
                List<Canal> canalesCliente = null;
                List<Canal> canales = null;
                List<Canal> allCanales = null;
                if (user != null) {
                    wsSession.getUserProperties().put(Constantes.ID, user.getId());
                    wsSession.getUserProperties().put(Constantes.NAME, user.getNombre());
                    wsSession.getUserProperties().put(Constantes.EMAIL, user.getEmail());

                    CanalServicios canalServicios = new CanalServicios();

                    canalesCliente = canalServicios.getCanalesByUser(username);
                    wsSession.getUserProperties().put(Constantes.CANALES_USERS, canalesCliente);
                    canales = canalServicios.getNotMyChannels(username);
                    allCanales = canalServicios.getCanales();
                    java.sql.Timestamp fecha = new java.sql.Timestamp(new Date().getTime());
                    mensajeGetCanalesUser = new Message(gson.toJson(canalesCliente), fecha, username, Tipo.GET_CANALES.ordinal());
                    mensajeGetCanales = new Message(gson.toJson(canales), fecha, null, Tipo.GET_CANALES.ordinal());
                    mensajeGetAllCanales = new Message(gson.toJson(allCanales), null, null, Tipo.CONFIG.ordinal());
                    mensajeBienvenida = new Message(String.format(Mensajes.BIENVENIDA_USER, username), fecha, username, Tipo.CONFIG.ordinal());

                }

                wsSession.getBasicRemote().sendText(gson.toJson(mensajeBienvenida));
                wsSession.getBasicRemote().sendText(gson.toJson(mensajeGetCanales));
                wsSession.getBasicRemote().sendText(gson.toJson(mensajeGetAllCanales));
                wsSession.getBasicRemote().sendText(gson.toJson(mensajeGetCanalesUser));

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
                canal.setAdmin(username);
                if (new CanalServicios().insertCanal(canal, this) != null) {
                    int tipo = Tipo.SERVER_INFO.ordinal();
                    setNewChannelToSession(mensaje);
                    sendMessageToAllUser(new Message(tipo, String.format(Mensajes.NUEVO_CANAL_EN_CHAT, canal.getNombre())));
                }
                break;
            case TEXTO:
                sendMessageToMySubscriptionChannel(mensaje);
                if (mensaje.isGuardar()) {
                    new MensajesServicios().saveMessageToDatabase(mensaje);
                }

                break;
            case REQUEST_PERMISO:
                Canal canalOwner = new CanalServicios().getChannelOwner(mensaje);
                mensaje.setMensaje(String.format(Mensajes.NUEVO_REQUEST_TO_OWNER, username, canalOwner.getNombre()));
                sendRequestToOwner(canalOwner, mensaje);
                break;
            case GIVE_PERMISO:
                if (new CanalServicios().addUserToCanal(new CanalesUsers(mensaje.getId_canal(), mensaje.getNombre_user())) != null) {
                    setNewChannelToSession(mensaje);
                    sendRequestToOwner(new Canal(mensaje.getNombre_user()), new Message(Tipo.GIVE_PERMISO.ordinal(), String.format(Mensajes.GIVE_ACCESS_TO_USER, username)));
                    sendRequestToOwner(new Canal(mensaje.getNombre_user()), new Message(gson.toJson(new Canal(mensaje.getId_canal())), mensaje.getNombre_user(), Tipo.GET_CANALES.ordinal()));
                }
                break;
            case GET_CANALES:
                //Cualquiera puede cargar mensajes
                //TODO - El rango de selección es por fechas 
                break;
            case GET_MENSAJES:
                String rango = mensaje.getMensaje();
                RangoMensajes rangoMensajes = gson.fromJson(rango, RangoMensajes.class);
                rangoMensajes.setUser(mensaje.getNombre_user());
                List<Message> mensajes = new MensajesServicios().getMessagesByDates(rangoMensajes);
                Gson gson2 = new GsonBuilder().setDateFormat(DateFormat.FULL).create();
                Message mensajesDB = new Message(Tipo.GET_MENSAJES.ordinal(), gson2.toJson(mensajes));
                sendRequestToOwner(new Canal(mensaje.getNombre_user()), mensajesDB);
                break;
            case CONFIG:

                break;
            case DECLINE_ACCESS:
                sendRequestToOwner(new Canal(mensaje.getNombre_user()), new Message(Tipo.GIVE_PERMISO.ordinal(), String.format(Mensajes.DECLINE_ACCESS_TO_USER, username)));
                break;

        }

        // sendMessageToAllUser(mensaje);
    }

    @Override
    public void addNewChannelToChat(Canal canal) {
        try {
            Gson gson = new GsonBuilder().create();
            String newChannel = gson.toJson(canal);
            Message mensaje = new Message(newChannel, new java.sql.Timestamp(new Date().getTime()), username, Tipo.ADD_CANAL.ordinal());
            sendMessageToAllUser(mensaje);
        } catch (IOException ex) {
            Logger.getLogger(ChatWebsocket.class.getName()).log(Level.SEVERE, null, ex);
        }

    }

    private void sendMessageToAllUser(Message ms) throws IOException {
        Gson gson = new GsonBuilder().setDateFormat(Constantes.DATE_FORMAT_HHMMSS).create();
        for (Session s : wsSession.getOpenSessions()) {
            s.getBasicRemote().sendText(gson.toJson(ms));
        }
    }

    private void sendRequestToOwner(Canal canal, Message message) throws IOException {
        Gson gson = new GsonBuilder().setDateFormat(Constantes.DATE_FORMAT_HHMMSS).create();
        for (Session s : wsSession.getOpenSessions()) {
            if (s.getUserProperties().get(Constantes.NAME).equals(canal.getAdmin())) {
                s.getBasicRemote().sendText(gson.toJson(message));
            }

        }
    }

    private void sendMessageToMySubscriptionChannel(Message ms) throws IOException {
        Gson gson = new GsonBuilder().setDateFormat(Constantes.DATE_FORMAT_HHMMSS).create();
        CanalServicios canalServicios = new CanalServicios();
        for (Session s : wsSession.getOpenSessions()) {
            if (canalServicios.isSubscribeToChannel((List<Canal>) s.getUserProperties().get(Constantes.CANALES_USERS), ms)) {
                s.getBasicRemote().sendText(gson.toJson(ms));
            }

        }
    }

    private void setNewChannelToSession(Message ms) throws IOException {
        for (Session s : wsSession.getOpenSessions()) {
            if (s.getUserProperties().get(Constantes.NAME).equals(ms.getNombre_user())) {

                List<Canal> canales = new CanalServicios().getCanalesByUser(ms.getNombre_user());
                s.getUserProperties().put(Constantes.CANALES_USERS, canales);
            }
        }
    }

    private void sendObjectToAllUser(Object ms) throws EncodeException, IOException {
        for (Session s : wsSession.getOpenSessions()) {
            String user = (String) s.getUserProperties().get(Constantes.NAME);
            s.getBasicRemote().sendObject(ms);
        }
    }
}//fin clase
