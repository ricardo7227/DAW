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
        return dao.addUserToCanalJDBCTemplate(canalesUsers);
    }

    public List<Canal> getCanales(String user) {
        CanalesDAO dao = new CanalesDAO();
        return dao.getCanalesJDBCTemplate(user);
    }

}//fin clase
