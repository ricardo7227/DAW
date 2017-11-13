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
    
    public static final String resultadoQuery = "resultado";
    public static final String messageQueryAlumnoInserted = "El alumno fue insertado en la lista";
    public static final String messageQueryAlumnoUpdated = "El alumno fue actualizado en la lista";
    public static final String messageQueryAlumnoDeleted = "El alumno fue eliminado correctamente de la lista";
    public static final String messageQueryAlumnoDeletedFail = "Cuidado! el alumno tiene notas, Quieres borrarlo?";
    public static final String messageQueryAlumnoDeletedFailedAgain = "Seguimos sin poder borrar el alumno";
    
    public static final String messageQueryAsignaturaInserted = "Asignatura fue insertado en la lista";
    public static final String messageQueryAsignaturaInsertFailed = "Asignatura no agregada a la base de datos";
    public static final String messageQueryAsignaturaUpdated = "Asignatura actualizada correctamente";
    public static final String messageQueryAsignaturaUpdateFailed = "Error en la actualización de Asignatura";
    public static final String messageQueryAsignaturaDeleted = "Asignatura eliminada correctamente";
    public static final String messageQueryAsignaturaDeletedFail = "Cuidado! Tienes alumnos que estan cursando esta asignatura. Estás Seguro?";
    public static final String messageQueryAsignaturaDeletedFailedAgain = "Problemas graves, no pudimos borrar la Asignatura";
    
    public static final String messageQueryNotaMissing = "No tiene nota";
    public static final String messageQueryNotaUpdated = "Hemos actualizado la nota correctamente";
    public static final String messageQueryNotaUpdatedFail = "Falló en la actualización de Nota";
    
    
}

