/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package utils;

/**
 *
 * @author oscar
 */
public class Constantes {
    
    public static String alumnosList = "alumnosList";
    public static String asignaturasList = "asignaturasList";
    public static String notaResult = "notaResult";
    public static String notaMessage = "notaMessage";
    
    public static String alumnoResult = "alumnoResult";
    public static String asignaturaResult = "asignaturaResult";
    
    public static String alumnosJSP = "resultadosJsp.jsp";
    public static String asignaturasJSP = "asignaturasjsp.jsp";
    public static String notasJSP = "notasjsp.jsp";
    
    public static String actionJSP = "action";
    
    public static final String INSERT = "INSERT";
    public static final String UPDATE = "UPDATE";
    public static final String DELETE = "DELETE";
    public static final String VIEW = "VIEW";
    public static final String DELETE_FORCE = "DELETE_FORCE";
    
    //Columnas User
    public static final String USER = "USER";
    public static final String ID = "ID";
    public static final String NOMBRE = "NOMBRE";
    public static final String PASSWORD = "PASSWORD";
    public static final String ACTIVO = "ACTIVO";
    public static final String CODIGO_ACTIVACION = "CODIGO_ACTIVACION";
    public static final String FECHA_ACTIVACION = "FECHA_ACTIVACION";
    public static final String EMAIL = "EMAIL";
    
    public static  String resultadoQuery = "resultado";
    public static  String messageQueryAlumnoInserted = "El alumno fue insertado en la lista";
    public static  String messageQueryAlumnoInsertedFail = "Alumno no agregado en la lista, vuelve a intentarlo";
    public static  String messageQueryAlumnoUpdated = "El alumno fue actualizado en la lista";
    public static  String messageQueryAlumnoUpdatedFail = "Problemas actualizando el alumno, inténtalo otra vez";
    public static  String messageQueryAlumnoDeleted = "El alumno fue eliminado correctamente de la lista";
    public static  String messageQueryAlumnoDeletedFail = "Cuidado! el alumno tiene notas, Quieres borrarlo?";
    public static  String messageQueryAlumnoDeletedFailedAgain = "Seguimos sin poder borrar el alumno";
    
    public static  String messageQueryAsignaturaInserted = "Asignatura fue insertado en la lista";
    public static  String messageQueryAsignaturaInsertFailed = "Asignatura no agregada a la base de datos";
    public static  String messageQueryAsignaturaUpdated = "Asignatura actualizada correctamente";
    public static  String messageQueryAsignaturaUpdateFailed = "Error en la actualización de Asignatura";
    public static  String messageQueryAsignaturaDeleted = "Asignatura eliminada correctamente";
    public static  String messageQueryAsignaturaDeletedFail = "Cuidado! Tienes alumnos que estan cursando esta asignatura. Estás Seguro?";
    public static  String messageQueryAsignaturaDeletedFailedAgain = "Problemas graves, no pudimos borrar la Asignatura";
    
    public static  String messageQueryNotaMissing = "No tiene nota";
    public static  String messageQueryNotaUpdated = "Hemos actualizado la nota correctamente";
    public static  String messageQueryNotaUpdatedFail = "Falló en la actualización de Nota";
    
    
    
    
}

