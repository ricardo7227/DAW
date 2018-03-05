/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlet;

import dao.DeleteForceException;
import java.io.IOException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import modelo.GenericResponse;
import modelo.User;
import org.apache.http.HttpStatus;
import servicios.UsuariosServicios;

import utilidades.Constantes;
import utilidades.Mensajes;

/**
 *
 * @author daw
 */
@WebServlet(name = "usuariosAPIServlet", urlPatterns = {"/rest/usuariosAPI"})
public class UsuariosAPIServlet extends HttpServlet {

    private UsuariosServicios usuariosServicios;

    @Override
    public void init() throws ServletException {
        usuariosServicios = new UsuariosServicios();
    }

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
        //processRequest(request, response);

        request.setAttribute(Constantes.JSON, usuariosServicios.getAllUsers());

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
        User user = (User) request.getAttribute(Constantes.USER);
        if (user != null) {

            if (usuariosServicios.updateUser(user)) {
                request.setAttribute(Constantes.JSON, user);
            } else {
                response.setStatus(HttpStatus.SC_INTERNAL_SERVER_ERROR);
                request.setAttribute(Constantes.JSON, new GenericResponse(HttpStatus.SC_INTERNAL_SERVER_ERROR, Mensajes.messageQueryUserUpdatedFail));
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

    @Override
    protected void doDelete(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        User user = (User) req.getAttribute(Constantes.USER);
        String deleteForce = req.getParameter(Constantes.DELETE_FORCE);

        boolean rowsAffected = false;
        if (user != null) {
            if (deleteForce != null && !deleteForce.isEmpty() && Boolean.valueOf(deleteForce)) {
                try {
                    rowsAffected = usuariosServicios.deleteUserForce(user);

                } catch (DeleteForceException ex) {
                    req.setAttribute(Constantes.JSON, new GenericResponse(HttpStatus.SC_BAD_REQUEST, Mensajes.messageQueryUserDeletedFailedAgain));
                    Logger.getLogger(UsuariosAPIServlet.class.getName()).log(Level.SEVERE, null, ex);
                }
            } else {

                try {
                    rowsAffected = usuariosServicios.deleteUser(user);
                } catch (DeleteForceException ex) {
                    resp.setStatus(HttpStatus.SC_CONFLICT);
                    req.setAttribute(Constantes.JSON, new GenericResponse(HttpStatus.SC_CONFLICT, Mensajes.messageQueryUserDeletedFail));
                    Logger.getLogger(UsuariosAPIServlet.class.getName()).log(Level.SEVERE, null, ex);
                }

            }
        }
        if (rowsAffected) {
            req.setAttribute(Constantes.JSON, new GenericResponse(HttpStatus.SC_ACCEPTED, Mensajes.messageQueryUserDeleted));
        }
    }

    @Override
    protected void doPut(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        User usuario = (User) req.getAttribute(Constantes.USER);

        if (usuario != null) {

            if (usuariosServicios.insertUser(usuario)) {
                resp.setStatus(HttpStatus.SC_CREATED);
                req.setAttribute(Constantes.JSON, usuario);
            } else {
                resp.setStatus(HttpStatus.SC_INTERNAL_SERVER_ERROR);
                req.setAttribute(Constantes.JSON,
                        new GenericResponse(HttpStatus.SC_INTERNAL_SERVER_ERROR, Mensajes.messageQueryUserInsertedFail));
            }

        }

    }

}//fin clase
