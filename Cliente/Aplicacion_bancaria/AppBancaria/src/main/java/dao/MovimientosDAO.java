/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.List;
import model.Movimiento;
import model.MovimientosFechas;
import org.springframework.dao.DataAccessException;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.core.ResultSetExtractor;
import utils.Constantes;
import utils.SqlQuery;

/**
 *
 * @author daw
 */
public class MovimientosDAO {

//    public Movimiento getMovimientosJDBCTemplate(MovimientosFechas movimientosFechas) {
//
//        JdbcTemplate jtm = new JdbcTemplate(
//                DBConnection.getInstance().getDataSource());
//        Movimiento movimientos = null;
//        Object[] rangoMovimientos = new Object[]{movimientosFechas.getId_cuenta(),
//            movimientosFechas.getFecha_inicio(), movimientosFechas.getFecha_fin()};
//
//        String resultadoQuery = jtm.query(SqlQuery.SELECT_MOVIMIENTOS_BY_CUENTA_AND_FECHAS, rangoMovimientos, new ResultSetExtractor<String>() {
//            @Override
//            public String extractData(ResultSet rs) throws SQLException, DataAccessException {
//                return rs.next() ? rs.getString(Constantes.MOV_NUM_CUENTA) : null;
//            }
//        });
//
//        if (resultadoQuery != null) {
//            movimientos = (Movimiento) jtm.queryForObject(SqlQuery.SELECT_MOVIMIENTOS_BY_CUENTA_AND_FECHAS, rangoMovimientos,//funciona siempre que exista un dato en la base de datos
//                    new BeanPropertyRowMapper(Movimiento.class));
//        }
//
//        return movimientos;
//    }
    
    public List<Movimiento> getMovimientosJDBCTemplate(MovimientosFechas movimientosFechas) {

        String sql = SqlQuery.SELECT_MOVIMIENTOS_BY_CUENTA_AND_FECHAS;
        Object[] rangoMovimientos = new Object[]{movimientosFechas.getId_cuenta(),
            movimientosFechas.getFecha_inicio(), movimientosFechas.getFecha_fin()};
        
        List<Movimiento> customers = new JdbcTemplate(
                DBConnection.getInstance().getDataSource()).query(sql, rangoMovimientos,
                new BeanPropertyRowMapper(Movimiento.class));

        return customers;
    }

}
