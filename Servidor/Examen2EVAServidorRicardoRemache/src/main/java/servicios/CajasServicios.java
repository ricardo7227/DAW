/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import dao.CajaDAO;
import dao.UserDAO;
import java.util.Collection;
import java.util.List;
import modelo.Caja;
import modelo.Cosa;
import modelo.User;

/**
 *
 * @author daw
 */
public class CajasServicios {

    public CajasServicios() {
    }

    public Collection<Caja> getAllCajasByUser(User user) {
        UserDAO dao = new UserDAO();

//        Collection<Caja> cajasUser = new ArrayList<>();
//
//        Collection<Caja> cajas = dao.getAllCajas();
//        for (Caja caja : cajas) {
//            Collection<User> usuarios = dao.getAllUsersCaja(caja);
//            for (User usuario : usuarios) {
//                if (user.equals(usuario)) {
//                    cajasUser.add(caja);
//                }
//            }
//        }
        return dao.getAllCajasUser(user);
    }

    public boolean insertCaja(User usuario, Caja c) {
        UserDAO dao = new UserDAO();

        return dao.addCajaAUser(usuario, c);
    }

    public boolean insertCosasCajaOfUser(User usuario, Caja c, Cosa cosa) {
        CajaDAO dao = new CajaDAO();
        boolean isInsert = false;
        Collection<Caja> cajasUser = getAllCajasByUser(usuario);
        for (Caja caja : cajasUser) {
            if (c.equals(caja)) {
                isInsert = dao.addCosaACaja(cosa, caja);
            }
        }
        return isInsert;
    }

    public List<Cosa> getCosasByCaja(Caja caja) {
        return caja.getCosas();
    }

    public boolean addCantidadCosaACaja(Cosa cosa, Caja caja) {
        CajaDAO dao = new CajaDAO();

        return dao.addCantidadCosaACaja(cosa, caja);

    }

}//fin clase
