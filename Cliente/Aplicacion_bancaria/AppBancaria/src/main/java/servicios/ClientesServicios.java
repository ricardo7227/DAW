/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import dao.ClientesDAO;
import java.sql.Date;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import model.Cliente;
import org.json.JSONArray;
import org.json.JSONObject;
import utils.Constantes;

/**
 *
 * @author Gato
 */
public class ClientesServicios {

    public ClientesServicios() {
    }

    public Cliente tratarParametros(Map<String, String[]> parametros) {
        Cliente cliente = null;
        if (parametros != null && !parametros.isEmpty()) {
            cliente = new Cliente();
            if (parametros.get(Constantes.CLIENTE_DNI) != null && !parametros.get(Constantes.CLIENTE_DNI)[0].isEmpty()) {

                cliente.setCl_dni(parametros.get(Constantes.CLIENTE_DNI)[0]);

            }
            if (parametros.get(Constantes.CLIENTE_NOMBRE) != null && !parametros.get(Constantes.CLIENTE_NOMBRE)[0].isEmpty()) {

                cliente.setCl_nom(parametros.get(Constantes.CLIENTE_NOMBRE)[0]);

            }
            if (parametros.get(Constantes.CLIENTE_DIRECCION) != null && !parametros.get(Constantes.CLIENTE_DIRECCION)[0].isEmpty()) {

                cliente.setCl_dir(parametros.get(Constantes.CLIENTE_DIRECCION)[0]);

            }
            if (parametros.get(Constantes.CLIENTE_TELEFONO) != null && !parametros.get(Constantes.CLIENTE_TELEFONO)[0].isEmpty()) {

                cliente.setCl_tel(Long.valueOf(parametros.get(Constantes.CLIENTE_TELEFONO)[0]));

            }
            if (parametros.get(Constantes.CLIENTE_EMAIL) != null && !parametros.get(Constantes.CLIENTE_EMAIL)[0].isEmpty()) {

                cliente.setCl_ema(parametros.get(Constantes.CLIENTE_EMAIL)[0]);

            }
            if (parametros.get(Constantes.CLIENTE_F_NACIMIENTO) != null && !parametros.get(Constantes.CLIENTE_F_NACIMIENTO)[0].isEmpty()) {

                SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                java.util.Date parseDate = null;
                try {
                    parseDate = dateFormat.parse(parametros.get(Constantes.CLIENTE_F_NACIMIENTO)[0]);
                    cliente.setCl_fna(new Date(parseDate.getTime()));
                } catch (ParseException ex) {
                    Logger.getLogger(ClientesServicios.class.getName()).log(Level.SEVERE, null, ex);
                }
            }
            if (parametros.get(Constantes.CLIENTE_F_CL_CREA) != null && !parametros.get(Constantes.CLIENTE_F_CL_CREA)[0].isEmpty()) {

                SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                java.util.Date parseDate = null;
                try {
                    parseDate = dateFormat.parse(parametros.get(Constantes.CLIENTE_F_CL_CREA)[0]);
                    cliente.setCl_fna(new Date(parseDate.getTime()));
                } catch (ParseException ex) {
                    Logger.getLogger(ClientesServicios.class.getName()).log(Level.SEVERE, null, ex);
                }
            }
            if (parametros.get(Constantes.CLIENTE_NUM_CUENTAS) != null && !parametros.get(Constantes.CLIENTE_NUM_CUENTAS)[0].isEmpty()) {

                cliente.setCl_ncu(Integer.valueOf(parametros.get(Constantes.CLIENTE_NUM_CUENTAS)[0]));

            }
            if (parametros.get(Constantes.CLIENTE_SALDO) != null && !parametros.get(Constantes.CLIENTE_SALDO)[0].isEmpty()) {

                cliente.setCl_sal(Long.valueOf(parametros.get(Constantes.CLIENTE_SALDO)[0]));

            }

        }
        return cliente;

    }

    public boolean clienteExist(Cliente cliente) {
        ClientesDAO dao = new ClientesDAO();
        return dao.getNumClienteJDBCTemplate(cliente) != null;
    }

    public Cliente getCliente(Cliente cliente) {
        ClientesDAO dao = new ClientesDAO();
        return dao.getNumClienteJDBCTemplate(cliente);
    }

    public boolean checkDni(String dni_input) {
        boolean isValid = false;
        if (dni_input != null && !dni_input.isEmpty() && dni_input.length() == 9) {
            isValid = dni_input.matches("(?i)[0-9]{8}[A-Z]{1}");
        }
        return isValid;
    }

    /**
     *
     * @param cliente
     * @param plus - true para sumar, false para restar saldo y cuentas
     * @return cliente o null
     */
    public Cliente updateSaldoAndNcuentas(Cliente cliente, boolean plus) {
        ClientesDAO dao = new ClientesDAO();
        return (plus) ? dao.updateSaldoAndNCuentasPlusJDBCTemplate(cliente) : dao.updateSaldoAndNCuentasMinusJDBCTemplate(cliente);
    }

    public Cliente updateSaldo(Cliente cliente) {
        ClientesDAO dao = new ClientesDAO();
        return dao.updateSaldoByDNIJDBCTemplate(cliente);
    }

    public Cliente insertCliente(Cliente cliente) {
        ClientesDAO dao = new ClientesDAO();
        return dao.insertClienteJDBCTemplate(cliente);
    }

    public int deleteCliente(Cliente cliente) {
        ClientesDAO dao = new ClientesDAO();
        return dao.deleteClienteJDBCTemplate(cliente);
    }

    public float getSaldo(String saldo) {

        return (saldo != null) ? Float.valueOf(saldo) : 0;
    }

    public List<Cliente> checkAndGetClientes(JSONArray titulares, String saldo) {
        Gson gson = new GsonBuilder()
                .setDateFormat("yyyy-MM-dd").create();
        List<Cliente> clientes = new ArrayList<>();
        String dniTemp = null;
        boolean isDuplicateClient = false;
        ValidadorServicios validar = new ValidadorServicios();
        float importe = getSaldo(saldo);
        if (importe > 0) {

            for (Object titular : titulares) {
                if (titular instanceof JSONObject) {

                    JSONObject jsTitular = (JSONObject) titular;
                    Cliente newCLiente = gson.fromJson(jsTitular.toString(), Cliente.class);
                    boolean isClientValid = validar.validateModel(newCLiente);

                    if (isClientValid) {

                        if (dniTemp != null && dniTemp.equals(newCLiente.getCl_dni())) {
                            isDuplicateClient = true;
                        } else {
                            dniTemp = newCLiente.getCl_dni();
                        }
                        if (!isDuplicateClient) {
                            newCLiente.setCl_sal(importe);
                            clientes.add(newCLiente);
                        }
                    }

                }
            }
        }
        return clientes;
    }

    public boolean updateSaldoClientes(List<Cliente> clientes) {
        boolean isFinish = false;
        for (Cliente cliente : clientes) {

            if (updateSaldo(cliente) != null) {
                isFinish = true;
            }
        }
        return isFinish;
    }

}//fin clase
