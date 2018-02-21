/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package utilidades;

/**
 *
 * @author Gato
 */
public class SqlQuery {
    
    //USERS
    public static String SELECT_USER_BY_NAME_EMAIL = "SELECT * FROM USERS WHERE NOMBRE = ? AND EMAIL = ?";
    public static String SELECT_USER_BY_NAME_EMAIL_CODIGO_ACTIVACION = "SELECT * FROM USERS WHERE NOMBRE = ? AND EMAIL = ? AND CODIGO_ACTIVACION = ?";
    public static String SELECT_USER_BY_NAME = "SELECT * FROM USERS WHERE NOMBRE = ?";
    public static String SELECT_USER_BY_NAME_PASSWORD = "SELECT * FROM USERS WHERE NOMBRE = ? AND PASSWORD = ?";
    public static String SELECT_USER_BY_EMAIL = "SELECT * FROM USERS WHERE EMAIL = ?";
    public static String INSERT_USER = "INSERT INTO USERS (NOMBRE, PASSWORD, CODIGO_ACTIVACION, FECHA_ACTIVACION, EMAIL) VALUES(?,?,?,?,?)";
    public static String UPDATE_USER_ACTIVO_ON = "UPDATE USERS SET ACTIVO = 1 WHERE ID = ?";
    
}
