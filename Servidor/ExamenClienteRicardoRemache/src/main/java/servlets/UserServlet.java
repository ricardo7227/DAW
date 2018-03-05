/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import dao.UsuariosREST;
import java.io.IOException;

import java.util.Map;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import model.User;
import model.GenericResponse;
import org.apache.http.HttpStatus;
import servicios.UsersServicios;

import utils.Constantes;

/**
 *
 * @author daw
 */
@WebServlet(name = "UserServlet", urlPatterns = {"/usuarios"})
public class UserServlet extends HttpServlet {

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
        UsersServicios servicios = new UsersServicios();
        request.setCharacterEncoding("UTF-8");
        String action = request.getParameter(Constantes.actionJSP);
        User user = null;
        String messageToUser = null;
        Map<String, String[]> parametros = request.getParameterMap();

        UsuariosREST instanceREST = UsuariosREST.getInstance();
        if (action != null && !action.isEmpty()) {

            switch (action) {
                case Constantes.GET:
                    User[] listaUsers = instanceREST.getUsuarios();
                    request.setAttribute(Constantes.userList, listaUsers);
                    break;
                case Constantes.UPDATE:

                    user = servicios.tratarParametros(parametros);
                    messageToUser = (instanceREST.updateUser(user) != null) ? "usuario Actualizado" : "usuario No actualizado";

                    break;
                case Constantes.INSERT:

                    user = servicios.tratarParametros(parametros);
                    messageToUser = (instanceREST.addUser(user) != null) ? "usuario insertado" : "usuario no insertado";

                    break;
                case Constantes.DELETE:
                    user = servicios.tratarParametros(parametros);

                    GenericResponse responseDel = instanceREST.deleteUser(user, false);

                    if (responseDel != null && responseDel.getCode() == HttpStatus.SC_CONFLICT) {

                        request.setAttribute(Constantes.userResult, user);
                        messageToUser = "Fallo en el borrado";

                    } else if (responseDel != null && responseDel.getCode() == HttpStatus.SC_ACCEPTED) {

                        messageToUser = "Usuario Borrado";
                    }
                    break;
                case Constantes.DELETE_FORCE:

                    user = servicios.tratarParametros(parametros);
                     {

                        GenericResponse borrado = instanceREST.deleteUser(user, true);

                        messageToUser = (borrado != null && borrado.getCode() == HttpStatus.SC_ACCEPTED) ? "usuario Borrado": "usuario No borrado";

                    }
                    //1º -> BORRAR NOTA
                    //2º -> BORRAR ALUMNO
                    break;

            }
        }
        if (messageToUser != null) {
            request.setAttribute(Constantes.resultadoQuery, messageToUser);
        }

        request.getRequestDispatcher("/" + Constantes.indexJSP).forward(request, response);
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
