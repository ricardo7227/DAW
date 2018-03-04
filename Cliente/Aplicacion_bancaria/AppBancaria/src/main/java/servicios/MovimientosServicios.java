/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import dao.MovimientosDAO;
import java.sql.Date;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.List;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import model.Movimiento;
import model.MovimientosFechas;
import utils.Constantes;

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
    

}
