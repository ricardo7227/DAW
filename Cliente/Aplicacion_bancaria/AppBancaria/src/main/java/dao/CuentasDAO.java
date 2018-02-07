/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import java.sql.ResultSet;
import java.sql.SQLException;
import model.Cuenta;
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
public class CuentasDAO {

    public Cuenta getNumCuentaJDBCTemplate(Cuenta cuenta) {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        Cuenta cuentaDB = null;
        Object[] numCuenta = new Object[]{cuenta.getCu_ncu()};

        String resultadoQuery = jtm.query(SqlQuery.SELECT_CUENTA_BY_ID, numCuenta, new ResultSetExtractor<String>() {
            @Override
            public String extractData(ResultSet rs) throws SQLException, DataAccessException {
                return rs.next() ? rs.getString(Constantes.CU_NUM_CUENTA) : null;
            }
        });

        if (resultadoQuery != null) {
            cuentaDB = (Cuenta) jtm.queryForObject(SqlQuery.SELECT_CUENTA_BY_ID, numCuenta,//funciona siempre que exista un dato en la base de datos
                    new BeanPropertyRowMapper(Cuenta.class));
        }

        return cuentaDB;
    }

}
