/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import dao.UsersDAO;
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
import model.Asignatura;
import model.User;
import servicios.RegistroServicios;
import utils.Constantes;
import utils.PasswordHash;
import utils.UrlsPaths;

/**
 *
 * @author Gato
 */
@WebServlet(name = "registroServlet", urlPatterns = {UrlsPaths.REGISTRO})
public class RegistroServlet extends HttpServlet {

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
        RegistroServicios servicios = new RegistroServicios();
        User usuario = servicios.tratarParametro(parametros);

        if (action != null && !action.isEmpty()) {
            switch (action) {
                case Constantes.REGISTRAR:
                    if (!servicios.thisUserExist(usuario)) {

                        if (servicios.userReadyToWorkInsert(usuario)) {

                            usuario = servicios.generatePasswordAndActivationCode(usuario);

                            if (servicios.insertUser(usuario)) {

                                messageToUser = (servicios.buildAndSendEmail(request, usuario)) ? Constantes.messageUserRegisterSubmitEmail : Constantes.messageUserRegisterSubmitEmailFail;

                            } else {
                                messageToUser = Constantes.messageUserErrorInsert;
                            }

                        } else {
                            messageToUser = Constantes.messageUserMissingFields;
                        }

                    } else {
                        messageToUser = Constantes.messageUserExist;
                    }

                    break;

                case Constantes.VALIDATE:
                    if (servicios.userReadyToWorkValidate(usuario)) {

                        usuario = servicios.checkCredentials(usuario);

                        if (usuario != null) {
                            if (servicios.isOnTimeValidEmail(usuario)) {

                                messageToUser = (servicios.activateAccount(usuario)) ? Constantes.messageUserValidateOk : Constantes.messageUserValidateFail;
                            } else {

                                messageToUser = Constantes.messageUserValidateEmailTimeOut;
                            }

                        } else {
                            messageToUser = Constantes.messageUserValidateEmailFailID;
                        }

                    } else {
                        messageToUser = Constantes.messageUserValidateEmailFail;
                    }

                    break;

                case Constantes.LOGIN:
                    if (servicios.userReadyToWorkLogin(usuario)) {
                        String passwordFromClient = usuario.getPassword();
                        usuario = servicios.selectLoginUser(usuario);//recupera el hash de DB
                        if (usuario != null) {
                            if (usuario.isActivo()) {

                                if (PasswordHash.getInstance().validatePassword(passwordFromClient, usuario.getPassword())) {
                                    request.getSession().setAttribute(Constantes.LOGIN_ON, usuario);
                                } else {
                                    messageToUser = Constantes.messageUserLoginFailPassword;
                                }
                            } else {
                                messageToUser = Constantes.messageUserLoginFailActivo;
                            }

                        } else {
                            messageToUser = Constantes.messageUserLoginFailNombre;
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
        

        request.getRequestDispatcher(Constantes.registroJSP).forward(request, response);
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
            Logger.getLogger(RegistroServlet.class.getName()).log(Level.SEVERE, null, ex);
        } catch (InvalidKeySpecException ex) {
            Logger.getLogger(RegistroServlet.class.getName()).log(Level.SEVERE, null, ex);
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
            Logger.getLogger(RegistroServlet.class.getName()).log(Level.SEVERE, null, ex);
        } catch (InvalidKeySpecException ex) {
            Logger.getLogger(RegistroServlet.class.getName()).log(Level.SEVERE, null, ex);
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
