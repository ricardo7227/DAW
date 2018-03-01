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
import java.util.ArrayList;
import javax.websocket.CloseReason;
import javax.websocket.CloseReason.CloseCodes;
import javax.websocket.EncodeException;
import javax.websocket.OnClose;
import javax.websocket.OnError;
import model.CanalUser;
import model.CanalesUsers;
import model.MessageDecoder;
import model.MessageEncoder;
import model.RangoMensajes;
import servicios.AdminServicios;
import servicios.MensajesServicios;
import utilidades.AesUtil;

/**
 *
 * @author daw
 */
@ServerEndpoint(value = "/chat",
        configurator = GetHttpSessionConfigurator.class,
        decoders = MessageDecoder.class,
        encoders = MessageEncoder.class)
public class ChatWebsocket implements RecuperarCanalInterface {

    private Session wsSession;
    private HttpSession httpSession;
    private String username;
    private Canal global;
    private AesUtil aesUtil;
    private final int idCanalGlobal = 64;

    @OnOpen
    public void onOpen(Session session, EndpointConfig config) {
        this.wsSession = session;
        this.httpSession = (HttpSession) config.getUserProperties()
                .get(HttpSession.class.getName());//recupera sesión del servlet
        String idToken = (String) httpSession.getAttribute(Constantes.TOKEN);
        User userLogin = (User) httpSession.getAttribute(Constantes.LOGIN_ON);
        if (aesUtil == null) {//Encriptación para los mensajes enviados desde el Servidor al Canal Global
            aesUtil = new AesUtil(128, 1000);
        }
        if (idToken != null) {//Login por Google
            try {
                GoogleIdToken.Payload payLoad = IdTokenVerifierAndParser.getPayload(idToken);
                String userG = (String) payLoad.get(Constantes.NAME);
                String email = (String) payLoad.get(Constantes.EMAIL.toLowerCase());

                User user = new User(userG, Constantes.GOOGLE, email);

                setupLogin(user);

            } catch (Exception ex) {
                try {
                    wsSession.close();
                    Logger.getLogger(ChatWebsocket.class.getName()).log(Level.SEVERE, null, ex);
                } catch (IOException ex1) {
                    Logger.getLogger(ChatWebsocket.class.getName()).log(Level.SEVERE, null, ex1);
                }
            }

        } else if (idToken == null && userLogin != null) {
            setupLogin(userLogin);
        } else {
            try {
                wsSession.close();
            } catch (IOException ex) {
                Logger.getLogger(ChatWebsocket.class.getName()).log(Level.SEVERE, null, ex);
            }
        }

    }

    @OnMessage
    public void echo(Message mensaje) throws IOException {

        Gson gson = new GsonBuilder().excludeFieldsWithoutExposeAnnotation().setDateFormat(Constantes.JS_DATE_FORMAT).create();

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
                if (mensaje.getId_canal() == idCanalGlobal) {//Canal Global                    
                    sendMessageToAllUser(mensaje);
                } else {
                    sendMessageToMySubscriptionChannel(mensaje);
                }

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
                if (new CanalServicios().addUserToCanal(new CanalesUsers(mensaje.getId_canal(), mensaje.getNombre_user())) != null) {//Agrega un usuario a un canal
                    setNewChannelToSession(mensaje);

                    Canal channelUserRequest = new Canal(mensaje.getNombre_user());//Enviamos un mensaje de bienvenida y el canal, al usuario demandante
                    sendRequestToOwner(channelUserRequest, new Message(Tipo.GIVE_PERMISO.ordinal(), String.format(Mensajes.GIVE_ACCESS_TO_USER, username)));
                    sendRequestToOwner(channelUserRequest, new Message(gson.toJson(new Canal(mensaje.getId_canal())), mensaje.getNombre_user(), Tipo.GET_CANALES.ordinal()));
                }
                break;
            case GET_CANALES:
                //Lo hacemos en onOpen
                break;
            case GET_MENSAJES:
                String rango = mensaje.getMensaje();
                RangoMensajes rangoMensajes = gson.fromJson(rango, RangoMensajes.class);
                rangoMensajes.setUser(mensaje.getNombre_user());
                List<Message> mensajes = new MensajesServicios().getMessagesByDates(rangoMensajes);//recuperamos los mensajes
                Gson gson2 = new GsonBuilder().setDateFormat(DateFormat.FULL).create();
                Message mensajesDB = new Message(Tipo.GET_MENSAJES.ordinal(), gson2.toJson(mensajes));//convertimos a JSON y enviamos en el contenido del mensaje
                sendRequestToOwner(new Canal(mensaje.getNombre_user()), mensajesDB);
                break;
            case CONFIG:
                //Lo Hacemos en onOpen
                break;
            case DECLINE_ACCESS:
                sendRequestToOwner(new Canal(mensaje.getNombre_user()), new Message(Tipo.DECLINE_ACCESS.ordinal(), String.format(Mensajes.DECLINE_ACCESS_TO_USER, username)));
                break;

        }

    }

    @OnClose
    public void onClose(Session ss, CloseReason re) throws IOException {

        User u = (User) wsSession.getUserProperties().get(Constantes.LOGIN_ON);
        AdminServicios.getInstance().eraseUserOnline(u);

        httpSession.setAttribute(Constantes.TOKEN, null);
        if (re.getCloseCode() == CloseCodes.NORMAL_CLOSURE) {
            httpSession.setAttribute(Constantes.LOGIN, null);
        }

        sendMessageToAllUser(new Message(String.format(Mensajes.USUARIO_CLOSE_CHAT, u.getNombre()), u.getNombre(), Tipo.TEXTO.ordinal()));
    }

    @OnError
    public void onError(Session ss, Throwable re) {
        re.getCause();
    }

    @Override
    public void addNewChannelToChat(Canal canal) {
        try {
            Gson gson = new GsonBuilder().create();
            String newChannel = gson.toJson(canal);
            Message mensaje = new Message(newChannel, new java.sql.Timestamp(new Date().getTime()), username, Tipo.ADD_CANAL.ordinal());
            sendMessageToAllUser(mensaje);

            //Agregamos el canal al servicio de administración
            CanalUser canalUserControl = new CanalUser(canal.getId(), canal.getNombre(), username, username);
            List<CanalUser> listCanal = new ArrayList<>();
            listCanal.add(canalUserControl);
            AdminServicios.getInstance().addNewChannel(listCanal);

        } catch (IOException ex) {
            Logger.getLogger(ChatWebsocket.class.getName()).log(Level.SEVERE, null, ex);
        }

    }

    /**
     * Envía un mensaje a todas las sessiones abiertas
     *
     * @param Message ms
     * @throws IOException
     */
    private void sendMessageToAllUser(Message ms) throws IOException {
        for (Session s : wsSession.getOpenSessions()) {
            try {
                s.getBasicRemote().sendObject(ms);
            } catch (EncodeException ex) {
                Logger.getLogger(ChatWebsocket.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
    }

    /**
     * Busca en las sesiones abiertas el nombre del usuario al que enviar un
     * mensaje
     *
     * @param canal
     * @param message
     * @throws IOException
     */
    private void sendRequestToOwner(Canal canal, Message message) throws IOException {

        for (Session s : wsSession.getOpenSessions()) {
            if (s.getUserProperties().get(Constantes.NAME).equals(canal.getAdmin())) {
                try {
                    s.getBasicRemote().sendObject(message);
                } catch (EncodeException ex) {
                    Logger.getLogger(ChatWebsocket.class.getName()).log(Level.SEVERE, null, ex);
                }
            }

        }
    }

    /**
     * Recorremos todas las sesiones abiertas y en cada una buscamos en la lista
     * de canales asignados, el canal destinatario del mensaje.
     *
     * @param ms
     * @throws IOException
     */
    private void sendMessageToMySubscriptionChannel(Message ms) throws IOException {
        CanalServicios canalServicios = new CanalServicios();
        for (Session s : wsSession.getOpenSessions()) {
            if (canalServicios.isSubscribeToChannel((List<Canal>) s.getUserProperties().get(Constantes.CANALES_USERS), ms)) {
                try {
                    s.getBasicRemote().sendObject(ms);
                } catch (EncodeException ex) {
                    Logger.getLogger(ChatWebsocket.class.getName()).log(Level.SEVERE, null, ex);
                }
            }

        }
    }

    /**
     * En todas las sessiones abiertas buscamos un usuario y actualizamos su
     * lista de canales asignados.
     *
     * @param ms
     * @throws IOException
     */
    private void setNewChannelToSession(Message ms) throws IOException {
        for (Session s : wsSession.getOpenSessions()) {
            if (s.getUserProperties().get(Constantes.NAME).equals(ms.getNombre_user())) {

                List<Canal> canales = new CanalServicios().getCanalesByUser(ms.getNombre_user());
                s.getUserProperties().put(Constantes.CANALES_USERS, canales);
            }
        }
    }

    /**
     * Definimos parámetros en session, enviamos los canales y un mensaje de
     * bienvenida al usuario, además de avisar al resto de usuarios conectados
     *
     * @param user
     */
    private void setupLogin(User user) {

        try {
            RegistroServicios servicios = new RegistroServicios();
            if (servicios.getDuplicateUser(user) == null) {
                user = servicios.insertUser(user);
            } else {
                user = servicios.selectLoginUser(user);
            }
            wsSession.getUserProperties().put(Constantes.LOGIN_ON, user);
            httpSession.setAttribute(Constantes.LOGIN, Constantes.OK);
            AdminServicios.getInstance().setOnlineUser(user);

            Gson gson = new GsonBuilder().setDateFormat(Constantes.DATE_FORMAT_HHMMSS).create();

            Message mensajeBienvenida = null;
            Message mensajeGetCanalesUser = null;
            Message mensajeGetCanales = null;
            Message mensajeGetAllCanales = null;

            if (user != null) {
                username = user.getNombre();
                wsSession.getUserProperties().put(Constantes.ID, user.getId());
                wsSession.getUserProperties().put(Constantes.NAME, user.getNombre());
                wsSession.getUserProperties().put(Constantes.EMAIL, user.getEmail());

                CanalServicios canalServicios = new CanalServicios();

                List<Canal> canalesCliente = canalServicios.getCanalesByUser(username);
                wsSession.getUserProperties().put(Constantes.CANALES_USERS, canalesCliente);
                List<Canal> canales = canalServicios.getNotMyChannels(username);
                List<Canal> allCanales = canalServicios.getCanales();

                //Definimos la salt e iv del canal global 
                int pos = allCanales.indexOf(new Canal(idCanalGlobal));
                global = allCanales.get(pos);

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

            //Avisamos del nuevo usuario conectado en Canal Global
            String textoEncriptado = aesUtil.encrypt(global.getSalt(), global.getIv(), global.getClave(), String.format(Mensajes.NUEVO_USUARIO_EN_CHAT, username));
            sendMessageToAllUser(new Message(textoEncriptado, username, Tipo.TEXTO.ordinal(), idCanalGlobal));
        } catch (IOException ex) {
            Logger.getLogger(ChatWebsocket.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

}//fin clase
