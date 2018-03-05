/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import dao.DeleteForceException;
import dao.UserDAO;
import java.util.Collection;
import modelo.User;

/**
 *
 * @author daw
 */
public class UsuariosServicios {

    public UsuariosServicios() {
    }

    public Collection<User> getAllUsers() {
        UserDAO dao = new UserDAO();
        return dao.getAllUser();
    }

    public boolean insertUser(User usuario) {
        UserDAO dao = new UserDAO();
        return dao.addUser(usuario);
    }
    public boolean updateUser(User usuario) {
        UserDAO dao = new UserDAO();
        return dao.updateUser(usuario);
    }
    public boolean deleteUser(User usuario) throws DeleteForceException {
        UserDAO dao = new UserDAO();
        return dao.delUser(usuario);
    }
    public boolean deleteUserForce(User usuario) throws DeleteForceException {
        UserDAO dao = new UserDAO();
        return dao.delUserForce(usuario);
    }
}//fin clase
