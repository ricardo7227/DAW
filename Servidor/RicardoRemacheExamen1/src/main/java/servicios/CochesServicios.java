/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import dao.CochesDAO;
import java.io.UnsupportedEncodingException;
import java.sql.Date;
import java.sql.SQLException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.List;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;

import model.Coche;
import utils.Constantes;

/**
 *
 * @author oscar
 */
public class CochesServicios {

    public CochesServicios() {

    }

    public List<Coche> getAllcoches() {
        CochesDAO dao = new CochesDAO();
        return dao.getAllCochesJDBC();
    }

    public boolean updateCocheJDBC(Coche coche) {
        CochesDAO dao = new CochesDAO();
        return dao.updateCocheJDBC(coche);
    }

    public boolean insertCocheJDBC(Coche coche) {
        CochesDAO dao = new CochesDAO();
        return dao.insertCocheJDBC(coche);
    }

    public int deleteCocheJDBC(String id) {
        CochesDAO dao = new CochesDAO();
        return dao.deleteCocheByIdJDBC(id);
    }
    
    public boolean deleteCocheForce(int i) throws SQLException {
        CochesDAO dao = new  CochesDAO();
        return dao.deleteCocheByIddbUtils(i);
    }

    /**
     *
     * @param parametros
     * @return objeto  con sus parametros correspondientes
     * @throws UnsupportedEncodingException
     */
     public Coche tratarParametros(Map<String, String[]> parametros) {
        Coche coche = null;
        if (parametros != null && !parametros.isEmpty()) {
            coche = new Coche();
            if (parametros.get(Constantes.COCHE) != null && !parametros.get(Constantes.COCHE)[0].isEmpty()) {
                coche.setCoche(parametros.get(Constantes.COCHE)[0]);
            }
            if (parametros.get(Constantes.COMPRADO) != null && !parametros.get(Constantes.COMPRADO)[0].isEmpty()) {
                coche.setComprado(parametros.get(Constantes.COMPRADO)[0]);
            }
            if (parametros.get(Constantes.FECHA_COMPRA) != null && !parametros.get(Constantes.FECHA_COMPRA)[0].isEmpty()) {

                SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                java.util.Date parseDate = null;
                try {
                    parseDate = dateFormat.parse(parametros.get(Constantes.FECHA_COMPRA)[0]);
                    coche.setFecha_compra(new Date(parseDate.getTime()));
                } catch (ParseException ex) {
                    Logger.getLogger(LoginServicios.class.getName()).log(Level.SEVERE, null, ex);
                }
            }

        }
        
        
        return coche;

    }

    

}//fin clase
