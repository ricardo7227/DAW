/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import java.io.UnsupportedEncodingException;
import java.util.Iterator;
import java.util.Map;
import model.User;

/**
 *
 * @author oscar
 */
public class UsersServicios {

    public UsersServicios() {

    }

    /**
     *
     * @param parametros
     * @return objeto user con sus parametros correspondientes
     * @throws UnsupportedEncodingException
     */
    public User tratarParametros(Map<String, String[]> parametros) throws UnsupportedEncodingException {
        User user = null;
        if (parametros != null && !parametros.isEmpty()) {

            user = new User();

            Iterator<String> it = parametros.keySet().iterator();

            while (it.hasNext()) {
                String key = (String) it.next();
                String[] values = (String[]) parametros.get(key);
                if (values[0] != null && !values[0].isEmpty()) {

                    if ("name".equalsIgnoreCase(key)) {
                        user.setName(values[0]);
                    } else if ("password".equalsIgnoreCase(key)) {
                        user.setPassword(values[0]);
                    }
                }

            }

        }
        return user;
    }

    

}//fin clase
