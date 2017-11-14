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
import model.Alumno;
import servicios.AlumnosServicios;

import utils.Constantes;
import utils.ConstantesError;
import utils.SqlQuery;

/**
 *
 * @author daw
 */
@WebServlet(name = "AlumnosServlet", urlPatterns = {"/alumnos"})
public class AlumnosServlet extends HttpServlet {

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
        AlumnosServicios servicios = new AlumnosServicios();

        response.setContentType("text/html;charset=UTF-8");
        request.setCharacterEncoding("UTF-8");

        String action = request.getParameter(Constantes.actionJSP);
        Alumno alumno = null;
        String messageToUser = null;
        Map<String, String[]> parametros = request.getParameterMap();
        if (action != null && !action.isEmpty()) {

            switch (action) {
                case Constantes.UPDATE:

                    alumno = servicios.tratarParametros(parametros);
                    messageToUser = (servicios.updateAlumnoJDBC(alumno)) ? Constantes.messageQueryAlumnoUpdated : Constantes.messageQueryAlumnoDeletedFail;

                    break;
                case Constantes.INSERT:

                    alumno = servicios.tratarParametros(parametros);
                    messageToUser = (servicios.insertAlumnoJDBC(alumno)) ? Constantes.messageQueryAlumnoInserted : Constantes.messageQueryAlumnoInsertedFail;

                    break;
                case Constantes.DELETE:
                    String key = request.getParameter(SqlQuery.ID.toLowerCase());
                    int deleted = 0;
                    if (key != null && !key.isEmpty()) {
                        deleted = servicios.deleteAlumnoJDBC(key);
                    }
                    if (deleted == ConstantesError.CodeErrorClaveForanea) {
                        alumno = servicios.tratarParametros(parametros);
                        request.setAttribute(Constantes.alumnoResult, alumno);
                        messageToUser = Constantes.messageQueryAlumnoDeletedFail;

                    } else if (deleted > 0 && deleted < ConstantesError.CodeErrorClaveForanea) {

                        messageToUser = Constantes.messageQueryAlumnoDeleted;
                    }
                    break;
                case Constantes.DELETE_FORCE:

                    alumno = servicios.tratarParametros(parametros);
                     {
                        try {
                            boolean borrado = servicios.deleteAlumnoForce((int) alumno.getId());

                            messageToUser = (borrado) ? Constantes.messageQueryAlumnoDeleted : Constantes.messageQueryAlumnoDeletedFailedAgain;

                        } catch (SQLException ex) {
                            Logger.getLogger(AlumnosServlet.class.getName()).log(Level.SEVERE, null, ex);
                        }
                    }
                    //1º -> BORRAR NOTA 
                    //2º -> BORRAR ALUMNO
                    break;

            }
        }

        if (messageToUser != null) {
            request.setAttribute(Constantes.resultadoQuery, messageToUser);
        }

        request.setAttribute(Constantes.alumnosList, servicios.getAllAlumnos());//envia la lista al jsp
        request.getRequestDispatcher(Constantes.alumnosJSP).forward(request, response);
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
