/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import com.fasterxml.jackson.databind.ObjectMapper;
import config.Configuration;
import freemarker.template.Template;
import freemarker.template.TemplateException;
import java.io.IOException;
import java.util.HashMap;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import model.Cuenta;
import model.Movimiento;
import model.MovimientosFechas;
import servicios.CuentasServicios;
import servicios.MovimientosServicios;
import utils.Constantes;
import utils.Templates;
import utils.UrlsPaths;

/**
 *
 * @author daw
 */
@WebServlet(name = "MovimientosServlet", urlPatterns = {UrlsPaths.MOVIMIENTOS})
public class MovimientosServlet extends HttpServlet {

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
        
        try {
            freemarker.template.Configuration freeMarker = Configuration.getInstance().getFreeMarker();
            String messageToUser = null;

            HashMap paramentrosPlantilla = new HashMap();
            if (messageToUser != null) {
                paramentrosPlantilla.put(Constantes.MESSAGE_TO_USER, messageToUser);
            }

            Template plantilla = freeMarker.getTemplate(Templates.MOVIMIENTOS);
            plantilla.process(paramentrosPlantilla, response.getWriter());

        } catch (TemplateException ex) {
            Logger.getLogger(MovimientosServlet.class.getName()).log(Level.SEVERE, null, ex);
        }
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
        //processRequest(request, response);
        String action = request.getParameter(Constantes.ACTION_TEMPLATE);
        MovimientosServicios servicios = new MovimientosServicios();
        MovimientosFechas mf = servicios.tratarParametros(request.getParameterMap());

        if (action != null && !action.isEmpty()) {

            CuentasServicios cuentasServicios = new CuentasServicios();
            ObjectMapper mapper = new ObjectMapper();

            switch (action) {
                case Constantes.CHECK_NUM_CUENTA:

                    Cuenta cuentaDB = null;
                    if (cuentasServicios.comprobarNumCuenta(String.valueOf(mf.getId_cuenta()))) {
                        cuentaDB = cuentasServicios.getCuenta(new Cuenta(mf.getId_cuenta()));
                    }

                    mapper.writeValue(response.getOutputStream(), cuentaDB);

                    break;
                case Constantes.SEARCH_MOVIMIENTOS:
                    if (cuentasServicios.comprobarNumCuenta(String.valueOf(mf.getId_cuenta()))) {

                        List<Movimiento> listaMovimientos = servicios.getAllMovimientosByRango(mf);

                        mapper.writeValue(response.getOutputStream(), listaMovimientos);
                    }

                    break;

            }
        }

//        response.getWriter().write(mf.toString());
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
