/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

/**
 *
 * @author daw
 */
public class CuentasServicios {

    public CuentasServicios() {
    }

    public boolean comprobarNumCuenta(String numCuenta) {
        boolean cuentaValida = false;
        if (numCuenta != null && !numCuenta.isEmpty() && numCuenta.length() == 10) {
            String corte1 = numCuenta.substring(0, numCuenta.length() - 1);
            char corte2 = numCuenta.charAt(numCuenta.length());

            if (corte1.matches("[0-9]{9}") && Character.isDigit(corte2)) {
                int param1 = 0;

                char[] arrayCorte1 = corte1.toCharArray();
                for (char val : arrayCorte1) {
                    param1 += Integer.valueOf(val);
                }

                int param2 = Integer.valueOf(corte2);
                if (param1 % 9 == param2) {
                    cuentaValida = true;
                } else {
                    //no cumple mod
                }

            } else {
                //no son numeros
            }
        } else {
            //no cumple minimos
        }
        return cuentaValida;
    }
    
    
}//fin clase
