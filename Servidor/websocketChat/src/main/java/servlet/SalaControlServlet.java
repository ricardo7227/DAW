/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlet;

import config.Configuration;
import freemarker.template.Template;
import freemarker.template.TemplateException;
import java.io.IOException;
import java.util.HashMap;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import model.CanalUser;
import model.User;
import servicios.AdminServicios;
import utilidades.Constantes;
import utilidades.Templates;

/**
 *
 * @author daw
 */
@WebServlet(name = "SalaControl", urlPatterns = {"/controlRoom"})
public class SalaControlServlet extends HttpServlet {

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
            List<User> usuariosOn = null;
            List<User> usuariosOff = null;
            List<List<CanalUser>> canales = null;
            if (request.getSession().getAttribute(Constantes.LOGIN) != null) {
                usuariosOn = AdminServicios.getInstance().getListOnlineUsers();
                usuariosOff = AdminServicios.getInstance().getOfflineUsers();
                canales = AdminServicios.getInstance().getChannels();

            }

            paramentrosPlantilla.put(Constantes.USERS_ONLINE, usuariosOn);
            paramentrosPlantilla.put(Constantes.USERS_OFFLINE, usuariosOff);
            paramentrosPlantilla.put(Constantes.CHANNELS, canales);

            Template plantilla = Configuration.getInstance().getFreeMarker().getTemplate(Templates.CONTROL_ROOM);
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
