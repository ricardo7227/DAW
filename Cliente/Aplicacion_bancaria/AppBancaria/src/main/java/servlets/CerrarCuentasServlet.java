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
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import model.Cuenta;
import model.GenericResponse;
import org.apache.http.HttpStatus;
import servicios.CuentasServicios;
import utils.Constantes;
import utils.Mensajes;
import utils.Templates;

/**
 *
 * @author daw
 */
@WebServlet(name = "CerrarCuentasServlet", urlPatterns = {"/cerrarCuenta"})
public class CerrarCuentasServlet extends HttpServlet {

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

            Template plantilla = freeMarker.getTemplate(Templates.CERRAR_CUENTAS_TEMPLATE);
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

        Map<String, String[]> parametros = request.getParameterMap();

        Cuenta cuenta = new CuentasServicios().tratarParametros(parametros);

        ObjectMapper mapper = new ObjectMapper();

        if (new CuentasServicios().comprobarNumCuenta(String.valueOf(cuenta.getCu_ncu()))) {
            if (new CuentasServicios().deleteCompleteCuenta(cuenta) == null) {
                mapper.writeValue(response.getWriter(), new GenericResponse(HttpStatus.SC_ACCEPTED, String.format(Mensajes.MSJ_CUENTA_CERRADA, cuenta.getCu_ncu())));
            } else {

                mapper.writeValue(response.getWriter(), new GenericResponse(HttpStatus.SC_INTERNAL_SERVER_ERROR, String.format(Mensajes.MSJ_CUENTA_CERRADA_FAIL, cuenta.getCu_ncu())));
                //no borramos
            }
        } else {
            //numero de cuenta erroneo
            mapper.writeValue(response.getWriter(), new GenericResponse(HttpStatus.SC_BAD_REQUEST, String.format(Mensajes.MSJ_NUM_CUENTA_ERRONEA, cuenta.getCu_ncu())));
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
