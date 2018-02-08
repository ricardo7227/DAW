/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import dao.CuentasDAO;
import java.sql.Date;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import model.Cuenta;
import model.MovimientosFechas;
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

}//fin clase
