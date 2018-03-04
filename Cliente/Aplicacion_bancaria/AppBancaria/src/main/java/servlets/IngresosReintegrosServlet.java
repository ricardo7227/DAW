/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

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
import model.Movimiento;
import servicios.ClientesServicios;
import servicios.CuentasServicios;
import servicios.MovimientosServicios;
import utils.Constantes;
import utils.Templates;

/**
 *
 * @author Gato
 */
@WebServlet(name = "IngresosReintegrosServlet", urlPatterns = {"/operaciones"})
public class IngresosReintegrosServlet extends HttpServlet {

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

            Template plantilla = freeMarker.getTemplate(Templates.INGRESOS_REINTEGROS_TEMPLATE);
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
        processRequest(request, response);

        String action = request.getParameter(Constantes.ACTION_TEMPLATE);
        if (action != null && !action.isEmpty()) {
            switch (action) {
                case "newMovimiento":
                    //TODO comprobación en servidor
                    Movimiento movimiento = new Movimiento();
                    long nCuenta = 123456789;
                    Cuenta cuenta = new CuentasServicios().getCuenta(new Cuenta(nCuenta));
                    List<Cliente> clientes = new ArrayList<>();
                    ClientesServicios clientesServicios = new ClientesServicios();
                    Cliente titular1 = clientesServicios.getCliente(new Cliente(cuenta.getCu_dn1()));
                    clientes.add(titular1);
                    if (cuenta.getCu_dn2() != null) {
                        clientes.add(clientesServicios.getCliente(new Cliente(cuenta.getCu_dn2())));
                    }
                    //importe de la operación
                    cuenta.setCu_sal(movimiento.getMo_imp());
                    cuenta = new CuentasServicios().updateSaldo(cuenta);
                    if (new ClientesServicios().updateSaldoClientes(clientes) && cuenta != null) {//actualiza el saldo de los clientes
                        new MovimientosServicios().insertMovimiento(movimiento);
                    }

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
