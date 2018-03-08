/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import com.fasterxml.jackson.databind.ObjectMapper;
import java.io.IOException;
import java.util.List;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import model.GenericResponse;
import model.Movimiento;
import model.MovimientosFechas;
import org.apache.http.HttpStatus;
import servicios.CuentasServicios;
import servicios.MovimientosServicios;
import utils.Constantes;
import utils.Mensajes;

/**
 *
 * @author Gato
 */
@WebServlet(name = "RESTRecibos", urlPatterns = {"/rest/operacion"})
public class RESTRecibos extends HttpServlet {

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
        CuentasServicios cuentasServicios = new CuentasServicios();
        MovimientosServicios servicios = new MovimientosServicios();
        MovimientosFechas mf = (MovimientosFechas) request.getAttribute(Constantes.RANGO);
ObjectMapper mapper = new ObjectMapper();
        if (cuentasServicios.comprobarNumCuenta(String.valueOf(mf.getId_cuenta()))) {

            List<Movimiento> listaMovimientos = servicios.getAllMovimientosByRango(mf);

            
            mapper.writeValue(response.getOutputStream(), listaMovimientos);

        }else{
        response.setStatus(HttpStatus.SC_BAD_REQUEST);
            mapper.writeValue(response.getOutputStream(), new GenericResponse(HttpStatus.SC_BAD_REQUEST, String.format(Mensajes.MSJ_CUENTA_INVALIDA, mf.getId_cuenta())));
        }
    }

    @Override
    protected void doPut(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

        Movimiento movimiento = (Movimiento) request.getAttribute(Constantes.MOVIMIENTO);

        new MovimientosServicios().registrarNuevoMovimiento(movimiento, response);

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
