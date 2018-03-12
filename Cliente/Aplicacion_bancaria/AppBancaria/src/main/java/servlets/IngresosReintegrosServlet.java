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
import java.util.HashMap;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import model.Movimiento;
import servicios.MovimientosServicios;
import utils.Constantes;
import utils.Templates;
import utils.UrlsPaths;

/**
 *
 * @author Gato
 */
@WebServlet(name = "IngresosReintegrosServlet", urlPatterns = {UrlsPaths.REINTEGROS})
public class IngresosReintegrosServlet extends HttpServlet {

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
            freemarker.template.Configuration freeMarker = Configuration.getInstance().getFreeMarker();
            String messageToUser = null;

            HashMap paramentrosPlantilla = new HashMap();
            if (messageToUser != null) {
                paramentrosPlantilla.put(Constantes.MESSAGE_TO_USER, messageToUser);
            }

            Template plantilla = freeMarker.getTemplate(Templates.INGRESOS_REINTEGROS_TEMPLATE);
            plantilla.process(paramentrosPlantilla, response.getWriter());

        } catch (TemplateException ex) {
            Logger.getLogger(MovimientosServlet.class.getName()).log(Level.SEVERE, null, ex);
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

        Map<String, String[]> parametros = request.getParameterMap();
        String action = request.getParameter(Constantes.ACTION_TEMPLATE);
        if (action != null && !action.isEmpty()) {
            switch (action) {

                case Constantes.NEW_MOVIMIENTO:
                    MovimientosServicios movimientosServicios = new MovimientosServicios();
                    Movimiento movimiento = movimientosServicios.tratarParametrosMovimiento(parametros);
                    movimientosServicios.registrarNuevoMovimiento(movimiento, response);

                    break;
            }
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
