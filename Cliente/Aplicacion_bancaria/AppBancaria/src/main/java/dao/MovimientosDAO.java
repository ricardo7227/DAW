/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import java.util.List;
import model.Movimiento;
import model.MovimientosFechas;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import utils.SqlQuery;

/**
 *
 * @author daw
 */
public class MovimientosDAO {

    public List<Movimiento> getMovimientosJDBCTemplate(MovimientosFechas movimientosFechas) {

        String sql = SqlQuery.SELECT_MOVIMIENTOS_BY_CUENTA_AND_FECHAS;
        Object[] rangoMovimientos = new Object[]{movimientosFechas.getId_cuenta(),
            movimientosFechas.getFecha_inicio(), movimientosFechas.getFecha_fin()};

        List<Movimiento> customers = new JdbcTemplate(
                DBConnection.getInstance().getDataSource()).query(sql, rangoMovimientos,
                new BeanPropertyRowMapper(Movimiento.class));

        return customers;
    }

    public Movimiento insertMovimientoJDBCTemplate(Movimiento movimiento) {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        Object[] paramsMovimiento = new Object[]{movimiento.getMo_ncu(), movimiento.getMo_des(), movimiento.getMo_imp()};
        int rowAffected = jtm.update(SqlQuery.INSERT_MOVIMIENTOS, paramsMovimiento);
        if (rowAffected == 0) {
            movimiento = null;
        }

        return movimiento;
    }//fin

    public Movimiento deleteMovimientoJDBCTemplate(Movimiento movimiento) {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        Object[] paramsMovimiento = new Object[]{movimiento.getMo_ncu()};
        int rowAffected = jtm.update(SqlQuery.DELETE_MOVIMIENTOS_BY_NCUENTA, paramsMovimiento);
        if (rowAffected == 0) {
            movimiento = null;
        }

        return movimiento;
    }//fin

}
