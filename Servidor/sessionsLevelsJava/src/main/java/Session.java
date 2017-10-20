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
import javax.servlet.http.HttpSession;
import utils.SessionValues;
import utils.Constante;

/**
 *
 * @author daw
 */
@WebServlet(urlPatterns = {"/nivel1"})
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
        PrintWriter out = response.getWriter();
        HttpSession session = request.getSession();
        request.setAttribute(Constante.currentlevel, Constante.session1);//defino el nivel para el jsp

        if (!request.getParameterMap().isEmpty()) {//parametros vacios

            String nivel1 = String.valueOf(SessionValues.nivel1);
            String param1 = request.getParameter(nivel1);

            if (Constante.passNivel1.equals(param1)) {

                session.setAttribute(nivel1, param1);

                request.setAttribute(Constante.resultMessage, Constante.okresultMessage);
                request.setAttribute(Constante.levelTarget, Constante.session2);
                request.setAttribute(Constante.color, Constante.green);

            } else {

                request.setAttribute(Constante.resultLevel, Constante.crashLevel);
                request.setAttribute(Constante.resultMessage, Constante.crashresultMessage);
                request.setAttribute(Constante.levelTarget, Constante.session1);
                request.setAttribute(Constante.color, Constante.red);

            }

            request.getRequestDispatcher(Constante.nextLevelPage).forward(request, response);

        } else {

            out.print(Constante.empty);
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
