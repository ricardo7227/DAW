/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.google.api.client.http.HttpStatusCodes;
import config.Configuration;
import freemarker.template.Template;
import freemarker.template.TemplateException;
import java.io.IOException;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
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
import model.GenericResponse;
import org.json.JSONArray;
import org.json.JSONObject;
import servicios.ClientesServicios;
import servicios.CuentasServicios;
import utils.Constantes;
import utils.Mensajes;
import utils.Templates;
import utils.UrlsPaths;

/**
 *
 * @author daw
 */
@WebServlet(name = "AperturaCuentasServlet", urlPatterns = {UrlsPaths.APERTURA_CUENTAS})
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
                    DateFormat df = new SimpleDateFormat("yyyy-MM-dd");
                    mapper.setDateFormat(df);
                    mapper.writeValue(response.getOutputStream(), clienteDB);

                    break;
                case Constantes.NEW_ACCOUNT:
                    Cuenta newCuenta = null;
                    GenericResponse respuesta = null;
                    String json_new_account = request.getParameter(Constantes.DATOS);

                    JSONObject json_obj_account = new JSONObject(json_new_account);

                    String nCuenta = (String) json_obj_account.get(Constantes.N_CUENTA);
                    if (cuentasServicios.comprobarNumCuenta(nCuenta)) {

                        if (cuentasServicios.getCuenta(new Cuenta(Long.valueOf(nCuenta))) == null) {
                            JSONArray titulares = json_obj_account.getJSONArray(Constantes.TITULARES);
                            String saldo = (String) json_obj_account.get(Constantes.CLIENTE_SALDO);
                            List<Cliente> clientes = clientesServicios.checkAndGetClientes(titulares, saldo);

                            if (clientes.size() > 0) {
                                newCuenta = cuentasServicios.buildCuentaFromList(nCuenta, clientes);
                                newCuenta = cuentasServicios.createNewAccount(newCuenta, clientes);

                            } else {
                                respuesta = new GenericResponse(HttpStatusCodes.STATUS_CODE_BAD_REQUEST, Mensajes.MSJ_APERTURA_CUENTA_CAMPOS_FAIL);
                                response.setStatus(HttpStatusCodes.STATUS_CODE_BAD_REQUEST);
                            }

                        } else {
                            respuesta = new GenericResponse(HttpStatusCodes.STATUS_CODE_BAD_REQUEST, Mensajes.MSJ_APERTURA_CUENTA_N_ERRONEO);
                            response.setStatus(HttpStatusCodes.STATUS_CODE_BAD_REQUEST);
                        }
                    }

                    if (newCuenta == null && respuesta == null) {
                        respuesta = new GenericResponse(HttpStatusCodes.STATUS_CODE_SERVER_ERROR, Mensajes.MSJ_APERTURA_CUENTA_SERVIDOR_FAIL);
                        response.setStatus(HttpStatusCodes.STATUS_CODE_SERVER_ERROR);

                    } else if (newCuenta != null && respuesta == null) {
                        respuesta = new GenericResponse(HttpStatusCodes.STATUS_CODE_OK, Mensajes.MSJ_APERTURA_CUENTA_OK);
                    }
                    mapper.writeValue(response.getOutputStream(), respuesta);

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
