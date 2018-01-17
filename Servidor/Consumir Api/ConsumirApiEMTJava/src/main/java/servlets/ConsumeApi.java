/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import RestApi.RestApi;
import com.google.api.client.json.GenericJson;
import com.google.api.client.util.ArrayMap;
import config.Configuration;
import freemarker.template.Template;
import freemarker.template.TemplateException;
import java.io.IOException;
import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.concurrent.ExecutionException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import static utilidades.CodesApi.OK;
import utilidades.Constantes;
import utilidades.Tiempo;

/**
 *
 * @author daw
 */
@WebServlet(name = "ConsumeApi", urlPatterns = {"/api"})
public class ConsumeApi extends HttpServlet {

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
            throws ServletException, IOException, InterruptedException, ExecutionException {

        try {
            GenericJson json = RestApi.getInstance().getArriveStop("3727");
            GenericJson json1 = RestApi.getInstance().getListLines(Tiempo.getcurrentDate());
            GenericJson json2 = null;
            String lineaRequest = request.getParameter(Constantes.LINEA);
            if (lineaRequest != null) {
                json2 = RestApi.getInstance().getRoutetLine(Tiempo.getcurrentDate(), lineaRequest);
            }
            BigDecimal resultCode = (BigDecimal) json1.get(Constantes.RESULT_CODE);
            ArrayList lineasAutobus = null;
            if (resultCode != null && resultCode.intValue() == OK.ordinal()) {
                lineasAutobus = (ArrayList) json1.get(Constantes.RESULT_VALUES);
                ArrayMap<String, String> linea = (ArrayMap<String, String>) lineasAutobus.get(0);
            }

            HashMap paramentrosPlantilla = new HashMap();

            paramentrosPlantilla.put(Constantes.LISTA_LINEAS, lineasAutobus);
            Template plantilla = Configuration.getInstance().getFreeMarker().getTemplate(Constantes.INDEX_TEMPLATE);
            plantilla.process(paramentrosPlantilla, response.getWriter());
        } catch (TemplateException ex) {
            Logger.getLogger(ConsumeApi.class.getName()).log(Level.SEVERE, null, ex);
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
        try {
            processRequest(request, response);
        } catch (InterruptedException ex) {
            Logger.getLogger(ConsumeApi.class.getName()).log(Level.SEVERE, null, ex);
        } catch (ExecutionException ex) {
            Logger.getLogger(ConsumeApi.class.getName()).log(Level.SEVERE, null, ex);
        }
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
        try {
            processRequest(request, response);
        } catch (InterruptedException ex) {
            Logger.getLogger(ConsumeApi.class.getName()).log(Level.SEVERE, null, ex);
        } catch (ExecutionException ex) {
            Logger.getLogger(ConsumeApi.class.getName()).log(Level.SEVERE, null, ex);
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
