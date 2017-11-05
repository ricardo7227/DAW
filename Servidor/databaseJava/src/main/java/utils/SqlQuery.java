/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package utils;

/**
 *
 * @author daw
 */
public class SqlQuery {
    
    //Nombre columnas tabla Alumnos
    public static String ID = "ID";
    public final static String NOMBRE = "NOMBRE";
    public static String FECHA_NACIMIENTO = "FECHA_NACIMIENTO";
    public static String MAYOR_EDAD = "MAYOR_EDAD";
    
    public static String SELECT_ALL_ALUMNOS = "SELECT * FROM ALUMNOS";
    public static String UPDATE_ALUMNO = "UPDATE ALUMNOS SET NOMBRE = ? , FECHA_NACIMIENTO = ?, MAYOR_EDAD = ? WHERE ID = ?";
    public static String INSERT_ALUMNO = "INSERT INTO ALUMNOS (NOMBRE, FECHA_NACIMIENTO, MAYOR_EDAD)  VALUES ( ?, ?, ?)";
    public static String DELETE_ALUMNO = "DELETE FROM ALUMNOS WHERE ID = ? ";
    
    //public static String UPDATE_ALUMNO = "UPDATE ALUMNOS SET NOMBRE =\" ? \", FECHA_NACIMIENTO = str_to_date(\"?\",\"%d-%m-%Y\"), MAYOR_EDAD = ? WHERE ID = ?";

}
