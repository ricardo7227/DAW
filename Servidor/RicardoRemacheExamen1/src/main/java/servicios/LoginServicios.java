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
import javax.servlet.http.HttpServletRequest;
import model.Login;
import utils.Constantes;

/**
 *
 * @author Gato
 */
public class LoginServicios {

    public LoginServicios() {
    }

    public User getDuplicateUser(User user) {
        UsersDAO dao = new UsersDAO();

        return (user.getNombre() != null && user.getEmail() != null) ? dao.getDuplicateUserJDBCTemplate(user) : null;
    }
    
    public User getUser(Login user) {
        UsersDAO dao = new UsersDAO();

        return  dao.getUserJDBCTemplate(user);
    }
    public boolean updateActivo(User usuario) {
        UsersDAO dao = new UsersDAO();
        return dao.updateActivoByNombreJDBCTemplate(usuario) > 0;
    }

    public boolean insertUser(User user) {
        UsersDAO dao = new UsersDAO();
        return dao.insertIntoUserJDBCTemplate(user) != null;
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

    public boolean userReadyToWorkLogin(Login user) {

        return user.getNombre() != null && user.getPassword() != null;
    }

    private String buildUrlToValidate(HttpServletRequest request, User usuario) {
        String equal = "=";
        String and = "&";

        String uri = request.getScheme() + "://"
                + // "http" + "://
                request.getServerName()
                + // "myhost"
                ":"
                + // ":"
                request.getServerPort()
                + // "8080"
                request.getRequestURI()
                + // "/people"
                "?"
                + // "?"
                Constantes.actionJSP + equal + Constantes.VALIDATE + and + Constantes.NOMBRE + equal + usuario.getNombre()
                + "&" + Constantes.EMAIL + equal + usuario.getEmail() + and + Constantes.CODIGO_ACTIVACION + equal + usuario.getCodigo_activacion();

        return uri;
    }

    

    

    public User checkCredentials(User usuario) {
        UsersDAO dao = new UsersDAO();
        return dao.selectIdValidateUserJDBCTemplate(usuario);
    }

    public boolean isOnTimeLogin(Login usuario) {

        long time = timeElapsed(usuario.getFecha_login());

        return time <= Configuration.getInstance().getTimeToValidate();

    }

    private long timeElapsed(Date timeOfLogin) {

        return Duration.between(new java.util.Date(timeOfLogin.getTime()).toInstant(), Instant.now()).toMillis()/1000;

    }

    public boolean activateAccount(User usuario) {
        UsersDAO dao = new UsersDAO();
        return dao.validateUserByIdJDBCTemplate(usuario) > 0;
    }

    public Login selectLoginUser(Login usuario) {
        UsersDAO dao = new UsersDAO();

        return dao.getLoginUserJDBCTemplate(usuario);
    }

    /**
     *
     * @param parametros
     * @return User
     */
    public Login tratarParametro(Map<String, String[]> parametros) {
        Login usuario = null;
        if (parametros != null && !parametros.isEmpty()) {
            usuario = new Login();
            if (parametros.get(Constantes.NOMBRE) != null && !parametros.get(Constantes.NOMBRE)[0].isEmpty()) {
                usuario.setNombre(parametros.get(Constantes.NOMBRE)[0]);
            }
            if (parametros.get(Constantes.PASSWORD) != null && !parametros.get(Constantes.PASSWORD)[0].isEmpty()) {
                usuario.setPassword(parametros.get(Constantes.PASSWORD)[0]);
            }
            if (parametros.get(Constantes.FECHA_LOGIN) != null && !parametros.get(Constantes.FECHA_LOGIN)[0].isEmpty()) {

                SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                java.util.Date parseDate = null;
                try {
                    parseDate = dateFormat.parse(parametros.get(Constantes.FECHA_LOGIN)[0]);
                    usuario.setFecha_login(new Date(parseDate.getTime()));
                } catch (ParseException ex) {
                    Logger.getLogger(LoginServicios.class.getName()).log(Level.SEVERE, null, ex);
                }
            }

        }
        return usuario;

    }

}//fin clase
