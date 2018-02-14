/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import config.Configuration;
import freemarker.template.Template;
import freemarker.template.TemplateException;
import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import model.Cliente;
import model.Cuenta;
import org.json.JSONArray;
import org.json.JSONObject;
import servicios.ClientesServicios;
import servicios.CuentasServicios;
import servicios.ValidadorServicios;
import utils.Constantes;
import utils.Templates;


/**
 *
 * @author daw
 */
@WebServlet(name = "AperturaCuentasServlet", urlPatterns = {"/aperturaCuentas"})
public class AperturaCuentasServlet extends HttpServlet {

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

            Template plantilla = freeMarker.getTemplate(Templates.APERTURA_CUENTAS);
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

        String action = request.getParameter(Constantes.ACTION_TEMPLATE);

        if (action != null && !action.isEmpty()) {

            CuentasServicios cuentasServicios = new CuentasServicios();
            ClientesServicios clientesServicios = new ClientesServicios();

            Cuenta cuenta = cuentasServicios.tratarParametros(request.getParameterMap());
            Cliente cliente = clientesServicios.tratarParametros(request.getParameterMap());

            ObjectMapper mapper = new ObjectMapper();

            switch (action) {
                case Constantes.CHECK_NUM_CUENTA:
                    Cuenta cuentaDB = null;
                    if (cuentasServicios.comprobarNumCuenta(String.valueOf(cuenta.getCu_ncu()))) {
                        cuentaDB = cuentasServicios.getCuenta(cuenta);
                    }

                    mapper.writeValue(response.getOutputStream(), cuentaDB);

                    break;
                case Constantes.CHECK_DNI_TITULAR:
                    Cliente clienteDB = null;
                    if (clientesServicios.checkDni(cliente.getCl_dni())) {
                        clienteDB = clientesServicios.getCliente(cliente);

                    }
                    mapper.writeValue(response.getOutputStream(), clienteDB);

                    break;
                case Constantes.NEW_ACCOUNT:
                    String json_new_account = request.getParameter(Constantes.DATOS);
                    Gson gson = new GsonBuilder()
                            .setDateFormat("yyyy-MM-dd").create();
                    JSONObject json_obj_account = new JSONObject(json_new_account);

                    String nCuenta = (String) json_obj_account.get(Constantes.N_CUENTA);
                    if (cuentasServicios.comprobarNumCuenta(nCuenta)) {
                        if (cuentasServicios.getCuenta(cuenta) == null) {
                            JSONArray titulares = json_obj_account.getJSONArray(Constantes.TITULARES);
                            List<Cliente> clientes = new ArrayList<Cliente>();
                            String dniTemp = null;
                            boolean isDuplicate = false;
                            for (Object titular : titulares) {
                                if (titular instanceof JSONObject) {
                                    
                                        JSONObject jsTitular = (JSONObject) titular;
                                        Cliente cl = gson.fromJson(jsTitular.toString(), Cliente.class);//TODO - pendiente controlar JSON recibido
                                         boolean ok = new ValidadorServicios().validateModel(cl);
                                        if (dniTemp != null && dniTemp.equals(cl.getCl_dni())) {
                                            isDuplicate = true;
                                        } else {
                                            dniTemp = cl.getCl_dni();
                                        }
                                        if (!isDuplicate) {
                                            clientes.add(cl);
                                        }
                                    

                                }
                            }
                        }
                    }

                    String saldo = (String) json_obj_account.get(Constantes.CLIENTE_SALDO);

                    break;

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

}
