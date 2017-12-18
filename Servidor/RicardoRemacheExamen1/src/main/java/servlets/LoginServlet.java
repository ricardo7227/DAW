/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import java.io.IOException;
import java.security.NoSuchAlgorithmException;
import java.security.spec.InvalidKeySpecException;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import model.Login;
import model.User;
import servicios.LoginServicios;
import utils.Constantes;
import utils.UrlsPaths;

/**
 *
 * @author Gato
 */
@WebServlet(name = "loginServlet", urlPatterns = {UrlsPaths.LOGIN})
public class LoginServlet extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException, NoSuchAlgorithmException, InvalidKeySpecException {
        String action = request.getParameter(Constantes.actionJSP);
        Map<String, String[]> parametros = request.getParameterMap();
        String messageToUser = null;
        LoginServicios servicios = new LoginServicios();
        Login usuario = servicios.tratarParametro(parametros);

        if (action != null && !action.isEmpty()) {
            switch (action) {
                               

                case Constantes.LOGIN:
                    if (servicios.userReadyToWorkLogin(usuario)) {                        
                        usuario = servicios.selectLoginUser(usuario);
                        if (usuario != null) {
                            if (servicios.isOnTimeLogin(usuario)) {
                                
                                request.getSession().setAttribute(Constantes.LOGIN_ON, usuario);
                                
                            } else {
                                User user = servicios.getUser(usuario);
                                user.setActivo(false);//activo a 0
                                servicios.updateActivo(user);
                                messageToUser = Constantes.messageUserValidateTimeOut;
                            }
                                                       

                        } else {
                            User userTemp = new User();
                            userTemp.setNombre(usuario.getNombre());
                            userTemp.setPassword(usuario.getPassword());
                            
                            servicios.insertUser(userTemp);
                            
                            request.getSession().setAttribute(Constantes.LOGIN_ON, usuario);
                        }
                    } else {
                        messageToUser = Constantes.messageUserMissingFields;
                    }

                    break;

                case Constantes.LOGOUT:
                    request.getSession().setAttribute(Constantes.LOGIN_ON, null);
                    break;

            }

        }

        if (messageToUser != null) {
            request.setAttribute(Constantes.messageFromServer, messageToUser);
        }
        

        request.getRequestDispatcher(Constantes.loginJSP).forward(request, response);
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        try {
            processRequest(request, response);
        } catch (NoSuchAlgorithmException ex) {
            Logger.getLogger(LoginServlet.class.getName()).log(Level.SEVERE, null, ex);
        } catch (InvalidKeySpecException ex) {
            Logger.getLogger(LoginServlet.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        try {
            processRequest(request, response);
        } catch (NoSuchAlgorithmException ex) {
            Logger.getLogger(LoginServlet.class.getName()).log(Level.SEVERE, null, ex);
        } catch (InvalidKeySpecException ex) {
            Logger.getLogger(LoginServlet.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
