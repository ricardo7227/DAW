/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import dao.AlumnosDAO;
import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.sql.Date;
import java.text.ParseException;

import java.text.SimpleDateFormat;

import java.util.Iterator;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import model.Alumno;
import utils.Constantes;
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

        AlumnosDAO alumnosObj = new AlumnosDAO();
        
        response.setContentType("text/html;charset=UTF-8");
        request.setCharacterEncoding("UTF-8");
        String action = request.getParameter(Constantes.actionJSP);
        Alumno alumno = null;
        Map<String, String[]> parametros = null;
        if (action != null && !action.isEmpty()) {

            switch (action) {
                case Constantes.UPDATE:
                    alumno = new Alumno();
                    parametros = request.getParameterMap();

                    alumno = tratarParametros(parametros, alumno);

                    alumnosObj.updateUserJDBC(alumno);

                    break;
                case Constantes.INSERT:
                    alumno = new Alumno();
                    parametros = request.getParameterMap();
                    alumno = tratarParametros(parametros, alumno);

                    alumnosObj.insertUserJDBC(alumno);
                    break;
                case Constantes.DELETE:
                    String key = request.getParameter(SqlQuery.ID.toLowerCase());
                    if (key != null && !key.isEmpty()) {
                        alumnosObj.deleteUserByIdJDBC(key);
                    }
                    break;

            }
        }
        request.setAttribute(Constantes.alumnosList, alumnosObj.getAllAlumnosJDBC());//envia la lista al jsp
        request.getRequestDispatcher(Constantes.alumnosJSP).forward(request, response);
    }

    private Alumno tratarParametros(Map<String, String[]> parametros, Alumno alumno) throws UnsupportedEncodingException {
        if (parametros != null && !parametros.isEmpty()) {

            Iterator<String> it = parametros.keySet().iterator();

            while (it.hasNext()) {
                String key = (String) it.next();
                String[] values = (String[]) parametros.get(key);
                if (values[0] != null && !values[0].isEmpty()) {

                    if (SqlQuery.ID.equalsIgnoreCase(key)) {
                        alumno.setId(Long.valueOf(values[0]));
                    } else if (SqlQuery.NOMBRE.equalsIgnoreCase(key)) {
                        alumno.setNombre(new String(values[0].getBytes("UTF-8")));
                    } else if (SqlQuery.FECHA_NACIMIENTO.equalsIgnoreCase(key)) {
                        SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                        java.util.Date parseDate = null;
                        try {
                            parseDate = dateFormat.parse(values[0]);
                            alumno.setFecha_nacimiento(new Date(parseDate.getTime()));
                        } catch (ParseException ex) {
                            Logger.getLogger(AlumnosServlet.class.getName()).log(Level.SEVERE, null, ex);
                        }

                    } else if (SqlQuery.MAYOR_EDAD.equalsIgnoreCase(key)) {
                        alumno.setMayor_edad("on".equals(values[0]) ? Boolean.TRUE : Boolean.FALSE);
                    }
                }

            }

        }
        return alumno;
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
