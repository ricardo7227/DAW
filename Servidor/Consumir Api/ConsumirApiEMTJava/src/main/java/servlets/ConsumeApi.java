/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import RestApi.RestApi;
import com.google.api.client.json.GenericJson;
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
import static utilidades.Constantes.SERVER_NO_RESPONSE_TIME_OUT;
import utilidades.Tiempo;

/**
 *
 * @author daw
 */
@WebServlet(name = "ConsumeApi", urlPatterns = {"/api"})
public class ConsumeApi extends HttpServlet {

    private String messageToUser = null;

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
            GenericJson jsonParada = null;
            GenericJson jsonLineasEMT = null;
            GenericJson jsonParadasLinea = null;
            ArrayList lineasAutobus = null;
            ArrayList paradasLinea = null;
            ArrayList autobusesIncoming = null;

            String action = request.getParameter(Constantes.ACTION_TEMPLATE);
            action = action == null ? Constantes.DEFAULT : action;
            switch (action) {
                case Constantes.VIEW_LINE:
                    String lineaRequest = request.getParameter(Constantes.LINEA);
                    if (lineaRequest != null) {
                        jsonParadasLinea = RestApi.getInstance().getRoutetLine(Tiempo.getcurrentDate(), lineaRequest);
                        paradasLinea = (ArrayList) jsonParadasLinea.get(Constantes.RESULT_VALUES);
                    }

                    break;
                case Constantes.VIEW_STATION:
                    String paradaRequest = request.getParameter(Constantes.PARADA);
                    if (paradaRequest != null) {
                        paradaRequest = paradaRequest.replace(".", "");                        
                        jsonParada = RestApi.getInstance().getArriveStop(paradaRequest);
                        autobusesIncoming = (ArrayList) jsonParada.get(Constantes.ARRIVES);
                    }

                    break;
                default:
                    jsonLineasEMT = RestApi.getInstance().getListLines(Tiempo.getcurrentDate());
                    BigDecimal resultCode = (BigDecimal) jsonLineasEMT.get(Constantes.RESULT_CODE);
                    if (resultCode != null && resultCode.intValue() == OK.ordinal()) {
                        lineasAutobus = (ArrayList) jsonLineasEMT.get(Constantes.RESULT_VALUES);
                    }
                    break;
            }//fin switch            

            HashMap paramentrosPlantilla = new HashMap();
            if (messageToUser != null) {

            }

            paramentrosPlantilla.put(Constantes.LISTA_LINEAS, lineasAutobus);
            paramentrosPlantilla.put(Constantes.PARADAS_LINEA, paradasLinea);
            paramentrosPlantilla.put(Constantes.AUTOBUSES_INCOMING, autobusesIncoming);

            Template plantilla = Configuration.getInstance().getFreeMarker().getTemplate(Constantes.INDEX_TEMPLATE);
            plantilla.process(paramentrosPlantilla, response.getWriter());
        } catch (TemplateException ex) {
            Logger.getLogger(ConsumeApi.class.getName()).log(Level.SEVERE, null, ex);
        } catch (InterruptedException ex) {
            Logger.getLogger(ConsumeApi.class.getName()).log(Level.SEVERE, null, ex);
        } catch (ExecutionException ex) {
            Logger.getLogger(ConsumeApi.class.getName()).log(Level.SEVERE, null, ex);
            response.getWriter().print(SERVER_NO_RESPONSE_TIME_OUT);
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
