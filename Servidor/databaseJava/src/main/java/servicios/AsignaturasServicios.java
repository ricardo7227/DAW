/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import dao.AsignaturasDAO;
import java.io.UnsupportedEncodingException;

import java.util.Iterator;
import java.util.List;
import java.util.Map;


import model.Asignatura;

import utils.SqlQuery;

/**
 *
 * @author daw
 */
public class AsignaturasServicios {

    AsignaturasDAO dao;

    public AsignaturasServicios() {
        dao = new AsignaturasDAO();
    }

    public List<Asignatura> getAllAsignaturasdbUtils() {

        return dao.getAllAsignaturasdbUtils();
    }

    public boolean insertAsignaturadbUtils(Asignatura a) {
        return dao.insertAsignaturadbUtils(a);
    }
    

    public int updateAsignaturadbUtils(Asignatura asignatura) {
        return dao.updateAsignaturasdbUtils(asignatura);
    }

    public int deleteAsignaturadbUtils(String key) {
        return dao.deleteAsignaturadbUtils(key);
    }

    public Asignatura tratarParametros(Map<String, String[]> parametros) throws UnsupportedEncodingException {
        Asignatura asignatura = null;
        if (parametros != null && !parametros.isEmpty()) {

            asignatura = new Asignatura();

            Iterator<String> it = parametros.keySet().iterator();

            while (it.hasNext()) {
                String key = (String) it.next();
                String[] values = (String[]) parametros.get(key);
                if (values[0] != null && !values[0].isEmpty()) {

                    if (SqlQuery.ID.equalsIgnoreCase(key)) {
                        asignatura.setId(Long.valueOf(values[0]));
                    } else if (SqlQuery.NOMBRE.equalsIgnoreCase(key)) {
                        asignatura.setNombre(new String(values[0].getBytes("UTF-8")));
                    } else if (SqlQuery.CURSO.equalsIgnoreCase(key)) {

                        asignatura.setCurso(new String(values[0].getBytes("UTF-8")));

                    } else if (SqlQuery.CICLO.equalsIgnoreCase(key)) {
                        asignatura.setCiclo(new String(values[0].getBytes("UTF-8")));

                    }
                }

            }

        }
        return asignatura;
    }
}//FIN CLASE
