/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import utils.SessionValues;
import utils.Valor;

/**
 *
 * @author daw
 */
@WebServlet(urlPatterns = {"/session"})
public class Session extends HttpServlet {

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
        response.setContentType("text/html;charset=UTF-8");

        String param = request.getParameter(String.valueOf(SessionValues.nivel1));

        if (request.getParameter(String.valueOf(SessionValues.nivel1))
                != null) {
            if (request.getParameter(String.valueOf(SessionValues.nivel1))
                    .equalsIgnoreCase(Valor.passNivel1)) {

                request.getSession().setAttribute(String.valueOf(SessionValues.nivel1), param);

            }else{
                request.getSession().setAttribute(String.valueOf(SessionValues.nivel1), Valor.passWrong);
            }
            response.getWriter().print(Valor.passRecived);
            //request.getRequestDispatcher(Valor.session2).forward(request, response);

        } else {
            if (request.getParameterMap().isEmpty()) {
                response.getWriter().print(Valor.empty);
            } else {

                request.getSession().setAttribute(String.valueOf(SessionValues.nivel1), Valor.passWrong);

                response.getWriter().print(Valor.passRecived);
            }

        }

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
