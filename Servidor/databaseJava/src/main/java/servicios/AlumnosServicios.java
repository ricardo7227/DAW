/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servicios;

import dao.AlumnosDAO;
import java.io.UnsupportedEncodingException;
import java.sql.Date;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Iterator;
import java.util.List;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import model.Alumno;
import servlets.AlumnosServlet;
import utils.SqlQuery;

/**
 *
 * @author oscar
 */
public class AlumnosServicios {

    private AlumnosDAO dao;
    
    public AlumnosServicios() {
        dao = new AlumnosDAO();
    }
    
    
    
    
    public List<Alumno> getAllAlumnos()
    {               
        return dao.getAllAlumnosJDBC();
    }
    
    
    public boolean addAlumno(Alumno alumnoNuevo)
    {
        
        return true;
    }
    
    public boolean updateAlumnoJDBC(Alumno alumno){
       return dao.updateUserJDBC(alumno);
    }
    
    public boolean insertAlumnoJDBC(Alumno alumno){
        return dao.insertUserJDBC(alumno);
    }
    
    public  boolean deleteAlumnoJDBC(String id){
        return dao.deleteUserByIdJDBC(id);
    }
    
    /**
     * 
     * @param parametros
     * @return objeto alumno con sus parametros correspondientes
     * @throws UnsupportedEncodingException 
     */
    public Alumno tratarParametros(Map<String, String[]> parametros) throws UnsupportedEncodingException {
        Alumno alumno = null;
        if (parametros != null && !parametros.isEmpty()) {
            
            alumno = new Alumno();
            
            Iterator<String> it = parametros.keySet().iterator();

            while (it.hasNext()) {
                String key = (String) it.next();
                String[] values = (String[]) parametros.get(key);
                if (values[0] != null && !values[0].isEmpty()) {

                    if (SqlQuery.ID.equalsIgnoreCase(key)) {
                        alumno.setId(Long.valueOf(values[0]));
                    } else if (SqlQuery.NOMBRE.equalsIgnoreCase(key)) {
                        alumno.setNombre(values[0]);
                    } else if (SqlQuery.FECHA_NACIMIENTO.equalsIgnoreCase(key)) {
                        SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                        java.util.Date parseDate = null;
                        try {
                            parseDate = dateFormat.parse(values[0]);
                            alumno.setFecha_nacimiento(new Date(parseDate.getTime()));
                        } catch (ParseException ex) {
                            Logger.getLogger(AlumnosServlet.class.getName()).log(Level.SEVERE, null, ex);
                        }

                    } else if (SqlQuery.MAYOR_EDAD.equalsIgnoreCase(key)) {
                        alumno.setMayor_edad("on".equals(values[0]) ? Boolean.TRUE : Boolean.FALSE);
                    }
                }

            }

        }
        return alumno;
    }
    
}//fin clase
