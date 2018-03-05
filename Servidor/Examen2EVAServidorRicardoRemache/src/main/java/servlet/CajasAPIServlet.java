/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlet;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import modelo.Caja;

import modelo.GenericResponse;
import modelo.User;
import org.apache.http.HttpStatus;
import servicios.CajasServicios;
import utilidades.Constantes;
import utilidades.Mensajes;

/**
 *
 * @author daw
 */
@WebServlet(name = "CajasApi", urlPatterns = {"/rest/cajasAPI"})
public class CajasAPIServlet extends HttpServlet {

    private CajasServicios servicios;

    @Override
    protected void doPut(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {

        User user = (User) req.getAttribute(Constantes.USER);
        Caja caja = (Caja) req.getAttribute(Constantes.CAJA);
        if (user != null && caja != null) {
            if (!servicios.insertCaja(user, caja)) {
                resp.setStatus(HttpStatus.SC_INTERNAL_SERVER_ERROR);
                req.setAttribute(Constantes.JSON,
                        new GenericResponse(HttpStatus.SC_INTERNAL_SERVER_ERROR, Mensajes.messageQueryCajaInsertedFail));
            }
            else {
                resp.setStatus(HttpStatus.SC_CREATED);
                req.setAttribute(Constantes.JSON, caja);
            }

        }

    }

    @Override
    public void init() throws ServletException {
        servicios = new CajasServicios();
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
        
        User user = (User) request.getAttribute(Constantes.USER);
        request.setAttribute(Constantes.JSON, servicios.getAllCajasByUser(user));

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
