/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import servicios.AlumnosServicios;
import utils.Constantes;
import model.Alumno;
import model.GenericResponse;
import utils.CodesError;

/**
 *
 * @author daw
 */
@WebServlet(name = "RestAlumnos", urlPatterns = {"/rest/alumnos"})
public class RestAlumnos extends HttpServlet {

    private AlumnosServicios servicios;

    @Override
    protected void doDelete(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        Alumno alumno = (Alumno) req.getAttribute(Constantes.ALUMNO);

        if (alumno != null && alumno.getId() > 0) {

            int rowsAffected = servicios.deleteAlumnoJDBC(alumno.getId());
            req.setAttribute(Constantes.JSON, rowsAffected > 0 ? new GenericResponse(rowsAffected, Constantes.messageQueryAlumnoDeleted) : new GenericResponse(CodesError.DELETE.ordinal(), Constantes.messageQueryAlumnoDeletedFail));
        }
    }

    @Override
    protected void doPut(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {

        Alumno alumno = (Alumno) req.getAttribute(Constantes.ALUMNO);
        if (alumno != null) {
            alumno = servicios.insertAlumnoJDBC(alumno);
            req.setAttribute(Constantes.JSON, alumno.getId() > 0 ? alumno : new GenericResponse(CodesError.INSERT.ordinal(), Constantes.messageQueryAlumnoInsertedFail));
        }

    }

    @Override
    public void init() throws ServletException {
        servicios = new AlumnosServicios();
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

        request.setAttribute(Constantes.JSON, servicios.getAllAlumnos());

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
        Alumno alumno = (Alumno) request.getAttribute(Constantes.ALUMNO);
        if (alumno != null) {
            alumno = servicios.updateAlumnoJDBC(alumno);
            request.setAttribute(Constantes.JSON, alumno != null ? alumno : new GenericResponse(CodesError.UPDATE.ordinal(), Constantes.messageQueryAlumnoUpdatedFail));
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
