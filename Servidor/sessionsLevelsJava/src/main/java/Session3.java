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
@WebServlet(urlPatterns = {"/nivel3"})
public class Session3 extends HttpServlet {

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
        
        String nivel1 = String.valueOf(SessionValues.nivel1);
        String nivel2 = String.valueOf(SessionValues.num3);
        String nivel3 = String.valueOf(SessionValues.nivel3);
        
        //Sessiones anteriores
        if (session.getAttribute(nivel1) == null
                || session.getAttribute(nivel2) == null) {
            
            out.print(Constante.sessionError);
        } else {
            
            if (!request.getParameterMap().isEmpty()) {//parametros vacios
                String parametro = request.getParameter(nivel3);
                
                if (parametro != null && parametro.equals(Constante.passNivel3)) {
                    
                    session.setAttribute(nivel3, parametro);
                    request.getRequestDispatcher(Constante.congrats).forward(request, response);
                } else {
                    
                    out.print(Constante.passWrong);
                    session.invalidate();
                }
            } else {
                
                out.print(Constante.empty);
            }
            
        }
        
    }//fin processRequest

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
