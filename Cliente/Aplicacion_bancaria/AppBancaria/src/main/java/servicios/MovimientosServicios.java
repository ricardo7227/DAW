/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import com.fasterxml.jackson.databind.ObjectMapper;
import dao.MovimientosDAO;
import java.io.IOException;
import java.sql.Date;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.http.HttpServletResponse;
import model.Cliente;
import model.Cuenta;
import model.GenericResponse;
import model.Movimiento;
import model.MovimientosFechas;
import org.apache.http.HttpStatus;
import utils.Constantes;
import utils.Mensajes;

/**
 *
 * @author daw
 */
public class MovimientosServicios {

    public MovimientosServicios() {
    }

    public List<Movimiento> getAllMovimientosByRango(MovimientosFechas mf) {
        MovimientosDAO dao = new MovimientosDAO();
        return dao.getMovimientosJDBCTemplate(mf);
    }

    public Movimiento insertMovimiento(Movimiento movimiento) {
        MovimientosDAO dao = new MovimientosDAO();
        return dao.insertMovimientoJDBCTemplate(movimiento);
    }

    public MovimientosFechas tratarParametros(Map<String, String[]> parametros) {
        MovimientosFechas movimientos = null;
        if (parametros != null && !parametros.isEmpty()) {
            movimientos = new MovimientosFechas();
            if (parametros.get(Constantes.FECHA_INI) != null && !parametros.get(Constantes.FECHA_INI)[0].isEmpty()) {

                SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                java.util.Date parseDate = null;
                try {
                    parseDate = dateFormat.parse(parametros.get(Constantes.FECHA_INI)[0]);
                    movimientos.setFecha_inicio(new Date(parseDate.getTime()));
                } catch (ParseException ex) {
                    Logger.getLogger(MovimientosServicios.class.getName()).log(Level.SEVERE, null, ex);
                }
            }
            if (parametros.get(Constantes.FECHA_FIN) != null && !parametros.get(Constantes.FECHA_FIN)[0].isEmpty()) {

                SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                java.util.Date parseDate = null;
                try {
                    parseDate = dateFormat.parse(parametros.get(Constantes.FECHA_FIN)[0]);
                    movimientos.setFecha_fin(new Date(parseDate.getTime()));
                } catch (ParseException ex) {
                    Logger.getLogger(MovimientosServicios.class.getName()).log(Level.SEVERE, null, ex);
                }
            }
            if (parametros.get(Constantes.N_CUENTA) != null && !parametros.get(Constantes.N_CUENTA)[0].isEmpty()) {

                movimientos.setId_cuenta(Long.valueOf(parametros.get(Constantes.N_CUENTA)[0]));

            }

        }
        return movimientos;

    }

    public Movimiento tratarParametrosMovimiento(Map<String, String[]> parametros) {
        Movimiento movimiento = null;
        if (parametros != null && !parametros.isEmpty()) {
            movimiento = new Movimiento();

            if (parametros.get(Constantes.MOV_NUM_CUENTA) != null && !parametros.get(Constantes.MOV_NUM_CUENTA)[0].isEmpty()) {
                movimiento.setMo_ncu(Long.valueOf(parametros.get(Constantes.MOV_NUM_CUENTA)[0]));
            }

            if (parametros.get(Constantes.MOV_DESCRIP) != null && !parametros.get(Constantes.MOV_DESCRIP)[0].isEmpty()) {
                movimiento.setMo_des(parametros.get(Constantes.MOV_DESCRIP)[0]);
            }

            if (parametros.get(Constantes.MOV_IMPORTE) != null && !parametros.get(Constantes.MOV_IMPORTE)[0].isEmpty()) {
                movimiento.setMo_imp(Long.valueOf(parametros.get(Constantes.MOV_IMPORTE)[0]));

            }
        }
        return movimiento;

    }

    public void registrarNuevoMovimiento(Movimiento movimiento, HttpServletResponse response) throws IOException {

        CuentasServicios cuentasServicios = new CuentasServicios();

        ValidadorServicios validar = new ValidadorServicios();

        ObjectMapper mapper = new ObjectMapper();

        if (validar.validateModel(movimiento)) {
            if (cuentasServicios.comprobarNumCuenta(String.valueOf(movimiento.getMo_ncu()))) {
                long nCuenta = movimiento.getMo_ncu();
                Cuenta cuenta = cuentasServicios.getCuenta(new Cuenta(nCuenta));

                List<Cliente> clientes = new ArrayList<>();
                ClientesServicios clientesServicios = new ClientesServicios();
                Cliente titular1 = clientesServicios.getCliente(new Cliente(cuenta.getCu_dn1()));
                clientes.add(titular1);
                if (cuenta.getCu_dn2() != null) {
                    clientes.add(clientesServicios.getCliente(new Cliente(cuenta.getCu_dn2())));
                }
                //importe de la operación
                cuenta.setCu_sal(movimiento.getMo_imp());
                cuenta = cuentasServicios.updateSaldo(cuenta);

                if (new ClientesServicios().updateSaldoClientes(clientes) && cuenta != null) {//actualiza el saldo de los clientes

                    insertMovimiento(movimiento);

                    mapper.writeValue(response.getWriter(), new GenericResponse(HttpStatus.SC_ACCEPTED, Mensajes.MSJ_MOVIMIENTO_CREADO));

                } else {
                    //cuenta invalida
                    response.setStatus(HttpStatus.SC_BAD_REQUEST);
                    mapper.writeValue(response.getWriter(), new GenericResponse(HttpStatus.SC_BAD_REQUEST, String.format(Mensajes.MSJ_CUENTA_INVALIDA, movimiento.getMo_ncu())));

                }
            } else {
                //cuenta invalida
                response.setStatus(HttpStatus.SC_BAD_REQUEST);
                mapper.writeValue(response.getWriter(), new GenericResponse(HttpStatus.SC_BAD_REQUEST, String.format(Mensajes.MSJ_CUENTA_INVALIDA, movimiento.getMo_ncu())));
            }

        } else {
            //campos incompletos
            response.setStatus(HttpStatus.SC_BAD_REQUEST);
            mapper.writeValue(response.getWriter(), new GenericResponse(HttpStatus.SC_BAD_REQUEST, Mensajes.MSJ_MOVIMIENTO_CAMPOS_INCOMPLETOS));

        }
    }

}
