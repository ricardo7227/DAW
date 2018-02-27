/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlet;

import utilidades.Templates;

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
import servicios.RegistroServicios;
import utilidades.Constantes;
import utilidades.PasswordHash;

/**
 *
 * @author daw
 */
@WebServlet(name = "SalaChatServlet", urlPatterns = {"/myChat"})
public class SalaChatServlet extends HttpServlet {

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

            HashMap paramentrosPlantilla = new HashMap();
            //paramentrosPlantilla.put(Constantes.LOGIN_ON, usuario);

            Template plantilla = Configuration.getInstance().getFreeMarker().getTemplate(Templates.CHAT_ROOM);
            plantilla.process(paramentrosPlantilla, response.getWriter());
        } catch (TemplateException ex) {
            Logger.getLogger(SalaChatServlet.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

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

        try {
            String action = request.getParameter(Constantes.ACTION);
            Map<String, String[]> parametros = request.getParameterMap();
            LoginServicios servicios = new LoginServicios();
            User usuario = servicios.tratarParametro(parametros);

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

                                        session.setAttribute(Constantes.LOGIN_ON, usuario);
                                        //session.setAttribute(Constantes.LEVEL_ACCESS, levelAccessUser);

                                    } else {
                                        //messageToUser = Constantes.MESSAGE_USER_LOGIN_FAIL_PASSWORD;
                                    }
                                } else {
                                    //messageToUser = Constantes.MESSAGE_USER_LOGIN_FAIL_ACTIVO;
                                }

                            } else {
                                //messageToUser = Constantes.MESSAGE_USER_LOGIN_FAIL_NOMBRE;
                            }
                        } else {
                            //messageToUser = Constantes.MESSAGE_USER_MISSING_FIELDS;
                        }

                        break;
                    case Constantes.LOGIN_GOOGLE:
                        //define el token del usuario en session
                        session.setAttribute(Constantes.TOKEN, request.getParameter(Constantes.TOKEN));
                        break;

                    case Constantes.REGISTRAR:
                        RegistroServicios serviciosResgistro = new RegistroServicios();
                        usuario = serviciosResgistro.tratarParametro(parametros);
                        User userActivate = new User(usuario.getNombre(), usuario.getPassword(), usuario.getEmail());
                        if (!serviciosResgistro.thisUserExist(userActivate)) {

                            if (serviciosResgistro.userReadyToWorkInsert(userActivate)) {

                                usuario = serviciosResgistro.generatePasswordAndActivationCode(userActivate);

                                if (serviciosResgistro.insertUser(userActivate) != null) {

                                } else {
                                    // messageToUser = Constantes.MESSAGE_USER_ERROR_INSERT;
                                }

                            } else {
                                //messageToUser = Constantes.MESSAGE_USER_MISSING_FIELDS;
                            }

                        } else {
                            //messageToUser = Constantes.MESSAGE_USER_EXIST;
                        }

                        break;

                }
            }

        } catch (NoSuchAlgorithmException | InvalidKeySpecException ex) {
            Logger.getLogger(SalaChatServlet.class.getName()).log(Level.SEVERE, null, ex);
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
