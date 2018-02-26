/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import dao.CanalesDAO;
import java.util.List;
import model.Canal;
import model.CanalesUsers;
import model.Message;
import websocket.ChatWebsocket;

/**
 *
 * @author Gato
 */
public class CanalServicios {

    public CanalServicios() {
    }

    public Canal insertCanal(Canal canal, ChatWebsocket chatWebsocket) {
        CanalesDAO dao = new CanalesDAO();
        return dao.insertCanalJDBCTemplate(canal, chatWebsocket);
    }

    public CanalesUsers addUserToCanal(CanalesUsers canalesUsers) {
        CanalesDAO dao = new CanalesDAO();
        return dao.addUserToChannelJDBCTemplate(canalesUsers);
    }

    public List<Canal> getCanalesByUser(String user) {
        CanalesDAO dao = new CanalesDAO();
        return dao.getCanalesByUserJDBCTemplate(user);
    }

    public List<Canal> getCanales() {
        CanalesDAO dao = new CanalesDAO();
        return dao.getCanalesJDBCTemplate();
    }
    public List<Canal> getNotMyChannels(String username) {
        CanalesDAO dao = new CanalesDAO();
        return dao.getNotMyChannelsJDBCTemplate(username);
    }
    public Canal getChannelOwner(Message message) {
        CanalesDAO dao = new CanalesDAO();
        return dao.getChannelOwnerByIDChannelJDBCTemplate(message);
    }

    public boolean isSubscribeToChannel(List<Canal> canales,Message message){
        boolean isSubscribe = false;
        for (Canal canal : canales) {
            if (canal.getId() == message.getId_canal()) {
                isSubscribe = true;
            }
        }
        return isSubscribe;
    }
}//fin clase
