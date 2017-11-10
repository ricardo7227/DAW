/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import dao.NotasDAO;
import java.util.Iterator;
import java.util.Map;
import model.Asignatura;
import model.Nota;
import utils.SqlQuery;

/**
 *
 * @author daw
 */
public class NotasServicios {

    NotasDAO dao;

    public NotasServicios() {
        dao = new NotasDAO();
    }

    public Nota getNota(int idAlumno, int Asignatura) {
        return dao.getNotaJDBC(idAlumno, Asignatura);
    }

    public int[] tratarParametros(Map<String, String[]> parametros) {
        int claves [] = null;
        if (parametros != null && !parametros.isEmpty()) {

            claves = new int[2];

            Iterator<String> it = parametros.keySet().iterator();

            while (it.hasNext()) {
                String key = (String) it.next();
                String[] values = (String[]) parametros.get(key);
                if (values[0] != null && !values[0].isEmpty()) {

                    if (SqlQuery.ID_ALUMNO.equalsIgnoreCase(key)) {
                        claves[0] = Integer.valueOf(values[0]);
                    } else if (SqlQuery.ID_ASIGNATURA.equalsIgnoreCase(key)) {
                        claves[1] = Integer.valueOf(values[0]);
                    }  
                }

            }

        }
        return claves;
    }

}//fin clase
