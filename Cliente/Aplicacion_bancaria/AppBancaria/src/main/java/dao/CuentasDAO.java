/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
import model.Cliente;
import model.Cuenta;
import model.Movimiento;
import org.springframework.dao.DataAccessException;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.core.ResultSetExtractor;
import org.springframework.jdbc.datasource.DataSourceTransactionManager;
import org.springframework.transaction.TransactionStatus;
import org.springframework.transaction.support.TransactionCallback;
import org.springframework.transaction.support.TransactionTemplate;
import utils.Constantes;
import utils.Mensajes;
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

    /**
     *
     * @param cuenta
     * @return cuenta o null, cuenta de la base de datos
     */
    public Cuenta insertCuentaJDBCTemplate(final Cuenta cuenta) {
        Cuenta cuentaDB = null;
        final Movimiento movimiento = new Movimiento(cuenta.getCu_ncu(), Mensajes.MSJ_APERTURA_CUENTA, (long) cuenta.getCu_sal());
        TransactionTemplate template = new TransactionTemplate(new DataSourceTransactionManager(DBConnection.getInstance().getDataSource()));

        final JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());

        int resultTrans = template.execute(new TransactionCallback<Integer>() {
            @Override
            public Integer doInTransaction(TransactionStatus ts) {
                int rowsAffectedCuenta = 0;
                try {

                    Object[] params = new Object[]{cuenta.getCu_ncu(), cuenta.getCu_dn1(), cuenta.getCu_dn2(), cuenta.getCu_sal()};
                    Object[] paramsMovimiento = new Object[]{movimiento.getMo_ncu(), movimiento.getMo_des(), movimiento.getMo_imp()};

                    rowsAffectedCuenta = jtm.update(SqlQuery.INSERT_CUENTA, params);
                    jtm.update(SqlQuery.INSERT_MOVIMIENTOS, paramsMovimiento);

                } catch (DataAccessException e) {
                    ts.setRollbackOnly();
                }
                return rowsAffectedCuenta;

            }
        });
        if (resultTrans > 0) {
            cuentaDB = getNumCuentaJDBCTemplate(cuenta);
        }
        return cuentaDB;
    }//fin

    public Cuenta updateSaldoJDBCTemplate(Cuenta cuenta) {
        Cuenta clienteDB = null;
        JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());
        Object[] cue = new Object[]{cuenta.getCu_sal(), cuenta.getCu_ncu()};
        int rowsAffected = jtm.update(SqlQuery.UPDATE_CUENTA_SALDO, cue);

        if (rowsAffected > 0) {
            clienteDB = getNumCuentaJDBCTemplate(cuenta);
        }
        return clienteDB;
    }

    public Cuenta deleteCuentaJDBCTemplate(final Cuenta cuenta) {
        Cuenta cuentaDB = null;
        
        TransactionTemplate template = new TransactionTemplate(new DataSourceTransactionManager(DBConnection.getInstance().getDataSource()));

        final JdbcTemplate jtm = new JdbcTemplate(
                DBConnection.getInstance().getDataSource());

        int resultTrans = template.execute(new TransactionCallback<Integer>() {
            @Override
            public Integer doInTransaction(TransactionStatus ts) {
                int rowsAffectedCuenta = 0;
                try {

                    List<Cliente> clientes = new ArrayList<>();

                    Object[] dniCliente1 = new Object[]{cuenta.getCu_dn1()};
                    Cliente cliente1 = (Cliente) jtm.queryForObject(SqlQuery.SELECT_CLIENTE_BY_ID, dniCliente1,//funciona siempre que exista un dato en la base de datos
                            new BeanPropertyRowMapper(Cliente.class));
                    clientes.add(cliente1);

                    if (cuenta.getCu_dn2() != null) {
                        Object[] dniCliente2 = new Object[]{cuenta.getCu_dn2()};
                        Cliente cliente2 = (Cliente) jtm.queryForObject(SqlQuery.SELECT_CLIENTE_BY_ID, dniCliente2,//funciona siempre que exista un dato en la base de datos
                                new BeanPropertyRowMapper(Cliente.class));
                        clientes.add(cliente2);
                    }

                    for (Cliente cliente : clientes) {
                        cliente.setCl_sal(cuenta.getCu_sal());
                        if (cliente.getCl_ncu() == 1) {
                            //eliminar cliente
                            Object[] cli = new Object[]{cliente.getCl_dni()};
                            int rowsAffected = jtm.update(SqlQuery.DELETE_CLIENTE_BY_ID, cli);

                        } else {
                            //restar nºcuentas
                            Object[] cli = new Object[]{cliente.getCl_sal(), cliente.getCl_dni()};
                            int rowsAffected = jtm.update(SqlQuery.UPDATE_CLIENTE_BY_ID_SALDO_N_CUENTAS_MINUS, cli);

                        }
                    }//fin for
                    
                    Object[] paramsMovimiento = new Object[]{cuenta.getCu_ncu()};
                    int rowAffected = jtm.update(SqlQuery.DELETE_MOVIMIENTOS_BY_NCUENTA, paramsMovimiento);

                    rowsAffectedCuenta = jtm.update(SqlQuery.DELETE_CUENTA, paramsMovimiento);

                } catch (DataAccessException e) {
                    ts.setRollbackOnly();
                }
                return rowsAffectedCuenta;

            }
        });
        if (resultTrans == 0) {
            cuentaDB = getNumCuentaJDBCTemplate(cuenta);
        }
        return cuentaDB;
    }

}//fin clase
