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
public class Api {
    public static final String BASE_URL_CRUD = "https://f2dfec45-70cc-404e-ae25-71e1cd140bf0.mock.pstmn.io/";
    //public static final String BASE_URL_CRUD = "http://localhost:8080/databaseJavaRest/rest/";
    
    //end-points
    public static String END_POINT_ALUMNOS = BASE_URL_CRUD + "alumnos";
    public static String END_POINT_ASIGNATURAS = BASE_URL_CRUD + "asignaturas";
    public static String END_POINT_NOTAS = BASE_URL_CRUD + "notas";
    
    //TODO BORRAR
    public static String END_POINT_GetNodesLines= BASE_URL_CRUD + "/bus/GetNodesLines.php";
    
    
    
}
