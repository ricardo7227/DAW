/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import dao.CuentasDAO;
import java.util.List;
import java.util.Map;
import model.Cliente;
import model.Cuenta;
import utils.Constantes;

/**
 *
 * @author daw
 */
public class CuentasServicios {

    public CuentasServicios() {
    }

    public boolean cuentaExist(Cuenta cuenta) {
        CuentasDAO dao = new CuentasDAO();
        return dao.getNumCuentaJDBCTemplate(cuenta) != null;
    }

    public Cuenta getCuenta(Cuenta cuenta) {
        CuentasDAO dao = new CuentasDAO();
        return dao.getNumCuentaJDBCTemplate(cuenta);
    }

    public Cuenta insertCuenta(Cuenta cuenta) {
        CuentasDAO dao = new CuentasDAO();
        return dao.insertCuentaJDBCTemplate(cuenta);
    }

    public Cuenta updateSaldo(Cuenta cuenta) {
        CuentasDAO dao = new CuentasDAO();
        return dao.updateSaldoJDBCTemplate(cuenta);
    }

    public boolean comprobarNumCuenta(String numCuenta) {
        boolean cuentaValida = false;
        if (numCuenta != null && !numCuenta.isEmpty() && numCuenta.length() == 10) {
            String corte1 = numCuenta.substring(0, numCuenta.length() - 1);
            char corte2 = numCuenta.charAt(numCuenta.length() - 1);

            if (corte1.matches("[0-9]{9}") && Character.isDigit(corte2)) {
                int param1 = 0;

                char[] arrayCorte1 = corte1.toCharArray();
                for (char val : arrayCorte1) {
                    param1 += Character.getNumericValue(val);
                }

                int param2 = Character.getNumericValue(corte2);
                if (param1 % 9 == param2) {
                    cuentaValida = true;
                }

            }
        } else if (numCuenta != null && numCuenta.length() < 10) {
            int size_numCuenta = numCuenta.length();
            char cero = '0';
            String numCuentaFilled;
            String ceros = "0";
            while (size_numCuenta < 9) {
                ceros += cero;
                size_numCuenta++;
            }
            numCuentaFilled = ceros + numCuenta;
            if (numCuentaFilled.length() == 10) {
                cuentaValida = comprobarNumCuenta(numCuentaFilled);
            }

        }
        return cuentaValida;
    }

    public Cuenta tratarParametros(Map<String, String[]> parametros) {
        Cuenta cuenta = null;
        if (parametros != null && !parametros.isEmpty()) {
            cuenta = new Cuenta();
//            if (parametros.get(Constantes.FECHA_INI) != null && !parametros.get(Constantes.FECHA_INI)[0].isEmpty()) {
//
//                SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
//                java.util.Date parseDate = null;
//                try {
//                    parseDate = dateFormat.parse(parametros.get(Constantes.FECHA_INI)[0]);
//                    cuenta.setFecha_inicio(new Date(parseDate.getTime()));
//                } catch (ParseException ex) {
//                    Logger.getLogger(MovimientosServicios.class.getName()).log(Level.SEVERE, null, ex);
//                }
//            }
//            if (parametros.get(Constantes.FECHA_FIN) != null && !parametros.get(Constantes.FECHA_FIN)[0].isEmpty()) {
//
//                SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
//                java.util.Date parseDate = null;
//                try {
//                    parseDate = dateFormat.parse(parametros.get(Constantes.FECHA_FIN)[0]);
//                    cuenta.setFecha_fin(new Date(parseDate.getTime()));
//                } catch (ParseException ex) {
//                    Logger.getLogger(MovimientosServicios.class.getName()).log(Level.SEVERE, null, ex);
//                }
//            }
            if (parametros.get(Constantes.N_CUENTA) != null && !parametros.get(Constantes.N_CUENTA)[0].isEmpty()) {

                cuenta.setCu_ncu(Long.valueOf(parametros.get(Constantes.N_CUENTA)[0]));

            }

        }
        return cuenta;

    }

    public Cuenta buildCuentaFromList(String nCuenta, List<Cliente> clientes) {

        String dni1 = null;
        String dni2 = null;
        float saldo = 0;
        for (Cliente cliente : clientes) {
            if (dni1 == null) {
                dni1 = cliente.getCl_dni();
                saldo = cliente.getCl_sal();
            } else {
                dni2 = cliente.getCl_dni();
            }

        }
        return new Cuenta(Long.valueOf(nCuenta), dni1, dni2, saldo);
    }

    public Cuenta createNewAccount(Cuenta cuenta, List<Cliente> clientes) {
        ClientesServicios clientesServicios = new ClientesServicios();
        Cuenta cuentaDB = null;
        boolean isCuentaFinish = false;

        boolean isClientFinish = tratarClientes(clientes, clientesServicios, true);

        if (isClientFinish) {
            cuentaDB = insertCuenta(cuenta);
            if (cuentaDB != null) {
                isCuentaFinish = true;
            }
        }
        if (!isCuentaFinish && !isClientFinish) {//fallo en agregando registro en cuentas y clientes
            tratarClientes(clientes, clientesServicios, false);
        }
        return cuentaDB;
    }

    /**
     * Actualiza en DB la lista de clientes o inserta sino existen.
     *
     * @param clientes
     * @param clientesServicios
     * @param aumentar - true - suma num cuentas y saldo a clientes existentes
     * @return
     */
    public boolean tratarClientes(List<Cliente> clientes, ClientesServicios clientesServicios, boolean aumentar) {
        boolean isClientFinish = false;
        for (Cliente cliente : clientes) {
            Cliente clienteDB = clientesServicios.getCliente(cliente);

            if (clienteDB != null) {

                if (!aumentar) {//quitar datos de cliente

                    if (clienteDB.getCl_ncu() > 1) {//más de una cuenta ->  quitamos cuenta y saldo

                        if (clientesServicios.updateSaldoAndNcuentas(cliente, aumentar) != null) {
                            isClientFinish = true;
                        }

                    } else {//borramos cuenta

                        if (clientesServicios.deleteCliente(cliente) > 0) {
                            isClientFinish = true;
                        }
                    }

                } else {
                    clienteDB = clientesServicios.updateSaldoAndNcuentas(cliente, aumentar);
                }

                if (clienteDB != null) {//cliente actualizado en DB
                    isClientFinish = true;
                }

            } else {//no existe en BD
                clienteDB = clientesServicios.insertCliente(cliente);
                if (clienteDB != null) {//cliente actualizado en DB
                    isClientFinish = true;
                }
            }
        }
        return isClientFinish;
    }
}//fin clase
