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
 * @author Gato
 */
@WebServlet(urlPatterns = {"/nivel2"})
public class Session2 extends HttpServlet {

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

        HttpSession session = request.getSession();
        PrintWriter out = response.getWriter();
        String nivel1 = String.valueOf(SessionValues.nivel1);

        String num1 = String.valueOf(SessionValues.num1);
        String num2 = String.valueOf(SessionValues.num2);
        String num3 = String.valueOf(SessionValues.num3);

        if (session.getAttribute(nivel1) != null) {//comprobación session nivel1

            if (request.getParameterMap().isEmpty()) {

                out.print(Constante.empty);

            } else {

                String param1 = request.getParameter(num1);
                if (Constante.passNivel21.equals(param1)) {//primera entrada

                    session.setAttribute(num1, param1);
                    out.print(String.format(Constante.passNextLevel2, param1));

                } else if (session.getAttribute(num1) != null) {//segunda entrada

                    String param2 = request.getParameter(num2);
                    if (Constante.passNivel22.equals(param2)) {

                        session.setAttribute(num2, param2);
                        out.print(String.format(Constante.passNextLevel2, param2));

                    } else if (session.getAttribute(num2) != null) {//tercera entrada

                        String param3 = request.getParameter(num3);
                        if (Constante.passNivel23.equals(param3)) {

                            session.setAttribute(num3, param3);
                            out.print(Constante.passRecived);
                        } else {

                            request.setAttribute(Constante.levelError, Constante.session2);
                            session.invalidate();
                            request.getRequestDispatcher(Constante.errorPage).forward(request, response);

                        }

                    } else {

                        request.setAttribute(Constante.levelError, Constante.session2);
                        session.invalidate();
                        request.getRequestDispatcher(Constante.errorPage).forward(request, response);
                    }
                } else {

                    request.setAttribute(Constante.levelError, Constante.session2);
                    session.invalidate();
                    request.getRequestDispatcher(Constante.errorPage).forward(request, response);
                }
            }
        } else {

            out.print(Constante.sessionError);
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
