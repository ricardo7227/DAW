/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;


import dao.UsersDAO;
import java.security.NoSuchAlgorithmException;
import java.security.spec.InvalidKeySpecException;
import java.sql.Date;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.http.HttpServletRequest;
import model.User;
import model.UserNewPassword;
import utils.Constantes;
import static utils.Constantes.MESSAGE_USER_NEW_PASSWORD;
import utils.PasswordHash;

/**
 *
 * @author Gato
 */
public class LoginServicios {
    
    public LoginServicios() {
    }
    
    public boolean userReadyToWorkLogin(User user) {
        
        return user.getNombre() != null && user.getPassword() != null;
    }
    
    public boolean userReadyToWorkChangePassword(UserNewPassword user) {
        
        return user.getOld_password() != null && user.getNew_password() != null && user.getNew_password_confirm() != null;
    }
    
    public boolean compareNewPassword(UserNewPassword user) {
        
        return user.getNew_password().contains(user.getNew_password_confirm());
    }
    
   
    
    public boolean buildAndSendEmail(HttpServletRequest request, User usuario) {        
        MandarMail mail = new MandarMail();
        String message =String.format(MESSAGE_USER_NEW_PASSWORD,usuario.getNombre(),usuario.getPassword());

        return mail.sendMail(usuario.getEmail(), message, String.format(Constantes.EMAIL_SUBJECT_NEW_PASSWORD, usuario.getNombre()));
    }
    
    public User selectLoginUser(User usuario) {
        UsersDAO dao = new UsersDAO();
        
        return dao.getLoginUserJDBCTemplate(usuario);
    }
    
   
    
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
                    Logger.getLogger(LoginServicios.class.getName()).log(Level.SEVERE, null, ex);
                }
            }
            
        }
        return usuario;
        
    }
    
   
    
}//fin clase
