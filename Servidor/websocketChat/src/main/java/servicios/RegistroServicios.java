/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import config.Configuration;
import dao.UsersDAO;
import java.sql.Date;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.time.Duration;
import java.time.Instant;
import model.User;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import utilidades.Constantes;

/**
 *
 * @author Gato
 */
public class RegistroServicios {

    public RegistroServicios() {
    }

    public User getDuplicateUser(User user) {
        UsersDAO dao = new UsersDAO();

        return (user.getNombre() != null && user.getEmail() != null) ? dao.getDuplicateUserJDBCTemplate(user) : null;
    }

    public User insertUser(User user) {
        UsersDAO dao = new UsersDAO();
        return dao.insertUserJDBCTemplate(user) ;
    }

    public boolean thisUserExist(User user) {

        return getDuplicateUser(user) != null;
    }

    public boolean userReadyToWorkInsert(User user) {

        return user.getNombre() != null && user.getPassword() != null && user.getEmail() != null;
    }

    public boolean userReadyToWorkValidate(User user) {

        return user.getNombre() != null && user.getEmail() != null && user.getCodigo_activacion() != null;
    }

    public boolean userReadyToWorkLogin(User user) {

        return user.getNombre() != null && user.getPassword() != null;
    }

    public User checkCredentials(User usuario) {
        UsersDAO dao = new UsersDAO();
        return dao.selectIdValidateUserJDBCTemplate(usuario);
    }

    public boolean isOnTimeValidEmail(User usuario) {

        long time = timeElapsed(usuario.getFecha_activacion());

        return time <= Configuration.getInstance().getTimeToValidate();

    }

    private long timeElapsed(Date timeOfRegister) {

        return Duration.between(new java.util.Date(timeOfRegister.getTime()).toInstant(), Instant.now()).toHours();

    }

    public boolean activateAccount(User usuario) {
        UsersDAO dao = new UsersDAO();
        return dao.validateUserByIdJDBCTemplate(usuario) > 0;
    }

    public User selectLoginUser(User usuario) {
        UsersDAO dao = new UsersDAO();

        return dao.getLoginUserJDBCTemplate(usuario);
    }

    /**
     *
     * @param parametros
     * @return User
     */
    public User tratarParametro(Map<String, String[]> parametros) {
        User usuario = null;
        if (parametros != null && !parametros.isEmpty()) {
            usuario = new User();
            if (parametros.get(Constantes.EMAIL) != null && !parametros.get(Constantes.EMAIL)[0].isEmpty()) {
                usuario.setEmail(parametros.get(Constantes.EMAIL)[0]);
            }
            if (parametros.get(Constantes.ID) != null && !parametros.get(Constantes.ID)[0].isEmpty()) {
                usuario.setId(Long.valueOf(parametros.get(Constantes.ID)[0]));
            }
            if (parametros.get(Constantes.NOMBRE) != null && !parametros.get(Constantes.NOMBRE)[0].isEmpty()) {
                usuario.setNombre(parametros.get(Constantes.NOMBRE)[0]);
            }
            if (parametros.get(Constantes.ACTIVO) != null && !parametros.get(Constantes.ACTIVO)[0].isEmpty()) {
                usuario.setActivo((Integer.valueOf(parametros.get(Constantes.ACTIVO)[0]) == 0) ? Boolean.FALSE : Boolean.TRUE);
            }
            if (parametros.get(Constantes.CODIGO_ACTIVACION) != null && !parametros.get(Constantes.CODIGO_ACTIVACION)[0].isEmpty()) {
                usuario.setCodigo_activacion(parametros.get(Constantes.CODIGO_ACTIVACION)[0]);
            }
            if (parametros.get(Constantes.PASSWORD) != null && !parametros.get(Constantes.PASSWORD)[0].isEmpty()) {
                usuario.setPassword(parametros.get(Constantes.PASSWORD)[0]);
            }
            if (parametros.get(Constantes.FECHA_ACTIVACION) != null && !parametros.get(Constantes.FECHA_ACTIVACION)[0].isEmpty()) {

                SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                java.util.Date parseDate = null;
                try {
                    parseDate = dateFormat.parse(parametros.get(Constantes.FECHA_ACTIVACION)[0]);
                    usuario.setFecha_activacion(new Date(parseDate.getTime()));
                } catch (ParseException ex) {
                    Logger.getLogger(RegistroServicios.class.getName()).log(Level.SEVERE, null, ex);
                }
            }

        }
        return usuario;

    }

}//fin clase
