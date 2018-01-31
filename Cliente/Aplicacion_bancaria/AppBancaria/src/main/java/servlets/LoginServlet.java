/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import config.Configuration;
import freemarker.template.Template;
import freemarker.template.TemplateException;
import java.io.IOException;
import java.security.NoSuchAlgorithmException;
import java.security.spec.InvalidKeySpecException;
import java.util.HashMap;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import model.User;
import servicios.LoginServicios;
import utils.Constantes;
import utils.PasswordHash;
import utils.UrlsPaths;

/**
 *
 * @author Gato
 */
@WebServlet(name = "LoginServlet", urlPatterns = {UrlsPaths.INDEX})
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
            throws ServletException, IOException {

        try {
            String action = request.getParameter(Constantes.ACTION_TEMPLATE);
            Map<String, String[]> parametros = request.getParameterMap();
            String messageToUser = null;
            LoginServicios servicios = new LoginServicios();
            User usuario = servicios.tratarParametro(parametros);
            long levelAccessUser = -1;
            freemarker.template.Configuration freeMarker = Configuration.getInstance().getFreeMarker();
            HttpSession session = request.getSession();

            if (action != null && !action.isEmpty()) {
                switch (action) {
                    case Constantes.LOGIN:
                        if (servicios.userReadyToWorkLogin(usuario)) {
                            String passwordFromClient = usuario.getPassword();
                            usuario = servicios.selectLoginUser(usuario);//recupera el hash de DB

                            if (usuario != null) {
                                if (usuario.isActivo()) {

                                    if (PasswordHash.getInstance().validatePassword(passwordFromClient, usuario.getPassword())) {

                                        //levelAccessUser = servicios.getIdTipoPermiso(usuario.getId());
                                        session.setAttribute(Constantes.LOGIN_ON, usuario);
                                        session.setAttribute(Constantes.LEVEL_ACCESS, levelAccessUser);

                                    } else {
                                        messageToUser = Constantes.MESSAGE_USER_LOGIN_FAIL_PASSWORD;
                                    }
                                } else {
                                    messageToUser = Constantes.MESSAGE_USER_LOGIN_FAIL_ACTIVO;
                                }

                            } else {
                                messageToUser = Constantes.MESSAGE_USER_LOGIN_FAIL_NOMBRE;
                            }
                        } else {
                            messageToUser = Constantes.MESSAGE_USER_MISSING_FIELDS;
                        }

                        break;
                    case Constantes.LOGOUT:
                        session.setAttribute(Constantes.LOGIN_ON, null);
                        freeMarker.setSharedVariable(Constantes.LOGIN_ON, null);
                        freeMarker.setSharedVariable(Constantes.LEVEL_ACCESS, null);
                        break;
                }
            }
            HashMap paramentrosPlantilla = new HashMap();
            if (messageToUser != null) {
                paramentrosPlantilla.put(Constantes.MESSAGE_TO_USER, messageToUser);
            }

            if (session.getAttribute(Constantes.LOGIN_ON) != null && usuario != null) {
                paramentrosPlantilla.put(Constantes.LOGIN_ON, usuario);
                freeMarker.setSharedVariable(Constantes.LOGIN_ON, usuario);
                freeMarker.setSharedVariable(Constantes.LEVEL_ACCESS, levelAccessUser);
            }

            Template plantilla = freeMarker.getTemplate(Constantes.INDEX_TEMPLATE);
            plantilla.process(paramentrosPlantilla, response.getWriter());
        } catch (TemplateException ex) {
            Logger.getLogger(LoginServlet.class.getName()).log(Level.SEVERE, null, ex);
        } catch (NoSuchAlgorithmException ex) {
            Logger.getLogger(LoginServlet.class.getName()).log(Level.SEVERE, null, ex);
        } catch (InvalidKeySpecException ex) {
            Logger.getLogger(LoginServlet.class.getName()).log(Level.SEVERE, null, ex);
        }

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
        processRequest(request, response);
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
        processRequest(request, response);
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
