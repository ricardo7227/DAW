/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import dao.CuentasDAO;
import model.Cuenta;

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
                for (char val : arrayCorte1) {//TODO suma mal
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

}//fin clase
