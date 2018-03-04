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

    /**
     * Busca cliente por DNI
     *
     * @param cliente
     * @return cliente o null si no existe
     */
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

    /**
     * Actualiza el saldo y n de cuentas de un cliente y recupera los nuevos
     * valores
     *
     * @param cliente
     * @return cliente o null
     */
    public Cliente updateSaldoAndNCuentasPlusJDBCTemplate(Cliente cliente) {
        Cliente clienteDB = null;
        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        Object[] cli = new Object[]{cliente.getCl_sal(), cliente.getCl_dni()};
        int rowsAffected = jtm.update(SqlQuery.UPDATE_CLIENTE_BY_ID_SALDO_N_CUENTAS, cli);

        if (rowsAffected > 0) {
            clienteDB = getNumClienteJDBCTemplate(cliente);
        }
        return clienteDB;
    }

    public Cliente updateSaldoAndNCuentasMinusJDBCTemplate(Cliente cliente) {
        Cliente clienteDB = null;
        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        Object[] cli = new Object[]{cliente.getCl_sal(), cliente.getCl_dni()};
        int rowsAffected = jtm.update(SqlQuery.UPDATE_CLIENTE_BY_ID_SALDO_N_CUENTAS_MINUS, cli);

        if (rowsAffected > 0) {
            clienteDB = getNumClienteJDBCTemplate(cliente);
        }
        return clienteDB;
    }

    public Cliente updateSaldoByDNIJDBCTemplate(Cliente cliente) {
        Cliente clienteDB = null;
        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        Object[] cli = new Object[]{cliente.getCl_sal(), cliente.getCl_dni()};
        int rowsAffected = jtm.update(SqlQuery.UPDATE_CLIENTE_SALDO_BY_DNI, cli);

        if (rowsAffected > 0) {
            clienteDB = getNumClienteJDBCTemplate(cliente);
        }
        return clienteDB;
    }

    public int deleteClienteJDBCTemplate(Cliente cliente) {

        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        Object[] cli = new Object[]{cliente.getCl_dni()};
        int rowsAffected = jtm.update(SqlQuery.DELETE_CLIENTE_BY_ID, cli);

        return rowsAffected;
    }

    public Cliente insertClienteJDBCTemplate(Cliente cliente) {
        Cliente clienteDB = null;
        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        Object[] cli = new Object[]{cliente.getCl_dni(), cliente.getCl_nom(), cliente.getCl_dir(), cliente.getCl_tel(), cliente.getCl_ema(), cliente.getCl_fna(), cliente.getCl_sal()};
        int rowsAffected = jtm.update(SqlQuery.INSERT_CLIENTE, cli);

        if (rowsAffected > 0) {
            clienteDB = getNumClienteJDBCTemplate(cliente);
        }
        return clienteDB;
    }

}//fin clase
