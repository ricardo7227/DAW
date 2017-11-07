/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import java.io.IOException;
import java.util.Map;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import model.Asignatura;
import servicios.AsignaturasServicios;
import utils.Constantes;
import utils.SqlQuery;

/**
 *
 * @author daw
 */
@WebServlet(name = "AsignaturasServlet", urlPatterns = {"/asignaturas"})
public class AsignaturasServlet extends HttpServlet {

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

        AsignaturasServicios servicios = new AsignaturasServicios();

        response.setContentType("text/html;charset=UTF-8");
        request.setCharacterEncoding("UTF-8");
        String action = request.getParameter(Constantes.actionJSP);
        Asignatura asignatura = null;
        Map<String, String[]> parametros = null;
        if (action != null && !action.isEmpty()) {

            switch (action) {
                case Constantes.UPDATE:

                    parametros = request.getParameterMap();

                    asignatura = servicios.tratarParametros(parametros);
                    int filas = servicios.updateAsignaturadbUtils(asignatura);

                    request.setAttribute(Constantes.resultadoQuery,
                            (filas > 0 ? Constantes.messageQueryAsignaturaUpdated : Constantes.messageQueryAsignaturaUpdateFailed));

                    break;
                case Constantes.INSERT:

                    parametros = request.getParameterMap();

                    asignatura = servicios.tratarParametros(parametros);

                    if (servicios.insertAsignaturadbUtils(asignatura)) {
                        request.setAttribute(Constantes.resultadoQuery, Constantes.messageQueryAsignaturaInserted);
                    }

                    break;
                case Constantes.DELETE:
                    String key = request.getParameter(SqlQuery.ID.toLowerCase());
                    if (key != null && !key.isEmpty()) {
                        servicios.deleteAsignaturadbUtils(key);

                    }
                    break;

            }
        }

        request.setAttribute(Constantes.asignaturasList, servicios.getAllAsignaturasdbUtils());//envia la lista al jsp
        request.getRequestDispatcher(Constantes.asignaturasJSP).forward(request, response);
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
