/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import dao.UsersDAO;
import java.sql.Date;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import model.User;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.http.HttpServletRequest;
import utils.Constantes;

/**
 *
 * @author Gato
 */
public class RegistroServicios {

    public RegistroServicios() {
    }

    @Deprecated
    public User getUserbyNombreAndEmail(User user) {
        UsersDAO dao = new UsersDAO();
        return dao.getUserByNombreAndEmailDBUtils(user);
    }

    public User getDuplicateUser(User user) {
        UsersDAO dao = new UsersDAO();

        return (user.getNombre() != null && user.getEmail() != null) ? dao.getDuplicateUserJDBCTemplate(user) : null;//prevenir la inserción de nulos;
    }

    public boolean insertUser(User user) {
        UsersDAO dao = new UsersDAO();
        return dao.insertUserJDBCTemplate(user) != null;
    }

    public boolean thisUserExist(User user) {

        return getDuplicateUser(user) != null;
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

    public boolean userReadyToWorkInsert(User user) {
        boolean valido = false;//NOMBRE, PASSWORD, EMAIL
        if (user.getNombre() != null && user.getPassword() != null && user.getEmail() != null) {
            valido = Boolean.TRUE;
        }
        return valido;
    }

    public boolean userReadyToWorkValidate(User user) {
        boolean valido = false;//NOMBRE,  EMAIL, Codigo_activacion
        if (user.getNombre() != null && user.getEmail() != null && user.getCodigo_activacion() != null) {
            valido = Boolean.TRUE;
        }
        return valido;
    }

    public boolean userReadyToWorkLogin(User user) {

        return user.getNombre() != null && user.getPassword() != null;
    }

    public String buildUrlToValidate(HttpServletRequest request, User usuario) {

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
                Constantes.actionJSP + "=" + Constantes.VALIDATE + "&" + Constantes.NOMBRE + "=" + usuario.getNombre()
                + "&" + Constantes.EMAIL + "=" + usuario.getEmail() + "&" + Constantes.CODIGO_ACTIVACION + "=" + usuario.getCodigo_activacion();

        return uri;
    }

    public boolean buildAndSendEmail(HttpServletRequest request, User usuario) {
        String UrlToValidate = buildUrlToValidate(request, usuario);
        MandarMail mail = new MandarMail();
        String message = "<a href=\"" + UrlToValidate + "\" target=\"_blank\">Click para validar tu cuenta</a>";

        return mail.sendMail(usuario.getEmail(), message, String.format(Constantes.emailSubjectValidate, usuario.getNombre()));
    }

    public long timeElapsed(Date timeRegister) {
        long currentTime = new java.util.Date().getTime();
        long difference = currentTime - timeRegister.getTime();
        return difference;
    }

    public User checkCredentials(User usuario) {
        UsersDAO dao = new UsersDAO();
        return dao.selectIdValidateUserJDBCTemplate(usuario);
    }

    public boolean isOnTimeValidEmail(User usuario) {

        long time = timeElapsed(usuario.getFecha_activacion());

        return time <= Constantes.MAX_TIME_TO_VALIDATE;

    }

    public boolean activateAccount(User usuario) {
        UsersDAO dao = new UsersDAO();
        return dao.validateUserByIdJDBCTemplate(usuario) > 0;
    }

    public User selectLoginUser(User usuario) {
        UsersDAO dao = new UsersDAO();

        return dao.getLoginUserJDBCTemplate(usuario);
    }

}//fin clase
