/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import java.sql.ResultSet;
import java.sql.SQLException;
import model.Cliente;
import org.springframework.dao.DataAccessException;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.core.ResultSetExtractor;
import utils.Constantes;
import utils.SqlQuery;

/**
 *
 * @author Gato
 */
public class ClientesDAO {

    public Cliente getNumClienteJDBCTemplate(Cliente cliente) {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        Cliente clienteDB = null;
        Object[] dniCliente = new Object[]{cliente.getCl_dni()};

        String resultadoQuery = jtm.query(SqlQuery.SELECT_CLIENTE_BY_ID, dniCliente, new ResultSetExtractor<String>() {
            @Override
            public String extractData(ResultSet rs) throws SQLException, DataAccessException {
                return rs.next() ? rs.getString(Constantes.CLIENTE_DNI) : null;
            }
        });

        if (resultadoQuery != null) {
            clienteDB = (Cliente) jtm.queryForObject(SqlQuery.SELECT_CLIENTE_BY_ID, dniCliente,//funciona siempre que exista un dato en la base de datos
                    new BeanPropertyRowMapper(Cliente.class));
        }

        return clienteDB;
    }
}//fin clase
