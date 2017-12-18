/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import java.io.IOException;
import java.sql.SQLException;

import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import model.Coche;
import servicios.CochesServicios;

import utils.Constantes;
import utils.ConstantesError;
import utils.SqlQuery;
import utils.UrlsPaths;

/**
 *
 * @author daw
 */
@WebServlet(name = "AlumnosServlet", urlPatterns = {UrlsPaths.COCHES})
public class CochesServlet extends HttpServlet {

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
        CochesServicios servicios = new CochesServicios();

        request.setCharacterEncoding("UTF-8");
        String action = request.getParameter(Constantes.actionJSP);
        Coche coche = null;
        String messageToUser = null;
        Map<String, String[]> parametros = request.getParameterMap();
        if (action != null && !action.isEmpty()) {

            switch (action) {
                case Constantes.UPDATE:

                    coche = servicios.tratarParametros(parametros);
                    messageToUser = (servicios.updateCocheJDBC(coche)) ? Constantes.messageQueryAlumnoUpdated : Constantes.messageQueryAlumnoUpdatedFail;

                    break;
                case Constantes.INSERT:

                    coche = servicios.tratarParametros(parametros);
                    messageToUser = (servicios.insertCocheJDBC(coche)) ? Constantes.messageQueryAlumnoInserted : Constantes.messageQueryAlumnoInsertedFail;

                    break;
                case Constantes.DELETE:
                    String key = request.getParameter(SqlQuery.ID.toLowerCase());
                    int deleted = 0;
                    if (key != null && !key.isEmpty()) {
                        deleted = servicios.deleteCocheJDBC(key);
                    }
                    if (deleted == ConstantesError.CodeErrorClaveForanea) {
                        coche = servicios.tratarParametros(parametros);
                        request.setAttribute(Constantes.cocheResult, coche);
                        messageToUser = Constantes.messageQueryAlumnoDeletedFail;

                    } else if (deleted > 0 && deleted < ConstantesError.CodeErrorClaveForanea) {

                        messageToUser = Constantes.messageQueryAlumnoDeleted;
                    }
                    break;
                case Constantes.DELETE_FORCE:

                    coche = servicios.tratarParametros(parametros);
                     {
                        try {
                            boolean borrado = servicios.deleteCocheForce((int) coche.getId());

                            messageToUser = (borrado) ? Constantes.messageQueryAlumnoDeleted : Constantes.messageQueryAlumnoDeletedFailedAgain;

                        } catch (SQLException ex) {
                            Logger.getLogger(CochesServlet.class.getName()).log(Level.SEVERE, null, ex);
                        }
                    }
                    
                    break;

            }
        }

        if (messageToUser != null) {
            request.setAttribute(Constantes.resultadoQuery, messageToUser);
        }

        request.setAttribute(Constantes.cochesList, servicios.getAllcoches());//envia la lista al jsp
        request.getRequestDispatcher("/" + Constantes.cocheJSP).forward(request, response);
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
