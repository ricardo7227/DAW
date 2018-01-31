/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import dao.MovimientosDAO;
import java.util.List;
import model.Movimiento;
import model.MovimientosFechas;

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
}
