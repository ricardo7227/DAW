/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import dao.UsersDAO;
import java.util.ArrayList;
import java.util.List;
import model.Canal;
import model.CanalUser;
import model.User;

/**
 * Esta clase se encarga de controlar, todos los usuarios conectados, no
 * conectados y los usuarios subscritos a diferentes canales
 *
 * @author Gato
 */
public class AdminServicios {

    private static AdminServicios instance;
    private List<User> usuariosConectados;
    private List<User> usuarios;
    private List<List<CanalUser>> canales;

    public static AdminServicios getInstance() {
        if (instance == null) {
            instance = new AdminServicios();
        }
        return instance;
    }

    public void setOnlineUser(User user) {
        if (usuariosConectados == null) {
            usuariosConectados = new ArrayList<>();
            usuariosConectados.add(user);
        } else {
            usuariosConectados.add(user);
        }
    }

    public List<User> getListOnlineUsers() {
        return usuariosConectados;
    }

    public List<User> getUsers() {
        if (usuarios == null) {
            UsersDAO dao = new UsersDAO();
            usuarios = dao.getUsersJDBCTemplate();
        }
        return usuarios;
    }

    private List<CanalUser> getUsersByChannel(Canal canal) {
        UsersDAO dao = new UsersDAO();
        return dao.getUsersbyChannelsJDBCTemplate(canal);

    }

    public List<List<CanalUser>> getChannels() {

        if (canales == null) {
            canales = new ArrayList<>();
            List<Canal> cs = new CanalServicios().getCanales();
            List<CanalUser> list = null;
            for (Canal canal : cs) {
                list = getUsersByChannel(canal);
                canales.add(list);
            }
        }
        return canales;
    }

    public void addNewChannel(List<CanalUser> canalUsers) {
        if (canales != null) {
            canales.add(canalUsers);
        }
    }

    public List<User> getOfflineUsers() {
        List<User> usuariosOff = null;
        if (usuariosConectados != null) {
            usuariosOff = getUsers();
            usuariosOff.removeAll(usuariosConectados);
        }
        return usuariosOff;
    }

    public void eraseUserOnline(User user) {
        int lista = usuariosConectados.size();
        for (int i = 0; i < usuariosConectados.size() && usuariosConectados.size() == lista; i++) {
            if (usuariosConectados.get(i).getId() == user.getId()) {
                usuariosConectados.remove(i);
            }
        }
    }

}//fin clase
